<?php
namespace App\Http\Controllers\Product\Admin;

use App\Http\Controllers\Controller,
    App\Http\Requests\Product\StoreProduct as StoreProductRequest,
    App\Http\Requests\Product\UpdateProduct as UpdateProductRequest,
    App\Category,
    App\Product,
    App\Image,
    App\Brand;

use Illuminate\Http\Request,
    Illuminate\Support\Facades\Lang;

class ProductController extends Controller
{
    const PAGINATION_NUMBER = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(self::PAGINATION_NUMBER);
        return view('catalog.product.admin.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_list = Category::getSelectList();
        $brands_list = Brand::getSelectList();
        return view('catalog.product.admin.create')->with([
            'categories_list' => $categories_list,
            'brands_list' => $brands_list
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Product\StoreProduct $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();

        $product->title = $request->input('title');
        $product->alias = $request->input('alias');
        $product->parent_id = $request->input('parent', null);
        $product->brand_id = $request->input('brand', null);

        try
        {
            $product->save();
            return redirect()->route('product.edit', ['id'=> $product->id]);
        } catch (\Exception $exception){
            return redirect()->route('product.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories_list = Category::getSelectList();
        $brands_list = Brand::getSelectList();
        return view('catalog.product.admin.edit')->with([
            'product' => $product,
            'categories_list' => $categories_list,
            'brands_list' => $brands_list
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Product\UpdateProduct $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->input('title');
        $product->alias = $request->input('alias');
        $product->parent_id = $request->input('parent', null);
        $product->brand_id = $request->input('brand', null);

        try
        {
            $product->save();
        } catch (\Exception $exception){

        }
        return redirect()->route('product.edit', ['id'=> $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        try{
            if (!$product)
            {
                throw new \Exception('Something wrong');
            }

            $product->delete();
            $message = "Category {$product->title} deleted";
        }
        catch (\Exception $exception){
            $message = "Something wrong";
        }

        return redirect()->route('product.index')->with('message', $message);
    }
}
