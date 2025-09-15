<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['vendor_id', 'category_id', 'name', 'slug', 'description', 'short_description', 'sku', 'price', 'quantity', 'track_quantity', 'status', 'approval_status', 'meta_title', 'meta_description'];

    public function vendor()
    {
        return $this->belongsTo(VendorProfile::class, 'vendor_id');
    }

    
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function isApproved()
    {
        return $this->approval_status === 'approved' && $this->status === 'active';
    }
}
