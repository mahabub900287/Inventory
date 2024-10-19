<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'description',
        'tariff_number',
        'country_id',
        'created_by',
        'updated_by',
        'status',
    ];

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         $model->sku = static::generateUniqueCode();
    //     });
    // }
    // protected static function generateUniqueCode()
    // {
    //     // Generate a unique code with a combination of letters and numbers
    //     $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $randomLetters = substr(str_shuffle($letters), 0, 3); // You can adjust the number of letters as needed
    //     $randomNumbers = rand(1000, 9999);
    //     return 'CODE' . $randomNumbers;
    // }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'bundle_products');
    }
    public function get_bundle_product()
    {
        return $this->hasMany(BundleProduct::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
