$(document).ready(function() {
    $('#btn__buy').on('click', function(event) {
        event.preventDefault();

        let nameMember = $('#name_member').val();
        let phoneNumber = $('#phone_number').val();
        let address = $('#address').val();

        if (!nameMember || !phoneNumber || !address) {
            Swal.fire({
                title: 'Thông tin người mua hàng không được để trống',
                icon: "error",
                confirmButtonText: "Tiếp tục"
            });
            return; 
        }

        $.ajax({
            method: 'POST',
            url: 'checkout',
            data: {
                name_member : nameMember,
                phone_number : phoneNumber,
                address : address
            },  
            success: function(res) {
                if (res.status ==  200) {
                    Swal.fire({
                        title: res.message,
                        icon: "success",
                        confirmButtonText: "Tiếp tục"
                    }).then(val => {
                        window.location.href = '/cart';
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
                    title: 'Sảy ra lỗi khi thanh toán hàng, vui lòng thử lại sau!',
                    icon: "error"
                });
            }
        });
    });

    $('.btn__apply').on('click', function() {
        let code = $('#code').val();

        if (!code) {
            Swal.fire({
                title: 'Bạn chưa nhập mã giảm giá!',
                icon: "error",
                confirmButtonText: "Tiếp tục"
            });
            return;
        }

        $.ajax({
            method: 'POST',
            url: 'checkout/checkCode',
            data: {
                code: code
            },
            success: function(res) {
                if (res.status ==  200) {
                    $('#match_total_sale').text(res.totalCartSale);

                    Swal.fire({
                        title: res.message,
                        icon: "success",
                        confirmButtonText: "Tiếp tục"
                    });
                } else {
                    $('#match_total_sale').text(res.totalCartSale);
                    $('#code').val('');

                    Swal.fire({
                        title: res.message,
                        icon: "error"
                    });
                }
            },
            error: function(err) {
                Swal.fire({
                    title: 'Sảy ra lỗi khi kiểm tra mã giảm giá!',
                    icon: "error",
                    confirmButtonText: "Tiếp tục"
                });
            }
        });
    });
});