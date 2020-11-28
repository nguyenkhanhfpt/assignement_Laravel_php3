$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.input-quantity-cart').on('change', function() {
        let id = $(this).data('id');
        let idCart = $(this).data('cart');
        let quantity = $(this).val();

        $.ajax({
            method: 'PATCH',
            url: `/cart/update/${idCart}/${id}`,
            data: {
                quantity: quantity
            },
            success: function(res) {
                if (res.status ==  200) {
                    $(`.quantity-${idCart}`).parent().find('.total-price').html(res.price_product);
                    $('.match_total').text(res.match_total);
                }

                if(res.status ==  402) {
                   $(`.quantity-${idCart}`).val(quantity - 1);

                    Swal.fire({
                        title: res.message,
                        icon: "error",
                        confirmButtonText: "Tiếp tục"
                    });
                }
            },
            error: function(err) {
                Swal.fire({
                    title: 'Không thể cập nhật số lượng giỏ hàng',
                    icon: "error",
                    confirmButtonText: "Tiếp tục"
                });
            }
        })
    });

});