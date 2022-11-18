<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seller;

class SellerController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'rol.admin.isValid']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sellers = Seller::all();
        return view('seller.index', ['sellers' => $sellers]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100'
        ]);

        Seller::create([
            'name' => $request->name,
        ]);

        return redirect('/seller');
    }

    public function actionEdit($id)
    {
        $seller = Seller::find($id);

        if (empty($seller)) {
            return redirect('/seller');
        }

        return view('/seller.edit', ['seller' => $seller]);
    }

    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100'
        ]);

        $seller = Seller::find($id);

        if (empty($seller)) {
            return redirect('/seller');
        }

        $seller->name = $request->name;

        $seller->save();

        return redirect('/seller');
    }

}
