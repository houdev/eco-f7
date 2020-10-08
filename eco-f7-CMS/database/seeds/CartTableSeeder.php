<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carts')->insert([
            'user_id' => 1,
            'product_id' => 1,
            'product_name' => 'Sol\'s T-Shirt Homme',
            'product_price' => 100,
            'quantity' => 3,
            'total_price' => 300,
        ]);

        DB::table('carts')->insert([
            'user_id' => 1,
            'product_id' => 2,
            'product_name' => 'Adidas Baskets Homme',
            'product_price' => 100,
            'quantity' => 1,
            'total_price' => 100,
        ]);

        DB::table('carts')->insert([
            'user_id' => 1,
            'product_id' => 3,
            'product_name' => 'Kenwood Robot',
            'product_price' => 100,
            'quantity' => 4,
            'total_price' => 400,
        ]);
    }
}
