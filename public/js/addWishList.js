$('.add_wishlist').on('click', function(e) {
    e.preventDefault();
    let idProduct = $(this).data("id");
    let nameProduct = $(this).data('name');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "POST",
        url: "/wishlist/add",
        data: {
            id_product: idProduct
        },
        success: function(result) {
            if(result == 'success') {
                Swal.fire({
                    title: nameProduct.trim(),
                    text: "Đã được thêm vào danh sách yêu thích!",
                    icon: "success",
                    confirmButtonText: "Tiếp tục mua hàng"
                });
            }
            else {
                Swal.fire({
                    title: nameProduct.trim(),
                    text: "Không thể thêm vào danh sách yêu thích!",
                    icon: "error",
                    confirmButtonText: "Tiếp tục mua hàng"
                });
            }
        }
    });
});