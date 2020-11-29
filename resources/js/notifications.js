$(document).ready(function() {
    function getAllNotifications() {
        $.ajax({
            method: 'GET',
            url: '/notifications',
            success: function(res) {
                $('#notification-content').html(res.view);
                $('#number-notify').html(res.numUnRead);
            },
            error: function(err) {
                console.log(err)
            }
        })
    }

    $(document).on('click', '.message-center a', function() {
        let id = $(this).data('id');

        $.ajax({
            method: 'PATCH',
            url: `/notifications/${id}`, 
            success: function(res) {
                getAllNotifications()
            },
            error: function(err) {
                console.log(err);
            }
        })
    });


    $(document).on('click', '.message-center a', function() {
        let id = $(this).data('id');

        $.ajax({
            method: 'PATCH',
            url: `/notifications`, 
            success: function(res) {
                getAllNotifications()
            },
            error: function(err) {
                console.log(err);
            }
        })
    });

    $(document).on('click', '.readed strong', function() {
        $.ajax({
            method: 'PATCH',
            url: `/notifications`, 
            success: function(res) {
                getAllNotifications()
            },
            error: function(err) {
                console.log(err);
            }
        })
    });

    getAllNotifications()
})