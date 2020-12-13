$(function () {
    "use strict";

    let pusher = new Pusher('c3352eb7ef48eb784445', {
        cluster: 'ap1'
    });
  
    let channel = pusher.subscribe('notification-channel');

    channel.bind('notification-event', function(data) {
        $("#morris-area-chart2").empty();
        statistical()
    });

    function statistical() {
        var data = [];

        $.ajax({
            url: '/admin/statistical',
            method: 'GET',
            success: function(res) {
                data = res;
    
                Morris.Area({
                    element: 'morris-area-chart2'
                    , data: data
                    , xkey: 'day'
                    , ykeys: ['count']
                    , labels: ['Đơn hàng']
                    , pointSize: 0
                    , dataLabels: false
                    , fillOpacity: .5
                    , pointStrokeColors: ['#b4becb']
                    ,xLabelFormat: function(d) {
                        return d.getDate() + '/' + (d.getMonth() + 1) + '/' + d.getFullYear(); 
                    }
                    , xLabels: 'day'
                    , behaveLikeLine: true
                    , gridLineColor: '#e0e0e0'
                    , lineWidth: 0.2
                    , smooth: false
                    , hideHover: 'auto'
                    , lineColors: ['#01c0c8']
                    , resize: true
                });
            } 
        })
    }

    statistical();
});