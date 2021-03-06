<?php /** @var \App\Product $product  */ ?>
@extends('layout.admin.app')
@section('content')
    <h1>{{ trans('product.edit_header') }}</h1>

    <div class="jumbotron">
        @if($product->image)
            <img src="{{ $product->image->src_small }}" alt="">
        @endif
        {{ Form::fileUpload('product_image', ['Product\Admin\ProductController@imageStore', $product->id], trans('main.upload_image'), ['multiple' => 'true'], trans('main.upload'), ['class' => 'btn btn-primary']) }}
    </div>

    {!! Form::open(['action' => ['Product\Admin\ProductController@update', $product->id], 'method' => 'POST']) !!}
    {{ Form::inputText('title', trans('product.label_title'), $product->title, [
    'placeholder' => trans('product.create_placeholder'),
    'autocomplete' => 'off'
    ]) }}
    {{ Form::inputText('alias', trans('product.create_alias_label'), $product->alias, [
    'placeholder' => trans('product.create_alias_placeholder'),
    'autocomplete' => 'off'
    ]) }}

    {{-- If categories exists --}}
    @if($categories_list)
        {{ Form::formSelect('category', trans('product.create_label_parent_select'), $categories_list, $product->category_id, []) }}
    @endif

    {{-- If categories exists --}}
    @if($products_list)
        {{ Form::formSelect('parent', trans('product.create_label_parent_select'), $products_list, $product->parent_id, []) }}
    @endif

    {{-- If brands exists --}}
    @if($brands_list)
        {{ Form::formSelect('brand', trans('brand.admin_brand_select_label'), $brands_list, $product->brand_id, []) }}
    @endif

    {{ Form::inputCheckbox('enable', trans('product.form_enable'), 1, $product->enable) }}
    {{ Form::inputCheckbox('in_stock', trans('product.form_in_stock'), 1, $product->in_stock) }}

    {{ Form::inputSubmit('submit', ['class' => 'btn btn-primary']) }}
    {{ Form::hidden('_method', 'PUT') }}
    {!! Form::close() !!}
@endsection