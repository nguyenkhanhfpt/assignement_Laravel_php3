$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    listen();
});

function listen() {
    getListSizes();
    addNewSize();
    deleteSize();
    editSize();
    updateSize();
}

function getListSizes() {
    let url = '/admin/sizes';

    $('#table-size').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: 'GET',
            url: url
        },
        columns: [
            { data: 'id'},
            { data: 'size'},
            {
                data: null,
                searchable: false,
                orderable: false,
                render: (data) => {
                    return `
                        <button class="btn btn-info edit-btn" title="Chỉnh sửa" data-id='${data.id}'>
                            <i class="fal fa-eye"></i>
                        </button>
                        <button class="btn btn-danger reset-confirm-btn btn-delete-size" data-id='${data.id}' title="Xóa">
                            <i class="far fa-trash"></i>
                        </button>   
                        `
                },
            },
        ],
        language: {
            "processing": "Đang tải..."
        },
        "displayLength": 25,
    });
}

function addNewSize() {
    $('#btn-add-size').on('click', function() {
        let size = $('#size').val();
        let url = '/admin/sizes';

        $.ajax({
            method: 'POST',
            url: url,
            data: {
                size: size
            },
            success: function(res) {
                if (res.status = 200) {
                    Swal.fire({
                        title: res.message,
                        icon: "success",
                        confirmButtonText: "Tiếp tục"
                    }).then(val => {
                        $('#table-size').DataTable().ajax.reload();

                        $('#addSizes .close').click();
                        $('#form-sizes').trigger("reset");
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
                    title: 'Lỗi khi thêm mới!',
                    icon: "error"
                });
            }
        });
    });
}

function deleteSize() {
    $('#table-size').on('click', '.btn-delete-size', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Bạn có chắc muốn xóa màu!',
            icon: "question",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Xóa`,
        }).then(result => {
            if (result.value) {
                $.ajax({
                    method: 'DELETE',
                    url: `/admin/sizes/${id}`,
                    success: function (res) {
                        if (res.status = 200) {
                            Swal.fire({
                                title: res.message,
                                icon: "success",
                                confirmButtonText: "Tiếp tục"
                            });

                            $('#table-size').DataTable().ajax.reload();
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

function editSize() {
    $('#table-size').on('click', '.edit-btn', function() {
        let id = $(this).data('id');

        $.ajax({
            method: 'GET',
            url: '/admin/sizes/' +id+ '/edit',
            success: function(res) {
                if (res.id) {
                    $('#size-edit').val(res.size);
                    $('#id-edit').val(id);
                    $('#editSizes').modal('show');
                }
            },
            error: function(error) {
                Swal.fire({
                    title: 'Has some errors!',
                    icon: "error"
                });
            }
        })
    })
}

function updateSize() {
    $('#btn-edit-size').on('click', function() {
        let size = $('#size-edit').val();
        let id = $('#id-edit').val();

        $.ajax({
            method: 'PATCH',
            url: '/admin/sizes/' +id,
            data: {
                size: size
            },
            success: function(res) {
                if (res.status = 200) {
                    $('#table-size').DataTable().ajax.reload();

                    Swal.fire({
                        title: res.message,
                        icon: "success",
                        confirmButtonText: "Tiếp tục"
                    }).then(result => {
                        $('#editSizes .close').click();
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
                    title: 'Lỗi khi cập nhật!',
                    icon: "error"
                });
            }
        });
    });
}
