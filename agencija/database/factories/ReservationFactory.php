<?php

namespace Database\Factories;
use App\Models\Arrangement;
use App\Models\Destination;
use App\Models\Partner;
use App\Models\Promotion;
use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $model = Reservation::class;

        return [
            'arrangement_id' => Arrangement::factory(),
            'client_id' => Client::factory(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'canceled']),
            'date' => Carbon::now()->format('Y-m-d'),
        ];
    }
}
