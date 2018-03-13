<?php
namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller,
    App\Category,
    App\Product;

class ProductController extends Controller
{
    /**
     * Display the specified category.
     *
     * @param  string $alias
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        try{

        /** @var \App\Product $product */
        $product = Product::where(['alias' => $alias])->firstOrFail();

        $template_name = $product->template_name ? $product->template_name : 'catalog.product.public.default';

        return view($template_name)->with([
                'product' => $product
            ]);

        } catch (\Exception $exception)
        {
            abort(404);
        }

    }
}
