<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$product_id = 1;
        $product = Product::find($product_id);
        var_dump($product->categories);
        var_dump($product);*/
        return 123;
//        return view('dashboard')->with('listings', $user->listings);
    }
}