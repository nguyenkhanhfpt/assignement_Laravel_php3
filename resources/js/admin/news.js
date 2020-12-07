$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    listen();
});

function listen() {
    getListNews();
    viewNews();
    updateStatusMember();
    deleteNews();
}

function getListNews() {
    let url = '/admin/news';

    $('#table-news').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: 'GET',
            url: url
        },
        columns: [
            { data: 'image-news'},
            { data: 'title'},
            { data: 'description'},
            {
                data: null,
                searchable: false,
                orderable: false,
                render: (data) => {
                    return `
                        <button class="btn btn-info view-btn mb-1" title="Chi tiết bài viết" data-id='${data.id}'>
                            <i class="fal fa-eye"></i>
                        </button>
                        <a href='news/${data.id}/edit' class="btn btn-warning mb-1" title="Chỉnh sửa bài viết">
                            <i class="fal fa-comment-alt-edit"></i>
                        </a>
                        <button class="btn btn-danger reset-confirm-btn btn-delete-news" data-id='${data.id}' title="Xóa bài viết">
                            <i class="far fa-trash"></i>
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

function deleteNews() {
    $('#table-news').on('click', '.btn-delete-news', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Bạn có chắc muốn xóa bài viết này!',
            icon: "question",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Xóa`,
        }).then(result => {
            if (result.value) {
                $.ajax({
                    method: 'DELETE',
                    url: `/admin/news/${id}`,
                    success: function (res) {
                        if (res.status == 200) {
                            Swal.fire({
                                title: res.message,
                                icon: "success",
                                confirmButtonText: "Tiếp tục"
                            });

                            $('#table-news').DataTable().ajax.reload();
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

function viewNews() {
    $('#table-news').on('click', '.view-btn', function() {
        let id = $(this).data('id');

        $.ajax({
            method: 'GET',
            url: `/admin/news/${id}`,
            success: function(res) {
                $('#view-news .modal-body').html(res);

                $('#view-news').modal();
            },
            error: function(error) {
                Swal.fire({
                    title: 'Đã có lỗi xảy ra!',
                    icon: "error"
                });
            }
        })
    })
}

function updateStatusMember() {
    $(document).on('change', '.switch',function() {
        let id = $(this).data('id');
        let status = 0;

        if(this.checked) {
            status = 1;
        }

        $.ajax({
            method: 'PATCH',
            url: '/admin/members/' +id,
            data: {
                status: status
            },
            success: function(res) {
                console.log(res)
                if (res.status == 200) {
                    $('#table-news').DataTable().ajax.reload();

                    Swal.fire({
                        title: res.message,
                        icon: "success",
                        confirmButtonText: "Tiếp tục"
                    }).then(result => {
                        $('#editColors .close').click();
                        $('#form-edit-colors').trigger("reset");
                    });
                } else {
                    Swal.fire({
                        title: res.message,
                        icon: "error"
                    });
                }
            },
            error: function(err) {
                Swal.fire({
                    title: 'Lỗi khi cập nhật trạng thái!',
                    icon: "error"
                });
            }
        });
    });
}