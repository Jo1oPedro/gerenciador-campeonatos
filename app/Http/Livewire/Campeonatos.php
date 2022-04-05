<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Campeonato;
use App\Models\Time;
use App\Models\Times_campeonato;

class Campeonatos extends Component
{
    //$this->reset() limpa todos os campos
    //$this->reset($nome) limpa só o campo nome
    public $nome;
    public $jogo;
    public $data_inicio;
    public $data_fim;
    public $timesNoCampeonato;
    public $timesForaDoCampeonato;
    public $idTimesNoCampeonato;
    public $times;
    public $campeonato;

    public function teste()
    {
        dd('teste');
    }

    protected $rules =  [
        'nome' => 'required|string|min:3',
        'data_inicio' => 'required|date',
        'data_fim' => 'required|date',
        'timesNoCampeonato' => 'required',
    ];

    public function resetInputs()
    {
        $this->nome = $this->jogo = $this->inicio = $this->encerramento = '';
        $this->timesNoCampeonato = '';
    }

    public function mount() 
    {
        $this->times = Time::all();
    }

    public function edit(Campeonato $campeonato) 
    {   
        $this->campeonato = $campeonato;
        $this->nome = $campeonato->nome;
        $this->jogo = $campeonato->jogo;
        $this->data_inicio = $campeonato->inicio;
        $this->data_fim = $campeonato->encerramento;
        $this->timesNoCampeonato = $campeonato->times->where('campeonato_id', $this->campeonato->id); // não está sendo devidamente utilizada pois não está sendo possivel colocar o attributo de selected para as options no edit
        if(count($this->timesNoCampeonato) > 0)
        {
            foreach($this->timesNoCampeonato as $key => $time)
            {
                $this->idTimesNoCampeonato[$key] = $time->time_id;
            }
            foreach($this->times as $key => $time)
            {
                $idTimes[$key] = $time->id;
            }
            if(count($this->timesNoCampeonato) > 0) 
            {
                $this->timesForaDoCampeonato = Time::whereIn('id', array_diff($idTimes,$this->idTimesNoCampeonato))->get(); // times que não foram selecionados
            }
            $this->timesNoCampeonato = Time::whereIn('id', $this->idTimesNoCampeonato)->get();
        } else {
            $this->timesForaDoCampeonato = Time::all();
            $this->idTimesNoCampeonato = [];
        }
    }

    public function update()
    {
        $this->campeonato->update([
            'nome' => $this->nome,
            'jogo' => $this->jogo,
            'inicio' => $this->data_inicio,
            'encerramento' => $this->data_fim,
        ]);
        $times = Times_campeonato::whereIn('time_id', $this->timesNoCampeonato)
                ->where('campeonato_id', $this->campeonato->id)->get();
        if(count($times) != 0 ) {
            foreach($times as $time)
            {
                $time->delete();
            }
        } else {
            if(!is_object($this->timesNoCampeonato))
            {   
                $idTimesSelecionados = array_diff($this->timesNoCampeonato, $this->idTimesNoCampeonato);
                if(count($idTimesSelecionados) > 0)
                {
                    foreach($idTimesSelecionados as $idTime)
                    {
                        if(
                            count(Times_campeonato::where([
                                ['time_id', '=', $idTime],
                                ['campeonato_id', '=', $this->campeonato->id]
                            ])->get()) == 0
                        ) {
                            Times_campeonato::create([
                                'time_id' => $idTime,
                                'campeonato_id' => $this->campeonato->id,
                            ]);
                        }
                    }
                }
            }
        }
        $this->campeonato->save();
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

        foreach($this->timesNoCampeonato as $time)
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
