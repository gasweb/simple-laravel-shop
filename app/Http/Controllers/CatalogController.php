<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category,
    App\Product;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "Some list of categories";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string $alias
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        $product_id = 1;

        /** @var \App\Category $category */
        $category = Category::where(['alias' => $alias])->first();


        if (!$category){
            die('No category');
        }

        $products = Product::where(['category_id' => $category->id])->get();
//        var_dump($category->id);
//        var_dump($products);
//        var_dump($product->categories()->first());

        return view('catalog.category.alias')->with([
            'category' => $category,
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
