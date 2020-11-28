$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    listen();
});

function listen() {
    deleteProduct();
}

function deleteProduct() {
    $('.table__product').on('click', '.btn-delete-product', function(event) {
        event.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            title: 'Bạn có chắc muốn xóa sản phẩm!',
            icon: "question",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Xóa`,
        }).then(result => {
            if (result.value) {
                $.ajax({
                    method: 'DELETE',
                    url: `/admin/products/${id}`,
                    success: function (res) {
                        if (res.status == 200) {
                            $(`.product-${id}`).parent().parent().remove();
                            
                            Swal.fire({
                                title: res.message,
                                icon: "success",
                                confirmButtonText: "Tiếp tục"
                            });
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
                if (res.status == 200) {
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
