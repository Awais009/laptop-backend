<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class OrderList extends Component
{

    public function render()
    {
        $orders = Order::orderByDesc('id')->get();
        return view('livewire.order.order-list',['orders'=>$orders]);
    }
}
