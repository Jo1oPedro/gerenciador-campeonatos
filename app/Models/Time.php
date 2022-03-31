<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jogador;

class Time extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'pais_origem',
        'pontuacao',
        'vitorias',
        'derrotas',
    ];

    public function Jogadores()
    {
        return $this->hasMany(Jogador::class);
    }

    /*public function campeonatos()
    {
        return $this->BelongsTo(Campeonatos::class);
    }*/

}
