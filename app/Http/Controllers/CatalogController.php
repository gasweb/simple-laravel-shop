<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreCategory,
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_list = Category::all()->pluck('title', 'id');
        return view('catalog.category.create')->with([
            'categories_list' => $categories_list
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $category = new Category();

        $category->title = $request->input('title');
        $category->alias = $request->input('alias');
        $category->parent_id = $request->input('parent', null);

        try
        {
            $category->save();
            return redirect('/')->with('message', 'Todo created');
        } catch (\Exception $exception){
            return redirect('/catalog/create');
        }
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
        $category = Category::find($id);
        $categories_list = Category::all()->pluck('title', 'id');
        return view('catalog.category.edit')->with([
            'category' => $category,
            'categories_list' => $categories_list
        ]);
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
