$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    listen();
});

function listen() {
    getListProductComment();
    viewComments();
    deleteCode();
}

function getListProductComment() {
    let url = '/admin/comments';

    $('#table-comments').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: 'GET',
            url: url
        },
        columns: [
            { data: 'name_product'},
            { data: 'comments_count'},
            {
                data: null,
                searchable: false,
                orderable: false,
                render: (data) => {
                    return `
                        <button class="btn btn-info view-btn" title="Chỉnh sửa" data-id='${data.id}'>
                            <i class="fal fa-eye"></i>
                        </button>`
                },
            },
        ],
        language: {
            "processing": "Đang tải..."
        },
        "displayLength": 25,
    });
}

function viewComments() {
    $('#table-comments').on('click', '.view-btn' ,function() {
        let url = '/admin/comments/';
        let id = $(this).data('id');

        $.ajax({
            method: 'GET',
            url: url +id,
            success: function(res) {
                $('#view-comment .modal-body').html(res);
                $('#view-comment').modal();
            }, 
            error: function(err) {
                Swal.fire({
                    title: 'Lỗi khi hiển thị chi tiết bình luận!',
                    icon: "error"
                });
            }
        });
    });
}

function deleteCode() {
    $(document).on('click', '.btn-delete-comment', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Bạn có chắc muốn xóa bình luận này!',
            icon: "question",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Xóa`,
        }).then(result => {
            if (result.value) {
                $.ajax({
                    method: 'DELETE',
                    url: `/admin/comments/${id}`,
                    success: function (res) {
                        if (res.status == 200) {
                            Swal.fire({
                                title: res.message,
                                icon: "success",
                                confirmButtonText: "Tiếp tục"
                            });

                            $(`.btn-delete-comment-${id}`).parent().parent().remove()

                            $('#table-comments').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                title: res.message,
                                icon: "error"
                            });
                        }
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Lỗi khi xóa!',
                            icon: "error"
                        });
                    }
                });
            }
        });
    })
}