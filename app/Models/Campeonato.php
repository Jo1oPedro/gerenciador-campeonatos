<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Time;

class Campeonato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data_inicio',
        'data_fim',
        'jogo',
    ];

    /*public function times() 
    {
        return $this->hasMany(Times::class);
    }*/
}
