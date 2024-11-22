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
        $banners = Product::with('image','images')
            ->where('type','banner')
            ->orderByDesc('id')
            ->get();
        $best_products = Product::with('image', 'images')
            ->whereNotIn('type', ['banner', 'all'])
            ->latest()
            ->get()
            ->groupBy('type');
        return response()->json([
            'success' => true,
            'storagePath' => asset('storage/app'),
            'message' => 'Products retrieved successfully',
            'navigations' => $navigations,
            'banners' => $banners,
            'best_products' => $best_products
        ], 200);
    }
}
