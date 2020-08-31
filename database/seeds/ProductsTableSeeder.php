<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $data = [
            ['name' => 'Sample Product X', 'available_stock' => '5'],
            ['name' => 'Sample Prodyct Y', 'available_stock' => '6'],
        ];

        Product::insert($data);
    }
}
