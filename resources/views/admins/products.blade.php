@extends('layouts.adminMaster')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Quản lý sản phẩm</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('adminProductAdd')}}" type="button" class="btn btn-success">
                    <i class="fal fa-plus"></i> Thêm sản phẩm
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h4 class="card-title mb-4">Danh sách</h4>

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
                                <img src="{{asset('images/products')}}/{{ $product->images[0]->image }}" alt="">
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
                                <img src="{{asset('images/products')}}/{{ $product->images[1]->image }}" alt="">
                                <img src="{{asset('images/products')}}/{{ $product->images[2]->image }}" alt="">
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
            </div>
        </div>
    </div>

@endsection