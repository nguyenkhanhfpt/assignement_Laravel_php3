$(function () {
    "use strict";
//     Morris.Area({
//         element: 'morris-area-chart'
//         , data: [{
//                 period: '2010'
//                 , iphone: 50
//                 , ipad: 80
//                 , itouch: 20
//         }, {
//                 period: '2011'
//                 , iphone: 130
//                 , ipad: 100
//                 , itouch: 80
//         }, {
//                 period: '2012'
//                 , iphone: 80
//                 , ipad: 60
//                 , itouch: 70
//         }, {
//                 period: '2013'
//                 , iphone: 70
//                 , ipad: 200
//                 , itouch: 140
//         }, {
//                 period: '2014'
//                 , iphone: 180
//                 , ipad: 150
//                 , itouch: 140
//         }, {
//                 period: '2015'
//                 , iphone: 105
//                 , ipad: 100
//                 , itouch: 80
//         }
//             , {
//                 period: '2016'
//                 , iphone: 250
//                 , ipad: 150
//                 , itouch: 200
//         }]
//         , xkey: 'period'
//         , ykeys: ['iphone', 'ipad', 'itouch']
//         , labels: ['iPhone', 'iPad', 'iPod Touch']
//         , pointSize: 3
//         , fillOpacity: 0
//         , pointStrokeColors: ['#00bfc7', '#fb9678', '#9675ce']
//         , behaveLikeLine: true
//         , gridLineColor: '#e0e0e0'
//         , lineWidth: 3
//         , hideHover: 'auto'
//         , lineColors: ['#00bfc7', '#fb9678', '#9675ce']
//         , resize: true
//     });
    
}); 


// sparkline
var sparklineLogin = function() { 
$('#sales1').sparkline([20, 40, 30], {
        type: 'pie',
        height: '90',
        resize: true,
        sliceColors: ['#01c0c8', '#7d5ab6', '#ffffff']
});
$('#sparkline2dash').sparkline([6, 10, 9, 11, 9, 10, 12], {
        type: 'bar',
        height: '154',
        barWidth: '4',
        resize: true,
        barSpacing: '10',
        barColor: '#25a6f7'
});

};    
var sparkResize;

$(window).resize(function(e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineLogin, 500);
});
sparklineLogin();