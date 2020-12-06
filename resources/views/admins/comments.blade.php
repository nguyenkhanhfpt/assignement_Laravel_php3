@extends('layouts.adminMaster')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor py-2">Quản lý bình luận</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách</h4>
                    <table id="table-comments" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sản Phẩm</th>
                                <th>Số Bình Luận</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view-comment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tất cả bình luận của sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @section('script')
        <script src="{{ asset('js/admin') }}/jquery.dataTables.min.js"></script>

        <script src="{{ asset('js/admin') }}/comments.js"></script>
    @endsection

@endsection