<?php /** @var \App\Product $product */ ?>
@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('product', $product) }}
    <h1 class="text-center">{{ $product->title }}</h1>
    <div class="row">
        <div class="col-sm-6">
            <img src="{{ $product->getImagePath() }}" alt="" class="card-img">
        </div>
        <div class="col-sm-6">

        </div>
    </div>

@endsection