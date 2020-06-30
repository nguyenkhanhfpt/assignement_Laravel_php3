@extends('layouts.adminMaster')

@section('menu')
    @include('components.menuAdmin')
@endsection

@section('content')
    <h2 class="text-center admin__title">Danh sách sản phẩm</h2>

    <div class="box">
        <table class="table table__product">
            <tr>
                <th>Tên sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Số lượng</th>
                <th>Giảm giá</th>
                <th>Đề xuất</th>
                <th>Ảnh thêm</th>
                <th></th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name_product }}</td>
                    <td>
                        <img src="{{asset('images')}}/{{$product->img_product}}" alt="">
                    </td>
                    <td>{{ number_format($product->price_product) }} đ</td>
                    <td>{{ $product->quantity_product }}</td>
                    <td>{{ $product->sale }} %</td>
                    <td>
                        @if($product->nomination == 1)
                            <div class="badges success"></div>
                        @else 
                            <div class="badges"></div>
                        @endif
                    </td>
                    <td>
                        <img src="{{asset('images')}}/{{$product->img_product_2}}" alt="">
                        <img src="{{asset('images')}}/{{$product->img_product_3}}" alt="">
                    </td>
                    <td>
                        <a href="{{route('adminProduct')}}/update/{{ $product->id_product }}" 
                        data-toggle="tooltip" data-placement="top" title="Thay đổi">
                            <i class="fal fa-edit"></i>
                        </a>
                        <a onClick="return confirm('Bạn có muốn xóa sản phẩm')" 
                        href="{{route('adminProduct')}}/delete/{{ $product->id_product }}" 
                        data-toggle="tooltip" data-placement="top" title="Xóa">
                            <i class="fal fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

        </table>

        <a class="btn btn-primary" href={{route('adminProductAdd')}}>Thêm sản phẩm</a>

    </div>
    
    
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

@endsection