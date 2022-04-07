<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Campeonato;
use App\Models\Time;
use App\Models\Times_campeonato;
use livewire\WithPagination;

class DashboardCampeonatos extends Component
{

    use WithPagination;
    public $searchTermCampeonato;
    public $searchTermTime;
    public $campeonatoId = NULL;

    public function resetInputs()
    {
        $this->campeonatoId = NULL;
    }

    public function getTimes($campeonatoId)
    {
        $this->campeonatoId = $campeonatoId;
    }

    public function updatingSearchInput()
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        $searchTermCampeonato = '%' . $this->searchTermCampeonato . '%';
        $searchTermTime = '%' . $this->searchTermTime . '%';
        $paginateTime = 7;
        $paginateCampeonato = 9;
        $times = Time::where('id', -1)->paginate($paginateTime);
        if($searchTermTime != '%%' || $searchTermCampeonato != '%%')
        {
            $this->updatingSearchInput();
        }
        if(isset($this->campeonatoId))
        {
            $timesIds = Times_campeonato::select('time_id')->where('campeonato_id', $this->campeonatoId)->get()->toArray();
            $times = Time::whereIn('id', $timesIds)
                            ->where('nome', 'like', $searchTermTime)
                            ->paginate($paginateTime, ['*'], "timePaginate{$this->campeonatoId}");
        }
        $campeonatos = Campeonato::where('nome', 'like', $searchTermCampeonato)->paginate($paginateCampeonato, ['*'], 'campeonatosPaginate');
        return view('livewire.dashBoards.campeonatos.dashboard-campeonatos', [
            'campeonatos' => $campeonatos,
            'times' => $times,
        ]);
    }
}
