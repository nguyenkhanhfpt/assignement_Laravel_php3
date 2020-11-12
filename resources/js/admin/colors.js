$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    listen();
});

function listen() {
    getListColor();
    addNewColor();
    deleteColor();
    editColor();
    updateColor();
}

function getListColor() {
    let url = '/admin/colors';

    $('#table-color').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: 'GET',
            url: url
        },
        columns: [
            { data: 'id'},
            { data: 'name'},
            {
                data: null,
                searchable: false,
                orderable: false,
                render: (data) => {
                    return `
                        <button class="btn btn-info edit-btn" title="Chỉnh sửa" data-id='${data.id}'>
                            <i class="fal fa-eye"></i>
                        </button>
                        <button class="btn btn-danger reset-confirm-btn btn-delete-color" data-id='${data.id}' title="Xóa">
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

function addNewColor() {
    $('#btn-add-color').on('click', function() {
        let name = $('#name').val();
        let url = '/admin/colors';

        $.ajax({
            method: 'POST',
            url: url,
            data: {
                name: name
            },
            success: function(res) {
                if (res.status = 200) {
                    Swal.fire({
                        title: res.message,
                        icon: "success",
                        confirmButtonText: "Tiếp tục"
                    }).then(val => {
                        $('#table-color').DataTable().ajax.reload();

                        $('#addColors .close').click();
                        $('#form-colors').trigger("reset");
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
                    title: 'Has some errors!',
                    icon: "error"
                });
            }
        });
    });
}

function deleteColor() {
    $('#table-color').on('click', '.btn-delete-color', function() {
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
                    url: `/admin/colors/${id}`,
                    success: function (res) {
                        if (res.status = 200) {
                            Swal.fire({
                                title: res.message,
                                icon: "success",
                                confirmButtonText: "Tiếp tục"
                            });

                            $('#table-color').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                title: res.message,
                                icon: "error"
                            });
                        }
                    },
                    error: function (error) {
                        Swal.fire({
                            title: 'Has some errors!',
                            icon: "error"
                        });
                    }
                });
            }
            
        });
        
        
    })
}

function editColor() {
    $('#table-color').on('click', '.edit-btn', function() {
        let id = $(this).data('id');

        $.ajax({
            method: 'GET',
            url: '/admin/colors/' +id+ '/edit',
            success: function(res) {
                if (res.id) {
                    $('#name-edit').val(res.name);
                    $('#id-edit').val(id);
                    $('#editColors').modal('show');
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

function updateColor() {
    $('#btn-edit-color').on('click', function() {
        let name = $('#name-edit').val();
        let id = $('#id-edit').val();

        $.ajax({
            method: 'PATCH',
            url: '/admin/colors/' +id,
            data: {
                name: name
            },
            success: function(res) {
                if (res.status = 200) {
                    $('#table-color').DataTable().ajax.reload();

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
                    title: 'Has some errors!',
                    icon: "error"
                });
            }
        });
    });
}