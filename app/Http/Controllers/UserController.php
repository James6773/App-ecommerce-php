<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Seller;
use App\Models\User;

class UserController extends Controller
{

    /*
    Client ID: 3
    Client secret: qCV3HTJTGWr1xVj2vocHmMWTojcc3VfAc9xU2Sxn
    */

    const SELLER_ROL = 2;
    const DEFAULT_PASSWORD = '123456789';

    public function __construct()
    {
        $this->middleware(['auth', 'rol.admin.isValid']);
    }

    public function index(Request $request)
    {
        $users = User::with(['Role', 'Seller'])->get();
        $sellers = Seller::all();

        // vista return
        return view('user.index', ['users' => $users, 'sellers' => $sellers]);
    }

    protected function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'seller_id' => ['required', 'integer'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => self::SELLER_ROL,
            'seller_id' =>  $request->seller_id,
            'password' => Hash::make(self::DEFAULT_PASSWORD),
        ]);

        return redirect('/user');
    }

    public function actionEdit($id)
    {
        $user = User::find($id);
        //dd($user);
        $sellers = Seller::all();

        if (empty($user)) {
            return redirect('/user');
        }

        return view('/user.edit', ['user' => $user, 'sellers' => $sellers]);
    }

    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'seller_id' => ['required', 'integer'],
        ]);

        $user = User::find($id);

        if (empty($user)) {
            return redirect('/user');
        }

        $user->name = $request->name;
        $user->seller_id = $request->seller_id;

        $user->save();

        return redirect('/user');
    }
}
