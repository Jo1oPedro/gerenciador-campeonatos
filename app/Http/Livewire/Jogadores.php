<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jogador;
use Livewire\WithPagination;

class Jogadores extends Component
{

    use WithPagination;

    public $jogadorId;
    public $nome;
    public $idade;
    public $nacionalidade;
    public $time;
    public $vitorias;
    public $derrotas;
    //public $time;

    public $searchTerm = '';
    protected $paginationTheme = 'bootstrap';

    protected $rules =  [
        'nome' => 'required|min:5|string',
        'idade' => 'required|integer|min:14|max:70',
        'nacionalidade' => 'required|string|min:2',
        //'time' => 'required|string|min:2',
    ];

    public function messages()
    {
        return [
            'nome.required' => 'O campo :attribute é obrigatorio',
            'nome.min' => 'O campo :attribute precisa ter pelo menos :min caracteres',
            'nome.string' => 'O campo :attribute precisa ser uma string',
            'idade.required' => 'O campo :attribute é obrigatorio',
            'idade.min' => 'O campo :attribute precisa ter pelo menos :min anos',
            'idade.max' => 'O campo :attribute pode ter até :max anos',
            'nacionalidade.required' => 'O campo de :attribute é obrigatorio',
            'nacionalidade.min' => 'O campo de :attribute precisa ter pelo menos :min caracteres',
            'nacionalidade.string' => 'O campo de :attribute precisa ser uma string',
        ];
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function resetErrors() 
    {
        $this->resetValidation();
    }

    public function resetInput() {
        $this->nome = $this->idade = $this->nacionalidade = $this->time = $this->jogadorId = '';
    }
    
    public function store() {
        $this->validate();

        Jogador::create([
            'nome' => $this->nome,
            'idade' => $this->idade,
            'nacionalidade' => $this->nacionalidade,
            //'time' => $this->time,
        ]);

        session()->flash('message', "Jogador $this->nome criado com sucesso");
        $this->resetInput(); // reseta os campos
        $this->emit('closeModal', '#addJogadorModal');
        //$this->emit('jogadorAdded'); // emite a ação para esconder o model de criação de jogador
        //$this->dispatchBrowserEvent('jogadorAdded'); // emite a ação para esconder o model de criação de jogador
    }

    public function edit(Jogador $jogador)
    {
        //$this->emit('jogadorInfo');
        //dd('morreu');
        $this->resetValidation();
        $this->jogadorId = $jogador->id;
        $this->nome = $jogador->nome;
        $this->idade = $jogador->idade;
        $this->nacionalidade = $jogador->nacionalidade;
        $this->vitorias = $jogador->vitorias;
        $this->derrotas = $jogador->derrotas;
        //$this->time = $jogador->time;
    }
    
    public function update()
    {
        $this->validate();
        if($this->jogadorId) 
        {
            Jogador::where('id', $this->jogadorId)->update([
                'nome' => $this->nome,
                'idade' => $this->idade,
                'nacionalidade' => $this->nacionalidade,
                'vitorias' => $this->vitorias,
                'derrotas' => $this->derrotas,
                //'time' => $this->time,
            ]);
        }
        session()->flash('message', "Jogador $this->nome atualizado com sucesso");
        $this->resetInput();
        $this->emit('closeModal', '#updateJogadorModal');
        //$this->emit('jogadorUpdated');
    }

    public function delete($jogador) 
    {
        $jogador = Jogador::where('id', $jogador)->first();
        if($jogador) {
            $name = $jogador->nome;
            $jogador->delete();
            session()->flash('message', "Jogador $name deletado com sucesso");
        }
        session()->flash('error', "Ocorreu um erro ao excluir o jogador");
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $paginate = 15;
        $jogadores = Jogador::where('nome', 'like', $searchTerm)->paginate($paginate);
        //$jogadores = Jogador::orderBy('id', 'DESC')->paginate($paginate);
        //$pagination = ceil(Jogador::count()/$paginate) não tava usando esse;

        return view('livewire.jogador.jogadores', [
            'jogadores' => $jogadores,
            //'pagination' => Jogador::paginate($paginate),
        ]);
    }
}
