<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'bundle_id',
        'quantity'
    ];
    public function get_product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
