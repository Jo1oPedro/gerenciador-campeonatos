<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jogador;
use App\Models\Campeonato;

class Time extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'pais_origem',
        'pontuacao',
        'vitorias',
        'derrotas',
        'campeonato_id',
    ];

    public function jogadores()
    {
        return $this->hasMany(Jogador::class);
    }

    public function campeonatos()
    {
        return $this->BelongsTo(Campeonato::class);
    }

}
