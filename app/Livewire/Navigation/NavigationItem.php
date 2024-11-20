<?php

namespace App\Livewire\Navigation;

use App\Models\Navigation;
use Livewire\Attributes\On;
use Livewire\Component;

class NavigationItem extends Component
{
    public $navigation;
    public $title = '';
    public $item_title = '';
    public $expand = false;
    public $expandItem = false;
    public $expanded = true;

    public function mount(Navigation $navigation)
    {
        $this->navigation = $navigation;
        $this->title = $navigation->title;
    }

    public function update(){
        $this->validate(['title'=>'required|string|max:191']);
        $this->navigation->title = $this->title;
        $this->navigation->save();
        $this->expand = false;

    }
    public function addItem()
    {
        $this->validate(['item_title'=>'required|string|max:191']);

        \App\Models\NavigationItem::create([
            'title' => $this->item_title,
            'navigation_id' => $this->navigation->id
        ]);
        $this->expanded = true;
    }

    #[On('deleteItem')]
    public function deleteItem($id)
    {
        $item = \App\Models\NavigationItem::destroy($id);
    }

    public function render()
    {
        return view('livewire.navigation.navigation-item');
    }
}
