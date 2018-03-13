@extends('layout.app')
@section('content')
    {{ Breadcrumbs::render('catalog', $category) }}
    @if(count($products) > 0)
        <div class="row">
            <?php /** @var \App\Product $product */ ?>
            @foreach($products as $product)
                <div class="col-sm-3">
                    <a href="{!! route('product.slug', ['slug' => $product->alias ]); !!}">
                        <img src="{{ $product->getImagePath() }}" alt="" class="img-responsive card-img">
                    </a>
                    <a href="{!! route('product.slug', ['slug' => $product->alias ]); !!}">
                        {{ $product->title }}
                    </a>
                    {{ $product->priceDisplay() }}
                </div>
            @endforeach
        </div>
    @endif
    <div class="pagination-wrapper">
        {{ $products->links() }}
    </div>
@endsection