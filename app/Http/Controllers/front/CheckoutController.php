<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    /**
     * Login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitOrder(Request $request){
        // Validation

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:191', // Full name must be a string with a max of 255 characters
            'phone_number' => 'required|string|max:191', // Basic phone validation
            'address' => 'required|string|max:191', // Address must not exceed 255 characters
            'address2' => 'nullable|string|max:191', // Optional secondary address
            'country' => 'required|string|max:100', // Country name limited to 100 characters
            'state' => 'required|string|max:100', // State name limited to 100 characters
            'city' => 'required|string|max:100', // City name limited to 100 characters
            'zip_code' => 'nullable|string|max:20', // Zip code limited to 20 characters
            'message' => 'nullable|string|max:1000', // Message limited to 1000 characters
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }
        $carts = Cart::where('user_id',$user->id)->get();
        if ($carts->count() == 0) {
            return response()->json(['message' => 'cart is empty'], 422);
        }

        $totalPrice = $carts->sum(fn($cart) => $cart->product->price * $cart->qty);



        $order = Order::create([
            'user_id' => $user->id,
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'address2' => $request->address2,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'message' => $request->message,
            'total' => $totalPrice,
        ]);

        $orderItems = $carts->map(fn($cart) => [
            'order_id' => $order->id,
            'product_id' => $cart->product_id,
            'qty' => $cart->qty,
            'sub_total' => $cart->product->price * $cart->qty,
        ]);

        OrderItem::insert($orderItems->toArray());

        $carts->each->delete();

        return response()->json([
            'message' => 'Order submitted successfully.',
        ], 200);


    }

    /**
     * Update product
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        // Authentication check
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Find the UserInfo instance by ID
        $info = UserInfo::find($id);

        // Check if the record exists
        if (!$info) {
            return response()->json([
                'message' => 'UserInfo not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255', // Full name must be a string with a max of 255 characters
            'phone_number' => 'required|string|regex:/^\+?[0-9]{7,15}$/', // Basic phone validation
            'address' => 'required|string|max:255', // Address must not exceed 255 characters
            'address2' => 'nullable|string|max:255', // Optional secondary address
            'country' => 'required|string|max:100', // Country name limited to 100 characters
            'state' => 'required|string|max:100', // State name limited to 100 characters
            'city' => 'required|string|max:100', // City name limited to 100 characters
            'zip_code' => 'string|max:20', // Zip code limited to 20 characters
            'message' => 'string|max:1000', // Message limited to 1000 characters
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Update the fields
        $info->full_name = $request->full_name;
        $info->phone_number = $request->phone_number;
        $info->address = $request->address;
        $info->address2 = $request->address2;
        $info->country = $request->country;
        $info->state = $request->state;
        $info->city = $request->city;
        $info->zip_code = $request->zip_code;
        $info->message = $request->message;

        // Save the updated record
        $info->save();


        return response()->json([
            'message' => 'info updated successfully.',
            'user_info' => $info,
        ], 200);
    }
}
