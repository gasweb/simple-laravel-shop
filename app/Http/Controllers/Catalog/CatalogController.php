<?php
namespace App\Http\Controllers\Catalog;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller,
    App\Category,
    App\Product;

class CatalogController extends Controller
{
    /**
     * Display a listing of categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('catalog.category.public.index');
    }

    /**
     * Display the specified category.
     *
     * @param  string $alias
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        /** @var \App\Category $category */
        $category = Category::where(['alias' => $alias])->first();


        if (!$category){
            die('No category');
        }

        $products = Product::where(['category_id' => $category->id])->paginate(10);

        return view('catalog.category.public.show')->with([
            'category' => $category,
            'products' => $products
        ]);
    }
}
