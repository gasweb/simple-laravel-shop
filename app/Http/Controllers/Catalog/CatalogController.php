<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller,
    App\Category,
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
}
