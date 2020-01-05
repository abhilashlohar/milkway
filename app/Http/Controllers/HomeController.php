<?php

namespace App\Http\Controllers;
use App\User;
use App\Product;
use App\Customers;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_count         = DB::table('users')->count();
        $product_count      = DB::table('products')->where('deleted',false)->count();
        $customer_count     = DB::table('customers')->where('deleted',false)->count();
        return view('home',compact('user_count','product_count','customer_count'));
    }
}
