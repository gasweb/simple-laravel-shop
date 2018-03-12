@extends('layout.admin.app')
@section('content')
    <h1 class="text-center">{{ trans('product.admin_list_header') }}</h1>
    <a href="{!! route('product.create'); !!}"><span class="fa fa-plus-circle"> {{ trans('product.admin_new_product_link_text') }}</span></a>
    <hr>
    @if(count($products) > 0)
        <table class="table table-bordered table-striped">
            <tr>
                <td>{{ trans('main.id') }}</td>
                <td>{{ trans('product.admin_list_table_parent') }}</td>
                <td>{{ trans('product.admin_list_table_title') }}</td>
                <td>{{ trans('product.admin_list_table_alias') }}</td>
                <td>{{ trans('main.date_created') }}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php /** @var \App\Product $product */ ?>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->parent)
                            <a href="{!! route('product.edit', ['id' => $product->parent->id ]); !!}">
                                {{ $product->parent->title }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->alias }}</td>
                    <td>{{ $product->created_at->format('d.M.Y H:i') }}</td>
                    <td>
                        <a href="{!! route('product.edit', ['id' => $product->id ]); !!}">
                            <span class="fa fa-edit"></span>
                        </a>

                    </td>
                    <td>
                        {!! Form::open(['action' => ['Product\Admin\ProductController@destroy', $product->id], 'method' => 'POST']) !!}
                        {{ Form::inputSubmit("delete", ['class' => 'btn btn-danger']) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        </table>
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>

    @endif
@endsection