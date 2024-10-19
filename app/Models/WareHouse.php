<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'country_id',
        'email',
        'phone',
        'street',
        'additional',
        'post_code',
        'city',
        'state',
        'dhl_status',
        'status'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->serial_code = static::generateUniqueCode();
        });
    }
    protected static function generateUniqueCode()
    {
        return 'CODE_' . time() . '_' . rand(1000, 9999);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
