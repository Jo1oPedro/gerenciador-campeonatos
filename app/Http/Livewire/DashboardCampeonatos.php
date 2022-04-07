<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Campeonato;
use App\Models\Time;
use App\Models\Times_campeonato;
use App\Models\Jogador;
use livewire\WithPagination;

class DashboardCampeonatos extends Component
{
    use WithPagination;
    public $searchTermCampeonato;
    public $searchTermTime;
    public $searchTermJogador;
    public $campeonatoId = NULL;
    public $time = NULL;

    public function resetInputs()
    {
        $this->campeonatoId = $this->time = NULL;
        $this->searchTermCampeonato = $this->searchTermTime = $this->searchTermJogador = "";
    }

    public function getJogadores(Time $time)
    {
        $this->resetInputs();
        $this->time = $time;
    }

    public function getTimes($campeonatoId)
    {
        $this->resetInputs();
        $this->campeonatoId = $campeonatoId;
    }

    public function updatingSearchInput($paginate)
    {
        $this->gotoPage(1, $paginate);
    }

    public function render()
    {
        $searchTermCampeonato = '%' . $this->searchTermCampeonato . '%';
        $searchTermTime = '%' . $this->searchTermTime . '%';
        $searchTermJogador = '%' . $this->searchTermJogador . '%';
        $paginateCampeonato = 9;
        $paginateTime = $paginateJogador = 7 ;
        $times = Time::where('id', -1)->paginate($paginateTime); // evitar bug com a funções do paginate onEachSide
        $jogadores = Jogador::where('id', -1)->paginate(7); // evitar bug com a funções do paginate onEachSide
        if($searchTermTime != '%%')
        {
            $this->updatingSearchInput("timePaginate{$this->campeonatoId}");
        } else if($searchTermCampeonato != '%%') {
            $this->updatingSearchInput("campeonatosPaginate");
        } else if($searchTermJogador != '%%') {
            $this->updatingSearchInput("jogadorPaginate{$this->time->id}");
        }
        if(isset($this->campeonatoId))
        {
            $timesIds = Times_campeonato::select('time_id')->where('campeonato_id', $this->campeonatoId)->get()->toArray();
            $times = Time::whereIn('id', $timesIds)
                            ->where('nome', 'like', $searchTermTime)
                            ->paginate($paginateTime, ['*'], "timePaginate{$this->campeonatoId}");
        }
        if(isset($this->time))
        {
            $jogadores = $this->time->jogadores()->where('nome', 'like', $searchTermJogador)->paginate($paginateJogador, ['*'], "jogadorPaginate{$this->time->id}");
            //dd($jogadores);
        }
        $campeonatos = Campeonato::where('nome', 'like', $searchTermCampeonato)->paginate($paginateCampeonato, ['*'], 'campeonatosPaginate');
        return view('livewire.dashBoards.campeonatos.dashboard-campeonatos', [
            'campeonatos' => $campeonatos,
            'times' => $times,
            'jogadores' => $jogadores,
        ]);
    }
}
