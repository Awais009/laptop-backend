<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Categories extends Component
{

#[Validate('required|string|max:191')]
    public $title;

    public function addCategory()
    {
        $this->validate();

        Category::create(['title' => $this->title]);
    }

    #[On('deleteCategory')]
    public function deleteCategory($id)
    {

        Category::destroy($id);
    }


    public function render()
    {
        $categories =   Category::orderByDesc('id')->get();
        return view('livewire.category.categories',['categories'=>$categories]);
    }
}
