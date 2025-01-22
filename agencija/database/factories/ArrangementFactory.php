<?php

namespace Database\Factories;
use App\Models\Arrangement;
use App\Models\Destination;
use App\Models\Partner;
use App\Models\Promotion;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arrangement>
 */
class ArrangementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $model = Arrangement::class;

        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'date' => $this->faker->date(),
            'description' => $this->faker->paragraph,
            'destination_id' => Destination::factory(),
            'promotion_id' => Promotion::factory(),
            'partner_id' => Partner::factory(),
        ];
    }
}
