<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Time;

class Times extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm;

    public $time_id;
    public $nome;
    public $pais_origem;
    public $pontuacao;
    public $vitorias;
    public $derrotas;

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'nome' => 'required|string|min:2',
        'pais_origem' => 'required|string|min:2',
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
            'pais_origem.required' => 'O campo pais de origem é obrigatorio',
            'pais_origem.string' => 'O campo pais de origem precisa ser um texto',
            'pais_origem.min' => 'O campo pais de origem precisa ter pelo menos :min caracteres',
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
        $this->pais_origem = $time->pais_origem;
        $this->pontuacao = $time->pontuacao;
        $this->vitorias = $time->vitorias;
        $this->derrotas = $time->derrotas;
    }

    public function update()
    {
        $this->validate();
        if(!$this->time_id) {
            session()->flash('message', "Ocorreu um problema ao atualizar o time $this->nome");
            $this->resetInput();
            $this->emit('closeModal', '#updateTimeModal');
        }
        Time::where('id', $this->time_id)->update([
            'nome' => $this->nome,
            'pais_origem' => $this->pais_origem,
            'pontuacao' => $this->pontuacao,
            'vitorias' => $this->vitorias,
            'derrotas' => $this->derrotas,
        ]);
        session()->flash('message', "Time $this->nome atualizado com sucesso");
        $this->resetInput();
        $this->emit('closeModal', '#updateTimeModal');
    }

    public function store() 
    {
        $this->validate();

        Time::create([
            'nome' => $this->nome,
            'pais_origem' => $this->pais_origem,
        ]);

        session()->flash('message', "Time $this->nome criado com sucesso");
        $this->resetInput();
        $this->emit('closeModal', '#addTimeModal');
    }

    public function resetErrors() 
    {
        $this->resetValidation();
    }

    public function resetInput() {
        $this->time_id = $this->nome = $this->pais_origem = $this->pontuacao = $this->vitorias = $this->derrotas = '';
    }
    
    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $paginate = 15;
        $times = Time::where('nome', 'like', $searchTerm)->paginate($paginate);

        return view('livewire.times.times', [ 
            'times' => $times,
        ]);
    }
}
