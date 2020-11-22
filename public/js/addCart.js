$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $('#btn-addCart').on('click', function(event) {
        event.preventDefault();

        let id = $("[name='id_product']").val();
        let size = $("[name='size']").val();
        let color = $("[name='color']").val();
        let quantity = $("[name='quantity']").val();

        if (size == '') {
            Swal.fire({
                title: 'Bạn phải chọn SIZE trước thi thêm vào giỏ',
                icon: "error",
                confirmButtonText: "Chọn lại sản phẩm"
            });
            return;
        }

        if (color == '') {
            Swal.fire({
                title: 'Bạn phải chọn MÀU trước thi thêm vào giỏ',
                icon: "error",
                confirmButtonText: "Chọn lại sản phẩm"
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "/cart/checkQuantity",
            data: {
                id_product: id,
                quantity: quantity
            },
            success: function(result) {
                if (result == true) { // Nếu còn số lượng thì cho phép thêm vào cart
                    $.ajax({
                        type: "POST",
                        url: "/cart/addCart",
                        data: {
                            id_product: id,
                            quantity: quantity,
                            size: size,
                            color: color
                        },
                        success: function(result) {
                            $(".number-cart").html(result.count);
                            $(".cart__amount span").html(result.total.toLocaleString());

                            Swal.fire({
                                title: "Đã được thêm vào giỏ hàng!",
                                icon: "success",
                                confirmButtonText: "Tiếp tục mua hàng"
                            });
        
                            $.ajax({
                                type: "GET",
                                url: "/cart/viewCart",
                                success: function(result) {
                                    $(".cart__mini-content").html(result);
                                }
                            });
                        }
                    });
                }
                else {
                    Swal.fire({
                        title: "Sản phẩm không đủ để bạn mua!",
                        icon: "error",
                        confirmButtonText: "Tiếp tục mua hàng"
                    });
                }
            }
        });
        
    });

    $(".add-cart").each(function() {
        let nameProduct = $(this)
            .parent()
            .parent()
            .parent()
            .find(".product__name a")
            .html();
        let idProduct = $(this)
            .parent()
            .parent()
            .parent()
            .find(".id__product")
            .html();
    
        $(this).on("click", function(event) {
            event.preventDefault();

            $.ajax({
                method: "GET",
                url: `/cart/checkSizeColor/${idProduct}`,
                success: function(result) {
                    $('#view-product .modal-body').html();

                    if (result !== 'false') {
                        $('#view-product .modal-body').html(result);

                        $('#view-product').modal();

                        return;
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "/cart/checkQuantity",
                            data: {
                                id_product: idProduct
                            },
                            success: function(result) {
                                if (result == true) { // Nếu còn số lượng thì cho phép thêm vào cart
                                    $.ajax({
                                        type: "POST",
                                        url: "/cart/addCart",
                                        data: {
                                            id_product: idProduct
                                        },
                                        success: function(result) {
                                            $(".number-cart").html(result.count);
                                            $(".cart__amount span").html(result.total.toLocaleString());
                                        }
                                    });
                
                                    Swal.fire({
                                        title: nameProduct.trim(),
                                        text: "Đã được thêm vào giỏ hàng!",
                                        icon: "success",
                                        confirmButtonText: "Tiếp tục mua hàng"
                                    });
                
                                    $.ajax({
                                        type: "GET",
                                        url: "/cart/viewCart",
                                        success: function(result) {
                                            $(".cart__mini-content").html(result);
                                        }
                                    });
                                }
                                else {
                                    Swal.fire({
                                        title: nameProduct.trim(),
                                        text: "Sản phẩm tạm thời hết hàng!",
                                        icon: "error",
                                        confirmButtonText: "Tiếp tục mua hàng"
                                    });
                                }
                            }
                        });
                    }
                }
            });
        });
    });

})







