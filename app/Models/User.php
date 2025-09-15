<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Product;

// class User extends Authenticatable
// {
//     /** @use HasFactory<\Database\Factories\UserFactory> */
//     use HasFactory, Notifiable;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var list<string>
//      */
//     protected $fillable = [
//         'name',
//         'email',
//         'password',
//     ];

//     /**
//      * The attributes that should be hidden for serialization.
//      *
//      * @var list<string>
//      */
//     protected $hidden = [
//         'password',
//         'remember_token',
//     ];

//     /**
//      * Get the attributes that should be cast.
//      *
//      * @return array<string, string>
//      */
//     protected function casts(): array
//     {
//         return [
//             'email_verified_at' => 'datetime',
//             'password' => 'hashed',
//         ];
//     }
// }

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'phone',
        'bank_name',
        'acct_name',
        'acct_no',
        'address',
        'avatar'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vendorProfile()
    {
        return $this->hasOne(VendorProfile::class, 'user_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function isVendor()
    {
        return $this->role === 'vendor';
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isCustomer()
    {
        return $this->role === 'customer';
    }
    
    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'vendor_id'); 
    //     // 'vendor_id' should be the foreign key in products table
    // }
}
