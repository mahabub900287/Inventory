<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryProduct extends Model
{
    use HasFactory;
    protected $fillable=['delivery_id','product_id','bundle_id','quantity', 'tracking_number'];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function bundles()
    {
        return $this->belongsTo(Bundle::class, 'bundle_id');
    }
}
