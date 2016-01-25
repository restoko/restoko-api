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

        for ($i = 1; $i < 10; $i++) {
            \App\Models\CartItem::create(
                [
                    'cart_id'    => $i,
                    'product_id' => $i
                    'status'     => 'active'
                ]
            );
        }
    }
}
