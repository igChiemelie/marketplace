<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Transaction;
use App\Models\ProductReview;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // $this->call([
        //     AdminUserSeeder::class,
        //     VendorSeeder::class,
        //     CustomerSeeder::class,
        //     ProductSeeder::class,
        // ]);
         // Categories + Products
        Category::factory(5)
            ->has(Product::factory(10))
            ->create();

        // Orders with Items
        Order::factory(10)
            ->has(OrderItem::factory(3))
            ->create();

        // Cart Items
        CartItem::factory(15)->create();

        // Transactions
        Transaction::factory(10)->create();

        // Reviews
        ProductReview::factory(20)->create();
    
    }
}
