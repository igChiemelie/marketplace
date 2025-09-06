<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number', 'customer_id', 'total_amount', 'tax_amount', 'shipping_amount', 'discount_amount', 'status', 'payment_status', 'payment_method', 'shipping_address', 'billing_address', 'notes'];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
