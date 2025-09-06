<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    public function run()
    {
        $user = User::updateOrCreate(['email'=>'vendor@marketplace.test'], [
            'name'=>'Demo Vendor',
            'email'=>'vendor@marketplace.test',
            'password'=>Hash::make('password'),
            'role'=>'vendor',
            'status'=>'active'
        ]);

        VendorProfile::updateOrCreate(['user_id'=>$user->id], [
            'shop_name'=>'Demo Shop',
            'shop_slug'=>'demo-shop',
            'shop_description'=>'Demo vendor shop',
            'commission_rate'=>10.00,
            'approval_status'=>'approved'
        ]);
    }
}
