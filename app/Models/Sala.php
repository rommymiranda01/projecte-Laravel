<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomSala',
        'numMaxPersones',
    ];

    //protected $table = 'salas';

    public function joc()
    {
        $this->hasMany(Joc::class);
    }
}
