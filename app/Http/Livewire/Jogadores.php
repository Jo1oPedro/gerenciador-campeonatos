<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jogador;
use App\Models\Time;
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
    public $allTimes;
    public $timeSelected = NULL;
    public $jogador;
    public $searchTerm = '';

    protected $rules =  [
        'nome' => 'required|min:5|string',
        'idade' => 'required|integer|min:14|max:70',
        'nacionalidade' => 'required|string|min:2',
        'timeSelected' => 'sometimes',
        'vitorias' => 'sometimes|integer|min:0',
        'derrotas' => 'sometimes|integer|min:0',
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
            'timeSelected.required' => 'O campo de times é obrigatorio',
            'vitorias.min' => 'O campo de :attribute não pode ser negativo',
            'derrotas.min' => 'O campo de :attribute não pode ser negativo',
        ];
    }

    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function resetErrors() 
    {
        $this->resetValidation();
    }

    public function resetInputs() {
        $this->nome = $this->idade = $this->nacionalidade = $this->time = $this->jogadorId = $this->vitorias = $this->derrotas = $this->jogador = '';
        $this->timeSelected = NULL;
        $this->resetValidation();
    }
    
    public function create() {
        $this->validate();
        Jogador::create([
            'nome' => $this->nome,
            'idade' => $this->idade,
            'nacionalidade' => $this->nacionalidade,
            'time_id' => $this->timeSelected,
        ]);
        session()->flash('message', "Jogador $this->nome criado com sucesso");
        $this->resetInputs();
        $this->emit('closeModal', '#addJogadorModal');
    }

    public function read(Jogador $jogador)
    {
        $this->resetInputs();
        $this->jogadorId = $jogador->id;
        $this->nome = $jogador->nome;
        $this->idade = $jogador->idade;
        $this->nacionalidade = $jogador->nacionalidade;
        $this->time = Time::where('id', $jogador->time_id)->first();
        if($this->time != NULL)
        {
            $this->time = $this->time->nome;
        }
        $this->vitorias = $jogador->vitorias;
        $this->derrotas = $jogador->derrotas;
    }

    public function edit(Jogador $jogador)
    {
        $this->resetInputs();
        $this->jogadorId = $jogador->id;
        $this->nome = $jogador->nome;
        $this->idade = $jogador->idade;
        $this->nacionalidade = $jogador->nacionalidade;
        $this->time = Time::where('id', $jogador->time_id)->first();
        $this->vitorias = $jogador->vitorias;
        $this->derrotas = $jogador->derrotas;
        $this->jogador = $jogador;
    }
    
    public function update()
    {
        $this->validate();
        if($this->timeSelected == "")
        {
            $this->timeSelected = $this->jogador->time_id;
        } else if($this->timeSelected == -1)
        {
            $this->timeSelected = NULL;
        }
        if($this->jogadorId) 
        {
            Jogador::where('id', $this->jogadorId)->update([
                'nome' => $this->nome,
                'idade' => $this->idade,
                'nacionalidade' => $this->nacionalidade,
                'vitorias' => $this->vitorias,
                'derrotas' => $this->derrotas,
                'time_id' => $this->timeSelected,
            ]);
        }
        session()->flash('message', "Jogador $this->nome atualizado com sucesso");
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
        $this->resetInputs();
    }

    public function updatingSearchInput()
    {
        $this->gotoPage(1);
    }

    public function mount() 
    {
        $this->allTimes = Time::all();
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        if($searchTerm != '%%')
        {
            $this->updatingSearchInput();
        }
        $paginate = 8;
        $jogadores = Jogador::where('nome', 'like', $searchTerm)->paginate($paginate);
        $timesName = [];
        foreach($jogadores as $key => $jogador) {
            if($jogador->time == NULL) {
                $timesName[$key] = "";
            }
            else {
                $timesName[$key] = $jogador->time->nome;
            }
        }
        return view('livewire.jogador.jogadores', [
            'jogadores' => $jogadores,
            'times' => $timesName,
        ]);
    }
}
