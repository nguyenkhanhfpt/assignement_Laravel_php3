@extends('layouts.adminMaster')

@section('menu')
    @include('components.menuAdmin')
@endsection

@section('content')
    <h2 class="text-center admin__title">Danh sách Bình luận</h2>

    <div class="box">
        <div class="table-responsive">
            <table class="table table_member">
                <thead>
                    <tr>
                        <th scope="col">Người bình luận</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Nội dung bình luận</th>
                        <th scope="col">Thời gian bình luận</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td scope="row">
                                <img src="{{asset('images')}}/{{$comment->img_member}}" alt="">
                                {{$comment->name_member}}
                            </td>
                            <td>
                                <img class="img_product" src="{{asset('images')}}/{{$comment->img_product}}" alt="">
                                {{ $comment->name_product }}
                            </td>
                            <td>
                                {{ $comment->content }}                                                                                                                                                                     
                            </td>
                            <td>{{ $comment->date_comment }}</td>
                            <td>
                                <a onClick="return confirm('Bạn có muốn xóa bình luận')" 
                                href="{{route('adminComment')}}/delete/{{$comment->id_comment}}" 
                                data-toggle="tooltip" data-placement="top" title="Xóa">
                                    <i class="fal fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

@endsection