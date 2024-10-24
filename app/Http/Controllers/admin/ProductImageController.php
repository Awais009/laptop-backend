<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends Controller
{
    /**
     * Upload product image
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Upload image
        $image = $request->file('image');
        $path = Storage::putFile('product_images', $image);

        // Create product image
        $productImage = new ProductImage();
        $productImage->path = $path;
        $productImage->description = $request->input('description');
        $productImage->product_id = $request->input('product_id');
        $productImage->save();

        return response()->json(['message' => 'Product image uploaded successfully'], 201);
    }

    /**
     * Get product images
     *
     * @param  int  $product_id
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        // Authentication check
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $productImages = ProductImage::where('product_id', $product_id)->get();

        return response()->json(['message' => 'Product images retrieved successfully', 'data' => $productImages], 200);
    }

    /**
     * Update product image
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

        $productImage = ProductImage::find($id);

        if (!$productImage) {
            return response()->json(['message' => 'Product image not found'], 404);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $productImage->description = $request->input('description', $productImage->description);
        $productImage->save();

        return response()->json(['message' => 'Product image updated successfully'], 200);
    }

    /**
     * Delete product image
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

        $productImage = ProductImage::find($id);

        if (!$productImage) {
            return response()->json(['message' => 'Product image not found'], 404);
        }

        Storage::delete($productImage->path);
        $productImage->delete();

        return response()->json(['message' => 'Product image deleted successfully'], 200);
    }
}
