$(function() {
    /*
    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2013 Q1',
            restuarants: 30,
            doctors: null,
            mechanics: 50
        }, {
            period: '2013 Q2',
            restuarants: 80,
            doctors: 90,
            mechanics: 100
        }, {
            period: '2013 Q3',
            restuarants: 23,
            doctors: 50,
            mechanics: 10
        }, {
            period: '2013 Q4',
            restuarants: 200,
            doctors: 150,
            mechanics: 300
        }, {
            period: '2014 Q1',
            restuarants: 250,
            doctors: 300,
            mechanics: 400
        }, {
            period: '2014 Q2',
            restuarants: 450,
            doctors: 400,
            mechanics: 200
        }, {
            period: '2014 Q3',
            restuarants: 260,
            doctors: 360,
            mechanics: 100
        }, {
            period: '2014 Q4',
            restuarants: 500,
            doctors: 600,
            mechanics: 700
        }, {
            period: '2015 Q1',
            restuarants: 1000,
            doctors: 800,
            mechanics: 900
        }, {
            period: '2015 Q2',
            restuarants: 1200,
            doctors: 1100,
            mechanics: 900
        }],
        xkey: 'period',
        ykeys: ['restuarants', 'doctors', 'mechanics'],
        labels: ['Restuarants', 'Doctors', 'Mechanics'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });


    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });
    */

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2015 Feb',
            a: 10,
            b: 9,
            c: 2
        }, {
            y: '2015 Mar',
            a: 7,
            b: 6,
            c: 3
        }, {
            y: '2015 Apr',
            a: 5,
            b: 4,
            c: 7
        }, {
            y: '2015 May',
            a: 7,
            b: 6,
            c: 8
        }, {
            y: '2015 Jun',
            a: 5,
            b: 4,
            c: 6
        }, {
            y: '2015 Jul',
            a: 7,
            b: 6,
            c: 3
        }, {
            y: '2015 Aug',
            a: 10,
            b: 9,
            c: 2
        }],
        xkey: 'y',
        ykeys: ['a', 'b', 'c'],
        labels: ['Movie awards', 'Family Trips', 'Club nites'],
        hideHover: 'auto',
        resize: true
    });

});
