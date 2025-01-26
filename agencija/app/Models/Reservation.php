<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;
    protected $fillable = ['arrangement_id', 'client_id', 'status', 'date'];
    public function arrangement()
    {
        return $this->belongsTo(Arrangement::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
