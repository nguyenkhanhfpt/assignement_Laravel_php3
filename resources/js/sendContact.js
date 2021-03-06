$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#contact-submit').on('click', function(event) {
        event.preventDefault();
        let your_email = $("[name='your_email']").val();
        let review = $("[name='review']").val();
        
        $.ajax({
            method: 'POST',
            url: '/sendMailContact',
            data: {
                your_email: your_email,
                review: review
            },
            success: function(res) {
                Swal.fire({
                    title: res.message,
                    icon: "success",
                    confirmButtonText: "Tiếp tục"
                });
            },
            error: function(error) {
                Swal.fire({
                    title: 'Không thể gửi nhận xét!',
                    icon: "error",
                    confirmButtonText: "Tiếp tục"
                });
            }
        })
    });

    $('#link_contact').on('click', function(event) {
        event.preventDefault();

        $([document.documentElement, document.body]).animate({
            scrollTop: $(".footer__contact").offset().top
        }, 1800);
    });

    $('#link_contact-mobile').on('click', function(event) {
        event.preventDefault();

        $([document.documentElement, document.body]).animate({
            scrollTop: $(".footer__contact").offset().top
        }, 1800);
    });
}); 