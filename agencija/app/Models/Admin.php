<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name', 'surname', 'email', 'password', // polja koja mogu biti popunjena
    ];

    protected $hidden = [
        'password', // Sakrivanje lozinke
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Korišćenje hashiranja lozinke
        ];
    }
}


