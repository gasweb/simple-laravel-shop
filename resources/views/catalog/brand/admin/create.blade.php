@extends('layout.admin.app')
@section('content')
    <h1>{{ trans('brand.create_header') }}</h1>

    {!! Form::open(['action' => 'Brand\Admin\BrandController@store', 'method' => 'POST']) !!}
        {{ Form::inputText('title', trans('brand.create_label'), '', [
        'placeholder' => trans('brand.create_placeholder'),
        'autocomplete' => 'off'
        ]) }}
        {{ Form::inputText('alias', trans('brand.create_alias_label'), '', [
        'placeholder' => trans('brand.create_alias_placeholder'),
        'autocomplete' => 'off'
        ]) }}
        {{ Form::inputSubmit('submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection