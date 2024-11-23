<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Navigation;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create product
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $navigations = Navigation::with('products.image','products.navigation_item')->get();
        $products = Product::with('image', 'images','navigation_item')
            ->whereNotIn('type', ['all'])
            ->latest()
            ->get()
            ->groupBy('type');
        return response()->json([
            'success' => true,
            'storagePath' => asset('storage/app'),
            'message' => 'Products retrieved successfully',
            'navigations' => $navigations,
            'products' => json_decode($products,true)
        ], 200);
    }
}
