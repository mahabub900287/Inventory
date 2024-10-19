<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'user_id',
        'street',
        'phone',
        'additional',
        'post_code',
        'city',
        'state',
        'company_name',
        'company_email',
        'company_phone',
        'created_by',
        'updated_by',
        'status',
    ];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
