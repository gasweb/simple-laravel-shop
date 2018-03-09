@extends('layout.admin.app')
@section('content')
    <h1 class="text-center">{{ trans('brand.admin_list_header') }}</h1>
    <a href="{!! route('brand.create'); !!}"><span class="fa fa-plus-circle"> {{ trans('brand.admin_new_brand_link_text') }}</span></a>
    <hr>
    @if(count($brands) > 0)
        <table class="table table-bordered table-striped">
            <tr>
                <td>{{ trans('main.id') }}</td>
                <td>{{ trans('brand.admin_list_table_title') }}</td>
                <td>{{ trans('brand.admin_list_table_alias') }}</td>
                <td>{{ trans('main.date_created') }}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->title }}</td>
                    <td>{{ $brand->alias }}</td>
                    <td>{{ $brand->created_at->format('d.M.Y H:i') }}</td>
                    <td>
                        <a href="{!! route('brand.edit', ['id' => $brand->id ]); !!}">
                            <span class="fa fa-edit"></span>
                        </a>

                    </td>
                    <td>
                        {!! Form::open(['action' => ['Brand\Admin\BrandController@destroy', $brand->id], 'method' => 'POST']) !!}
                        {{ Form::inputSubmit("delete", ['class' => 'btn btn-danger']) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        </table>
        <div class="pagination-wrapper">
            {{ $brands->links() }}
        </div>

    @endif
@endsection