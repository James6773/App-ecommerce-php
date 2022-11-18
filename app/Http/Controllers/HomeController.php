<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    const ADMIN_ROLE = 1;
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products;
        
        if ($request->user()->role_id == self::ADMIN_ROLE) {
            $products = Product::with(['Category', 'Brand', 'Seller'])->get();
        } else {
            $products = Product::with(['Category', 'Brand', 'Seller'])
                                    ->where('seller_id', $request->user()->seller_id)
                                    ->get();
        }

        return view('home', ['products' => $products]);
    }
}
