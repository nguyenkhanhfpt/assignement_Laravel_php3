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

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        $.ajax({
            type: "POST",
            url: "/cart/checkQuantity",
            data: {
                id_product: idProduct
            },
            success: function(result) {
                if (result == "true") { // Nếu còn số lượng thì cho phép thêm vào cart
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
    });
});
