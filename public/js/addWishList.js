$('.add_wishlist').on('click', function(e) {
    e.preventDefault();
    let idProduct = $(this).data("id");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        type: "POST",
        url: "/wishlist/add",
        data: {
            product_id: idProduct
        },
        success: function(result) {
            if(result.status == 200) {
                Swal.fire({
                    title: result.message,
                    icon: "success",
                    confirmButtonText: "Tiếp tục"
                });
            }
            else {
                Swal.fire({
                    title: result.message,
                    icon: "error",
                    confirmButtonText: "Tiếp tục"
                });
            }
        },
        error: function(err) {
            Swal.fire({
                title: 'Có lỗi khi thêm vào danh sách yêu thích!',
                icon: "error",
                confirmButtonText: "Tiếp tục"
            });
        }
    });
});