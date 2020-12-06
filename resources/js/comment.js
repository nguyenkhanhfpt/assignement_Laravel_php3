const { remove } = require("lodash");

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(document).on('click', '#submit-comment', function(event) {
        event.preventDefault();
        let content = $("[name='content']").val();
        let productId = $("[name='product_id']").val();

        if (content.length == 0) {
            Swal.fire({
                title: 'Nội dung bình luận không được để trống!',
                icon: "error",
                confirmButtonText: "Tiếp tục"
            });
            return;
        }

        $.ajax({
            method: 'POST',
            url: '/addComment',
            data: {
                product_id: productId,
                content: content
            },
            success: function(res) {
                if (res.status == 200) {
                    Swal.fire({
                        title: res.message,
                        icon: "success",
                        confirmButtonText: "Tiếp tục"
                    });

                    $('#no-comment').hide();
                    $("[name='content']").val('');
                    $('.comment').prepend(res.view);
                } else {
                    Swal.fire({
                        title: res.message,
                        icon: "error",
                        confirmButtonText: "Tiếp tục"
                    });
                }
            },
            error: function(error) {
                Swal.fire({
                    title: 'Có lỗi xảy ra khi bình luận!',
                    icon: "error",
                    confirmButtonText: "Tiếp tục"
                });
            }
        }) 
    })

    $(document).on('click', '.remove-comment', function(event) {
        event.preventDefault();
        let id = $(this).data('id');

        Swal.fire({
            title: 'Bạn có chắc muốn xóa bình luận này!',
            icon: "question",
            showDenyButton: true,
            showCancelButton: true,
        }).then(result => {
            if(result.value) {
                $.ajax({
                    method: 'DELETE',
                    url: `/comment/${id}`,
                    success: function(res) {
                        if (res.status == 200) {
                            $(`.remove-comment-${id}`).parent().remove()

                            Swal.fire({
                                title: res.message,
                                icon: "success",
                                confirmButtonText: "Tiếp tục"
                            });
                        } else {
                            Swal.fire({
                                title: res.message,
                                icon: "error",
                                confirmButtonText: "Tiếp tục"
                            });
                        }
                    }, 
                    error: function(err) {
                        Swal.fire({
                            title: 'Có lỗi xảy ra khi xóa bình luận!',
                            icon: "error",
                            confirmButtonText: "Tiếp tục"
                        });
                    }
                })
            }
        })
    });
});