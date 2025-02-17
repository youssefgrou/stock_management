<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create categories
        $categories = [
            [
                'name' => 'Electronics',
                'description' => 'Electronic devices and accessories',
                'slug' => 'electronics',
            ],
            [
                'name' => 'Office Supplies',
                'description' => 'Office stationery and supplies',
                'slug' => 'office-supplies',
            ],
            [
                'name' => 'Furniture',
                'description' => 'Office and home furniture',
                'slug' => 'furniture',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create products
        $products = [
            [
                'name' => 'Laptop Pro X',
                'sku' => 'LPX001',
                'description' => 'High-performance laptop for professionals',
                'category_id' => 1,
                'price' => 1299.99,
                'quantity' => 50,
                'minimum_quantity' => 10,
                'unit' => 'piece',
            ],
            [
                'name' => 'Wireless Mouse',
                'sku' => 'WM002',
                'description' => 'Ergonomic wireless mouse',
                'category_id' => 1,
                'price' => 29.99,
                'quantity' => 200,
                'minimum_quantity' => 20,
                'unit' => 'piece',
            ],
            [
                'name' => 'Premium Paper A4',
                'sku' => 'PP003',
                'description' => 'High-quality A4 printing paper',
                'category_id' => 2,
                'price' => 12.99,
                'quantity' => 500,
                'minimum_quantity' => 100,
                'unit' => 'box',
            ],
            [
                'name' => 'Gel Pens Set',
                'sku' => 'GPS004',
                'description' => 'Set of 12 colorful gel pens',
                'category_id' => 2,
                'price' => 8.99,
                'quantity' => 300,
                'minimum_quantity' => 50,
                'unit' => 'piece',
            ],
            [
                'name' => 'Office Chair Deluxe',
                'sku' => 'OCD005',
                'description' => 'Ergonomic office chair with lumbar support',
                'category_id' => 3,
                'price' => 299.99,
                'quantity' => 30,
                'minimum_quantity' => 5,
                'unit' => 'piece',
            ],
            [
                'name' => 'Standing Desk',
                'sku' => 'SD006',
                'description' => 'Adjustable height standing desk',
                'category_id' => 3,
                'price' => 499.99,
                'quantity' => 20,
                'minimum_quantity' => 3,
                'unit' => 'piece',
            ],
        ];


        foreach ($products as $product) {
            Product::create($product);
        }
        
    }
}
