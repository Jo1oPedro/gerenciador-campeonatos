<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Time;

class DashboardTimes extends Component
{
    public function ordernarPor($ordernar)
    {

    }

    public function render()
    {
        
        return view('livewire.dashboard-times');
    }
}
