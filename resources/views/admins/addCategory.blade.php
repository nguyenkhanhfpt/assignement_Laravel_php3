@extends('layouts.adminMaster')

@section('menu')
    @include('components.menuAdmin')
@endsection

@section('content')
    <h2 class="text-center admin__title">Thêm mới danh mục</h2>

    <div class="box--maxWidth">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger mb-3">
                    {{ $error }}
                </div>
            @endforeach
        @endif

        @isset($success) 
            <div class="alert alert-success mb-3">
                {{ $success }}
            </div>
        @endisset

        <form action="" method="POST" enctype="multipart/form-data" class="mt-2">
            @csrf
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên">
            </div>
            <div class="form-group">
                <label for="img_category">Ảnh danh mục</label>
                <input type="file" class="form-control-file" name="img_category" id="img_category">
            </div>

            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a class="btn btn-primary" href={{route('adminCategory')}}>Danh sách danh mục</a>
        </form>

        
    </div>
    

@endsection