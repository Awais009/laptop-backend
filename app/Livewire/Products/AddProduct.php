<?php

namespace App\Livewire\Products;

use App\Models\Filter;
use App\Models\Navigation;
use App\Models\NavigationItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;
 public $title = '';
 public $price = '';
 public $description = '';
 public $qty = '';
 public $navigation_id = '';
 public $navigation_item_id = '';
 public $sub_category_id = [];

 public $images = [];
 public $image_description = [];


    public function remove_item($index)
    {
        unset($this->images[$index]);
        unset($this->image_description[$index]);
    }

  public  function save()
    {
        $validator = $this->validate( [
            'title' => 'required|string|max:191',
            'price' => 'required|integer',
            'description' => 'required|string',
            'qty' => 'required|integer',
            'navigation_id' => 'required|exists:navigations,id',
            'navigation_item_id' => 'required|exists:navigation_items,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'images' => 'required',
            'images.*' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $sku = "SKU_".Str::random(10);

        while (Product::where('SKU', $sku)->exists()) {
            $sku = "SKU_".Str::random(10);
        }

        // Create product
        $product = new Product();
        $product->title = $this->title;
        $product->price = $this->price;
        $product->sku = $sku;
        $product->description = $this->description;
        $product->qty = $this->qty;
        $product->navigation_id = $this->navigation_id;
        $product->navigation_item_id = $this->navigation_item_id;
        $product->save();

        foreach ($this->sub_category_id as $sub_category_id) {
            Filter::create([
                'sub_category_id' => $sub_category_id,
                'product_id' => $product->id,
            ]);
        }
        // Upload image
        if($images = $this->images){
            foreach ($images as $key => $image){
                $path = $image->store('productImage', 'public');
                // Create product image
                ProductImage::create([
                'path' => $path,
                'description' => $this->image_description[$key] ?? null,
                'product_id' => $product->id

                ]);
            }

        }
        $this->reset('images');

    $this->redirectRoute('product.list');

    }

    public function render()
    {
        $navigations =  Navigation::OrderByDesc('id')->get();
        $nav_items =  NavigationItem::orderByDesc('id')->get();
        $sub_categories =  SubCategory::orderByDesc('id')->get();
        return view('livewire.products.add-product',[
            'navigations' => $navigations,
            'nav_items' => $nav_items,
            'sub_categories' => $sub_categories,
        ]);
    }

    public function rendered()
    {
        $this->dispatch('rendered');
    }

}
