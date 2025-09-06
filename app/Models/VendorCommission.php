<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class VendorCommission extends Model { protected $fillable=['vendor_id','order_item_id','order_total','commission_rate','commission_amount','vendor_earning','status','paid_at']; public function vendor(){ return $this->belongsTo(VendorProfile::class);} public function orderItem(){ return $this->belongsTo(OrderItem::class);} }
