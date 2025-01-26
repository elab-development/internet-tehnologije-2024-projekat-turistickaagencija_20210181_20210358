<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Arrangement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'price', 'date', 'description'
    ];
    
    public function destination()
{
    return $this->belongsTo(Destination::class);
}

public function promotion()
{
    return $this->belongsTo(Promotion::class);
}

public function partners()
{
    return $this->belongsToMany(Partner::class);
}
}
