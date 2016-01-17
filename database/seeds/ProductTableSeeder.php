<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();

        $products = [
            [
                'category_id'   => 1,
                'name' => 'product 1',
                'slug'  => 'product-1',
                'description' => 'a product 1',
                'price' => '1'
            ],
            [
                'category_id'   => 2,
                'name' => 'product 2',
                'slug'  => 'product-2',
                'description' => 'a product 2',
                'price' => '1'
            ],
            [
                'category_id'   => 3,
                'name' => 'product 3',
                'slug'  => 'product-3',
                'description' => 'a product 3',
                'price' => '1'
            ],
            [
                'category_id'   => 4,
                'name' => 'product 4',
                'slug'  => 'product-4',
                'description' => 'a product 4',
                'price' => '1'
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
