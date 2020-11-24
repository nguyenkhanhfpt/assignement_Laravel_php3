$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    listen();
});

function listen() {
    getListBill();
    viewDetail();
}

function getListBill() {
    let url = '/admin/bills';

    $.ajax({
        method: 'GET',
        url: url,
        success: function(res) {
            console.log(res)
        },
        error: function(err) {
            console.log(res)
        }
    })

    $('#table-bills').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: 'GET',
            url: url
        },
        columns: [
            { data: 'id'},
            { data: 'member.name_member'},
            { data: 'detail_bill_count'},
            { data: 'total'},
            { data: 'date_buy' },
            { data: 'status-box' },
            { 
                data: null,
                searchable: false,
                orderable: false,
                render: (data) => {
                    return `
                        <button class="btn btn-info btn-detail-bill" title="Chi tiết đơn hàng" data-id='${data.id}'>
                            <i class="fal fa-eye"></i>
                        </button>
                    `
                }
            }
        ],
        language: {
            "processing": "Đang tải..."
        },
        "displayLength": 25,
        "order": [[ 0, "desc" ]]
    });
}


function viewDetail() {
    $('#table-bills').on('click', '.btn-detail-bill', function() {
        let id = $(this).data('id');

        $.ajax({
            method: 'GET',
            url: `/admin/bills/${id}`,
            success: function(res) {
                $('#viewDetailBill .modal-body').html(res)

                $('#viewDetailBill').modal();
            },
            error: function(error) {
                Swal.fire({
                    title: 'Có một số lỗi khi hiển thị chi tiết đơn hàng!',
                    icon: "error"
                });
            }
        })
    })
}