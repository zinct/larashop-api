<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Stella ALl In One',
            'category_id' => 3,
            'price' => 50000,
            'stock' => 5,
            'status' => 1,
            'description' => 'lorem ipsum dolor sit amet',
        ]);
    }
}
