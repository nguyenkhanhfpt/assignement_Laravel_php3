$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    listen();
});

function listen() {
    getListMembers();
    viewMember();
    updateStatusMember();
    deleteMember();
}

function getListMembers() {
    let url = '/admin/members';

    $('#table-color').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: 'GET',
            url: url
        },
        columns: [
            { data: 'info'},
            { data: 'email'},
            { data: 'phone_number'},
            { data: 'address'},
            { data: 'status'},
            {
                data: null,
                searchable: false,
                orderable: false,
                render: (data) => {
                    return `
                        <button class="btn btn-info edit-btn" title="Chi tiết thành viên" data-id='${data.id}'>
                            <i class="fal fa-eye"></i>
                        </button>
                        <button class="btn btn-danger reset-confirm-btn btn-delete-member" data-id='${data.id}' title="Xóa">
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

function deleteMember() {
    $('#table-color').on('click', '.btn-delete-member', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Bạn có chắc muốn xóa thành viên này!',
            icon: "question",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Xóa`,
        }).then(result => {
            if (result.value) {
                $.ajax({
                    method: 'DELETE',
                    url: `/admin/members/${id}`,
                    success: function (res) {
                        if (res.status == 200) {
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
                            title: 'Lỗi khi xóa!',
                            icon: "error"
                        });
                    }
                });
            }
            
        });
    })
}

function viewMember() {
    $('#table-color').on('click', '.edit-btn', function() {
        let id = $(this).data('id');

        $.ajax({
            method: 'GET',
            url: `/admin/members/${id}`,
            success: function(res) {
                $('#view-member .modal-body').html(res);

                $('#view-member').modal();
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
                    title: 'Lỗi khi cập nhật trạng thái!',
                    icon: "error"
                });
            }
        });
    });
}