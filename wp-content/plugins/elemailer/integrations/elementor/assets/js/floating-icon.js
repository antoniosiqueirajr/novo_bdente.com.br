( function ( $ ) {
    const ElemailerFloatingAction = {
        init() {
            $( 'body' ).on( 'change', '.elemailer-admin-floating-select', function ( e ) {
                e.preventDefault();

                ElemailerFloatingAction.updateShortcodes( e, $( this ) );
            } );

            $( 'body' ).on( 'keyup', '.elemailer-admin-floating-input', function ( e ) {
                e.preventDefault();

                ElemailerFloatingAction.updateShortcodes( e, $( this ) );
            } );

            $( 'body' ).on( 'click', '.elemailer-admin-floating-action', function ( e ) {
                e.preventDefault();

                $('.elemailer-admin-floating-wrap').toggleClass( 'elemailer-floating-open' );
            } );

            $( 'body' ).on( 'click', '.elemailer-floating-head-close', function ( e ) {
                e.preventDefault();

                $('.elemailer-admin-floating-wrap').removeClass( 'elemailer-floating-open' );
            } );

            $( 'body' ).on( 'click', '.elemailer-floating-head-plus', function ( e ) {
                e.preventDefault();

                var blank_row = '<tr> <td><input type="text" class="elemailer-admin-floating-input" name="shortcode_key[][third_party_key]" placeholder="'+elemailer_floating_object.filed_key_text+'"></td> <td><input type="text" class="elemailer-admin-floating-input" name="shortcode_key[][elemailer_key]" placeholder="'+elemailer_floating_object.ele_filed_key_text+'"></td> <td> <span class="elemailer-floating-head-plus">+</span> <span class="elemailer-floating-head-minus">-</span> </td> </tr>';

                $('.elemailer-admin-floating-table').append( blank_row );
            } );

            $( 'body' ).on( 'click', '.elemailer-floating-head-minus', function ( e ) {
                e.preventDefault();

                $( this ).parent( 'td' ).parent( 'tr' ).remove();
                ElemailerFloatingAction.updateShortcodes( e, $( this ) );
            } );

            $( 'body' ).on( 'click', '.elemailer-admin-floating-save-label', function ( e ) {
                    e.preventDefault();

                    ElemailerFloatingAction.saveShortcdoes( e, $( this ) );
                }
            );

            $( 'body' ).on( 'click', '.elemailer-floating-codes-copy', function ( e ) {
                var currentHtml = $(this).html();
                $(this).html( 'Copied' );

                setTimeout(function() {
                    $('.elemailer-floating-codes-copy').html( currentHtml );
                }, 500);

                e.preventDefault();
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val( $('.elemailer-admin-floating-codes').val() ).select();
                document.execCommand("copy");
                $temp.remove();
            }
        );
        },

        /**
         * Save shortocdes
         *
         * @since x.x.x
         *
         * @param {Object}  e       Object current prevent default event.
         * @param {Object}  current Object current mouse event.
         */
        saveShortcdoes: ( e, current ) => {
            e.preventDefault();

            $.ajax( {
                type: 'GET',
                dataType: 'json',
                url: elemailer_floating_object.ajax_url,
                data: {
                    action: 'elemailer_save_shortcodes',
                    _ajax_nonce: elemailer_floating_object.ajax_nonce,
                    shortcodes: $('.elemailer-admin-floating-codes').val(),
                },
                beforeSend: () => {
                    $('.elemailer-admin-floating-save-label').css( 'cursor', 'progress' );
                },
                success( response ) {
                    $( '#wcp-slide-out-modal' ).html( response.content );
                    $('.elemailer-admin-floating-save-label').css( 'cursor', 'pointer' );
                },
                error() {
                    // error
                },
            } );
        },

        /**
         * Update shortcodes
         *
         * @since x.x.x
         *
         * @param {Object} e       Object current prevent default event.
         * @param {Object} current Object current mouse event.
         */
        updateShortcodes: ( e, current ) => {
            e.preventDefault();
            let ele_id     = $('.elemailer-admin-floating-select').val();

            if ( '' === ele_id ) {
                window.alert( 'Elemailer template requires.' );
                $('.elemailer-admin-floating-codes').val('');

                return false;
            }

            var third_party   = jQuery("input[name='shortcode_key[][third_party_key]']").map(function(){return jQuery(this).val();}).get();
            var elemailer_key = jQuery("input[name='shortcode_key[][elemailer_key]']").map(function(){return jQuery(this).val();}).get();
            var field_map     = '';
            var count_row     = 1;

            for( var i = 0; i < third_party.length; i++ ){
                var third_party_val = third_party[i];
                var elemailer_key_val = elemailer_key[i];

                if ( undefined !== typeof third_party_val && undefined !== typeof elemailer_key_val && '' !== third_party_val && '' !== elemailer_key_val ) {

                    if ( 1 === count_row ) {
                        field_map = ''+third_party_val+':emap:'+elemailer_key_val+'';
                    } else {
                        field_map += ' /esplit/ '+third_party_val+':emap:'+elemailer_key_val+'';
                    }
                    count_row++;
                }
            }
            var shortcodes = '[ele_override_start][elemailer:id="' + ele_id + '" '+ field_map +'][ele_override_end]';
            
            $('.elemailer-admin-floating-codes').val( shortcodes );
        },
    };

    $( function () {
        ElemailerFloatingAction.init();
    } );
} )( jQuery );