<?php

namespace App\Livewire\Category;

use Livewire\Component;

class SubCategory extends Component
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
        return view('livewire.category.sub-category');
    }
}
