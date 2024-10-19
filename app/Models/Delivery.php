<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    const ANNOUNCED_STATUS = 'announced';
    const DELIVERED_STATUS = 'delivered';
    const PROCESSING_STATUS = 'processing';
    const CANCELLED_STATUS = 'rejected';
    const COMPLETED_STATUS = 'completed';


    protected $fillable = [
        'warehouse_id',
        'delivery_type',
        'product_type',
        'inbound',
        'delivery_metarial',
        'start_date',
        'end_date',
        'ref_number',
        'sender_name',
        'sender_address',
        'description',
        'created_by',
        'updated_by',
        'status',
    ];


    public function deliveryProducts()
    {
        return $this->hasMany(DeliveryProduct::class, 'delivery_id')->where('product_id', '!=', null);
    }
    public function deliveryBundles()
    {
        return $this->hasMany(DeliveryProduct::class, 'delivery_id')->where('bundle_id', '!=', null);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
