<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    const RELEASE_STATUS = 'released';
    const PROCESSING_STATUS = 'processing';
    const SENT_STATUS = 'sent';
    const RETURN_REQUEST_STATUS = 'requested';
    const RETURN_STATUS = 'returns';

    protected $fillable = [
        'warehouse_id',
        'customer_address_id',
        'type',
        'order_number',
        'preview_picks',
        'invoice_number',
        'type_of_good',
        'dhl_order',
        'note',
        'status',
        'dhl_status',
        'created_by',
        'updated_by'
    ];
    public function warehouse()
    {
        return $this->belongsTo(WareHouse::class, 'warehouse_id');
    }
    public function customer_address()
    {
        return $this->belongsTo(CustomerAddress::class, 'customer_address_id');
    }
    public function get_product()
    {
        return $this->hasMany(ProductShipment::class, 'shipment_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    // public function get_bundle()
    // {
    //     return $this->hasMany(ProductShipment::class, 'bundle_id');
    // }
}
