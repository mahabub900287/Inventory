<?php

namespace App\Services\Company\Delivery;

use App\Models\Bundle;
use Throwable;
use App\Models\Product;
use App\Models\Delivery;
use Illuminate\Support\Str;
use App\Services\BaseService;
use App\Models\DeliveryProduct;
use App\Models\ProductStock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DeliveryService extends BaseService
{
	protected $model;
	public function __construct(Delivery $model)
	{
		parent::__construct($model);
	}

	public function createOrUpdate($data, $id = null)
	{
		isset($data['inbound']) ? $data['inbound'] = 1 : $data['inbound'] = 0;
		if ($id) {
			try {
				DB::beginTransaction();
				$data['updated_by'] = Auth::id();
				$delivery_metarial = $this->mergeDataForJson($data);
				$data['delivery_metarial'] = $delivery_metarial;

				$delivery = $this->model->findOrFail($id)->update($data);
				// Upload new data
				if (isset($data['product_id']) && count($data['product_id']) > 0) {
					// Delete old data
					$removed = DeliveryProduct::where('delivery_id', $id)->delete();
					foreach ($data['product_id'] as $key => $item) {
						$attribute_item = new DeliveryProduct();
						$attribute_item->delivery_id = $id;
						$data['product_type'] == 0 ? $attribute_item->product_id = $item : $attribute_item->bundle_id = $item;
						$attribute_item->quantity = $data['product_qty'][$key];
						$attribute_item->tracking_number = $data['product_tracking'][$key];
						$attribute_item->save();
					}
					if (isset($data['uploaded_file']) && $data['uploaded_file']) {
						$items = $this->excelImport($data['uploaded_file'], $delivery->id);
						if (count($items) > 0) {
							foreach ($items as $key => $item) {
								$attribute_item = new DeliveryProduct();
								$attribute_item->delivery_id = $delivery->id;
								$attribute_item->product_id = $item['product_id'];
								$attribute_item->bundle_id = $item['bundle_id'];
								$attribute_item->quantity = $item['quantity'];
								$attribute_item->tracking_number = $item['tracking_number'];
								$attribute_item->save();
							}
						}
					}
				}
				DB::commit();
				return true;
			} catch (Throwable $th) {
				DB::rollback();
				throw $th;
			}
		} else {
			try {
				$delivery_metarial = $this->mergeDataForJson($data);
				DB::beginTransaction();
				$data['created_by'] = Auth::id();
				$data['delivery_metarial'] = $delivery_metarial;
				$delivery = $this->model::create($data);
				// Upload attribute items
				if (isset($data['product_id']) && count($data['product_id']) > 0) {
					foreach ($data['product_id'] as $key => $item) {
						$attribute_item = new DeliveryProduct();
						$attribute_item->delivery_id = $delivery->id;
						$data['product_type'] == 0 ? $attribute_item->product_id = $item : $attribute_item->bundle_id = $item;
						$attribute_item->quantity = $data['product_qty'][$key];
						$attribute_item->tracking_number = $data['product_tracking'][$key];
						$attribute_item->save();
					}
				}
				if (isset($data['uploaded_file']) && $data['uploaded_file']) {
					$items = $this->excelImport($data['uploaded_file'], $delivery->id);

					if (count($items) > 0) {
						foreach ($items as $key => $item) {
							$attribute_item = new DeliveryProduct();
							$attribute_item->delivery_id = $delivery->id;
							$attribute_item->product_id = $item['product_id'];
							$attribute_item->bundle_id = $item['bundle_id'];
							$attribute_item->quantity = $item['quantity'];
							$attribute_item->tracking_number = $item['tracking_number'];
							$attribute_item->save();
						}
					}
				}
				DB::commit();
				return true;
			} catch (Throwable $th) {
				DB::rollback();
				throw $th;
			}
		}
	}
	public function deleteItem($id)
	{
		try {
			// Delete delivery item
			$items = DeliveryProduct::where('delivery_id', $id)->delete();
			// foreach ($items as $item) {
			// 	$item->delete();
			// }
			// Delete delivery
			$data = $this->model::findOrFail($id);
			return $data->delete();
		} catch (Throwable $th) {
			throw $th;
		}
	}

	public function mergeDataForJson($data)
	{

		if (count($data['parcel_qty']) > 0) {
			foreach ($data['parcel_qty'] as $key => $value) {
				$data['delivery_metarial'][$key] = [
					'parcel_qty' => $value,
					'parcel_tracking' => $data['parcel_tracking'][$key],
				];
			}

			return json_encode($data['delivery_metarial']);
		}
	}

	public function excelImport($the_file, $id)
	{

		try {
			$spreadsheet = IOFactory::load($the_file->getRealPath());
			$sheet        = $spreadsheet->getActiveSheet();
			$row_limit    = $sheet->getHighestDataRow();
			$column_limit = $sheet->getHighestDataColumn();
			$row_range    = range(2, $row_limit);
			$column_range = range('F', $column_limit);
			$startcount = 2;
			$data = array();
			foreach ($row_range as $row) {
				$product_id = Product::select('id')->where('sku', $sheet->getCell('A' . $row)->getValue())->first();
				$bundle_id = Bundle::select('id')->where('sku', $sheet->getCell('B' . $row)->getValue())->first();
				$data[] = [
					'delivery_id' => $id,
					'product_id' => $product_id ? $product_id->id : null,
					'bundle_id' => $bundle_id ? $bundle_id->id : null,
					'quantity' => $sheet->getCell('C' . $row)->getValue(),
					'tracking_number' => $sheet->getCell('D' . $row)->getValue()
				];
				$startcount++;
			}

			return $data;
		} catch (Throwable $th) {
			throw $th;
		}
	}

	public function change_status($id, $status)
	{

		$data = $this->model::with('deliveryProducts')->findOrFail($id);
		$data->status = $status;
		$data->save();
		if ($data->status == 'completed') {
			if ($this->stockUpdate($data)) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	public function stockUpdate($data)
	{

		if ($data->deliveryProducts->count() > 0) {
			if ($data->product_type == 0) {
				foreach ($data->deliveryProducts as $key => $value) {
					$productStock = ProductStock::where('product_id', $value->product_id)->where('warehouse_id', $data->warehouse_id)->first();
					if ($productStock) {
						$productStock->update([
							'stock' => $productStock->stock + $value->quantity
						]);
					} else {
						$update = ['product_id' => $value->product_id, 'warehouse_id' => $data->warehouse_id, 'stock' => $value->quantity];
						ProductStock::create($update);
					}
				}
			}
			return true;
		}
		if ($data->deliveryBundles->count() > 0) {
			if ($data->product_type == 1) {
				dd('bundle');
				foreach ($data->deliveryBundles as $key => $value) {
					$productStock = ProductStock::where('bundle_id', $value->bundle_id)->where('warehouse_id', $data->warehouse_id)->first();
					if ($productStock) {
						$productStock->update([
							'stock' => $productStock->stock + $value->quantity
						]);
					} else {
						$update = ['bundle_id' => $value->bundle_id, 'warehouse_id' => $data->warehouse_id, 'stock' => $value->quantity];
						ProductStock::create($update);
					}
				}
			}
			return true;
		}
		return false;
	}
}
