<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryItem extends Component
{

    public $category;
    public $title = '';
    public $item_title = '';
    public $expand = false;
    public $expandItem = false;
    public $expanded = true;

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->title = $category->title;
    }

    public function update(){
        $this->validate(['title'=>'required|string|max:191']);
        $this->category->title = $this->title;
        $this->category->save();
        $this->expand = false;

    }
    public function addItem()
    {
        $this->validate(['item_title'=>'required|string|max:191']);

        \App\Models\SubCategory::create([
            'title' => $this->item_title,
            'category_id' => $this->category->id
        ]);
        $this->expanded = true;
    }

    #[On('deleteItem')]
    public function deleteItem($id)
    {
        $item = \App\Models\SubCategory::destroy($id);
    }
    public function render()
    {
        return view('livewire.category.category-item');
    }
}
