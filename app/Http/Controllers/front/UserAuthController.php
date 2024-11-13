<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{

    /**
     * Login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function userInfo(Request $request){
         // Validation

         $user = Auth::user();

         if (!$user) {
             return response()->json(['message' => 'Unauthorized'], 401);
         }
         $validator = Validator::make($request->all(), [
             'user_id' => 'required|exists:users,id', // Ensure the user exists in the users table
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

         $info = new UserInfo();
         $info->user_id = $request->user_id;
         $info->full_name = $request->full_name;
         $info->phone_number = $request->phone_number;
         $info->address = $request->address;
         $info->address2 = $request->address2;
         $info->country = $request->country;
         $info->state = $request->state;
         $info->city = $request->city;
         $info->zip_code = $request->zip_code;
         $info->message = $request->message;

         // Save the data to the database
         $info->save();



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

    /**
     * Login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        // Validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:191',
            'password' => 'required|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        // Attempt login
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Generate token
        $token = Auth::user()->createToken('login_token')->plainTextToken;

        // Return response
        return response()->json(['token' => $token, 'user' => Auth::user()], 200);
    }

    /**
     * Register
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate token
        $token = $user->createToken('register_token')->plainTextToken;

        // Return response
        return response()->json(['token' => $token, 'user' => $user], 201);
    }

    /**
     * Logout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $user->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }


}
