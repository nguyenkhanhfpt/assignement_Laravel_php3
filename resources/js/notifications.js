$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function getAllNotifications() {
        $.ajax({
            method: 'GET',
            url: '/notifications',
            success: function(res) {
                $('#notification-content').html(res.view);
                $('#number-notify').html(res.numUnRead);
                if (res.numUnRead) {
                    $('.notify').addClass('d-block');
                    $('.notify').removeClass('d-none');
                } else {
                    $('.notify').removeClass('d-block');
                    $('.notify').addClass('d-none');
                }
            },
            error: function(err) {
                console.log(err)
            }
        })
    }

    function getNumBill(){
        $.ajax({
            method: 'GET',
            url: `/admin/update`,
            success: function(res) {
                $('#numPeddingBill').text(res.countBill);
            }
        });
    }

    $(document).on('click', '.message-center a', function() {
        let id = $(this).data('id');

        $.ajax({
            method: 'PATCH',
            url: `/notification/${id}`, 
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

    let pusher = new Pusher('c3352eb7ef48eb784445', {
        cluster: 'ap1'
      });
  
    let channel = pusher.subscribe('notification-channel');

    channel.bind('notification-event', function(data) {
        getAllNotifications()
        getNumBill()
    });

    getAllNotifications()
})