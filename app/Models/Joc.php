<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joc extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'durada',
        'foto',
        'id_sala',
    ];

    public function sala()
    {
        $this->belongsTo(Sala::class);
    }

    public function reserva()
    {
        $this->hasMany(Reserva::class);
    }
}
