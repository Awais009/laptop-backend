<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{

    public function remove($id)
    {
        Product::destroy($id);
    }
    public function render()
    {
        $products =  Product::orderByDesc('id')->get();
        return view('livewire.products.product-list',[
            'products' => $products
        ]);
    }

    public function rendered()
    {
        $this->dispatch('rendered');
    }
}
