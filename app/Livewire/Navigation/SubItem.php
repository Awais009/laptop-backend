<?php

namespace App\Livewire\Navigation;

use Livewire\Component;

class SubItem extends Component
{
    public $item;
    public $title = '';
    public $expand = false;
    public function mount(){
        $this->title = $this->item->title;
    }

    public function update(){
        $this->item->title = $this->title;
        $this->item->save();
        $this->expand =false;

    }

    public function render()
    {
        return view('livewire.navigation.sub-item');
    }
}
