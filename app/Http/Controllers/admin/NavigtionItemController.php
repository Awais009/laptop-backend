<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NavigtionItemController extends Controller
{
    /**
     * Create navigation item
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
            'navigation_id' => 'required|exists:navigations,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Create navigation item
        $navigationItem = new NavigationItem();
        $navigationItem->title = $request->input('title');
        $navigationItem->navigation_id = $request->input('navigation_id');
        $navigationItem->save();

        return response()->json(['message' => 'Navigation item created successfully'], 201);
    }

    /**
     * Get all navigation items
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

        $navigationItems = NavigationItem::all();

        return response()->json(['message' => 'Navigation items retrieved successfully', 'data' => $navigationItems], 200);
    }

    /**
     * Get navigation item by ID
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

        $navigationItem = NavigationItem::find($id);

        if (!$navigationItem) {
            return response()->json(['message' => 'Navigation item not found'], 404);
        }

        return response()->json(['message' => 'Navigation item retrieved successfully', 'data' => $navigationItem], 200);
    }

    /**
     * Update navigation item
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

        $navigationItem = NavigationItem::find($id);

        if (!$navigationItem) {
            return response()->json(['message' => 'Navigation item not found'], 404);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'navigation_id' => 'sometimes|required|exists:navigations,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Update navigation item
        $navigationItem->title = $request->input('title', $navigationItem->title);
        $navigationItem->navigation_id = $request->input('navigation_id', $navigationItem->navigation_id);
        $navigationItem->save();

        return response()->json(['message' => 'Navigation item updated successfully'], 200);
    }

    /**
     * Delete navigation item
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

        $navigationItem = NavigationItem::find($id);

        if (!$navigationItem) {
            return response()->json(['message' => 'Navigation item not found'], 404);
        }

        $navigationItem->delete();

        return response()->json(['message' => 'Navigation item deleted successfully'], 200);
    }
}
