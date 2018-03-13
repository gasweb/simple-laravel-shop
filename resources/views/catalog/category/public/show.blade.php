@extends('layout.app')
@section('content')
    @if(count($products) > 0)
        <div class="row">
            <?php /** @var \App\Product $product */ ?>
            @foreach($products as $product)
                <div class="col-sm-3">
                    <img src="{{ $product->getImagePath() }}" alt="" class="img-responsive card-img">
                    {{ $product->title }}
                </div>
            @endforeach
        </div>
    @endif

    <div class="pagination-wrapper">
        {{ $products->links() }}
    </div>
@endsection