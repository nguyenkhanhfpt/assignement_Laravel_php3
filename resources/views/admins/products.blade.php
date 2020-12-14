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
                        <th class="font-weight-bold">Tên sản phẩm</th>
                        <th class="font-weight-bold">Ảnh sản phẩm</th>
                        <th class="font-weight-bold">Giá sản phẩm</th>
                        <th class="font-weight-bold">Số lượng</th>
                        <th class="font-weight-bold">Giảm giá</th>
                        <th class="font-weight-bold">Đề xuất</th>
                        <th></th>
                    </tr>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name_product }}</td>
                            <td>
                                @if (count($product->images))
                                    <img src="{{asset('images/products')}}/{{ $product->images[0]->image }}" alt="">
                                @endif
                            </td>
                            <td>
                                {{number_format($product->price_product - ($product->price_product / 100 * $product->sale))}} đ
                            </td>
                            <td>{{ $product->quantity_product }}</td>
                            <td>{{ $product->sale }} %</td>
                            <td>
                                @if($product->nomination)
                                    <div class="badges success"></div>
                                @else 
                                    <div class="badges"></div>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('adminProduct')}}/update/{{ $product->id }}" 
                                data-toggle="tooltip" data-placement="top" title="Thay đổi">
                                    <i class="fal fa-edit"></i>
                                </a>
                                <a href="" data-id="{{ $product->id }}" class="product-{{ $product->id }} btn-delete-product" 
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

    @section('script')
        <script src="{{ asset('js/admin') }}/jquery.dataTables.min.js"></script>

        <script src="{{ asset('js/admin') }}/products.js"></script>
    @endsection

@endsection