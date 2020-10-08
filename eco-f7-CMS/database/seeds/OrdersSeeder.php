<?php

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_infos')->insert([
            'user_id' => 1,
            'order_status' => 'Pending',
            'order_shipping_address' => 'Batna Algeria',
            'order_total_price' => 4000,
        ]);

        DB::table('order_products')->insert([
            'order_id' => 1,
            'product_id' => 2,
            'product_name' => 'Adidas Baskets Homme',
            'product_price' => 1000,
            'product_quantity' => 1,
            'product_total_price' => 1000,
        ]);

        DB::table('order_products')->insert([
            'order_id' => 1,
            'product_id' => 5,
            'product_name' => 'Samsung Galaxy S9+',
            'product_price' => 1000,
            'product_quantity' => 3,
            'product_total_price' => 3000,
        ]);

    }
}
