<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Time;
use App\Models\Jogador;
use App\Models\Campeonato;
use App\Models\Times_campeonato;

class Times extends Component
{

    use WithPagination;
    
    public $time;
    public $nome;
    public $paisOrigem;
    public $pontuacao;
    public $vitorias;
    public $derrotas;
    public $jogadoresNoTime = [];
    public $jogadoresSemTime = [];
    public $campeonatos;
    public $campeonatosDoTime = [];
    public $campeonatosSemEsseTime = [];
    public $searchTerm = "";

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'nome' => 'required|string|min:2',
        'paisOrigem' => 'required|string|min:2',
        'pontuacao' => 'sometimes|required|integer|min:0',
        'vitorias' => 'sometimes|required|integer|min:0',
        'derrotas' => 'sometimes|required|integer|min:0',
        'jogadoresNoTime' => 'sometimes',
        'campeonatosDoTime' => 'sometimes',
    ];

    public function messages()
    {
        return [
            'nome.required' => 'O campo :attribute é obrigatorio',
            'nome.string' => 'O campo :attribute precisa ser um texto',
            'nome.min' => 'O campo :attribute precisa ter pelo menos :min caracteres',
            'paisOrigem.required' => 'O campo pais de origem é obrigatorio',
            'paisOrigem.string' => 'O campo pais de origem precisa ser um texto',
            'paisOrigem.min' => 'O campo pais de origem precisa ter pelo menos :min caracteres',
            'pontuacao.required' => 'O campo :attribute é obrigatorio',
            'pontuacao.integer' => 'O campo :attribute precisa ser um número inteiro',
            'pontuacao.min' => 'O campo :attribute não pode ser menor do que :min',
            'vitorias.required' => 'O campo :attribute é obrigatorio',
            'vitorias.intenger' => 'O campo :attribute precisa ser um número inteiro',
            'vitorias.min' => 'O campo :attribute não pode ser menor do que :min',
            'derrotas.required' => 'O campo :attribute é obrigatorio',
            'derrotas.integer' => 'O campo :attribute precisa ser um número inteiro',
            'derrotas.min' => 'O campo :attribute não pode ser menor do que :min',
        ];
    }

    public function create() 
    {
        $this->resetValidation();
        $this->pontuacao = $this->vitorias = $this->derrotas = 0;
        $this->validate();
        $time = Time::create([
            'nome' => $this->nome,
            'pais_origem' => $this->paisOrigem,
        ]);
        Jogador::whereIn('id', $this->jogadoresNoTime)->update([
            'time_id' => $time->id,
        ]);
        foreach($this->campeonatosDoTime as $campeonato)
        {
            Times_campeonato::create([
                'time_id' => $time->id,
                'campeonato_id' => $campeonato,
            ]);
        }
        session()->flash('message', "Time $this->nome criado com sucesso");
        $this->resetInputs();
    }

    public function read(Time $time) 
    {
        $this->nome = $time->nome;
        $this->paisOrigem = $time->pais_origem;
        $this->pontuacao = $time->pontuacao;
        $this->vitorias = $time->vitorias;
        $this->derrotas = $time->derrotas;
        $this->jogadoresNoTime = $time->jogadores;
        $this->campeonatosDoTime = Times_campeonato::select('id')->where('time_id', $time->id)->get();
        $this->campeonatosDoTime = Campeonato::whereIn('id', $this->campeonatosDoTime->toArray())->get();
    }

    public function edit(Time $time)
    {
        $this->time = $time;
        $this->nome = $time->nome;
        $this->paisOrigem = $time->pais_origem;
        $this->pontuacao = $time->pontuacao;
        $this->vitorias = $time->vitorias;
        $this->derrotas = $time->derrotas;
        $this->jogadoresNoTime = $time->jogadores;
        $this->jogadoresSemTime = Jogador::where('time_id', NULL)->get();
        $this->campeonatosDoTime = Times_campeonato::select('campeonato_id')->where('time_id', $time->id)->get()->toArray();
        $this->campeonatosSemEsseTime = Campeonato::whereNotIn('id', $this->campeonatosDoTime)->get();
        $this->campeonatosDoTime = Campeonato::whereIn('id', $this->campeonatosDoTime)->get();
    }

    public function update()
    {
        $this->validate();
        if(!$this->time) {
            session()->flash('error', "Ocorreu um problema ao atualizar o time $this->nome");
            $this->resetInputs();
            $this->render();
        }
        $this->time->update([
            'nome' => $this->nome,
            'pais_origem' => $this->paisOrigem,
            'pontuacao' => $this->pontuacao,
            'vitorias' => $this->vitorias,
            'derrotas' => $this->derrotas,
        ]);
        $this->jogadoresNoTime = Jogador::whereIn('id', $this->jogadoresNoTime)->get();
        foreach($this->jogadoresNoTime as $jogador)
        {
            if($jogador->time_id != NULL)
            {
                $jogador->time_id = NULL;
            } else {
                $jogador->time_id = $this->time->id;
            }
            $jogador->save();
        }
        if(is_array($this->campeonatosDoTime))
        {
            $idsCampeonatosDoTime = $this->campeonatosDoTime;
            $this->campeonatosDoTime = Times_campeonato::whereIn('campeonato_id', $this->campeonatosDoTime)
                                                        ->where('time_id', $this->time->id)
                                                        ->get();
            $idCampeonatosSemEsseTime = [];
            foreach($this->campeonatosDoTime->toArray() as $key => $campeonato) 
            {
                $idCampeonatosSemEsseTime[$key] = $campeonato['campeonato_id'];
            }
            foreach($this->campeonatosDoTime as $campeonato)
            {
                if($campeonato->time_id == $this->time->id)
                {
                    $campeonato->delete();
                }
            }
            $idCampeonatosSemEsseTime = array_diff($idsCampeonatosDoTime, $idCampeonatosSemEsseTime);
            foreach($idCampeonatosSemEsseTime as $campeonato)
            {
                Times_campeonato::create([
                    'time_id' => $this->time->id,
                    'campeonato_id' => $campeonato,
                ]);
            }
        }
        session()->flash('message', "Time $this->nome atualizado com sucesso");
        $this->resetInputs();
    }

    public function delete(Time $time) 
    {
        $nome = $time->nome;
        $time->delete();
        $this->resetInputs();
        session()->flash('message', "Time $time->nome deletado com sucesso");
    }

    public function updatingSearchInput()
    {
        $this->gotoPage(1);
    }

    public function resetErrors() 
    {
        $this->resetValidation();
    }

    public function resetInputs() {
        $this->time = $this->nome = $this->paisOrigem = $this->pontuacao = $this->vitorias = $this->derrotas = '';
        $this->jogadoresNoTime = $this->jogadoresSemTime = $this->campeonatosDoTime = $this->campeonatosSemEsseTime = [];
        $this->resetValidation();
    }

    public function mount()
    {
        $this->campeonatos = Campeonato::all();
    }
    
    public function render()
    {
        $this->jogadores = Jogador::where('time_id', NULL)->get();
        $searchTerm = '%'.$this->searchTerm.'%';
        if($searchTerm != '%%')
        {
            $this->updatingSearchInput();
        }
        $paginate = 15;
        $times = Time::where('nome', 'like', $searchTerm)->paginate($paginate);
        return view('livewire.times.times', [ 
            'times' => $times,
            'jogadores' => $this->jogadores,
        ]);
    }
}
