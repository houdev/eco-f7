<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Sol\'s T-Shirt Homme',
            'price' => 1000,
            'description' => 'Profitez de notre sélection de T-Shirt pour Homme  dans notre boutique en ligne chez Jumia, n\'hésitez pas, un simple clique sur j\'achète et ce produit est à vous.',
            'thumbnail' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/11/295/1.jpg?6244',
            'stock_quantity' => 5,
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Adidas Baskets Homme',
            'price' => 1000,
            'description' => 'Adidas est une firme allemande fondée en 1949 par Adolf Dassler. spécialisée dans la fabrication d\'articles de sport. basée à Herzogenaurach en Allemagne.',
            'thumbnail' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/12/4971/1.jpg?7384',
            'stock_quantity' => 5,
        ]);

        DB::table('products')->insert([
            'category_id' => 2,
            'name' => 'Kenwood Robot',
            'price' => 1000,
            'description' => 'Robot multifonctions 30 fonctions KENWOOD FP691 Multi-Pro- 900W- Blanc',
            'thumbnail' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/17/3602/1.jpg?1045',
            'stock_quantity' => 5,
        ]);

        DB::table('products')->insert([
            'category_id' => 3,
            'name' => 'Asus Vivobook 15"',
            'price' => 1000,
            'description' => 'La série ASUS X540 est alimentée par des processeurs Intel® pour vous offrir des performances informatiques fluides et réactives. Doté de graphiques intégrés et d\'un contrôleur de mémoire intégré avancé, le X540 est une plate-forme informatique quotidienne idéale.',
            'thumbnail' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/05/6571/1.jpg?0192',
            'stock_quantity' => 5,
        ]);

        DB::table('products')->insert([
            'category_id' => 4,
            'name' => 'Samsung Galaxy S9+',
            'price' => 1000,
            'description' => 'Notre objectif à double ouverture F2.4 / F1.5 s’ajuste pour laisser plus de lumière entrer en cas de besoin, vous permettant de capturer la bonne quantité de lumière, de jour comme de nuit.',
            'thumbnail' => 'https://dz.jumia.is/unsafe/fit-in/500x500/filters:fill(white)/product/20/5111/1.jpg?0147',
            'stock_quantity' => 5,
        ]);

    }
}
