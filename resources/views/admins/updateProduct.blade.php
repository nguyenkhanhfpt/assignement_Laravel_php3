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
                <h4 class="card-title mb-4"></h4>

                <form-edit-product :id="{{ $product->id }}"></form-edit-product>
                
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js') }}/app.js"></script>
@endsection
