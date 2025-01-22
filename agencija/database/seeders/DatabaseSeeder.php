<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Arrangement; 
use App\Models\Client;
use App\Models\Promotion;
use App\Models\Reservation;
use App\Models\Partner;
use App\Models\Destination;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Arrangement::query()->delete();
        Client::query()->delete();
        Promotion::query()->delete();
        Reservation::query()->delete();
        Partner::query()->delete();
        Destination::query()->delete();


        $this->call([
            DestinationSeeder::class,
            PartnerSeeder::class,
            PromotionSeeder::class,
            ArrangementSeeder::class,
            ClientSeeder::class,
            ReservationSeeder::class,
        ]);

    /*\App\Models\Destination::factory(10)->create();
    \App\Models\Partner::factory(5)->create();
    \App\Models\Promotion::factory(3)->create();
    \App\Models\Arrangement::factory(10)->create();
    \App\Models\Client::factory(20)->create();
    \App\Models\Reservation::factory(50)->create();*/
        
    }
}
