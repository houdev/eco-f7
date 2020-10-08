<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminTableSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            InfosTableSeeder::class,
            ProductsTableSeeder::class,
            ProductGalleriesTableSeeder::class,
            CartTableSeeder::class,
            OrdersSeeder::class,
            PaymentsTableSeeder::class,
    ]);

    }
}
