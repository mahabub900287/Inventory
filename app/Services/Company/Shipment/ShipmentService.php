<?php

namespace App\Services\Company\Shipment;

use App\Models\Bundle;
use App\Models\Country;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\WareHouse;
use Illuminate\Support\Str;
use App\Services\BaseService;
use App\Models\CustomerAddress;
use App\Models\ProductShipment;
use App\Models\PackagingMaterial;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class ShipmentService extends BaseService
{
    protected $model;

    public function __construct()
    {
        $this->model = Shipment::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        try {
            $data['updated_by'] = auth()->user()->id;
            $address_id = $this->storeOrUpdateAddress($data);
            $data['customer_address_id'] = $address_id;
            if ($id != null) {
            } else {
                $data['created_by'] = auth()->user()->id;
            }
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
    public function storeOrUpdateAddress($data, $id = null)
    {
        try {
            if (isset($data['address_id'])) {
                $address = CustomerAddress::where('id', $data['address_id'])->first();
                $address->update([
                    'country_id' => $data['country_id'],
                    'user_id' => auth()->user()->id,
                    'street'    => $data['street'],
                    'phone' => $data['phone'],
                    'additional' => $data['additional'],
                    'post_code' => $data['post_code'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'company_name' => $data['company_name'],
                    'company_email' => $data['company_email'],
                    'company_phone' => $data['company_number']
                ]);
            } else {
                $address = CustomerAddress::create([
                    'country_id' => $data['country_id'],
                    'user_id' => auth()->user()->id,
                    'street'    => $data['street'],
                    'phone' => $data['phone'],
                    'additional' => $data['additional'],
                    'post_code' => $data['post_code'],
                    'city' => $data['city'],
                    'state' => $data['state'] ?? '',
                    'company_name' => $data['company_name'],
                    'company_email' => $data['company_email'],
                    'company_phone' => $data['company_number']
                ]);
            }
            return  $address->id;
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function productShipment($data, $shipment_id)
    {
        try {
            ProductShipment::where('shipment_id', $shipment_id)->delete();
            $data['products'] = array_combine($data['products'], $data['quantity']);
            foreach ($data['products'] as $key => $item) {
                $shipment_item = new ProductShipment();
                if ($data['type'] == 'product') {
                    $shipment_item->product_id = $key;
                }
                if ($data['type'] == 'bundle') {
                    $shipment_item->bundle_id = $key;
                }
                $shipment_item->shipment_id = $shipment_id;
                $shipment_item->quantity = $item;
                $shipment_item->save();
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function excelUpload($data)
    {
        try {
            if ($data['uploaded_file']) {
                $items = $this->excelImport($data['uploaded_file']);
                foreach ($items as $item) {
                    $item['updated_by'] = Auth::id();
                    $country = Country::where('shortname', strtoupper($item['country_code']))->first();
                    $warehouse = WareHouse::where('serial_code', $item['serial_code'])->first();
                    $item['country_id']  = $country->id;
                    $address_id = $this->storeOrUpdateAddress($item);

                    $shipment = new Shipment();
                    $shipment->warehouse_id = $warehouse->id;
                    $shipment->customer_address_id  = $address_id;
                    $shipment->order_number  = $item['order_number'];
                    if (!is_null($item['product_sku'])) {
                        $shipment->type  = 'product';
                    } else {
                        $shipment->type  = 'bundle';
                    }
                    $shipment->invoice_number = $item['invoice_number'];
                    $shipment->type_of_good = $item['type_of_good'];
                    $shipment->updated_by = $item['updated_by'];
                    $shipment->created_by = $item['updated_by'];
                    $shipment->save();

                    if ($shipment) {
                        $shipment_item = new ProductShipment();
                        if (!is_null($item['product_sku'])) {
                            $product = Product::where('sku', $item['product_sku'])->first();
                            $shipment_item->product_id = $product->id;
                        } else {
                            $bundle = Bundle::where('sku', $item['bundle_sku'])->first();
                            $shipment_item->bundle_id = $bundle->id;
                        }
                        $shipment_item->shipment_id = $shipment->id;
                        $shipment_item->quantity = $item['quantity'];
                        $shipment_item->save();
                    }
                }
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function excelImport($the_file)
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
                $data[] = [
                    'order_number' => $sheet->getCell('A' . $row)->getValue(),
                    'company_name'  => $sheet->getCell('B' . $row)->getValue(),
                    'company_email' => $sheet->getCell('C' . $row)->getValue(),
                    'company_number' => $sheet->getCell('D' . $row)->getValue(),
                    'street' => $sheet->getCell('E' . $row)->getValue(),
                    'phone' => $sheet->getCell('F' . $row)->getValue(),
                    'additional' => $sheet->getCell('G' . $row)->getValue(),
                    'post_code' => $sheet->getCell('H' . $row)->getValue(),
                    'city' => $sheet->getCell('I' . $row)->getValue(),
                    'country_code' => $sheet->getCell('J' . $row)->getValue(),
                    'type_of_good' => $sheet->getCell('K' . $row)->getValue(),
                    'invoice_number' => $sheet->getCell('L' . $row)->getValue(),
                    'product_sku' => $sheet->getCell('M' . $row)->getValue(),
                    'bundle_sku' => $sheet->getCell('N' . $row)->getValue(),
                    'quantity' => $sheet->getCell('O' . $row)->getValue(),
                    'serial_code' => $sheet->getCell('P' . $row)->getValue(),
                ];
                $startcount++;
            }
            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
