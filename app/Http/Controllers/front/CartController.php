<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Add product to cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Authentication check
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Check if product already exists in cart
        $existingCart = Cart::where('user_id', $user->id)
            ->where('product_id', $request->input('product_id'))
            ->first();

        if ($existingCart) {
            // Update quantity
            $existingCart->qty += $request->input('qty');
            $existingCart->save();
        } else {
            // Create new cart entry
            $cart = new Cart();
            $cart->product_id = $request->input('product_id');
            $cart->qty = $request->input('qty');
            $cart->user_id = $user->id;
            $cart->save();
        }

        return response()->json(['message' => 'Product added to cart successfully'], 201);
    }

    /**
     * Get cart items
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Authentication check
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $cartItems = Cart::with('product.image')->where('user_id', $user->id)->get();

        return response()->json([
            'message' => 'Cart items retrieved successfully',
            'storagePath' => asset('storage/app/private'),
            'cart' => $cartItems,
        ], 200);
    }

    /**
     * Update cart item quantity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Authentication check
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $cartItem = Cart::find($id);

        if (!$cartItem || $cartItem->user_id !== $user->id) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'qty' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $cartItem->qty = $request->input('qty');
        $cartItem->save();

        return response()->json(['message' => 'Cart item updated successfully','cart'=>$cartItem], 200);
    }

    /**
     * Remove cart item
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Authentication check
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $cartItem = Cart::find($id);

        if (!$cartItem || $cartItem->user_id !== $user->id) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Cart item removed successfully'], 200);
    }
}
