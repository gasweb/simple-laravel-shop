<?php
namespace App\Http\Controllers\Brand\Admin;

use App\Http\Controllers\Controller,
    App\Http\Requests\Brand\StoreBrand as StoreBrandRequest,
    App\Http\Requests\Brand\UpdateBrand as UpdateBrandRequest,
    App\Http\Requests\Brand\BrandSingleImage as StoreBrandSingleImageRequest,
    App\Category,
    App\Brand,
    App\Image;

use Illuminate\Http\Request,
    Illuminate\Support\Facades\Lang;

class BrandController extends Controller
{
    const PAGINATION_NUMBER = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'desc')->paginate(self::PAGINATION_NUMBER);
        return view('catalog.brand.admin.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalog.brand.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Brand\StoreBrand  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = new Brand();

        $brand->title = $request->input('title');
        $brand->alias = $request->input('alias');

        try
        {
            $brand->save();
            return redirect()->route('brand.edit', ['id'=> $brand->id]);
        } catch (\Exception $exception){
            return redirect()->route('brand.create');
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
     * Method to upload image and bind to current brand
     * @param \App\Http\Requests\Brand\BrandSingleImage $request
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function imageStore(StoreBrandSingleImageRequest $request, $id)
    {
        try{
            /** @var \App\Brand $brand */
            $brand = Brand::findOrFail($id);

            $current_image = $brand->image;

            if ($current_image)
            {
                Image::destroyImage($current_image);
            }

            $image_id = Image::uploadImage($request, 'brand_image');


            $brand->cover_image_id = $image_id;
            $brand->save();

            return redirect()->route('brand.edit', ['id'=> $brand->id]);
        } catch (\Exception $exception){

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('catalog.brand.admin.edit')->with([
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Brand\UpdateBrand  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = Brand::find($id);

        if ($brand)
        {
            $brand->title = $request->input('title');
            $brand->alias = $request->input('alias');

            try
            {
                $brand->save();
            } catch (\Exception $exception){

            }
            return redirect()->route('brand.edit', ['id'=> $brand->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if ($brand)
        {
            try{
                $brand->delete();
                $message = "Category {$brand->title} deleted";
            }
            catch (\Exception $exception){
                $message = "Something wrong";
            }

            return redirect()->route('brand.index')->with('message', $message);
        }
    }
}
