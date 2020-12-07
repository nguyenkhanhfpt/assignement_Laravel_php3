@extends('layouts.adminMaster')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center py-2">
            <h4 class="text-themecolor">Quản lý bài viết</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('news.create')}}" type="button" class="btn btn-success">
                    <i class="fal fa-plus"></i> Thêm bài viết
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body news">
                    <h4 class="card-title">Danh sách</h4>
                    <table id="table-news" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Ảnh bài viết</th>
                                <th>Tiêu đề</th>
                                <th>Mô tả</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view-news" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết bài viết</h4>
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

        <script src="{{ asset('js/admin') }}/news.js"></script>
    @endsection

@endsection