<?php

namespace App\Services\Admin\WareHouse;

use App\Models\WareHouse;
use App\Services\BaseService;

class WareHouseService extends BaseService
{
    protected $model;

    public function __construct()
    {
        $this->model = WareHouse::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        try {
            // Call patent method
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}
