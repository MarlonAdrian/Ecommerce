<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Commerce;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [           
            'code_product' => $this->faker->iban(),
            'name_product' => $this->faker->userAgent(),//text(50)
            'price' => $this->faker->randomFloat(2, 50, 100),
            'description' => $this->faker->sentence(),
            'stock' => $this->faker->numberBetween($min = 4, $max = 8)
        ];
    }
}
