@extends('layout/app')
@section('content')
    <h1 class="text-center">{{ trans('category.admin_list_header') }}</h1>
    <a href="/admin/catalog/create"><span class="fa fa-plus-circle"> {{ trans('category.admin_new_category_link_text') }}</span></a>
    <hr>
    @if(count($categories) > 0)
        <table class="table table-bordered table-striped">
            <tr>
                <td>{{ trans('main.id') }}</td>
                <td>{{ trans('category.admin_list_table_title') }}</td>
                <td>{{ trans('category.admin_list_table_alias') }}</td>
                <td>{{ trans('category.admin_list_table_parent') }}</td>
                <td>{{ trans('main.date_created') }}</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->alias }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td>{{ $category->date_created }}</td>
                    <td>
                        <a href="{!! route('catalog.edit', ['id' => $category->id ]); !!}">
                            <span class="fa fa-edit"></span>
                        </a>

                    </td>
                    <td>
                        {!! Form::open(['action' => ['Catalog\Admin\CatalogController@destroy', $category->id], 'method' => 'POST']) !!}
                        {{ Form::inputSubmit("delete", ['class' => 'btn btn-danger']) }}
                        {{ Form::hidden('_method', 'DELETE') }}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        </table>
        <div class="pagination-wrapper">
            {{ $categories->links() }}
        </div>

    @endif
@endsection