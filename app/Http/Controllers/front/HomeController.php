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

        $navigations = Navigation::with('products.image')->get();

        return response()->json([
            'success' => true,
            'storagePath' => asset('storage/app/private'),
            'message' => 'Products retrieved successfully',
            'navigations' => $navigations
        ], 200);
    }
}
