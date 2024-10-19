<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'type',
        'prepacked',
        'prepacked_metarial',
        'weight',
        'barcode_type',
        'barcode_number',
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
    //     $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $randomLetters = substr(str_shuffle($letters), 0, 3); // You can adjust the number of letters as needed
    //     $randomNumbers = rand(1000, 9999);
    //     return 'CODE' . $randomNumbers;
    // }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = json_encode($value);
    }

    public function getTypeAttribute($value)
    {
        return json_decode($value, true);
    }
}
