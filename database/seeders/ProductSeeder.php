<?php

namespace Database\Seeders;

use App\Models\Product;

use App\Models\Commerce;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $commerces_products = Commerce::all();
        $commerces_products->each(function($product)
        {
            Product::factory()->count(2)->for($product)->create();
        });        
    }
}
