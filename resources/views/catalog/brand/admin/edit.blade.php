<?php /** @var \App\Brand $brand */ ?>
@extends('layout.admin.app')
@section('content')
    <h1>{{ trans('brand.create_header') }}</h1>

    <div class="jumbotron">
        @if($brand->image)
            <img src="{{ url('/'.$brand->image->src_small) }}" alt="">
        @endif
        {{ Form::fileUpload('brand_image', ['Brand\Admin\BrandController@imageStore', $brand->id], trans('main.upload_image'), [], trans('main.upload'), ['class' => 'btn btn-primary']) }}
    </div>

    {!! Form::open(['action' => ['Brand\Admin\BrandController@update', $brand->id], 'method' => 'POST']) !!}
    {{ Form::inputText('title', trans('brand.create_label'), $brand->title, [
    'placeholder' => trans('brand.create_placeholder'),
    'autocomplete' => 'off'
    ]) }}
    {{ Form::inputText('alias', trans('brand.create_alias_label'), $brand->alias, [
    'placeholder' => trans('brand.create_alias_placeholder'),
    'autocomplete' => 'off'
    ]) }}

    {{ Form::inputSubmit('submit', ['class' => 'btn btn-primary']) }}
    {{ Form::hidden('_method', 'PUT') }}
    {!! Form::close() !!}
@endsection