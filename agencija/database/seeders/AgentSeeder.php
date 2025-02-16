<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    public function run()
    {
        Agent::factory()->count(5)->create([
            'role' => 'agent', // Postavi automatski 'user' u svakom unosu
        ]);  // Kreira 5 agenata
    }
}
