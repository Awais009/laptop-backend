<?php

namespace App\Livewire;

use App\Models\HomeBanner;
use App\Models\Product;
use Livewire\Component;

class ManageHome extends Component
{
    public $typeFilter = '';

    public function filterType($type)
    {
    $this->typeFilter = $type;
    }

    public function changeType($id,$type)
    {
        Product::find($id)->update(['type' => $type]);
    }
    public function render()
    {
        $products = Product::when($this->typeFilter, fn ($q) => $q->where('type',$this->typeFilter) )->orderByDesc('id')->get();
        return view('livewire.manage-home',['products'=>$products]);
    }
}
