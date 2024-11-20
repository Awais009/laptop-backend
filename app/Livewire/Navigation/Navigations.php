<?php

namespace App\Livewire\Navigation;

use App\Models\Navigation;
use Livewire\Component;

class Navigations extends Component
{
    public function render()
    {
     $navigations =   Navigation::orderByDesc('id')->get();
        return view('livewire.navigation.navigations',['navigations'=>$navigations]);
    }
}
