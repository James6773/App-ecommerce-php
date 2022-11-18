<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Seller;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'user.product.isValid']);
    }

    public function index(Request $request)
    {
        $category = Category::all();
        $brand = Brand::all();
        $products = Product::with(['Category', 'Brand', 'Seller'])
                            ->where('seller_id', $request->user()->seller_id)
                            ->get();

        return view('product.index', [
            'categories' => $category,
            'brands' => $brand,
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'price' => ['required', 'integer'],
            'inventory' => ['required', 'integer'],
            'image' => 'required|string|max:255',
            'category_id' => ['required', 'integer'],
            'brand_id' => ['required', 'integer'],
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'inventory' => $request->inventory,
            'image' =>  $request->image,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'seller_id' => $request->user()->seller_id,
        ]);

        return redirect('/product');
    }
}
