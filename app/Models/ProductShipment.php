<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShipment extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function bundles()
    {
        return $this->belongsTo(Bundle::class, 'bundle_id');
    }
}
