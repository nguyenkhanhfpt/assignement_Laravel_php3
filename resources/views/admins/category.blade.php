@extends('layouts.adminMaster')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Danh mục sản phẩm</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategory">
                    <i class="fa fa-plus-circle"></i> Thêm danh mục
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card w-100">
            <div class="card-body">
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
            </div>
        </div>
    </div>

    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mới danh mục</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control" placeholder="Nhập tên danh mục">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection


