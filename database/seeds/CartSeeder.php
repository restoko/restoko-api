<?php

use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 10; $i++) {
            \App\Models\Cart::create(
                [
                    'table_id'  => $i,
                    'status'    => 'active'
                ]
            );
        }

        $faker = Faker\Factory::create();
        for ($i = 1; $i < 10; $i++) {
            for ($k = 1; $k < 6; $k++) {
                \App\Models\CartItem::create(
                    [
                        'cart_id'    => $i,
                        'product_id' => $k,
                        'quantity'   => $faker->numberBetween(5, 20),
                        'status'     => 'active'
                    ]
                );
            }
        }
    }
}
