<table class="table table_member table_bill my-0">
    <thead>
        <tr>
            <th class="font-weight-bold">
                Người bình luận
            </th>
            <th class="font-weight-bold">
                Nội dung
            </th>
            <th class="font-weight-bold">
                Ngày bình luận
            </th>
            <th class="font-weight-bold">
                Xóa Bình Luận
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($commentProduct as $comment)
            <tr>
                <td>
                    <img src="{{ asset('images') }}/{{ $comment->member->img_member }}" alt="">
                    {{ $comment->member->name_member }}
                </td>
                <td>{{ $comment->content }}</td>
                <td>{{ $comment->date_comment }}</td>
                <td>
                    <button class="btn btn-danger reset-confirm-btn btn-delete-comment btn-delete-comment-{{ $comment->id }}" 
                        data-id={{ $comment->id }} title="Xóa">
                        <i class="far fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
