<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'role' => 'required|in:user',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
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
