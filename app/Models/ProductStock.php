<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;
    protected $fillable = ['warehouse_id', 'product_id', 'bundle_id', 'stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }
}
