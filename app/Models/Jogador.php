<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Time;

class Jogador extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'idade',
        'nacionalidade',
        'time_id',
        //'time',
    ];

    public function Time()
    {
        return $this->belongsTo(Time::class);
    }
}
