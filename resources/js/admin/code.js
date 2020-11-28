$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    listen();
});

function listen() {
    getListCode();
    addNewCode();
    deleteCode();
}

function getListCode() {
    let url = '/admin/codes';

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
            { data: 'sale' },
            { data: 'start'},
            { data: 'end'},
            { data: 'status'},
            {
                data: null,
                searchable: false,
                orderable: false,
                render: (data) => {
                    return `
                        <button class="btn btn-danger reset-confirm-btn btn-delete-code" data-id='${data.id}' title="Xóa">
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

function addNewCode() {
    $('#btn-add-code').on('click', function() {
        let name = $('#name').val();
        let price = $('#price').val();
        let start = $('#start').val();
        let end = $('#end').val();
        let url = '/admin/codes';

        if (new Date(start).getTime() > new Date(end).getTime()) {
            Swal.fire({
                title: 'Ngày bắt đầu không được sau ngày kết thúc!',
                icon: "error"
            });
            return;
        }

        $.ajax({
            method: 'POST',
            url: url,
            data: {
                name: name,
                price: price,
                start: start,
                end: end
            },
            success: function(res) {
                if (res.status ==  200) {
                    Swal.fire({
                        title: res.message,
                        icon: "success",
                        confirmButtonText: "Tiếp tục"
                    }).then(val => {
                        $('#table-color').DataTable().ajax.reload();

                        $('#addCodes .close').click();
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
                    title: 'Lỗi khi thêm mới mã giảm giá!',
                    icon: "error"
                });
            }
        });
    });
}

function deleteCode() {
    $('#table-color').on('click', '.btn-delete-code', function() {
        let id = $(this).data('id');

        Swal.fire({
            title: 'Bạn có chắc muốn xóa mã giảm giá!',
            icon: "question",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Xóa`,
        }).then(result => {
            if (result.value) {
                $.ajax({
                    method: 'DELETE',
                    url: `/admin/codes/${id}`,
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