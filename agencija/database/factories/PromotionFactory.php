<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Arrangement;
use App\Models\Destination;
use App\Models\Partner;
use App\Models\Promotion;
use App\Models\Client;
use App\Models\Reservation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $model = Promotion::class;

        return [
            'discount' => $this->faker->randomFloat(2, 5, 50), //popust izmedju 2 i 50
        ];
    }
}
