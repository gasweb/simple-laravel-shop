@extends('layout.admin.app')
@section('content')
    {{ $category->title }}
    @if(count($products) > 0)
        @foreach($products as $product)
            <div class="jumbotron">
                <h3>{{ $product->title }}</h3>
                <p>{{ $product->preview_description }}</p>
            </div>
        @endforeach
    @endif
@endsection