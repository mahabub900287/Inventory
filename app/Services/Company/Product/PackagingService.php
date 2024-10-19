<?php

namespace App\Services\Company\Product;

use App\Models\PackagingMaterial;
use Illuminate\Support\Str;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class PackagingService extends BaseService
{
    protected $model;

    public function __construct()
    {
        $this->model = PackagingMaterial::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        // try {
            if ($id == null) {
                $data['created_by'] = auth()->user()->id;
            }
            $data['updated_by'] = auth()->user()->id;
            $data['status'] = 'active';
            $data['masurement'] = json_encode([
                'length' => $data['length'],
                'width'  => $data['width'],
                'height' => $data['height']
            ]);
            // Call patent method
            return parent::storeOrUpdate($data, $id);
        // } catch (\Exception $e) {
        //     $this->logFlashThrow($e);
        // }
    }
}
