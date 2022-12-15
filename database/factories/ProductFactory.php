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
            'price' => $this->faker->numberBetween($min = 1.00, $max = 500.00),
            'description' => $this->faker->sentence(),
            'stock' => $this->faker->numberBetween($min = 4, $max = 8)
        ];
    }
}
