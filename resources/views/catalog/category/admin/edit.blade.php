@extends('layout.admin.app')
@section('content')
    <h1>{{ trans('category.create_header') }}</h1>

    {!! Form::open(['action' => ['Catalog\Admin\CatalogController@update', $category->id], 'method' => 'POST']) !!}
    {{ Form::inputText('title', trans('category.create_label'), $category->title, [
    'placeholder' => trans('category.create_placeholder'),
    'autocomplete' => 'off'
    ]) }}
    {{ Form::inputText('alias', trans('category.create_alias_label'), $category->alias, [
    'placeholder' => trans('category.create_alias_placeholder'),
    'autocomplete' => 'off'
    ]) }}

    {{-- If categories exists --}}
    @if($categories_list)
        {{ Form::formSelect('parent', trans('category.create_label_parent_select'), $categories_list, $category->parent_id, []) }}
    @endif
    {{ Form::inputSubmit('submit', ['class' => 'btn btn-primary']) }}
    {{ Form::hidden('_method', 'PUT') }}
    {!! Form::close() !!}

    <div class="jumbotron">
        @if($category->image)
            <img src="{{ $category->image->src_small }}" alt="">
        @endif
        {{ Form::fileUpload('category_image', ['Catalog\Admin\CatalogController@imageStore', $category->id], trans('main.upload_image'), [], trans('main.upload'), ['class' => 'btn btn-primary']) }}
    </div>
@endsection