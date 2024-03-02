(function ($) {
    "use strict";
    console.log('emails function js loaded');

    $(window).load(function () {
        $('.preloader').fadeOut('slow');
    });

    var id = 0;

    var type = 'all';

    $(window).on('load', function () {
        $("iframe.elemailer-iframe").load(function () {
            //alert("Id changed"); 
            $('.iframeBeforeLoad').removeClass('iFrameLoading');
        });

        elemailer_show_hide_wc_email_where_apply( $('.elemailer_wc_email_where_apply').val() );
        elemailer_show_wc_email_reciepient();

        function markSecondStepProgressbar() {
            if (!$('.template-title-sub-wrapper').hasClass("hide")) {
                $('.cmpb-step ul li').removeClass('active');
                $('.cmpb-step ul li:first-child').addClass('active');
                $('.cmpb-step ul li:nth-child(2)').addClass('active');
            }
        }
        //Custom Markups For Action Buttons  
        var all_data_btn = '<span class="action_links"><ul>';
        all_data_btn += '<li class="listStatistics_li"><a href="#" class="listStatistics">Statistics</a> | </li>';
        all_data_btn += '<li class="listEdit_li"><a href="#" class="listEdit" title="Edit">Edit</a> | </li>';
        all_data_btn += '<li class="listPause_li"><a href="#" class="listPause" title="Pause"><span class="pause">Pause</span><span class="resume">Resume</span></a> | </li>';
        all_data_btn += '<li class="listTerminate_li"><a href="#" class="listTerminate" title="Terminate">Terminate</a> | </li>';
        all_data_btn += '<li class="listDuplicate_li"><a href="#" class="listDuplicate" title="Duplicate">Duplicate</a> | </li>';
        all_data_btn += '<li class="listMoveToTrash_li"><a href="#" class="listMoveToTrash" title="Trash">Trash</a> | </li>';
        all_data_btn += '<li class="listEditWithElementor_li"><a href="#" target="_blank" class="listEditWithElementor" title="Edit Design">Edit Design</a></li>';
        
        all_data_btn += '</ul></span>';

        var trash_data_btn = '<span class="action_links"><ul>';
        trash_data_btn += '<li class="listRestore_li"><a href="#" class="listRestore" title="Restore">Restore</a> | </li>';
        trash_data_btn += '<li class="listPermanentremove_li"><a href="#" class="listPermanentremove" title="Delete">Delete</a></li>';
        trash_data_btn += '</ul></span>';

        if (window.location.hash) {
            var idTab = window.location.hash;
            $('.elat-content-box').addClass('hide');

            $('.ele-create-mail-tab').addClass('hide');
            $(idTab).removeClass('hide');
            $('.ela-nav-tab ul li a').parent().removeClass('active');
            $('a[href="' + idTab + '"]').parent().addClass('active');

            markSecondStepProgressbar();

            if (idTab == '#newsletter') {
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().destroy();
                newsLetterDataTableCall();
            } else if (idTab == '#welcomeemail') {
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().destroy();
                welcomeEmailDataTableCall();
            } else if (idTab == '#postnotification') {
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().destroy();
                postNotificationDataTableCall();
            } else if (idTab == '#woocommerceemail') {
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().destroy();
                woocommerceemailDataTableCall();
            }


        } else {
            $('#newsletter_dataTable').DataTable().destroy();
            $('#welcomeemail_dataTable').DataTable().destroy();
            $('#postnotification_dataTable').DataTable().destroy();
            $('#woocommerceemail_dataTable').DataTable().destroy();
            newsLetterDataTableCall();
        }

        $('.ela-nav-tab .newsletter-tab').on('click', function () {
            $('#newsletter_dataTable').DataTable().destroy();
            $('#welcomeemail_dataTable').DataTable().destroy();
            $('#postnotification_dataTable').DataTable().destroy();
            $('#woocommerceemail_dataTable').DataTable().destroy();

            $('#newsletter_dataTable').DataTable().clear();
            $('#welcomeemail_dataTable').DataTable().clear();
            $('#postnotification_dataTable').DataTable().clear();
            $('#woocommerceemail_dataTable').DataTable().clear();
            $('input[name="allCheckBtn"]').prop('checked', false);
            $('.moveTrashSelected').addClass('hide');
            newsLetterDataTableCall();
        });

        $('.ela-nav-tab .welcomeemail-tab').on('click', function () {
            $('#newsletter_dataTable').DataTable().destroy();
            $('#welcomeemail_dataTable').DataTable().destroy();
            $('#postnotification_dataTable').DataTable().destroy();
            $('#woocommerceemail_dataTable').DataTable().destroy();

            $('#newsletter_dataTable').DataTable().clear();
            $('#welcomeemail_dataTable').DataTable().clear();
            $('#postnotification_dataTable').DataTable().clear();
            $('#woocommerceemail_dataTable').DataTable().clear();
            $('input[name="allCheckBtn"]').prop('checked', false);
            $('.moveTrashSelected').addClass('hide');
            welcomeEmailDataTableCall();
        });

        $('.ela-nav-tab .postnotification-tab').on('click', function () {
            $('#newsletter_dataTable').DataTable().destroy();
            $('#welcomeemail_dataTable').DataTable().destroy();
            $('#postnotification_dataTable').DataTable().destroy();
            $('#woocommerceemail_dataTable').DataTable().destroy();

            $('#newsletter_dataTable').DataTable().clear();
            $('#welcomeemail_dataTable').DataTable().clear();
            $('#postnotification_dataTable').DataTable().clear();
            $('#woocommerceemail_dataTable').DataTable().clear();
            $('input[name="allCheckBtn"]').prop('checked', false);
            $('.moveTrashSelected').addClass('hide');
            postNotificationDataTableCall();
        });

        $('.ela-nav-tab .woocommerceemail-tab').on('click', function () {
            $('#newsletter_dataTable').DataTable().destroy();
            $('#welcomeemail_dataTable').DataTable().destroy();
            $('#postnotification_dataTable').DataTable().destroy();
            $('#woocommerceemail_dataTable').DataTable().destroy();

            $('#newsletter_dataTable').DataTable().clear();
            $('#welcomeemail_dataTable').DataTable().clear();
            $('#postnotification_dataTable').DataTable().clear();
            $('#woocommerceemail_dataTable').DataTable().clear();
            $('input[name="allCheckBtn"]').prop('checked', false);
            $('.moveTrashSelected').addClass('hide');
            woocommerceemailDataTableCall();
        });

        function newsLetterDataTableCall() {
            var elAllNewsLetter = $('#eleNewsLetterAll');
            var elTrashNewsLetter = $('#eleNewsLetterTrash');

            $('#newsletter_dataTable').DataTable().destroy();
            runNewsLetterDataTable(type);

            elAllNewsLetter.on('click', function (e) {
                e.preventDefault();
                $('#newsletter_dataTable').removeClass('trashListData');
                type = 'all';
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().destroy();
                runNewsLetterDataTable(type);
            });

            elTrashNewsLetter.on('click', function (e) {
                e.preventDefault();
                $('#newsletter_dataTable').addClass('trashListData');
                type = 'trash';
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().destroy();
                runNewsLetterDataTable(type);
            });
        } 

        function runNewsLetterDataTable(type) {
            var elAllNewsLetter = $('#eleNewsLetterAll');
            var elTrashNewsLetter = $('#eleNewsLetterTrash');

            elAllNewsLetter.removeClass('active-type');
            elTrashNewsLetter.removeClass('active-type');

            var listDatatable;
            var allListData = elemailer.restUrl + 'emails/get_all_emails/newsletter';
            var trashListData = elemailer.restUrl + 'emails/get_trash_emails/newsletter'; 

            
            var markups = (type == 'all') ? all_data_btn : trash_data_btn;
            listDatatable = $('#newsletter_dataTable').DataTable({
                
                "processing": true,
                "serverSide": true,
                "order": [ 0, 'desc' ],
                "ajax": {
                    "url": (type == 'all') ? allListData : trashListData,
                    "data": function ( d ) {
                       d.eordercolumn=d.order[0].column; //pass order column number 
                       d.eorderdir=d.order[0].dir; //pass order Asc/dsc
                       d.esearchvalue=d.search.value; //pass order Asc/dsc
                    }
                },
                columns: [
                    {
                        data: "id",
                        className: "ele_data_id",
                        render: function (data, type, row) {
                            return '<span id="data_' + data + '"><input class="eleDataCheckBox" type="checkbox" id="' + data + '" name="action_ids" value="' + data + '"></span>';
                        }
                    },
                    { 
                        data: "post_title", 
                        className: "emails-email has_action_options",
                        render: function (data, type, row) {
                            
                            return '<span class="title_text">' + data + '</span>'+markups;
                        }
                    },
                     
                    { data: "subject" },
                    {
                        data: "status",
                        orderable: false,
                        className: "send-status",
                        render: function (data, type, row) {
                            return '<span class="status_column">'+ data.replaceAll('-', ' ') +'</span>';
                        }
                    },
                    {
                        data: "lists",
                        orderable: false,
                        className: "list_td",
                        render: function (data, type, row) {
                            return '<span class="list_column">'+ data +'</span>';
                        }
                    }, 
                      
                    {
                        data: 'set_on',
                        orderable: false,
                        className: "start_date_time",
                        render: function (data, type, row) {
                            var dataWIthUnderScore = data;
                            var set_on_data = dataWIthUnderScore.replace(/_/g, " ");
                            return set_on_data;
                        }

                    },
                    {
                        data: "shortcode",
                        className: "center",
                        orderable: false,
                        render: function (data, type, row) {
                            return '<input class="short_code_field_ro" type="text" name="shortcode_id" value=\''+ data +'\' onClick="this.select();" readonly>';
                        }
                    }, 
                    {
                        data: 'post_date',
                        className: "post_date",
                        render: function (data, type, row) {
                            var dataWIthSpace = data;
                            var post_date_data = dataWIthSpace.replace(/ /g, "<br>");
                            return '<span class="postDate_column">'+ post_date_data +'</span>';
                            
                        }

                    },  
                ],
                "initComplete": function (settings, json) {
                    if (type == 'all') {
                        elAllNewsLetter.children().text(json.recordsTotal);
                        elTrashNewsLetter.removeClass('active-type');
                        elAllNewsLetter.addClass('active-type');
                    } else {
                        elTrashNewsLetter.children().text(json.recordsTotal);
                        elAllNewsLetter.removeClass('active-type');
                        elTrashNewsLetter.addClass('active-type');
                    }
                }
            });
        }

        function welcomeEmailDataTableCall() {
            var elAllWelcomeData = $('#eleWelcomeEmailAll');
            var elTrashWelcomeData = $('#eleWelcomeEmailTrash');

            $('#welcomeemail_dataTable').DataTable().destroy();
            runWelcomeEmailDataTable(type);

            elAllWelcomeData.on('click', function (e) {
                e.preventDefault();
                $('#welcomeemail_dataTable').removeClass('trashListData');
                type = 'all';
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().destroy();
                runWelcomeEmailDataTable(type);
            });

            elTrashWelcomeData.on('click', function (e) {
                e.preventDefault();
                $('#welcomeemail_dataTable').addClass('trashListData');
                type = 'trash';
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().destroy();
                runWelcomeEmailDataTable(type);
            });
        }

        function runWelcomeEmailDataTable(type) {
            var elAllWelcomeData = $('#eleWelcomeEmailAll');
            var elTrashWelcomeData = $('#eleWelcomeEmailTrash');

            elAllWelcomeData.removeClass('active-type');
            elTrashWelcomeData.removeClass('active-type');

            var welcomeListDataTable;
            var welcomeEmailAllListData = elemailer.restUrl + 'emails/get_all_emails/welcomeemail';
            var welcomeEmailTrashListData = elemailer.restUrl + 'emails/get_trash_emails/welcomeemail';
            var markups = (type == 'all') ? all_data_btn : trash_data_btn;
            welcomeListDataTable = $('#welcomeemail_dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [ 0, 'desc' ],
                "ajax": {
                    "url": (type == 'all') ? welcomeEmailAllListData : welcomeEmailTrashListData,
                    "data": function ( d ) {
                       d.eordercolumn=d.order[0].column; //pass order column number 
                       d.eorderdir=d.order[0].dir; //pass order Asc/dsc
                       d.esearchvalue=d.search.value; //pass order Asc/dsc
                    }
                },
                //ajax: (type == 'all') ? welcomeEmailAllListData : welcomeEmailTrashListData,
                columns: [
                    {
                        data: "id",
                        className: "ele_data_id",
                        render: function (data, type, row) {
                            return '<span id="data_' + data + '"><input class="eleDataCheckBox" type="checkbox" id="' + data + '" name="action_ids" value="' + data + '"></span>';
                        }
                    },
                    { 
                        data: "post_title", 
                        className: "emails-email has_action_options",
                        render: function (data, type, row) {
                            
                            return '<span class="title_text">' + data + '</span>'+markups;
                        }
                    },
                    { data: "subject" },
                    {
                        data: "status",
                        orderable: false,
                        className: "send-status",
                        render: function (data, type, row) {
                            return '<span class="status_column">'+ data.replaceAll('-', ' ') +'</span>';
                        }
                    },
                    { 
                        data: "lists",
                        orderable: false,
                        className: 'events',
                        render: function(data, type, row){
                            return data.replaceAll('-', ' ');
                        }
                    },
                    {
                        data: 'set_on',
                        orderable: false,
                        className: "start_date_time",
                        render: function (data, type, row) {
                            var dataWIthUnderScore = data;
                            var set_on_data = dataWIthUnderScore.replace(/_/g, " ");
                            return set_on_data;
                        }

                    },
                    {
                        data: "shortcode",
                        orderable: false,
                        className: "center",
                        render: function (data, type, row) {
                            return '<input class="short_code_field_ro" type="text" name="shortcode_id" value=\''+ data +'\' onClick="this.select();" readonly>';
                        }
                    }, 
                    {
                        data: "post_date",
                        className: "post_date",
                        render: function (data, type, row) {
                            var dataWIthSpace = data;
                            var post_date_data = dataWIthSpace.replace(/ /g, "<br>");
                            return '<span class="postDate_column">'+ post_date_data +'</span>';
                        }
                    }, 
                ],
                "initComplete": function (settings, json) {
                    if (type == 'all') {
                        elAllWelcomeData.children().text(json.recordsTotal);
                        elTrashWelcomeData.removeClass('active-type');
                        elAllWelcomeData.addClass('active-type');
                    } else {
                        elTrashWelcomeData.children().text(json.recordsTotal);
                        elAllWelcomeData.removeClass('active-type');
                        elTrashWelcomeData.addClass('active-type');
                    }
                }
            });
        }

        function postNotificationDataTableCall() {
            var elAllPostData = $('#elePostNotificationAll');
            var elTrashPostData = $('#elePostNotificationTrash');

            $('#postnotification_dataTable').DataTable().destroy();
            runPostNotificationDataTable(type);

            elAllPostData.on('click', function (e) {
                e.preventDefault();
                $('#postnotification_dataTable').removeClass('trashListData');
                type = 'all';
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().destroy();
                runPostNotificationDataTable(type);
            });

            elTrashPostData.on('click', function (e) {
                e.preventDefault();
                $('#postnotification_dataTable').addClass('trashListData');
                type = 'trash';
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().destroy();
                runPostNotificationDataTable(type);
            });
        }

        function runPostNotificationDataTable(type) {
            var elAllPostData = $('#elePostNotificationAll');
            var elTrashPostData = $('#elePostNotificationTrash');

            elAllPostData.removeClass('active-type');
            elTrashPostData.removeClass('active-type');

            var postListDataTable;
            var postNotificationAllListData = elemailer.restUrl + 'emails/get_all_emails/postnotification';
            var postNotificationTrashListData = elemailer.restUrl + 'emails/get_trash_emails/postnotification';
            var markups = (type == 'all') ? all_data_btn : trash_data_btn;
            postListDataTable = $('#postnotification_dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [ 0, 'desc' ],
                "ajax": {
                    "url": (type == 'all') ? postNotificationAllListData : postNotificationTrashListData,
                    "data": function ( d ) {
                       d.eordercolumn=d.order[0].column; //pass order column number 
                       d.eorderdir=d.order[0].dir; //pass order Asc/dsc
                       d.esearchvalue=d.search.value; //pass order Asc/dsc
                    }
                },
                //ajax: (type == 'all') ? postNotificationAllListData : postNotificationTrashListData,
                columns: [
                    {
                        data: "id",
                        className: "ele_data_id",
                        render: function (data, type, row) {
                            return '<span id="data_' + data + '"><input class="eleDataCheckBox" type="checkbox" id="' + data + '" name="action_ids" value="' + data + '"></span>';
                        }
                    },
                    { 
                        data: "post_title", 
                        className: "emails-email has_action_options",
                        render: function (data, type, row) {
                            
                            return '<span class="title_text">' + data + '</span>'+markups;
                        }
                    },
                    { data: "subject" },
                    {
                        data: "status",
                        className: "send-status",
                        render: function (data, type, row) {
                            return '<span class="status_column">'+ data.replaceAll('-', ' ') +'</span>';
                        }
                    },
                    {
                        data: "lists",
                        orderable: false,
                        className: "list_td",
                        render: function (data, type, row) {
                            return '<span class="list_column">'+ data +'</span>';
                        }
                    },
                    {
                        data: 'set_on',
                        orderable: false,
                        className: "start_date_time",
                        render: function (data, type, row) {
                            var dataWIthUnderScore = data;
                            var set_on_data = dataWIthUnderScore.replace(/_/g, " ");
                            return set_on_data;
                        }

                    },
                    {
                        data: "shortcode",
                        orderable: false,
                        className: "center",
                        render: function (data, type, row) {
                            return '<input class="short_code_field_ro" type="text" name="shortcode_id" value=\''+ data +'\' onClick="this.select();" readonly>';
                        }
                    }, 
                    { 
                        data: "post_date",
                        className: "post_date",
                        render: function (data, type, row) {
                            var dataWIthSpace = data;
                            var post_date_data = dataWIthSpace.replace(/ /g, "<br>");
                            return '<span class="postDate_column">'+ post_date_data +'</span>';
                        }
                    }, 
                ],
                "initComplete": function (settings, json) {
                    if (type == 'all') {
                        elAllPostData.children().text(json.recordsTotal);
                        elTrashPostData.removeClass('active-type');
                        elAllPostData.addClass('active-type');
                    } else {
                        elTrashPostData.children().text(json.recordsTotal);
                        elAllPostData.removeClass('active-type');
                        elTrashPostData.addClass('active-type');
                    }
                }
            });
        }

        function woocommerceemailDataTableCall() {
            var elAllPostData = $('#elewoocommerceemailAll');
            var elTrashPostData = $('#elewoocommerceemailTrash');

            $('#woocommerceemail_dataTable').DataTable().destroy();
            runwoocommerceemailDataTable(type);

            elAllPostData.on('click', function (e) {
                e.preventDefault();
                $('#woocommerceemail_dataTable').removeClass('trashListData');
                type = 'all';
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().clear().destroy();
                runwoocommerceemailDataTable(type);
            });

            elTrashPostData.on('click', function (e) {
                e.preventDefault();
                $('#woocommerceemail_dataTable').addClass('trashListData');
                type = 'trash';
                $('#newsletter_dataTable').DataTable().destroy();
                $('#welcomeemail_dataTable').DataTable().destroy();
                $('#postnotification_dataTable').DataTable().destroy();
                $('#woocommerceemail_dataTable').DataTable().clear().destroy();
                runwoocommerceemailDataTable(type);
            });
        }

        function runwoocommerceemailDataTable(type) {
            var elAllPostData = $('#elewoocommerceemailAll');
            var elTrashPostData = $('#elewoocommerceemailTrash');

            elAllPostData.removeClass('active-type');
            elTrashPostData.removeClass('active-type');

            var postListDataTable;
            var postwoocommerceemailAllListData = elemailer.restUrl + 'emails/get_all_emails/woocommerceemail';
            var postNwoocommerceemailTrashListData = elemailer.restUrl + 'emails/get_trash_emails/woocommerceemail';
            var markups = (type == 'all') ? all_data_btn : trash_data_btn;
            postListDataTable = $('#woocommerceemail_dataTable').DataTable({
                responsive: true,
                "processing": true,
                "serverSide": true,
                "order": [ 0, 'desc' ],
                "ajax": {
                    "url": (type == 'all') ? postwoocommerceemailAllListData : postNwoocommerceemailTrashListData,
                    "data": function ( d ) {
                       d.eordercolumn=d.order[0].column; //pass order column number 
                       d.eorderdir=d.order[0].dir; //pass order Asc/dsc
                       d.esearchvalue=d.search.value; //pass order Asc/dsc
                    }
                },
                //ajax: (type == 'all') ? postwoocommerceemailAllListData : postNwoocommerceemailTrashListData,
                columns: [
                    {
                        data: "id",
                        className: "ele_data_id",
                        render: function (data, type, row) {
                            return '<span id="data_' + data + '"><input class="eleDataCheckBox" type="checkbox" id="' + data + '" name="action_ids" value="' + data + '"></span>';
                        }
                    },
                    { 
                        data: "post_title", 
                        className: "emails-email has_action_options",
                        render: function (data, type, row) {
                            
                            return '<span class="title_text">' + data + '</span>'+markups;
                        }
                    },
                    { data: "subject" },
                    {
                        data: "status",
                        className: "send-status",
                        render: function (data, type, row) {
                            return '<span class="status_column">'+ data.replaceAll('-', ' ') +'</span>';
                        }
                    },
                    {
                        data: "lists",
                        className: "list_td",
                        render: function (data, type, row) {
                            return '<span class="list_column">'+ data +'</span>';
                        }
                    },
                    {
                        data: "recipient",
                        className: "list_td",
                        render: function (data, type, row) {
                            return '<span class="list_column">'+ data +'</span>';
                        }
                    },
                    {
                        data: "appliedon",
                        orderable: false,
                        className: "list_td",
                        // render: function (data, type, row) {
                        //     return '<span class="list_column">'+ data +'</span>';
                        // }
                    },
                    {
                        data: "shortcode",
                        className: "center",
                        render: function (data, type, row) {
                            return '<input class="short_code_field_ro" type="text" name="shortcode_id" value=\''+ data +'\' onClick="this.select();" readonly>';
                        }
                    }, 
                    { 
                        data: "post_date",
                        className: "post_date",
                        render: function (data, type, row) {
                            var dataWIthSpace = data;
                            var post_date_data = dataWIthSpace.replace(/ /g, "<br>");
                            return '<span class="postDate_column">'+ post_date_data +'</span>';
                        }
                    }, 
                ],
                "initComplete": function (settings, json) {
                    if (type == 'all') {
                        elAllPostData.children().text(json.recordsTotal);
                        elTrashPostData.removeClass('active-type');
                        elAllPostData.addClass('active-type');
                    } else {
                        elTrashPostData.children().text(json.recordsTotal);
                        elAllPostData.removeClass('active-type');
                        elTrashPostData.addClass('active-type');
                    }
                }
            });
        } 


        // Statistics Data Table call
        runStatsDataTable();

        function runStatsDataTable() {

            var statsListDataTable = $('#stats_dataTable');
            if(statsListDataTable.length > 0){
                var emailId = statsListDataTable.data('email-id');
                var statsAllListData = elemailer.restUrl + 'emails/stats_data/' + emailId;
                statsListDataTable = $('#stats_dataTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": statsAllListData,
                        "data": function ( d ) {
                           d.eordercolumn=d.order[0].column; //pass order column number 
                           d.eorderdir=d.order[0].dir; //pass order Asc/dsc
                           d.esearchvalue=d.search.value; //pass order Asc/dsc
                        }
                    },  
                    "lengthMenu": [[10, 25, 50, 999999999999999999], [10, 25, 50, "All"]],
                    columns: [
                        { data: "email" },
                        {  
                            data: "mail_sent", 
                            render: function (data, type, row) {
                                if(data==1){
                                    return 'Sent';
                                }
                                return data;
                            }

                        },

                        { data: "mail_open" },
                        { data: "created_at" },
                    ],
                    dom: 'l<"pos-center"B>frtip',
                    buttons: [
                         {
                            extend: 'spacer',
                            style: 'bar',
                            text: '               '
                        },
                        'copyHtml5',
                        'csvHtml5',
                    ],
                    
                    "initComplete": function (settings, json) {
                    }
                });
            }
        }
        
        // Elemailer Action Nav Show Hide 
        $('.moveTrashSelected').addClass('hide');
        $('.deleteSelected').addClass('hide');
        $('.moveToPublishedSelected').addClass('hide');

        $('.elat-filter-btn li a').on('click', function () {
            $('.moveTrashSelected').addClass('hide');
            $('.deleteSelected').addClass('hide');
            $('.moveToPublishedSelected').addClass('hide');
            $('input.allCheckBtn').prop('checked', false);
        });
        $('.ela-nav-tab>ul li a').on('click', function () {
            $('.moveTrashSelected').addClass('hide');
            $('.deleteSelected').addClass('hide');
            $('.moveToPublishedSelected').addClass('hide');
            $('input.allCheckBtn').prop('checked', false);
        });


        $('.elelist_dataTable').on('click', 'input.eleDataCheckBox', function () {
            var parentEtable = $(this).parents("div.ele-data-table-area");

            if (parentEtable.find('.allEleList.active-type').length > 0) {
                if (parentEtable.find('.eleDataCheckBox').is(':checked')) {
                    parentEtable.find('.moveTrashSelected').removeClass('hide');
                } else {
                    parentEtable.find('.moveTrashSelected').addClass('hide');
                }
            }
            if (parentEtable.find('.trashNav.active-type').length > 0) {
                if (parentEtable.find('.eleDataCheckBox').is(':checked')) {
                    parentEtable.find('.deleteSelected').removeClass('hide');
                    parentEtable.find('.moveToPublishedSelected').removeClass('hide');
                } else {
                    parentEtable.find('.deleteSelected').addClass('hide');
                    parentEtable.find('.moveToPublishedSelected').addClass('hide');
                }
            }

            console.log($(this));
            console.log(parentEtable);
        });

        // Select And Deselect All on All Check click 
        $('input.allCheckBtn').on('click', function () {
            var parentEtable = $(this).parents("div.ele-data-table-area");
            if ($(this).is(':checked')) {
                //Check Footer Checkbox
                parentEtable.find('input.allCheckBtn').prop('checked', true);
                //Check Unheck All List 
                parentEtable.find('input.eleDataCheckBox').prop('checked', true);
            }
            if ($(this).is(":not(:checked)")) {
                parentEtable.find('input.allCheckBtn').prop('checked', false);
                parentEtable.find('input.eleDataCheckBox').prop('checked', false);;
            }

            if (parentEtable.find('.allEleList.active-type').length > 0) {
                if (parentEtable.find('.eleDataCheckBox').is(':checked')) {
                    parentEtable.find('.moveTrashSelected').removeClass('hide');
                } else {
                    parentEtable.find('.moveTrashSelected').addClass('hide');
                }
            }
            if (parentEtable.find('.trashNav.active-type').length > 0) {
                if (parentEtable.find('.eleDataCheckBox').is(':checked')) {
                    parentEtable.find('.deleteSelected').removeClass('hide');
                    parentEtable.find('.moveToPublishedSelected').removeClass('hide');
                } else {
                    parentEtable.find('.deleteSelected').addClass('hide');
                    parentEtable.find('.moveToPublishedSelected').addClass('hide');
                }
            }
        });

        //Select Checked values from the table 
        $('.elelist_dataTable').on('click', 'input[name="action_ids"]', function () {
            var parentEtable = $(this).parents("div.ele-data-table-area");
            var totalCountOfCheckbox = parentEtable.find('input[name="action_ids"]').length;
            var totalChecked = parentEtable.find('input[name="action_ids"]:checked').length;

            if (totalCountOfCheckbox == totalChecked) {
                parentEtable.find('input[name="allCheckBtn"]').prop('checked', true);
                parentEtable.find('.check_all_footer .allCheckBtn').prop('checked', true);
            } else {
                parentEtable.find('input[name="allCheckBtn"]').prop('checked', false);
                parentEtable.find('.check_all_footer .allCheckBtn').prop('checked', false);
            }
            console.log('Uncheck ' + totalCountOfCheckbox);
            console.log('Uncheck ' + totalChecked);
        });


        // Statistics Click And Redirect Action Button JS
        $('.elelist_dataTable').on('click', 'a.listStatistics', function (e) {
            e.preventDefault();
            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            var currentUrl = window.location.href;
            var redirect = currentUrl.replace(/\?page=.*/, '?page=elemailer-emails&action=stats&email_id=' + id);
            if (redirect) {
                window.location.href = redirect;
            }

        });

        //Trash Selected Item
        $('.moveToTrash').on('click', function (e) {
            e.preventDefault();
            var eleDataCheckedValues = []
            $('input[name="action_ids"]:checked').each(function () {
                eleDataCheckedValues.push(this.value);
            });
            // console.log(eleDataCheckedValues);
            // do ajax request
            $.ajax({
                url: elemailer.restUrl + 'emails/change_status_multiple/trash',
                type: 'POST',
                data: { selected: eleDataCheckedValues },
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == 1) {
                        $('#welcomeemail_dataTable').DataTable().destroy();
                        $('#newsletter_dataTable').DataTable().destroy();
                        $('#postnotification_dataTable').DataTable().destroy();
                        $('#woocommerceemail_dataTable').DataTable().destroy();

                        if (response.term == 'newsletter') {
                            newsLetterDataTableCall();
                        } else if (response.term == 'welcomeemail') {
                            welcomeEmailDataTableCall();
                        } else if (response.term == 'postnotification') {
                            postNotificationDataTableCall();
                        } else if (response.term == 'woocommerceemail') {
                            woocommerceemailDataTableCall();
                        }
                    } else {
                        console.log(response.error);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });

        });

        //Restore Selected Item
        $('.moveToPublished').on('click', function (e) {
            e.preventDefault();
            var eleDataCheckedValues = []
            $('input[name="action_ids"]:checked').each(function () {
                eleDataCheckedValues.push(this.value);
            });
            // console.log(eleDataCheckedValues);
            // do ajax request
            $.ajax({
                url: elemailer.restUrl + 'emails/change_status_multiple/published',
                type: 'POST',
                data: { selected: eleDataCheckedValues },
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == 1) {
                        $('#welcomeemail_dataTable').DataTable().destroy();
                        $('#newsletter_dataTable').DataTable().destroy();
                        $('#postnotification_dataTable').DataTable().destroy();
                        $('#woocommerceemail_dataTable').DataTable().destroy();

                        if (response.term == 'newsletter') {
                            newsLetterDataTableCall();
                        } else if (response.term == 'welcomeemail') {
                            welcomeEmailDataTableCall();
                        } else if (response.term == 'postnotification') {
                            postNotificationDataTableCall();
                        } else if (response.term == 'woocommerceemail') {
                            woocommerceemailDataTableCall();
                        }
                    } else {
                        console.log(response.error);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });

        });

        //Delete Selected Item
        $('.deleteSelected').on('click', function (e) {
            e.preventDefault();
            var eleDataCheckedValues = []
            $('input[name="action_ids"]:checked').each(function () {
                eleDataCheckedValues.push(this.value);
            });
            // console.log(eleDataCheckedValues);
            // do ajax request
            $.ajax({
                url: elemailer.restUrl + 'emails/change_status_multiple/delete',
                type: 'POST',
                data: { selected: eleDataCheckedValues },
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == 1) {
                        $('#welcomeemail_dataTable').DataTable().destroy();
                        $('#newsletter_dataTable').DataTable().destroy();
                        $('#postnotification_dataTable').DataTable().destroy();
                        $('#woocommerceemail_dataTable').DataTable().destroy();

                        if (response.term == 'newsletter') {
                            newsLetterDataTableCall();
                        } else if (response.term == 'welcomeemail') {
                            welcomeEmailDataTableCall();
                        } else if (response.term == 'postnotification') {
                            postNotificationDataTableCall();
                        } else if (response.term == 'woocommerceemail') {
                            woocommerceemailDataTableCall();
                        }
                    }
                    else {
                        console.log(response.error);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });

        });

        // Pause cron
        $('.elelist_dataTable').on('click', 'a.listPause', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            var currentUrl = window.location.href;
            var redirect = currentUrl.replace(/\?page=.*/, '?page=elemailer-emails&action=pause&email_id=' + id );
            if (redirect) {
                window.location.href = redirect;
            }       

        }); 
        //stop/terminate cron
         $('.elelist_dataTable').on('click', 'a.listTerminate', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            var currentUrl = window.location.href;
            var redirect = currentUrl.replace(/\?page=.*/, '?page=elemailer-emails&action=stop&email_id=' + id );
            if (redirect) {
                window.location.href = redirect;
            }       

        }); 

        // Edit a record
        $('.elelist_dataTable').on('click', 'a.listEdit', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            var currentUrl = window.location.href;
            var redirect = currentUrl.replace(/\?page=.*/, '?page=elemailer-emails&action=create&email_id=' + id + '#elemailer-template-info');

            if (redirect) {
                window.location.href = redirect;
            }

        }); 

        // Edit design with Elemnetor directly
        $('.elelist_dataTable').on('click', 'a.listEditWithElementor', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            var currentUrl = window.location.href;
            var redirect = currentUrl.replace(/admin.php.*/, 'post.php?post=' + id + '&action=elementor');
            
            window.open(
              redirect,
              '_blank' // <- This is what makes it open in a new window.
            );

        });

        // Duplicate a record
        $('.elelist_dataTable').on('click', 'a.listDuplicate', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            let paramAdd = (elemailer.restUrl.indexOf('index.php?rest_route=') !== -1) ? '&status=duplicate' : '?status=duplicate';

            $.ajax({
                url: elemailer.restUrl + 'emails/change_status/' + id + paramAdd,
                type: 'POST',
                data: {
                    'id': id,
                },
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    console.log(response);
                    if (response.status == 1) {
                        $('#welcomeemail_dataTable').DataTable().destroy();
                        $('#newsletter_dataTable').DataTable().destroy();
                        $('#postnotification_dataTable').DataTable().destroy();
                        $('#woocommerceemail_dataTable').DataTable().destroy();

                        if (response.term == 'newsletter') {
                            newsLetterDataTableCall();
                        } else if (response.term == 'welcomeemail') {
                            welcomeEmailDataTableCall();
                        } else if (response.term == 'postnotification') {
                            postNotificationDataTableCall();
                        } else if (response.term == 'woocommerceemail') {
                            woocommerceemailDataTableCall();
                        }
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });

        // Move to published a record
        $('.elelist_dataTable').on('click', 'a.listRestore', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            let paramAdd = (elemailer.restUrl.indexOf('index.php?rest_route=') !== -1) ? '&status=published' : '?status=published';

            $.ajax({
                url: elemailer.restUrl + 'emails/change_status/' + id + paramAdd,
                type: 'POST',
                data: {
                    'id': id,
                },
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    console.log(response);
                    if (response.status == 1) {
                        deleteRow(parent);
                        $('#welcomeemail_dataTable').DataTable().destroy();
                        $('#newsletter_dataTable').DataTable().destroy();
                        $('#postnotification_dataTable').DataTable().destroy();
                        $('#woocommerceemail_dataTable').DataTable().destroy();

                        if (response.term == 'newsletter') {
                            newsLetterDataTableCall();
                        } else if (response.term == 'welcomeemail') {
                            welcomeEmailDataTableCall();
                        } else if (response.term == 'postnotification') {
                            postNotificationDataTableCall();
                        } else if (response.term == 'woocommerceemail') {
                            woocommerceemailDataTableCall();
                        }
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });

        // Trash a record
        $('.elelist_dataTable').on('click', 'a.listMoveToTrash', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();
            //console.log(id);
            let paramAdd = (elemailer.restUrl.indexOf('index.php?rest_route=') !== -1) ? '&status=trash' : '?status=trash';
            $.ajax({
                url: elemailer.restUrl + 'emails/change_status/' + id + paramAdd,
                type: 'POST',
                data: {
                    'id': id,
                },
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    console.log(response);
                    if (response.status == 1) {
                        deleteRow(parent);
                        $('#welcomeemail_dataTable').DataTable().destroy();
                        $('#newsletter_dataTable').DataTable().destroy();
                        $('#postnotification_dataTable').DataTable().destroy();
                        $('#woocommerceemail_dataTable').DataTable().destroy();

                        if (response.term == 'newsletter') {
                            newsLetterDataTableCall();
                        } else if (response.term == 'welcomeemail') {
                            welcomeEmailDataTableCall();
                        } else if (response.term == 'postnotification') {
                            postNotificationDataTableCall();
                        } else if (response.term == 'woocommerceemail') {
                            woocommerceemailDataTableCall();
                        }
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });

        // Delete a record
        $('.elelist_dataTable').on('click', 'a.listPermanentremove', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            $.ajax({
                url: elemailer.restUrl + 'emails/delete/' + id,
                type: 'POST',
                data: {
                    'id': id,
                },
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    console.log(response);
                    if (response.status == 1) {
                        deleteRow(parent);
                        $('#welcomeemail_dataTable').DataTable().destroy();
                        $('#newsletter_dataTable').DataTable().destroy();
                        $('#postnotification_dataTable').DataTable().destroy();
                        $('#woocommerceemail_dataTable').DataTable().destroy();

                        if (response.term == 'newsletter') {
                            newsLetterDataTableCall();
                        } else if (response.term == 'welcomeemail') {
                            welcomeEmailDataTableCall();
                        } else if (response.term == 'postnotification') {
                            postNotificationDataTableCall();
                        } else if (response.term == 'woocommerceemail') {
                            woocommerceemailDataTableCall();
                        }
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });

        function deleteRow(parent) {
            parent.remove();
        }

    });

    $('.form-input-select').select2();

    $(".ela-nav-tab ul li a").on('click', function (e) {
        $('.ela-nav-tab ul li a').parent().removeClass('active');
        $(this).parent().addClass('active');
        var getIDfromAnchor = $(this).attr('href');
        //var makeDivmatchID = '#'+getIDfromAnchor;
        $('.elat-content-box').addClass('hide');
        $(getIDfromAnchor).removeClass('hide');
    });

    //elat-content-box
    function eleReloadWarn() {
        $(window).bind("beforeunload", function () {
            return confirm("Do you really want to refresh?");
        });
    }

    // Category Select JS
    $('.newsletter a').on('click', function () {
        console.log('newsletter click');
        $('#newsletter').trigger('click');
        $('.template_subject_general').removeClass('hide');
        $('.save_and_send_general').removeClass('hide');
        eleReloadWarn();
    });

    $('.welcomeemail a').on('click', function () {
        console.log('welcome click');
        $('#welcome-email').trigger('click');
        $('.template_subject_general').removeClass('hide');
        $('.save_and_send_general').removeClass('hide');
        eleReloadWarn();
    });

    $('.postnotification a').on('click', function () {
        console.log('post notification click');
        $('#post-notification').trigger('click');
        $('.template_subject_general').removeClass('hide');
        $('.save_and_send_general').removeClass('hide');
        eleReloadWarn();
    });

    $('.woocommerceemail a').on('click', function () {
        console.log('woocommerce email click');
        $('#woocommerce-email').trigger('click');
        $('.woocommerceemail-template-type').removeClass('hide');
        $('.woocommerceemail-where-apply').removeClass('hide');
        $('.woocommerceemail-product-select').removeClass('hide');
        $('.woocommerceemail-category-select').removeClass('hide');
        $('.save_and_send_general').addClass('hide');
        $('.save_and_send_wc_email').removeClass('hide');
        $('.template_subject_wc_email').removeClass('hide');
        $('.template_subject_wc_email_placeholders').removeClass('hide');
        $('.template_name_wc_email').removeClass('hide');
        $('.template_subject_general').addClass('hide');
        $('.template_name_general').addClass('hide');
        eleReloadWarn();
    });

    $('.template_subject_wc_email_placeholder').on('click', function (event) {
        event.preventDefault();
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val( $(this).html() ).select();
        document.execCommand("copy");
        $temp.remove();

        var template_subject = $("#template_subject");

        var cursorPos = template_subject.prop('selectionStart');
        var v = template_subject.val();
        var textBefore = v.substring(0,  cursorPos);
        var textAfter  = v.substring(cursorPos, v.length);

        template_subject.val(textBefore + $(this).html() + textAfter);
        
    });
    elemailer_hide_show_where_to_apply_box();
    $('.elemailer_wc_email_where_apply').on('change', function () {
        elemailer_show_hide_wc_email_where_apply( $(this).val() );
    });

    $('.elemailer_wc_email_type_field').on('change', function () {
        elemailer_show_wc_email_reciepient();
        elemailer_hide_show_where_to_apply_box();
    });

    function elemailer_show_wc_email_reciepient() {
        if ( $('.elemailer_wc_email_type_field').val() ) {
            var result = $('.elemailer_wc_email_type_field').val().split('-');
            if ( result[0] === 'admin' ) {
                $(".elemailer-email-recipient-html").html( '<b>Email recipient:</b> <i>Admin</i>' );
            } else {
                $(".elemailer-email-recipient-html").html( '<b>Email recipient:</b> <i>Customer</i>' );
            }
        }
    }

    function elemailer_hide_show_where_to_apply_box() {
        if ( $('.elemailer_wc_email_type_field').val() ) {
            var result = $('.elemailer_wc_email_type_field').val();
            if ( result === 'customer-new-account' || result === 'customer-reset-password' ) {
               $('.elemailer_wc_email_where_apply').val('global').trigger('change');;
               $('.woocommerceemail-where-apply ').addClass('hide-hardly');
            }else{
                $('.woocommerceemail-where-apply ').removeClass('hide-hardly');
            } 
        }
    }

    function elemailer_show_hide_wc_email_where_apply( type ) {
        console.log(type);
        if ( 'category' === type ) {
            $(".woocommerceemail-category-select").removeClass('hide-hardly');
            $(".woocommerceemail-product-select").addClass('hide-hardly');
        } else if ( 'product' === type ) {
            $(".woocommerceemail-category-select").addClass('hide-hardly');
            $(".woocommerceemail-product-select").removeClass('hide-hardly');
        } else {
            $(".woocommerceemail-category-select").addClass('hide-hardly');
            $(".woocommerceemail-product-select").addClass('hide-hardly');
        }
    }

    // Triggered After Clicked Mail Type
    $('.template-category-single a').on('click', function () {
        console.log('goto to template info section click');
        console.log(id);
        jumpToTemplateInfoSection();

    });

    // Triggered After Set Template Info
    $('.template-title-sub-wrapper .ele-btn').on('click', function (e) {
        e.preventDefault();
        console.log('goto to design section click');
        console.log(id);
        console.log('Ploader Added');


        var rquired_msg = '';
        var count = 0;
        $('input#template_name, input#template_subject').each(function () {
            if (!$(this).val()) {
                rquired_msg = 'Required fields are empty';
                $(this).css('border-color', '#f00');
                $('p.required-msg').css('display', 'block');
                count++;
            }
        });
        $('input#template_name, input#template_subject').change(function () {
            if ($(this).val()) {
                $(this).css('border-color', '#cdcdcd');
            }
        });
        console.log(count);
        if (count == 0) {
            elemailerCreateMailTemplate();

        }
        $('.required-msg').text(rquired_msg);


        $("iframe.elemailer-iframe").load(function () {
            //alert("Id changed"); 
            $('.iframeBeforeLoad').removeClass('iFrameLoading');
        });

    });




    // Check Designed Content Save or Not



    var eleDesignIframe = $('#eleDesignIframe');
    eleDesignIframe.on('load', function () {
        var iframeContents = $(this).contents();
        var saveElement = iframeContents.find('#elementor-panel-saver-button-publish');

        $('.tba-btn a.next').on('click', function () {
            $(saveElement).trigger("click");
            console.log('saved');
        });
    });


    // Triggered After Design Template
    $('.tba-btn a.next').on('click', function () {
        console.log('goto to mail send section click');
        console.log(id);


        jumpToSendMailSection();
        showScheduleOptionByEmailType();

    });

    // Prev To  Template Info
    $('.template-builder-area .prev').on('click', function () {
        console.log(id);
        jumpToTemplateInfoSection();
    });
    // Prev To Design 
    $('.tsa-btn .prev').on('click', function (e) {
        //e.preventDefault();
        console.log(id);
        jumpToTemplateDesignSection();
    });

    $('.tsa-btn .save_and_send').on('click', function (e) {
        $(window).off('beforeunload');
        e.preventDefault();
        console.log('save and send button click');

        var frquired_msg = '';
        var fcount = 0;
        $('select[required]').each(function () {
            var elWelcomeType = $('select[name="wm_event_of_send"]');
            if (!$(this).val() && elWelcomeType.val() != 'new-subscriber' && elWelcomeType.val() != 'new-wp-user') {
                frquired_msg = 'Required fields are empty';
                $(this).css('border-color', '#f00');
                $(this).siblings('.select2-container').addClass('emptyValue');
                $('p.required-msg').css('display', 'block');
                fcount++;
            }
        });
        $('select[required]').change(function () {
            if ($(this).val() && elWelcomeType.val() != 'new-subscriber' && elWelcomeType.val() != 'new-wp-user') {
                $(this).css('border-color', '#cdcdcd');
                $(this).siblings('.select2-container').removeClass('emptyValue');
            }
        });

        if (fcount == 0) {
            console.log('Saved');
            elemailerSaveMailTemplate('sent');
            $('.preloader').fadeIn('slow');
            var currentUrl = window.location.href;
            var tabId = $('.template-category-radio-btn input[type=radio]:checked').val();
            var redirect = currentUrl.replace(/&action=.*/, '&action=list');

            if (redirect) {
                window.location.href = redirect + '#' + tabId;
            }
        }
        $('.required-msg').text(frquired_msg);

    });

    $('.tsa-btn .save_for_later').on('click', function (e) {
        $(window).off('beforeunload');
        e.preventDefault();
        elemailerSaveMailTemplate('save');
        $('.preloader').fadeIn('slow');
        var currentUrl = window.location.href;
        var tabId = $('.template-category-radio-btn input[type=radio]:checked').val();
        var redirect = currentUrl.replace(/&action=.*/, '&action=list');

        if (redirect) {
            window.location.href = redirect + '#' + tabId;
        }
    });

    // Next To Template Name And Subject js
    function jumpToTemplateInfoSection() {
        $('.template-category-area').addClass('hide');
        $('.template-builder-area').addClass('hide');
        $('.template-send-area').addClass('hide');
        $('.template-title-sub-wrapper').removeClass('hide');

        if (!$('.template-title-sub-wrapper').hasClass("hide")) {
            $('.cmpb-step ul li').removeClass('active');
            $('.cmpb-step ul li:first-child').addClass('active');
            $('.cmpb-step ul li:nth-child(2)').addClass('active');
        }
    }



    // Next To Template Design js
    function jumpToTemplateDesignSection() {
        $('.template-title-sub-wrapper').addClass('hide');
        $('.template-category-area').addClass('hide');
        $('.template-send-area').addClass('hide');
        $('.template-builder-area').removeClass('hide');
        if (!$('.template-builder-area').hasClass("hide")) {
            $('.cmpb-step ul li').removeClass('active');
            $('.cmpb-step ul li:first-child').addClass('active');
            $('.cmpb-step ul li:nth-child(2)').addClass('active');
            $('.cmpb-step ul li:nth-child(3)').addClass('active');
        }
    }

    // Next To Template Send Option js
    function jumpToSendMailSection() {
        $('.template-title-sub-wrapper').addClass('hide');
        $('.template-category-area').addClass('hide');
        $('.template-builder-area').addClass('hide');
        $('.template-send-area').removeClass('hide');
        if (!$('.template-send-area').hasClass("hide")) {
            $('.cmpb-step ul li').removeClass('active');
            $('.cmpb-step ul li:first-child').addClass('active');
            $('.cmpb-step ul li:nth-child(2)').addClass('active');
            $('.cmpb-step ul li:nth-child(3)').addClass('active');
            $('.cmpb-step ul li:nth-child(4)').addClass('active');
        }
    }




    function elemailerCreateMailTemplate() {
        var form = $('.template-create-form'),
            data = form.serialize(),
            template_name = $('input[name="template_name"]').val(),
            template_subject = $('input[name="template_subject"]').val();

        id = form.data('id');

        if (template_name != '' && template_subject != '') {
            $.ajax({
                url: elemailer.restUrl + 'emails/update/' + id,
                type: 'POST',
                data: data,
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == 1) {
                        jumpToTemplateDesignSection();
                        let iframe = $('.elemailer-iframe');
                        let url = iframe.attr('src');
                        url = url.replace('[POST_ID]', response.data.id);
                        iframe.attr('data-id', response.data.id);
                        iframe.attr('src', url);
                        id = response.data.id;

                        $('.template-settings-update-form').data('id', id);

                    }
                    console.log(response);
                },
                error: function (response) {
                    console.log(response);
                }
            });
        } else {
            console.log('Empty field!');
        }


    }

    function elemailerSaveMailTemplate(action) {
        // var returnData;
        var form = $('.template-settings-update-form'),
            data = form.serialize();

        id = form.data('id');
        //console.log(data);
        let paramAdd = (elemailer.restUrl.indexOf('index.php?rest_route=') !== -1) ? '&status=' : '?status=';
        $.ajax({
            url: elemailer.restUrl + 'emails/settings_update/' + id + paramAdd + action,
            type: 'POST',
            data: data,
            headers: {
                'X-WP-Nonce': elemailer.nonce,
            },
            dataType: 'JSON',
            success: function (response) {
                console.log(response);
                if (response.status == 1) {
                    id = response.data.id;
                } else {
                    $('.preloader').fadeOut('slow');
                    console.log('Data Update Failed');
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    $('a').on('click', function (e) {
        var x = window.pageXOffset,
            y = window.pageYOffset;
        $(window).one('scroll', function () {
            window.scrollTo(x, y);
        })
    });

    // Flatpickr Js
    $(window).on('load', function () {
        $(".flatpickr").flatpickr();

        $(".eleFlatPickerTime").flatpickr(
            {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: false
            }
        );
        showScheduleOptionByEmailType();
    });



    // Schedule Check Js
    $('.schedule-check').on('click', function () {
        showScheduleOptionByEmailType();
    });

    function showScheduleOptionByEmailType() {

        if ($(".schedule-check").is(':checked')) {
            $('.condition-based-entry').removeClass('hide');
        } else {
            $('.condition-based-entry').addClass('hide');
        }

        if ($("#newsletter").is(':checked')) {
            $('.tsbc').addClass('hide');
            $('.tsb-newsletter').removeClass('hide');
        }

        if ($("#welcome-email").is(':checked')) {
            $('.tsbc').addClass('hide');
            $('.tsb-control.checkbox.schedule-it').hide();
            if ($('select[name="wm_event_of_send"]').val() != 'new-subscriber') {
                $('.tsb-control.select-list').hide();
            } else {
                $('.tsb-control.select-list').show();
            }
            $('.condition-based-entry').removeClass('hide');
            $('.tsb-welcomeEmail').removeClass('hide');
        }

        if ($("#post-notification").is(':checked')) {
            $('.tsbc').addClass('hide');
            $('.tsb-postnotification').removeClass('hide');
        }

        if ($("#woocommerce-email").is(':checked')) {
            $('.tsbc').addClass('hide');
            $('.tsb-control.checkbox.schedule-it').hide();
            $('.tsb-control.select-list').hide();
            $('.tsb-control.checkbox').hide();
        }
    }

    $('#field_event').on('change', function (e) {
        e.preventDefault();
        console.log('change');
        if ($(this).val() == 'new-wp-user') {
            $('.wm_user_type').removeClass('hide');
        } else {
            $('.wm_user_type').addClass('hide');
        }

        if ($(this).val() != 'new-subscriber') {
            $('.tsb-control.select-list').hide();
        } else {
            $('.tsb-control.select-list').show();
        }
    });

    // Check Email Data From Table Is sent or Not
    $(document).ajaxStop(function () {
        $('td.send-status').each(function () {
            var tdSentStatus = $(this).text();
            // if (tdSentStatus != 'draft' && tdSentStatus != 'publish' && (tdSentStatus != '')) {
            //     $(this).parent().addClass('tdsent');
            //     $(this).parent().parent().addClass('sent_done');   
            // }

            if(tdSentStatus==''){
                 $(this).parent().addClass('td-empty-status');
            }
            else if(tdSentStatus=='draft'){
                 $(this).parent().addClass('td-draft');
            }
            else if(tdSentStatus=='scheduled to send'){
                 $(this).parent().addClass('td-scheduled');
            } 
            else if(tdSentStatus=='scheduled to send'){
                 $(this).parent().addClass('td-scheduled');
            } 
            else if(tdSentStatus=='terminated'){
                 $(this).parent().addClass('td-terminated');
            }
            else if(tdSentStatus=='paused'){
                 $(this).parent().addClass('td-paused');
            }else if(tdSentStatus=='running'){
                 $(this).parent().addClass('td-running');
            }else{
                $(this).parent().addClass('tdsent');
                $(this).parent().parent().addClass('sent_done');   
            }
            
        });
    });

}(jQuery));