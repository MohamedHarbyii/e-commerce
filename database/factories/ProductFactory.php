<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [

            'name' => $this->faker->words(3, true), // مثلاً "Wireless Phone Charger"


            'description' => $this->faker->sentences(3, true),

            'stock' => $this->faker->numberBetween(0, 200),

            'price' => $this->faker->randomFloat(2, 5, 2000),

            'image' => $this->faker->image(
                storage_path('app/public/images/products'),640, 480, 'technics', false
            ),
        ];
    }
}
