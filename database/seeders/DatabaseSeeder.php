<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\InvoiceDetail;
use App\Models\InvoiceHeader;
use App\Models\Product;
use App\Models\Testimony;
use App\Models\User;
use Database\Factories\InvoiceHeaderFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //admin
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin1234'),
        ]);

        Admin::factory()->count(2)->create();

        //user
        User::create([
            'name' => 'User',
            'email' => 'test@gmail.com',
            'password' => Hash::make('Test1234'),
            'money' => 0,
            'address' => 'Jalan Serta Yesus'
        ]);

        // Define the categories as a simple array of strings
        $categories = ['Sweet', 'Savory', 'Mini', 'Box'];

        // Seed the categories into the database
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }

        $products = [
            ['name' => 'Original', 'category_id' => 1, 'image' => 'original.jpg', 'description' => 'This is Original', 'price' => 6000, 'stock' => 100],
            ['name' => 'Original Rhum', 'category_id' => 1, 'image' => 'ori_ rhum.jpg', 'description' => 'This is Original Rhum', 'price' => 7000, 'stock' => 100],
            ['name' => 'Matcha Whipped', 'category_id' => 1, 'image' => 'soes-matcha-whipped.jpg', 'description' => 'This is Matcha Whipped', 'price' => 7000, 'stock' => 100],
            ['name' => 'Chocolate Whipped', 'category_id' => 1, 'image' => 'chocolate-whipped.jpg', 'description' => 'This is Chocolate Whipped', 'price' => 7000, 'stock' => 100],
            ['name' => 'Coffe', 'category_id' => 1, 'image' => 'coffe.jpg', 'description' => 'This is Coffe', 'price' => 7000, 'stock' => 100],
            ['name' => 'Cheese', 'category_id' => 1, 'image' => 'cheese.jpg', 'description' => 'This is Cheese', 'price' => 7000, 'stock' => 100],
            ['name' => 'Durian', 'category_id' => 1, 'image' => 'durian.jpg', 'description' => 'This is Durian', 'price' => 8000, 'stock' => 100],
            ['name' => 'Strawberry Cheesecake', 'category_id' => 1, 'image' => 'strawbery-cheesecake.JPG', 'description' => 'This is Strawberry Cheesecake', 'price' => 8000, 'stock' => 100],
            ['name' => 'Cookies & Cream', 'category_id' => 1, 'image' => 'cookies-cream.JPG', 'description' => 'This is Cookies & Cream', 'price' => 8000, 'stock' => 100],
            ['name' => 'Burger Soes', 'category_id' => 2, 'image' => 'burger-soes.jpg', 'description' => 'This is Burger Soes', 'price' => 9000, 'stock' => 100],
            ['name' => 'Risol Soes', 'category_id' => 2, 'image' => 'risol-soes.jpg', 'description' => 'This is Risol Soes', 'price' => 8000, 'stock' => 100],
            ['name' => 'Mix Mini Soes', 'category_id' => 3, 'image' => 'soes-mini-bites.jpg', 'description' => 'This is Mix Mini Soes', 'price' => 19000, 'stock' => 100],
            ['name' => 'Soes Kering', 'category_id' => 3, 'image' => 'soes-kering.jpg', 'description' => 'This is Soes Kering', 'price' => 19000, 'stock' => 100],
            ['name' => 'Box Soes 4 Mix', 'category_id' => 4, 'image' => 'box-soes4.jpg', 'description' => 'Berisikan 4 soes dengan 2 varian rasa', 'price' => 8000, 'stock' => 100],
            ['name' => 'Box Soes 8 Mix', 'category_id' => 4, 'image' => 'box-soes8.jpg', 'description' => 'Berisikan 8 soes dengan 4 varian rasa', 'price' => 8000, 'stock' => 100],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        User::factory()->count(9)->create();
        // InvoiceHeader::factory()->count(100)->create();

        for($i = 0; $i < 5; $i++){
            $invoiceHeader = InvoiceHeader::factory()->create();
            $invoiceDetails = InvoiceDetail::factory()
                ->count(5)
                ->for($invoiceHeader)
                ->create();
        }

        Testimony::factory()->count(10)->create();
    }
}
