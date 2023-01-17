<?php

namespace Database\Seeders;


use App\Models\Role;
use App\Models\User;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\ProductOrder;
use Faker\Generator;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductOrderSeeder extends Seeder
{
    public function run()
    {
        $owner_personal_phone = User::whereHas(
            'role', function($q){
                $q->where('name', 'owner');
            }
        )->select('personal_phone')->pluck('personal_phone')->first();

        //Address Client       
        $client_address = User::whereHas(
            'role', function($q){
                $q->where('name', 'client');
            }
        )->select('address')->pluck('address')->first();   


        $faker = app(Generator::class);

		foreach(range(1, 5) as $index)
		{
            $productos=Product::all();

            $client_id = User::whereHas(
                'role', function($q){
                    $q->where('name', 'client');
                }
            )->select('id')->pluck('id')->first();   


			ProductOrder::create([
                'user_id'=>$faker->numberBetween($min = 5, $max = 9),
                'name_product' =>Product::select('name_product')->pluck('name_product')->first()
			]);
		}         
    }
}
