<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'name' => 'Cash On Delivery',
            'description' => 'Cash On Delivery'
        ]);

        DB::table('payments')->insert([
            'name' => 'Algerie Post',
            'description' => 'Algerie Post (CCP)'
        ]);
    }
}
