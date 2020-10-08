<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductGalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_galleries')->insert([
            'product_id' => 1,
            'image' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/11/295/1.jpg?6244',
        ]);

        DB::table('product_galleries')->insert([
            'product_id' => 1,
            'image' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/27/579/1.jpg?4624',
        ]);

        DB::table('product_galleries')->insert([
            'product_id' => 2,
            'image' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/12/4971/1.jpg?7384',
        ]);

        DB::table('product_galleries')->insert([
            'product_id' => 2,
            'image' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/26/7491/1.jpg?6503',
        ]);

        DB::table('product_galleries')->insert([
            'product_id' => 3,
            'image' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/17/3602/1.jpg?1045',
        ]);

        DB::table('product_galleries')->insert([
            'product_id' => 3,
            'image' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/17/3602/5.jpg?1045',
        ]);

        DB::table('product_galleries')->insert([
            'product_id' => 4,
            'image' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/05/6571/1.jpg?0192',
        ]);

        DB::table('product_galleries')->insert([
            'product_id' => 4,
            'image' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/05/6571/3.jpg?0192',
        ]);

        DB::table('product_galleries')->insert([
            'product_id' => 5,
            'image' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/20/5111/1.jpg?0147',
        ]);

        DB::table('product_galleries')->insert([
            'product_id' => 5,
            'image' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/20/5111/3.jpg?0147',
        ]);

    }
}
