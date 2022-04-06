<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Campeonato;
use livewire\WithPagination;

class DashboardCampeonatos extends Component
{

    use WithPagination;
    public $searchTerm;

    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $paginate = 15;
        $campeonatos = Campeonato::where('nome', 'like', $searchTerm)->paginate($paginate);
        return view('livewire.dashBoards.campeonatos.dashboard-campeonatos', [
            'campeonatos' => $campeonatos,
        ]);
    }
}
