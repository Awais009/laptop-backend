<?php

namespace App\Livewire;

use App\Livewire\Navigation\Navigations;
use App\Models\Navigation;
use App\Models\NavigationItem;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
class Dashboard extends Component
{





    function formatNumber($num) {
        $num = intval($num) ;


        $suffixes = ['', 'K', 'M', 'B', 'T'];
        $exp = floor(log10($num) / 3);
        if ($num == 0) {
            return '0';
        }
        $value = $num / pow(10, $exp*3);
        $formatted = ($value == (int) $value) ? (int) $value : number_format($value, 1);
        return $formatted . $suffixes[$exp];
    }
    public function render()
    {

        $today_revenue =  Order::where('status','delivered')-> where('created_at',now())-> sum('total');
        $total_revenue = Order::where('status','delivered')->sum('total');
        $monthlyAverageIncomes = [];
        $transactions = Order::select(
            DB::raw('COUNT(*) as count'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total) as total_income')
        )
            ->whereYear('created_at',date('Y'))
            ->groupBy('month')
            ->get();


        $totalIncome = Order::whereYear('created_at', date('Y'))->sum('total');
        $currentMonth = date('n'); // current month (1-12)

        foreach ($transactions as $transaction) {
            $monthlyAverageIncomes[$transaction->month] = [
                'month' => date('M', mktime(0, 0, 0, $transaction->month, 1)),
                'total_income' => $this->formatNumber($transaction->total_income) ,
                'count' => $transaction->count ,
                'percentage' => ($totalIncome != 0) ? round(($transaction->total_income / $totalIncome) * 100, 2) : 0,
                'color' => ($transaction->month == $currentMonth) ? '#22c55e' : '#95a0c5',
            ];
        }

// Fill missing months with 0
        for ($i = 1; $i <= 12; $i++) {
            if (!isset($monthlyAverageIncomes[$i])) {
                $monthlyAverageIncomes[$i] = [
                    'month' => date('M', mktime(0, 0, 0, $i, 1)),
                    'total_income' => 0,
                    'percentage' => 0,
                    'count' => 0,
                    'color' => '#95a0c5',
                ];
            }
        }

// Sort array by key (month)
        ksort($monthlyAverageIncomes);

//        dd($monthlyAverageIncomes);
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

        $navigations = Navigation::with('products')
            ->select('id', 'title')
            ->get()
            ->map(function ($navigation) {
                return[ 'count' => $navigation->products->count(),'name' => $navigation->title];
            })
            ->toArray();


        return view('livewire.dashboard', compact('navigations', 'orderPercentages','monthlyAverageIncomes','total_revenue','today_revenue'));
    }
}
