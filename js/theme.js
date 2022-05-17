/*------------------------------------------------------------------
[Table of contents]

    - main js

- Project:    Soony - HTML Template
- Version:    1.1
- Author:     Andrey Sokoltsov
- Profile:    http://themeforest.net/user/andreysokoltsov
--*/

/* main js */
$(document).on('ready', function () {

    'use strict';

    function preload() {
        var $preloader = $('#page-preloader'),
            $spinner = $preloader.find('.spinner-loader');
        $( window ).on('load', function() {
            $spinner.fadeOut();
            $preloader.delay(500).fadeOut('slow');
        });
    }
    preload();


    //show form
    $('#show-form').on('click', function (event) {
        if(!($(this).hasClass('active'))){
            event.preventDefault();
            $(this).addClass('active');
            $(this).parents('.form-holder').find('.screen-input').addClass('active').focus();
        }
    });


    //map
    function initMap() {
        var myLatLng = {lat: 34.0536067, lng: -118.2425561};

        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 12
        });

        if($('#map').hasClass('with-marker')){
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: 'images/marker-black.png'
            });
        }
    }
    $(window).on('load', function () {
        if($('div').is('#map')){
            initMap();
        }
    });


    //init custom scroll
    $('.scroll-viewport').mCustomScrollbar({
        axis:"y",
        theme:"dark",
        scrollInertia: 500
    });


    //show hidden pages
    var $contactBtn = $('#contact-btn'),
        $aboutBtn = $('#about-btn'),
        $contactPageWrapper = $('.contact-page-wrapper'),
        $aboutPageWrapper = $('.about-page-wrapper'),
        $closeContactPage = $('.close-contact-page');


    $contactBtn.on('click', function () {
        $contactPageWrapper.addClass('active opened');
    });
    $aboutBtn.on('click', function () {
        $aboutPageWrapper.addClass('active opened');
    });
    //hide hidden pages
    $closeContactPage.on('click', function () {
        $contactPageWrapper.removeClass('active');
        $aboutPageWrapper.removeClass('active');
        setTimeout(function () {
            $contactPageWrapper.removeClass('opened');
            $aboutPageWrapper.removeClass('opened');
        }, 800);
    });
    $('.page-popup').on('click', function (event) {
        if($(this).hasClass('active')){
            if ($(event.target).closest($('.close-icon')).length) return;
            if ($(event.target).closest($('.contact-page')).length) return;
            $contactPageWrapper.removeClass('active');
            $aboutPageWrapper.removeClass('active');
            setTimeout(function () {
                $contactPageWrapper.removeClass('opened');
                $aboutPageWrapper.removeClass('opened');
            }, 800);
        }
    });


    //init slider
    $('.about-slider').slick({
        arrows: false,
        autoplay: true,
        speed: 1000,
        dots: true
    });


    //slider - img to background
    $('.about-slider img').each(function () {
        var imgUrl = $(this).attr('src');
        $(this).parent().css('background-image', 'url("' + imgUrl + '")');
        $(this).css('opacity', '0');
    });


    //countdown timer
    function countdownTimer() {
        var now = new Date();
        // var newYear = new Date(2017, 6, 5, 0, 0, 0, 0);
        var endDate = new Date($('.end-date').data('countdownDate'));
        var time = endDate - now;

        var days = Math.floor(time / (1000 * 60 * 60 * 24));
        var hours = Math.floor((time % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var min = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
        var sec = Math.floor((time % (1000 * 60)) / 1000);

        if(parseInt(hours) < 10){
            hours = '0' + hours;
        }
        if(parseInt(min) < 10){
            min = '0' + min;
        }

        if(parseInt(sec) < 10){
            sec = '0' + sec;
        }

        $('.days').text(days).append('<span>d</span>');
        $('.hours').text(hours).append('<span>h</span>');
        $('.minutes').text(min).append('<span>min</span>');
        $('.seconds').text(sec).append('<span>sec</span>');

    }
    if($('div').is('.footer-timer') || $('div').is('.main-countdown')){
        countdownTimer();
        setInterval(countdownTimer, 1000);
    }


    //init jQueryUI Datepicker
    if($('input').is('.date-input')){
        $('.date-input').datepicker({
            showOtherMonths: true
        });
    }


    //init timepicker
    if($('input').is('.time-input')){
        $('.time-input').timeEntry({
            spinnerImage: ''
        });
    }

});
