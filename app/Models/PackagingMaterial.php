<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagingMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'type',
        'reorder_point',
        'masurement',
        'description',
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
}
