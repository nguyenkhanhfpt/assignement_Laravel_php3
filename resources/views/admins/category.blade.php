@extends('layouts.adminMaster')

@section('menu')
    @include('components.menuAdmin')
@endsection

@section('content')
    <h2 class="text-center admin__title">Danh mục sản phẩm</h2>

    <div class="box--maxWidth">
        <table class="table table-bordered table_category">
            <tr>
                <th>Mã</th>
                <th>Tên danh mục</th>
                <th>Ảnh danh mục</th>
                <th></th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id_category }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <img src="{{asset('images')}}/{{$category->img_category}}" alt="">
                    </td>
                    <td>
                        <a href="{{route('adminCategory')}}/update/{{$category->id_category}}" 
                        data-toggle="tooltip" data-placement="top" title="Thay đổi">
                            <i class="fal fa-edit"></i>
                        </a>
                        <a onClick="return confirm('Bạn có muốn xóa danh mục')" 
                        href="{{route('adminCategory')}}/delete/{{$category->id_category}}" 
                        data-toggle="tooltip" data-placement="top" title="Xóa">
                            <i class="fal fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>

        <a class="btn btn-primary" href={{route('adminCategoryAdd')}}>Thêm danh mục</a>
    </div>

@endsection


