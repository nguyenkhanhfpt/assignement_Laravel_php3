@extends('layouts.adminMaster')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Quản lý mã giảm giá</h4>
        </div>

        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCodes">
                    <i class="fa fa-plus-circle"></i> Thêm mã giảm giá
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách</h4>
                    <table id="table-color" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên Mã</th>
                                <th>Tiền Giảm</th>
                                <th>Ngày Bắt Đầu</th>
                                <th>Ngày Kết Thúc</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addCodes" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mã giảm giá</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <form id="form-colors">
                        <div class="form-group">
                            <label for="name">Tên mã</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên mã">
                        </div>
                        <div class="form-group">
                            <label for="price">Số tiền</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Nhập số tiền được giảm">
                        </div>
                        <div class="form-group">
                            <label for="start">Ngày bắt đầu</label>
                            <input type="datetime-local" class="form-control" id="start" name="start">
                        </div>
                        <div class="form-group">
                            <label for="end">Ngày kết thúc</label>
                            <input type="datetime-local" class="form-control" id="end" name="end">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="button" class="btn btn-success" id="btn-add-code">Thêm</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @section('script')
        <script src="{{ asset('js/admin') }}/jquery.dataTables.min.js"></script>

        <script src="{{ asset('js/admin') }}/code.js"></script>
    @endsection

@endsection