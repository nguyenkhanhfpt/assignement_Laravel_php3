$(document).ready(function() {
    $(".right-side-toggle").click(function(){
        $(".right-sidebar").slideDown(50);
        $(".right-sidebar").toggleClass("shw-rside")}
    )

    $(document).on('keyup', '#input_search', function(event) {
        $('.nav__box-search__product').addClass('active');

        let textSearch =$(this).val();

        if (textSearch.length > 0){
            $.ajax({
                url: '/products/search',
                method: 'POST',
                data: {
                    q: textSearch,
                },
                success: function(res) {
                    $('#box_search_product').html(res)
                }
            })
        } else {
            $('.nav__box-search__product').removeClass('active');
        }
    })
})