<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VendorProfile extends Model
{
    protected $fillable = ['user_id','nin','shop_name','shop_slug','shop_description','shop_logo','shop_banner','commission_rate','approval_status','address','city','state','country','postal_code'];

    public function user() { return $this->belongsTo(User::class); }
    public function products() { return $this->hasMany(Product::class, 'vendor_id'); }
    public function orderItems() { return $this->hasMany(OrderItem::class, 'vendor_id'); }
    public function commissions() { return $this->hasMany(VendorCommission::class, 'vendor_id'); }
    public function isApproved() { return $this->approval_status === 'approved'; }
}
