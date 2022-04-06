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
    public $jogadoresSemTime;
    public $campeonato;
    public $campeonatosDoTime = [];
    public $searchTerm;

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
        $this->resetInputs();
        $this->nome = $time->nome;
        $this->paisOrigem = $time->pais_origem;
        $this->pontuacao = $time->pontuacao;
        $this->vitorias = $time->vitorias;
        $this->derrotas = $time->derrotas;
        $this->jogadoresNoTime = $time->jogadores;
    }

    public function edit(Time $time)
    {
        $this->resetInputs();
        $this->time = $time;
        $this->nome = $time->nome;
        $this->paisOrigem = $time->pais_origem;
        $this->pontuacao = $time->pontuacao;
        $this->vitorias = $time->vitorias;
        $this->derrotas = $time->derrotas;
        $this->jogadoresNoTime = $time->jogadores;
        $this->jogadoresSemTime = Jogador::where('time_id', NULL)->get();
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
            echo $jogador->time_id;
            if($jogador->time_id != NULL)
            {
                $jogador->time_id = NULL;
            } else {
                $jogador->time_id = $this->time->id;
            }
            $jogador->save();
        }
        session()->flash('message', "Time $this->nome atualizado com sucesso");
        $this->resetInputs();
    }

    public function delete(Time $time) 
    {
        $nome = $time->nome;
        $time->delete();
        session()->flash('message', "Time $time->nome deletado com sucesso");
    }

    public function resetErrors() 
    {
        $this->resetValidation();
    }

    public function resetInputs() {
        $this->time_id = $this->nome = $this->paisOrigem = $this->pontuacao = $this->vitorias = $this->derrotas = '';
        $this->jogadoresNoTime = $this->jogadoresSemTime = [];
        $this->resetValidation();
    }

    public function mount()
    {
        $this->jogadores = Jogador::where('time_id', NULL)->get();
        $this->campeonatos = Campeonato::all();
    }
    
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $paginate = 15;
        $times = Time::where('nome', 'like', $searchTerm)->paginate($paginate);
        //$time = Time::where('id', 1)->get();
        //dd($time[0]->nome);
        //$jogador = $time[0]->Jogadores()->get();
        //dd($jogador[2]->nome);
        //$this->allJogadores = Jogador::where('id', 3)->get();
        //dd($this->allJogadores[0]->nome);
        return view('livewire.times.times', [ 
            'times' => $times,
            //'allJogadores' => $this->allJogadores,
        ]);
    }
}
