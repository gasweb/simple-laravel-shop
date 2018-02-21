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
        $product_id = 1;

        /** @var \App\Product $product */
        $product = Product::find($product_id);
//        var_dump($product->categories()->first());

        return view('catalog.product.preview')->with('product', $product);
    }
}