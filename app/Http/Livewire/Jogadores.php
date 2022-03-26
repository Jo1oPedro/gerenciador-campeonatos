<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jogador;
use Livewire\WithPagination;

class Jogadores extends Component
{

    use WithPagination;

    public $name;
    public $idade;
    public $nacionalidade;
    public $time;

    protected $paginationTheme = 'bootstrap';

    protected $rules =  [
        'name' => 'required|min:5|string',
        'idade' => 'required|integer',
        'nacionalidade' => 'required|string|min:2',
        'time' => 'required|string|min:2',
    ];

    public function resetInput() {
        $this->name = $this->idade = $this->nacionalidade = $this->time = '';
    }
    
    public function store() {
        $this->validate();

        Jogador::create([
            'name' => $this->name,
            'idade' => $this->idade,
            'nacionalidade' => $this->nacionalidade,
            'time' => $this->time,
        ]);

        session()->flash('message', "Jogador $this->name criado com sucesso");
        $this->resetInput(); // reseta os campos
        //$this->emit('jogadorAdded'); // emite a ação para esconder o model de criação de jogador
        $this->dispatchBrowserEvent('jogadorAdded'); // emite a ação para esconder o model de criação de jogador
    }
    
    public function render()
    {
        $jogadores = Jogador::orderBy('id', 'DESC')->paginate(5);
        return view('livewire.jogador.jogadores', [
            'jogadores' => $jogadores,
            'pagination' => Jogador::paginate(5),
        ]);
    }
}
