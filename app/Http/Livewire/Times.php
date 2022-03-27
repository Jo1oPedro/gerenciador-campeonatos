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

    public $nome;
    public $pais_origem;
    public $pontuacao;
    public $vitorias;
    public $derrotas;

    protected $rules = [
        'nome' => 'required|string|min:2',
        'pais_origem' => 'required|string|min:2',
    ];

    public function messages()
    {
        return [
            'nome.required' => 'O campo :attribute é obrigatorio',
            'nome.string' => 'O campo :attribute precisa ser um texto',
            'nome.min' => 'O campo :attribute precisa ter pelo menos :value caracteres',
            'pais_origem.required' => 'O campo pais de origem é obrigatorio',
            'pais_origem.string' => 'O campo pais de origem precisa ser um texto',
            'pais_origem.min' => 'O campo pais de origem precisa ter pelo menos :value caracteres',
        ];
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

    public function resetInput() {
        $this->nome = $this->pais_origem = $this->pontuacao = $this->vitorias = $this->derrotas = '';
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
