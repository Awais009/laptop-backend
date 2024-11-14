<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NavigtionController extends Controller
{
    /**
     * Create navigation
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
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Create navigation
        $navigation = new Navigation();
        $navigation->title = $request->input('title');
        $navigation->save();

        return response()->json(['message' => 'Navigation created successfully'], 201);
    }

    /**
     * Get all navigations
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $navigations = Navigation::with('items')->get();

        return response()->json(['message' => 'Navigations retrieved successfully', 'navigations' => $navigations], 200);
    }

    /**
     * Get navigation by ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Authentication check
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $navigation = Navigation::find($id);

        if (!$navigation) {
            return response()->json(['message' => 'Navigation not found'], 404);
        }

        return response()->json(['message' => 'Navigation retrieved successfully', 'data' => $navigation], 200);
    }

    /**
     * Update navigation
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

        $navigation = Navigation::find($id);

        if (!$navigation) {
            return response()->json(['message' => 'Navigation not found'], 404);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Update navigation
        $navigation->title = $request->input('title', $navigation->title);
        $navigation->save();

        return response()->json(['message' => 'Navigation updated successfully'], 200);
    }

    /**
     * Delete navigation
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

        $navigation = Navigation::find($id);

        if (!$navigation) {
            return response()->json(['message' => 'Navigation not found'], 404);
        }

        $navigation->delete();

        return response()->json(['message' => 'Navigation deleted successfully'], 200);
    }
}
