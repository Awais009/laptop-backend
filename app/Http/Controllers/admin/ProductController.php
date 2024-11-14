<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Navigation;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    /**
     * Create product
     *
     * @return \Illuminate\Http\Response
     */
    public function allProduct(Request $request){


        $products = Product::with('image','navigation_item')
            ->when($request->nav, function ($query) use ($request) {
                $query->whereHas('navigation', function ($subQuery) use ($request) {
                    $subQuery->where('title', $request->nav);
                });
            })
            ->when($request->nav_item, function ($query) use ($request) {
                $query->whereHas('navigation_item', function ($subQuery) use ($request) {
                    $subQuery->where('title', $request->nav_item);
                });
            })
            ->whereHas('image')
            ->orderByDesc('id')
            ->get();

        $categories = Category::with('sub_categories')->get();
        return response()->json([
            'success' => true,
            'storagePath' => asset('storage/app/private'),
            'message' => 'Products retrieved successfully',
            'products' => $products,
            'categories' => $categories
        ], 200);
    }

    /**
     * Create product
     *
     * @return \Illuminate\Http\Response
     */
    public function productDetail($SKU){

        $product = Product::with('images','navigation_item')->where('SKU',$SKU)->first();
        $navigation = Navigation::with('items','products.image')->get();
        return response()->json([
            'success' => true,
            'storagePath' => asset('storage/app/private'),
            'message' => 'Products retrieved successfully',
            'product' => $product,
            'navigations' => $navigation
        ], 200);
    }

    /**
     * Create product
     *
     * @return \Illuminate\Http\Response
     */
    public function quickView($SKU){

        $product = Product::with('images','navigation_item')->where('SKU',$SKU)->first();

        return response()->json([
            'success' => true,
            'storagePath' => asset('storage/app/private'),
            'message' => 'Products retrieved successfully',
            'product' => $product,
        ], 200);
    }

    /**
     * Create product
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $products = Product::with('images')->OrderByDesc('id')->get();
        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'data' => $products
        ], 200);
    }

    /**
     * Create product
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // Authentication check
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'required|string',
            'qty' => 'required|integer',
            'navigation_id' => 'required|exists:navigations,id',
            'navigation_item_id' => 'required|exists:navigation_items,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'images' => 'required|array',
            'images.*' => 'image|max:2048',
            'image_description.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $sku = "SKU_".Str::random(10);

        while (Product::where('SKU', $sku)->exists()) {
            $sku = "SKU_".Str::random(10);
        }

        // Create product
        $product = new Product();
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->sku = $sku;
        $product->description = $request->input('description');
        $product->qty = $request->input('qty');
        $product->navigation_id = $request->input('navigation_id');
        $product->navigation_item_id = $request->input('navigation_item_id');
        $product->sub_category_id = $request->input('sub_category_id');
        $product->save();

        // Upload image
        if($images = $request->file('images')){
        foreach ($images as $key => $image){
        $path = $image->store('productImage');
        // Create product image
        $productImage = new ProductImage();
        $productImage->path = $path;
        $productImage->description = $request->image_description[$key];
        $productImage->product_id = $product->id;
        $productImage->save();
        }

        }



        return response()->json(['message' => 'Product created successfully'], 201);
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

        // Find product
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|integer',
            'description' => 'sometimes|required|string',
            'qty' => 'sometimes|required|integer',
            'navigation_id' => 'sometimes|required|exists:navigations,id',
            'navigation_item_id' => 'sometimes|required|exists:navigation_items,id',
            'sub_category_id' => 'sometimes|required|exists:sub_categories,id',
            'images.*' => 'image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        // Update product
        $product->title = $request->input('title', $product->title);
        $product->price = $request->input('price', $product->price);
        $product->description = $request->input('description', $product->description);
        $product->qty = $request->input('qty', $product->qty);
        $product->navigation_id = $request->input('navigation_id', $product->navigation_id);
        $product->navigation_item_id = $request->input('navigation_item_id', $product->navigation_item_id);
        $product->sub_category_id = $request->input('sub_category_id', $product->sub_category_id);
        $product->save();


        if($images = $request->file('images')){
            foreach ($product->images as $prod_image){
            if (Storage::exists($prod_image->path)) Storage::delete($prod_image->path);
            $prod_image->delete();
            }
            foreach ($images as $image){
                $path = $image->store('productImages');
                // Create product image
                $productImage = new ProductImage();
                $productImage->path = $path;
                $productImage->description = $request->input('description');
                $productImage->product_id = $product->id;
                $productImage->save();
            }

        }


        return response()->json(['message' => 'Product updated successfully'], 200);
    }

    /**
     * Delete navigation
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        // Authentication check
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Find product
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Delete product
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
