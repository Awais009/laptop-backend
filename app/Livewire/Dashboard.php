<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {

        $orderPercentages = Order::whereIn('status', ['pending', 'cancelled', 'delivered'])
            ->whereYear('created_at', date('Y'))
            ->select(
                DB::raw('status'),
                DB::raw('COALESCE(ROUND((COUNT(*) / (SELECT COUNT(*) FROM users)) * 100), 0) as percentage')
            )
            ->groupBy('status')
            ->pluck('percentage', 'status')
            ->transform(function ($value) {
                return intval($value);
            })
            ->toArray();
//        dd($orderPercentages);

        return view('livewire.dashboard');
    }
}
