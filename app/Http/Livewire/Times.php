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
