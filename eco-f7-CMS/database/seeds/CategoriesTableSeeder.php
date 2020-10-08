<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Clothes',
            'description' => 'clothes clothes',
            'icon' => 'https://image.flaticon.com/icons/svg/2965/2965318.svg',
            'cover' => 'https://www.english-learn-online.com/wp-content/uploads/clothes-696x373.jpg',
        ]);

        DB::table('categories')->insert([
            'name' => 'Kitchen',
            'description' => 'kitchen kitchen',
            'icon' => 'https://image.flaticon.com/icons/svg/2944/2944348.svg',
            'cover' => 'https://png.pngtree.com/png-vector/20191129/ourmid/pngtree-hand-drawn-kitchen-tools-doodle-set-of-cooking-utensils-vector-illustration-png-image_2046732.jpg',
        ]);

        DB::table('categories')->insert([
            'name' => 'Informatics',
            'description' => 'Informatics Informatics',
            'icon' => 'https://image.flaticon.com/icons/svg/2933/2933190.svg',
            'cover' => 'https://techguided.com/wp-content/uploads/2019/10/500-Gaming-PC-Build.jpg',
        ]);

        DB::table('categories')->insert([
            'name' => 'Smart Phones',
            'description' => 'Smart Phones',
            'icon' => 'https://image.flaticon.com/icons/svg/900/900338.svg',
            'cover' => 'https://i.cdn.newsbytesapp.com/images/142_5951592045581.jpg',
        ]);

    }
}
