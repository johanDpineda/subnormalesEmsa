<?php

namespace App\Http\Livewire\ToggleUserActivo;

use App\Models\User;
use Livewire\Component;

class Active extends Component
{

    public $user;
    public $activo;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->activo = $user->activo;
    }

    public function toggleActivo()
    {
        $this->user->activo = !$this->user->activo;
        $this->user->save();
        $this->activo = $this->user->activo;
    }




    public function render()
    {
        return view('livewire.toggle-user-activo.active');
    }
}
