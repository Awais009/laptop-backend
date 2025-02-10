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
use function PHPUnit\Framework\isEmpty;

class AddProduct extends Component
{
    use WithFileUploads;
    public $id ;
    public $product ;
    public $title = '';
    public $over_price = '';
    public $price = '';
    public $description = '';
    public $qty = '';
    public $navigation_id = '';
    public $navigation_item_id = '';
    public $sub_category_id = [];

    public $images = [];
    public $productImages = [];
    public $image_description = [];

    public function mount()
    {
        $this->product = Product::find($this->id);
        $this->title = $this->product?->title;
        $this->over_price = $this->product?->over_price;
        $this->price = $this->product?->price;
        $this->description = $this->product?->description;
        $this->qty = $this->product?->qty;
        $this->navigation_id = $this->product?->navigation_id;
        $this->navigation_item_id = $this->product?->navigation_item_id;
        $this->sub_category_id = $this->product?->filters()->pluck('sub_category_id')->toArray() ?? [];


    }

    public function remove_item($index)
    {
        unset($this->images[$index]);
        unset($this->image_description[$index]);
    }

    public  function save()
    {
        $validator = $this->validate( [
            'title' => 'required|string|max:191',
            'over_price' => 'required|integer',
            'price' => 'required|integer|lt:over_price',
            'description' => 'required|string',
            'qty' => 'required|integer',
            'navigation_id' => 'required|exists:navigations,id',
            'navigation_item_id' => 'required|exists:navigation_items,id',
            'sub_category_id' => 'required|exists:sub_categories,id',

        ]);

        if (!$this->id){
            $this->validate([
                'images' => 'required',
                'images.*' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
            ]);
        }

        $sku = "SKU_".Str::random(10);

        while (Product::where('SKU', $sku)->exists()) {
            $sku = "SKU_".Str::random(10);
        }

        // Create product
        $product =  Product::updateOrCreate(['id' => $this->id],[
            'title' => $this->title,
            'over_price' => $this->over_price,
            'price' => $this->price,
            'sku' => $sku,
            'description' => $this->description,
            'qty' => $this->qty,
            'navigation_id' => $this->navigation_id,
            'navigation_item_id' => $this->navigation_item_id,
        ]);

            $product->filters()->delete();

        foreach ($this->sub_category_id as $sub_category_id) {
            Filter::create([
                'sub_category_id' => $sub_category_id,
                'product_id' => $product->id,
            ]);
        }
        if ($this->productImages) {
            $this->productImages->each(function ($item) {
                $item->description = $this->image_description[$item->id];
                $item->save();
            });
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

    public function removeImage($id)
    {
        $image = ProductImage::find($id);
        if (file_exists(asset('storage/app/' . $image->path))) {
            unlink(asset('storage/app/' . $image->path));
        }
        $image->delete();


    }


    public function render()
    {

        $this->productImages = $this->product?->images ?? [];
        if ($this->productImages){
            $this->productImages->each(function ($item) {
                $this->image_description[$item->id] = $item->description;
            });
        }

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
