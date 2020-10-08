<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('infos')->insert([
            'shop_name' => 'Eco-f7',
            'shop_logo' => 'Eco-f7',
            'shop_description' => 'Eco-f7 is an E-commerce website made by vue and framework7',
            'shop_image' => 'Eco-f7',
        ]);
    }
}
