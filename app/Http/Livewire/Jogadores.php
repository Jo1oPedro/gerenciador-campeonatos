<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jogador;
use Livewire\WithPagination;

class Jogadores extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $jogadores = Jogador::orderBy('id', 'DESC')->paginate(5);
        return view('livewire.jogadores', [
            'jogadores' => $jogadores,
            'pagination' => Jogador::paginate(5),
        ]);
    }
}
