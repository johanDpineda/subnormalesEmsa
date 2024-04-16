<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

use Livewire\WithPagination;

class Indexteams extends Component
{
    use WithPagination;
    public $subnorm;
    public $query = '';
    public $cant = 6;
    public $playersCountTeams;
    protected $queryString = [
        'cant' => ['except' => 6],
        'query' => ['except' => '']
    ];

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function mount()
    {
       

    }

    public function chargingData()
    {
        
    }



    public function render()
    {
        $subnorm = $this->chargingData();
        return view('livewire.frontend.indexteams',compact('subnorm'));
    }
}
