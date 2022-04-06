<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Time;
use App\Models\Jogador;

class Times extends Component
{

    use WithPagination;
    
    public $time_id;
    public $nome;
    public $paisOrigem;
    public $pontuacao;
    public $vitorias;
    public $derrotas;
    public $jogadoresNoTime = [];
    public $searchTerm;

    public function getJogadores(Time $time) 
    {
        (count($this->allJogadores) == 0) ? $this->allJogadores = $time->Jogadores()->get() : $this->allJogadores = [];
        /*if($this->allJogadores = '') 
        {
            $this->allJogadores = $time->Jogadores()->get();
        }*/
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'nome' => 'required|string|min:2',
        'paisOrigem' => 'required|string|min:2',
        'pontuacao' => 'sometimes|required|integer|',
        'vitorias' => 'sometimes|required|integer|min:0',
        'derrotas' => 'sometimes|required|integer|min:0',
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
            'vitorias.required' => 'O campo :attribute é obrigatorio',
            'vitorias.intenger' => 'O campo :attribute precisa ser um número inteiro',
            'vitorias.min' => 'O campo :attribute não pode ser menor do que :min',
            'derrotas.required' => 'O campo :attribute é obrigatorio',
            'derrotas.integer' => 'O campo :attribute precisa ser um número inteiro',
            'derrotas.min' => 'O campo :attribute não pode ser menor do que :min',
        ];
    }

    public function edit(Time $time) 
    {
        $this->resetErrors();
        $this->time_id = $time->id;
        $this->nome = $time->nome;
        $this->paisOrigem = $time->paisOrigem;
        $this->pontuacao = $time->pontuacao;
        $this->vitorias = $time->vitorias;
        $this->derrotas = $time->derrotas;
        //$this->allJogadores = $time->Jogadores()->get();
        $this->editado = true;
    }

    public function update()
    {
        $this->validate();
        if(!$this->time_id) {
            session()->flash('error', "Ocorreu um problema ao atualizar o time $this->nome");
            $this->resetInputs();
            $this->emit('closeModal', '#updateTimeModal');
            $this->render();
        }
        Time::where('id', $this->time_id)->update([
            'nome' => $this->nome,
            'pais_origem' => $this->paisOrigem,
            'pontuacao' => $this->pontuacao,
            'vitorias' => $this->vitorias,
            'derrotas' => $this->derrotas,
        ]);
        session()->flash('message', "Time $this->nome atualizado com sucesso");
        $this->resetInputs();
        $this->emit('closeModal', '#updateTimeModal');
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
        session()->flash('message', "Time $this->nome criado com sucesso");
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
        $this->time_id = $this->nome = $this->paisOrigem = $this->pontuacao = $this->vitorias = $this->derrotas = $this->allJogadores = '';
        $this->editado = false;
    }

    public function mount()
    {
        $this->jogadores = Jogador::all();
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
