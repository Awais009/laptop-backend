<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class Invoice extends Component
{
    public $id;
    public function render()
    {
        $order =  Order::find($this->id);
        return view('livewire.order.invoice',['order'=>$order]);
    }
}
