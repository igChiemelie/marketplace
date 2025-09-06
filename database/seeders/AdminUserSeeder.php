<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(['email'=>'admin@marketplace.test'], [
            'name'=>'Admin',
            'email'=>'admin@marketplace.test',
            'password'=>Hash::make('password'),
            'role'=>'admin',
            'status'=>'active'
        ]);
    }
}
