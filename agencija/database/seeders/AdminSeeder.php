<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::factory()->count(2)->create( [
            'role' => 'admin', // Postavi automatski 'user' u svakom unosu
        ]);  // Kreira 5 agenata);  // Kreira jednog admina
    }
}
