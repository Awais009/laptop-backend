<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller

{
    /**
     * Create sub category
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
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Create sub category
        $subCategory = new SubCategory();
        $subCategory->title = $request->input('title');
        $subCategory->category_id = $request->input('category_id');
        $subCategory->save();

        return response()->json(['message' => 'Sub Category item created successfully'], 201);
    }

    /**
     * Get all sub categories
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

        $subCategory = SubCategory::all();

        return response()->json(['message' => 'Sub Category items retrieved successfully', 'data' => $subCategory], 200);
    }

    /**
     * Get sub category by ID
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

        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return response()->json(['message' => 'Sub Category item not found'], 404);
        }

        return response()->json(['message' => 'Sub Category item retrieved successfully', 'data' => $subCategory], 200);
    }

    /**
     * Update sub category
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

        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return response()->json(['message' => 'Sub Category item not found'], 404);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Update sub category
        $subCategory->title = $request->input('title', $subCategory->title);
        $subCategory->category_id = $request->input('category_id', $subCategory->category_id);
        $subCategory->save();

        return response()->json(['message' => 'Sub Category item updated successfully'], 200);
    }

    /**
     * Delete sub category
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

        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return response()->json(['message' => 'Sub Category item not found'], 404);
        }

        $subCategory->delete();

        return response()->json(['message' => 'Sub Category item deleted successfully'], 200);
    }
}
