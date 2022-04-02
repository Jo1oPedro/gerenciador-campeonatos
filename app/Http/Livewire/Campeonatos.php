<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Campeonato;
use App\Models\Time;

class Campeonatos extends Component
{
    //$this->reset() limpa todos os campos
    //$this->reset($nome) limpa só o campo nome
    public $nome;
    public $jogo;
    public $data_inicio;
    public $data_fim;
    public $timesSelected = [];
    public $times = [];

    public function teste()
    {
        dd('teste');
    }

    protected $rules = [
        'nome' => 'required|string|min:3',
        'data_inicio' => 'required|date',
        'data_fim' => 'required|date',
    ];

    public function resetInputs()
    {
        $this->nome = $this->jogo = $this->inicio = $this->encerramento = '';
        $this->timesSelected = []; 
    }

    public function mount() 
    {
        $this->times = Time::all();
    }

    public function edit(Campeonato $campeonato) 
    {   
        $this->nome = $campeonato->nome;
        $this->jogo = $campeonato->jogo;
        $this->data_inicio = $campeonato->inicio;
        $this->data_fim = $campeonato->encerramento;
    }

    public function create() 
    {
        $this->validate();
        $campeonato = Campeonato::create([
            'nome' => $this->nome,
            'jogo' => $this->jogo,
            'inicio' => $this->data_inicio,
            'encerramento' => $this->data_fim,
        ]);

        foreach($this->timesSelected as $time)
        {
            $time = Time::find($time);
            $time->campeonato_id = $campeonato->id;
            $time->save();
        }
        $this->resetInputs();
        //$this->emit('resetSelect');
    }

    public function render()
    {
        return view('livewire.campeonatos.campeonatos', [
            'campeonatos' => Campeonato::all(),
        ]);
    }
}
