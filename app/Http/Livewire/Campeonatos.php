<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Campeonato;

class Campeonatos extends Component
{
    //$this->reset() limpa todos os campos
    //$this->reset($nome) limpa só o campo nome
    public $nome;
    public $data_inicio;
    public $data_fim;
    public $time1;
    public $time2;

    protected $rules = [
        'nome' => 'required|string|min:3',
        'data_inicio' => 'required|date',
        'data_fim' => 'required|date',
        'time1' => 'required|string|min:2',
        'time2' => 'required|string|min:2',
    ];

    public function submit()
    {
        $this->validate();
        Campeonato::create([
            'nome' => $this->nome,
            'time1' => $this->time1,
            'time2' => $this->time2,
            'inicio' => $this->data_inicio,
            'encerramento' => $this->data_fim,
        ]);
    }

    public function render()
    {
        return view('livewire.campeonatos.campeonatos', [
            'campeonatos' => Campeonato::all(),
        ]);
    }
}
