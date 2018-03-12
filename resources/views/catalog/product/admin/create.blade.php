@extends('layout.admin.app')
@section('content')
    <h1>{{ trans('product.create_header') }}</h1>

    {!! Form::open(['action' => 'Product\Admin\ProductController@store', 'method' => 'POST']) !!}
        {{ Form::inputText('title', trans('product.label_title'), '', [
        'placeholder' => trans('product.create_placeholder'),
        'autocomplete' => 'off'
        ]) }}
        {{ Form::inputText('alias', trans('product.create_alias_label'), '', [
        'placeholder' => trans('product.create_alias_placeholder'),
        'autocomplete' => 'off'
        ]) }}

    {{-- If categories exists --}}
    @if($categories_list)
        {{ Form::formSelect('parent', trans('product.admin_category_select_label'), $categories_list, '', []) }}
    @endif

    {{-- If brands exists --}}
    @if($brands_list)
        {{ Form::formSelect('brand', trans('brand.admin_brand_select_label'), $brands_list, '', []) }}
    @endif
        {{ Form::inputSubmit('submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection