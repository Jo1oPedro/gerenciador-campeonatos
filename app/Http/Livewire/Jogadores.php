<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jogador;
use Livewire\WithPagination;

class Jogadores extends Component
{

    use WithPagination;

    public $jogadorId;
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

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function resetInput() {
        $this->name = $this->idade = $this->nacionalidade = $this->time = $this->jogadorId = '';
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
        $this->emit('jogadorAdded'); // emite a ação para esconder o model de criação de jogador
        //$this->dispatchBrowserEvent('jogadorAdded'); // emite a ação para esconder o model de criação de jogador
    }

    public function edit(Jogador $jogador)
    {
        $this->jogadorId = $jogador->id;
        $this->name = $jogador->name;
        $this->idade = $jogador->idade;
        $this->nacionalidade = $jogador->nacionalidade;
        $this->time = $jogador->time;
    }
    
    public function update()
    {
        $this->validate();
        if($this->jogadorId) 
        {
            Jogador::where('id', $this->jogadorId)->update([
                'name' => $this->name,
                'idade' => $this->idade,
                'nacionalidade' => $this->nacionalidade,
                'time' => $this->time,
            ]);
        }
        session()->flash('message', "Jogador $this->name atualizado com sucesso");
        $this->resetInput();
        $this->emit('jogadorUpdated');
    }

    public function delete(Jogador $jogador) 
    {
        $jogador->delete();
    }

    public function render()
    {
        $paginate = 15;
        $jogadores = Jogador::orderBy('id', 'DESC')->paginate($paginate);
        //$pagination = ceil(Jogador::count()/$paginate);

        return view('livewire.jogador.jogadores', [
            'jogadores' => $jogadores,
            'pagination' => Jogador::paginate($paginate),
        ]);
    }
}
