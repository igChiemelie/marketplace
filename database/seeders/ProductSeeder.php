<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\VendorProfile;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $vendor = VendorProfile::first();
        if (!$vendor) return;

        Product::updateOrCreate(['sku'=>'DEMO-001'], [
            'vendor_id'=>$vendor->id,
            'category_id'=>null,
            'name'=>'Demo Product 1',
            'slug'=>'demo-product-1',
            'description'=>'Demo product 1 description',
            'sku'=>'DEMO-001',
            'price'=>2500.00,
            'quantity'=>10,
            'status'=>'active',
            'approval_status'=>'approved'
        ]);

        Product::updateOrCreate(['sku'=>'DEMO-002'], [
            'vendor_id'=>$vendor->id,
            'category_id'=>null,
            'name'=>'Demo Product 2',
            'slug'=>'demo-product-2',
            'description'=>'Demo product 2 description',
            'sku'=>'DEMO-002',
            'price'=>4500.00,
            'quantity'=>5,
            'status'=>'active',
            'approval_status'=>'approved'
        ]);
    }
}
