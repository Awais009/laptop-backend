<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Component;

class OrderDetail extends Component
{
    public $id;

    public function changeStatus($statue)
    {
        Order::find($this->id)->update(['status' => $statue]);
    }

    public function render()
    {
        $order =  Order::find($this->id);
        return view('livewire.order.order-detail',['order'=>$order]);
    }
}
