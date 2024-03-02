(function ($) {
    "use strict"
    console.log('settings function js loaded');

    $(window).on('load', function () {
        if (window.location.hash) {
            var idTab = window.location.hash;
            $('.elat-content-box').addClass('hide');
            $(idTab).removeClass('hide');
            $('.ela-nav-tab ul li a').parent().removeClass('active');
            $('a[href="' + idTab + '"]').parent().addClass('active');
        }

    });

    $('.save-global-settings').on('click', function (e) {
        e.preventDefault();
        var data = $('.global-settings-form').serialize();
        console.log(data);
        var afterSubmit_msg = '';

        $.ajax({
            url: elemailer.restUrl + 'settings/insert/all',
            type: 'POST',
            data: data,
            headers: {
                'X-WP-Nonce': elemailer.nonce,
            },
            dataType: 'JSON',
            success: function (response) {
                console.log(response);
                //alert('Saved'); 
                if (response.status == 1) {
                    afterSubmit_msg = response.data.message;
                    $('p.aftersubmit-msg').css('display', 'block');
                    $('p.aftersubmit-msg').text(afterSubmit_msg);
                } else {
                    afterSubmit_msg = response.error;
                    $('p.aftersubmit-msg').css('display', 'block');
                    $('p.aftersubmit-msg').text(afterSubmit_msg);
                }
            },
            error: function (response) {
                console.log(response);

            }
        });
    });

    $(".ela-nav-tab ul li a").on('click', function (e) {
        $('.ela-nav-tab ul li a').parent().removeClass('active');
        $(this).parent().addClass('active');
        var getIDfromAnchor = $(this).attr('href');
        //var makeDivmatchID = '#'+getIDfromAnchor;
        $('.elat-content-box').addClass('hide');
        $(getIDfromAnchor).removeClass('hide');
        $('p.aftersubmit-msg').css('display', 'none');
    });

    //elat-content-box
    $('.form-input-select').select2({
        placeholder: 'Leave this field empty to display all lists',
    });

    $('a').on('click', function (e) {
        var x = window.pageXOffset,
            y = window.pageYOffset;
        $(window).one('scroll', function () {
            window.scrollTo(x, y);
        })
    });

    // Show Hide Subscriber Notification Email Box On radio select
    $('.sto-radio label').on('click', function () {
        $(this).siblings('input[type=radio]').trigger('click');
    });

    $('#newsubs-notificationRadio label, #newsubs-notificationRadio input[type=radio]').on('click', function () {
        $(this).siblings('input[type=radio]').trigger('click');

        if ($("#newsubs-notificationRadio input:radio[value='yes']").is(":checked")) {
            $('#ns-notification-form-mail').fadeIn(600);
        }
        if ($("#newsubs-notificationRadio input:radio[value='no']").is(":checked")) {
            $('#ns-notification-form-mail').fadeOut(600);
        }
    });
    
    $(window).on('load', function () {
        if ($("#newsubs-notificationRadio input:radio[value='yes']").is(":checked")) {
            $('#ns-notification-form-mail').fadeIn(600);
        }
        if ($("#newsubs-notificationRadio input:radio[value='no']").is(":checked")) {
            $('#ns-notification-form-mail').fadeOut(600);
        }
    });

    // Show Hide Subscriber Notification Email Box On radio select
    $('#signUpConFirmOption label, #signUpConFirmOption input[type=radio]').on('click', function () {
        $(this).siblings('input[type=radio]').trigger('click');

        if ($("#signUpConFirmOption input:radio[value='yes']").is(":checked")) {
            $('#signUpConfirm').removeClass('othersOptionHide');
        }
        if ($("#signUpConFirmOption input:radio[value='no']").is(":checked")) {
            $('#signUpConfirm').addClass('othersOptionHide');
        }
    });

    $(window).on('load', function () {
        if ($("#signUpConFirmOption input:radio[value='yes']").is(":checked")) {
            $('#signUpConfirm').removeClass('othersOptionHide');
        }
        if ($("#signUpConFirmOption input:radio[value='no']").is(":checked")) {
            $('#signUpConfirm').addClass('othersOptionHide');
        }
    });

    $('.elesettings-link').on('click', function (e) {
        e.preventDefault();
        var pageId = $(this).prev().find('select').val();
        var type = $(this).data('type');
        $.ajax({
            url: elemailer.restUrl + 'settings/preview_page_link/' + pageId,
            type: 'GET',
            data: { type: type },
            headers: {
                'X-WP-Nonce': elemailer.nonce,
            },
            dataType: 'JSON',
            success: function (response) {
                window.open(response, '_blank');
            },
            error: function (response) {
                console.log(response);

            }
        });
    });

})(jQuery);