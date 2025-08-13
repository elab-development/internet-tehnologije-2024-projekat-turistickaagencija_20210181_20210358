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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $model = Destination::class;

        $destinationLinks= [
            "https://www.travelandleisure.com/thmb/rbPz5_6COrWFh94qFRHYLJrRM-g=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/iguazu-falls-argentina-brazil-MOSTBEAUTIFUL0921-e967cc4764ca4eb2b9941bd1b48d64b5.jpg",
            "https://media.cntravellerme.com/photos/647f5a66d49d9911e8a60ae4/master/pass/Plitvice-Lakes-Croatia-GettyImages-1080935866.jpg",
            "https://static.tripzilla.in/media/125812/conversions/6c9544ff-608c-40fa-8fa9-61272093f736-w768.webp"
            ];

        return [
            'name' => $this->faker->city,
            'picture_link' => $this->faker->randomElement($destinationLinks)
        ];
    }
}
