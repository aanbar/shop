<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class, 10)->create()->each(
            function ($Product) {
                $Products = factory(\App\Product::class, 3)->create();
                $ids = $Products->pluck('id')->all();
                $Product->Bundle()->attach($ids);
            }
        );
    }
}
