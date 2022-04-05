<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Campeonato;
use App\Models\Time;
use App\Models\Times_campeonato;
use Livewire\WithPagination;

class Campeonatos extends Component
{

    use WithPagination;
    //$this->reset() limpa todos os campos
    //$this->reset($nome) limpa só o campo nome
    public $nome;
    public $jogo;
    public $dataInicio;
    public $dataFim;
    public $timesNoCampeonato = [];
    public $timesForaDoCampeonato;
    public $idTimesNoCampeonato;
    public $times;
    public $campeonato;
    public $searchTerm = '';
    protected $paginationTheme = 'bootstrap';

    protected $rules =  [
        'nome' => 'required|min:5|string',
        'jogo' => 'required|min:5|string',
        'dataInicio' => 'required|date',
        'dataFim' => 'required|date',
        'timesNoCampeonato' => 'sometimes',
    ];

    public function messages()
    {
        return [
            'nome.required' => 'O campo :attribute é obrigatorio',
            'nome.min' => 'O campo :attribute precisa ter pelo menos :min caracteres',
            'nome.string' => 'O campo :attribute precisa ser uma string',
            'jogo.required' => 'O campo :attribute é obrigatorio',
            'jogo.min' => 'O campo :attribute precisa ter pelo menos :min caracteres',
            'jogo.string' => 'O campo :attribute precisa ser uma string',
            'dataInicio.required' => 'O campo :attribute é obrigatorio',
            'dataInicio.date' => 'O campo :attribute precisa ser é uma data',
            'dataFim.required' => 'O campo :attribute é obrigatorio',
            'dataFim.date' => 'O campo :attribute precisa ser é uma data',
        ];
    }

    public function resetInputs()
    {
        $this->nome = $this->jogo = $this->dataInicio = $this->dataFim = '';
        $this->timesNoCampeonato = $this->timesForaDoCampeonato = $this->idTimesNoCampeonato = [];
        $this->resetValidation();
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function create() 
    {
        $this->validate();
        $campeonato = Campeonato::create([
            'nome' => $this->nome,
            'jogo' => $this->jogo,
            'inicio' => $this->dataInicio,
            'encerramento' => $this->dataFim,
        ]);

        foreach($this->timesNoCampeonato as $idTime)
        {
            Times_campeonato::create([
                'time_id' => $idTime,
                'campeonato_id' => $campeonato->id,
            ]);
        }
        //$this->emit('resetSelect');
    }

    public function edit(Campeonato $campeonato) 
    {   
        $this->campeonato = $campeonato;
        $this->nome = $campeonato->nome;
        $this->jogo = $campeonato->jogo;
        $this->dataInicio = $campeonato->inicio;
        $this->dataFim = $campeonato->encerramento;
        $this->timesNoCampeonato = $campeonato->times->where('campeonato_id', $this->campeonato->id); // não está sendo devidamente utilizada pois não está sendo possivel colocar o attributo de selected para as options no edit
        //dd($this->timesNoCampeonato);
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
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate();
        $this->campeonato->update([
            'nome' => $this->nome,
            'jogo' => $this->jogo,
            'inicio' => $this->dataInicio,
            'encerramento' => $this->dataFim,
        ]);
        $times = Times_campeonato::whereIn('time_id', $this->timesNoCampeonato)
                ->where('campeonato_id', $this->campeonato->id)->get();
        if(count($times) != 0 ) {
            foreach($times as $time)
            {
                $time->delete();
            }
        }
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
        $this->campeonato->save();
    }

    public function delete(Campeonato $campeonato)
    {
        $campeonato->delete();
    }

    public function mount() 
    {
        $this->times = Time::all();
    }

    public function render()
    {
        return view('livewire.campeonatos.campeonatos', [
            'campeonatos' => Campeonato::all(),
        ]);
    }
}
