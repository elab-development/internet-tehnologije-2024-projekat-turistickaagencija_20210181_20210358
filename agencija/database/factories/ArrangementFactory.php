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
        // Kreiramo destinaciju
        $destination = Destination::factory()->create();

        // Generišemo naziv aranžmana u skladu sa destinacijom
        $arrangementTemplates = [
            "Explore {destination}",
            "Romantic getaway to {destination}",
            "Adventure in {destination}",
            "Relaxing trip to {destination}",
            "Cultural tour of {destination}"
        ];

        $name = str_replace("{destination}", $destination->name, $this->faker->randomElement($arrangementTemplates));

        return [
            'name' => $name,
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'date' => $this->faker->dateTimeBetween('2025-09-01', '2026-12-31')->format('Y-m-d'),
            'description' => 'Join us on an unforgettable journey and explore the wonders of this amazing destination. Enjoy comfort, culture, and adventure all in one package.',
            'destination_id' => $destination->id,
            'promotion_id' => Promotion::factory(),
            'partner_id' => Partner::factory(),
        ];
    }
}
