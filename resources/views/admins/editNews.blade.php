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
                <div class="card-body">
                    <h4 class="card-title">Chỉnh sửa bài viết</h4>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger mb-1">{{ $error }}</div>
                        @endforeach
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mb-1">{{ session('success') }}</div>
                    @endif

                    <form id="form-add-news" action="{{ route('news.update', $news->id ) }}" method="POST" enctype="multipart/form-data" class="mt-2">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="title">Tiêu đề bài viết</label>
                            <input 
                                type="text" class="form-control" 
                                name="title" id="title" 
                                placeholder="Nhập tên sản phẩm" 
                                value="{{ $news->title }}"
                            >
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea name="description" class="form-control" id="description" rows="4">{{ $news->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="content">Nội dung</label>
                            <textarea name="content">{{ $news->content }}</textarea>
                        </div>

                        <div class="form-group mt-3">
                            <label for="image">Ảnh bài viết</label>
                            <input type="file" accept="image/*" class="form-control-file" 
                                name="file">
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a class="btn btn-primary" href="{{ route('news.index') }}">Danh sách bài viết</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            CKEDITOR.replace('content');
        </script>
    @endsection

@endsection