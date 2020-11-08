@extends('layouts.adminMaster')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Quản lý sản phẩm</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <a href="" type="button" class="btn btn-success">
                    <i class="fal fa-plus"></i> Thêm sản phẩm
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card w-100">
            <div class="card-body">
                <h4 class="card-title mb-4">Thêm sản phẩm</h4>

                <form action="" method="POST" enctype="multipart/form-data" class="mt-2">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name_product">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="name_product" id="name_product" 
                                placeholder="Nhập tên sản phẩm">
                                <small class="form-text text-danger">
                                    @error('name_product')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="id_category">Tên danh mục</label>
                                <select class="form-control" id="id_category" name="id_category">
                                    <option selected ></option>
                                    @foreach($categories as $category) 
                                        <option value={{$category->id_category}}> {{$category->name}} </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-danger">
                                    @error('id_category')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="price_product">Giá sản phẩm</label>
                                <input type="text" class="form-control" name="price_product" id="price_product" 
                                placeholder="Nhập giá của sản phẩm">
                                <small class="form-text text-danger">
                                    @error('price_product')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="img_product">Ảnh sản phẩm</label>
                                <input type="file" class="form-control-file" name="img_product" id="img_product">
                                <small class="form-text text-danger">
                                    @error('img_product')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>

                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="sale">Giảm giá</label>
                                <input type="text" class="form-control" name="sale" id="sale" 
                                placeholder="Giảm giá cho sản phẩm">
                            </div>
                            <div class="form-group">
                                <label for="quantity_product">Số lượng sản phẩm</label>
                                <input type="text" class="form-control" name="quantity_product" id="quantity_product" 
                                placeholder="Số lượng sản phẩm">
                                <small class="form-text text-danger">
                                    @error('quantity_product')
                                        {{ $message }}
                                    @enderror
                                </small>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="img_product_2">Ảnh sản phẩm 2</label>
                                        <input type="file" class="form-control-file" name="img_product_2" id="img_product_2">
                                        <small class="form-text text-danger">
                                            @error('img_product_2')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="img_product_3">Ảnh sản phẩm 3</label>
                                        <input type="file" class="form-control-file" name="img_product_3" id="img_product_3">
                                        <small class="form-text text-danger">
                                            @error('img_product_3')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="decscription">Mô tả sản phẩm</label>
                        <textarea class="form-control" id="decscription" rows="5" name="decscription"></textarea>
                        <small class="form-text text-danger">
                            @error('decscription')
                                {{ $message }}
                            @enderror
                        </small>
                    </div>

                    <div class="custom-control custom-checkbox mr-sm-2 mb-3">
                        <input type="checkbox" class="custom-control-input" name="nomination" id="nomination">
                        <label class="custom-control-label" for="nomination">Đề cử sản phẩm</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                    <a class="btn btn-primary" href={{route('adminProduct')}}>Danh sách sản phẩm</a>
                </form>
            </div>
        </div>
    </div>

@endsection



