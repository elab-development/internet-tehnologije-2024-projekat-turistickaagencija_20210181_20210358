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
        $destinations = [
            ['name' => 'London',         'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/London%20Skyline.jpg?width=1600'], 
            ['name' => 'Amsterdam',      'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Canal_in_Amsterdam.JPG?width=1600'],
            ['name' => 'Dubai',          'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Dubai_Marina_Skyline_93.jpg?width=1600'],
            ['name' => 'Sydney',         'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/SydneyOperaHouse.jpg?width=1600'],
            ['name' => 'Kyoto',          'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Kyoto_Skyline.jpg?width=1600'],
            ['name' => 'Rio de Janeiro', 'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Sunset_at_Rio_de_Janeiro_Skyline_%285328149427%29.jpg?width=1600'],
            ['name' => 'Bali',           'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Beach_of_Bali_%2817703410942%29.jpg?width=1600'],
            ['name' => 'Iguazu Falls',   'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Iguazu_Falls_%286038215352%29.jpg?width=1600'],
            ['name' => 'Beograd',    'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Beograd%20Panorama%20%286645290383%29.jpg?width=1600'],
            ['name' => 'Novi Sad',   'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Panorama%20of%20Novi%20Sad.jpg?width=1600'],
            ['name' => 'Paris',      'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Skyline%20of%20Paris%20with%20the%20Eiffel%20Tower%202.jpg?width=1600'],
            ['name' => 'Rome',       'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Colosseum%20in%20rome.jpg?width=1600'],
            ['name' => 'Venice',     'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Grand%20Canal-Venice.jpg?width=1600'],
            ['name' => 'Santorini',  'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Santorini_Oia.jpg?width=1600'],
            ['name' => 'Tokyo',      'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Tokyo-skyline.jpg?width=1600'],
            ['name' => 'Prague',     'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Prague_Skyline.jpg?width=1600'],
            ['name' => 'Barcelona',  'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Barcelona_skyline_2007.jpg?width=1600'],
            ['name' => 'Vienna',     'picture_link' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Vienna_Skyline.jpg?width=1600'],
        ];

        $destination = $this->faker->randomElement($destinations);

        return [
            'name' => $destination['name'],
            'picture_link' => $destination['picture_link']
        ];
    }
}
