@extends('layout/app')
@section('content')
    <h1>{{ trans('category.create_header') }}</h1>

    {!! Form::open(['action' => 'CatalogController@store', 'method' => 'POST']) !!}
        {{ Form::inputText('title', trans('category.create_label'), '', [
        'placeholder' => trans('category.create_placeholder'),
        'autocomplete' => 'off'
        ]) }}
        {{ Form::inputText('alias', trans('category.create_alias_label'), '', [
        'placeholder' => trans('category.create_alias_placeholder'),
        'autocomplete' => 'off'
        ]) }}

    {{-- If categories exists --}}
    @if($categories_list)
        {{ Form::formSelect('parent', trans('category.create_label_parent_select'), $categories_list, '', []) }}
    @endif
        {{ Form::inputSubmit('submit', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection