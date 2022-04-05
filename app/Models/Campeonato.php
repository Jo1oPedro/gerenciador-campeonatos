<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Time;
use App\Models\Times_campeonato;

class Campeonato extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'inicio',
        'encerramento',
        'jogo',
    ];

    public function times() 
    {
        return $this->hasMany(Times_campeonato::class);
    }
}
