<?php

namespace App\Services\Company\Product;

use App\Models\Country;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Services\BaseService;
use App\Models\SystemSettings;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class ProductService extends BaseService
{
    protected $model;

    public function __construct()
    {
        $this->model = Product::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        try {
            if ($id == null) {
                $data['created_by'] = auth()->user()->id;
            }
            $data['updated_by'] = auth()->user()->id;
            isset($data['prepacked']) ? $data['prepacked'] = 1 : $data['prepacked'] = 0;
            $data['sku'] = Str::replace(' ', '', $data['sku']);
            $data['status'] = 'active';
            if ($data['prepacked'] == 1) {
                $data['prepacked_metarial'] = json_encode([
                    'length' => $data['pre_length'],
                    'width'  => $data['pre_width'],
                    'height' => $data['pre_height']
                ]);
            }
            if ($data['prepacked'] == 0) {
                $data['prepacked_metarial'] = null;
            }
            // Call patent method
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
    public function excelUpload($data)
    {
        try {
            if ($data['uploaded_file']) {
                $items = $this->excelImport($data['uploaded_file']);
                $validationRules = [
                    'name' => 'required|unique:products,name',
                    'type' => 'nullable',
                    'prepacked' => 'nullable',
                    'weight' => 'required|string',
                    'description' => 'nullable|string',
                    'tariff_number' => 'required|string',
                    'country_code' => 'required|string',
                ];
                if (count($items) > 0) {
                    foreach ($items as $key => $item) {
                        $validator = Validator::make($item, $validationRules);
                        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $randomLetters = substr(str_shuffle($letters), 0, 3); // You can adjust the number of letters as needed
                        $randomNumbers = rand(1000, 9999);
                        $sku = 'CODE' . $randomNumbers;
                        $country = Country::where('shortname', strtoupper($item['country_code']))->first();
                        $attribute_item = new Product();
                        $attribute_item->name = $item['name'];
                        $attribute_item->sku = $sku;
                        $attribute_item->type  = $item['type'];
                        $attribute_item->prepacked  = $item['prepacked'];
                        $attribute_item->prepacked_metarial  = $item['prepacked_metarial'];
                        $attribute_item->weight  = $item['weight'];
                        $attribute_item->description  = $item['description'];
                        $attribute_item->tariff_number  = $item['tariff_number'];
                        $attribute_item->country_id  = $country->id;
                        $attribute_item->item_type  = $item['item_type'];
                        $attribute_item->status  = $item['status'];
                        $attribute_item->created_by  = auth()->user()->id;
                        $attribute_item->save();
                    }
                }
            }
        } catch (\Exception $e) {
            throw $e;
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
                    'name' => $sheet->getCell('A' . $row)->getValue(),
                    'type' => $sheet->getCell('B' . $row)->getValue(),
                    'prepacked' => $sheet->getCell('C' . $row)->getValue(),
                    'prepacked_metarial' => $sheet->getCell('D' . $row)->getValue(),
                    'weight' => $sheet->getCell('E' . $row)->getValue(),
                    'description' => $sheet->getCell('F' . $row)->getValue(),
                    'tariff_number' => $sheet->getCell('G' . $row)->getValue(),
                    'country_code' => $sheet->getCell('H' . $row)->getValue(),
                    'item_type' => $sheet->getCell('I' . $row)->getValue(),
                    'status' => $sheet->getCell('J' . $row)->getValue(),
                ];
                $startcount++;
            }
            return $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function skuSettings()
    {
        $productSettings = SystemSettings::query()->where('settings_key', 'general')->first();

        if ($productSettings) {
            $productMaxId = (Product::query()->max('id') + 1);

            $generatedSKU = make8digits($productMaxId);

            return [
                'auto' => $productSettings->settings_value['sku.auto'],
                'editable' => $productSettings->settings_value['sku.editable'],
                'generated_sku' => $generatedSKU
            ];
        }
        return [
            'auto' => null,
            'editable' => null,
            'generated_sku' => null
        ];
    }
}
