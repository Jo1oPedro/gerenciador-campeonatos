<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Time;
use livewire\WithPagination;

class DashboardTimes extends Component
{
    use WithPagination;

    public $searchTermTime;
    public $ordernar = NULL;

    public function ordernarPor($ordernar)
    {
        $this->ordernar = $ordernar;
    }

    public function updatingSearchInput()
    {
        $this->gotoPage(1, 'campeonatosPaginate'); // por só ter um paginate nessa pagina, não há necessidade de se passar o segundo parametro
    }

    public function render()
    {
        $searchTermTime = '%' . $this->searchTermTime . '%';
        if($searchTermTime != '%%')
        {
            $this->updatingSearchInput();
        }
        if(isset($this->ordernar))
        {
            $times = Time::where('pais_origem', 'like', $searchTermTime)
                        ->orderBy($this->ordernar, 'desc')
                        ->paginate(6 , ['*'], 'campeonatosPaginate'); 
        } else {
            $times = Time::where('pais_origem', 'like', $searchTermTime)->paginate(6 , ['*'], 'campeonatosPaginate');   
        }
        $this->ordernar = NULL;
        return view('livewire.dashboards.times.dashboard-times',[
            'times' => $times,
        ]);
    }
}
