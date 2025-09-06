<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(['email'=>'customer@marketplace.test'], [
            'name'=>'Demo Customer',
            'email'=>'customer@marketplace.test',
            'password'=>Hash::make('password'),
            'role'=>'customer',
            'status'=>'active'
        ]);
    }
}
