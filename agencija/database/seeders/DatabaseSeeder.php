<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Arrangement;
use App\Models\Client;
use App\Models\Agent;
use App\Models\Admin;
use App\Models\Promotion;
use App\Models\Reservation;
use App\Models\Partner;
use App\Models\Destination;
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
            AdminSeeder::class,  
            AgentSeeder::class,  
            ReservationSeeder::class,
            
        ]);
    }

}

