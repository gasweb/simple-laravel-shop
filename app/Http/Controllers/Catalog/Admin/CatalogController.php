<?php
namespace App\Http\Controllers\Catalog\Admin;

use App\Http\Controllers\Controller,
    App\Http\Requests\Category\StoreCategory as StoreCategoryRequest,
    App\Http\Requests\Category\UpdateCategory as UpdateCategoryRequest,
    App\Category,
    App\Product;

use Illuminate\Support\Facades\Lang;

class CatalogController extends Controller
{
    const PAGINATION_NUMBER = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(self::PAGINATION_NUMBER);
        return view('catalog.category.admin.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_list = Category::all()->pluck('title', 'id');
        $categories_list->prepend(Lang::get('category.admin_category_select_empty_option'), '');
        return view('catalog.category.admin.create')->with([
            'categories_list' => $categories_list
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Category\StoreCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();

        $category->title = $request->input('title');
        $category->alias = $request->input('alias');
        $category->parent_id = $request->input('parent', null);

        try
        {
            $category->save();
            return redirect()->route('catalog.edit', ['id'=> $category->id]);
        } catch (\Exception $exception){
            return redirect()->route('catalog.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        return view('catalog.category.admin.alias')->with([
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
        $categories_list->prepend(Lang::get('category.admin_category_select_empty_option'), '');
        return view('catalog.category.admin.edit')->with([
            'category' => $category,
            'categories_list' => $categories_list
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Category\UpdateCategory  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->title = $request->input('title');
        $category->alias = $request->input('alias');
        $category->parent_id = $request->input('parent', null);

        try
        {
            $category->save();
        } catch (\Exception $exception){

        }
        return redirect()->route('catalog.edit', ['id'=> $category->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        try{
            $category->delete();
            $message = "Category {$category->title} deleted";
        }
        catch (\Exception $exception){
            $message = "Something wrong";
        }

        return redirect()->route('catalog.index')->with('message', $message);
    }
}
