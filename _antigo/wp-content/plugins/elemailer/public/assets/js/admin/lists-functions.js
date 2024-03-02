(function ($) {
    "use strict"
    console.log('list function js loaded.');

    $(window).load(function () {
        $('.preloader').fadeOut('slow');
    });

    $(window).on('load', function () {
        var type = 'all';
        var elAll = $('#eleListAll ');
        var elTrash = $('#eleListTrash ');

        var listDatatable;
        var allListData = elemailer.restUrl + 'lists/get_all_list/get';
        var trashListData = elemailer.restUrl + 'lists/get_trash_list/get';

        //Custom Markups For Action Buttons
        var all_data_btn = '<span class="action_links"><ul>';
        all_data_btn += '<li class="listEdit_li"><a href="#" class="listEdit" title="Edit">Edit</a> | </li>';
        all_data_btn += '<li class="listMoveToTrash_li"><a href="#" class="listMoveToTrash" title="Trash">Trash</a></li> | ';
        all_data_btn += '<li class="listViewSubscribers_li"><a href="#" class="listView subscribed_select_btn" title="View Subscribers">View Subscribers</a></li>';
        all_data_btn += '</ul></span>';

        var trash_data_btn = '<span class="action_links"><ul>';
        trash_data_btn += '<li class="listRestore_li"><a href="#" class="listRestore" title="Restore">Restore</a> | </li>';
        trash_data_btn += '<li class="listPermanentremove_li"><a href="#" class="listPermanentremove" title="Delete">Delete</a></li>';
        trash_data_btn += '</ul></span>';

        function runListDataTable(type) {
            var markups = (type == 'all') ? all_data_btn : trash_data_btn;
            listDatatable = $('#list_dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [ 0, 'desc' ],
                "ajax": {
                    "url": (type == 'all') ? allListData : trashListData,
                    "type": "GET",
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
                        data: "name",
                        className: "title-class has_action_options",
                        render: function (data, type, row) {
                            return '<span class="name-text">' + data + '</span>' + markups;
                        }
                    },
                    { data: "type",

                        render: function (data, type, row) {
                            if(data=='default'){
                                return 'Public';
                            }else if(data == 'private'){
                                return 'Private';
                            }else{
                                return 'Not visible! Update!';
                            }
                        }

                    },
                    { data: "description" },
                    { data: "subscribed",orderable: false,},  
                    { data: "unsubscribed",orderable: false,  },  
                    { data: "total" },  
                    {
                        data: 'created_at',
                        className: "post_date",
                        render: function (data, type, row) {
                            var dataWIthSpace = data;
                            var post_date_data = dataWIthSpace.replace(/ /g, "<br>");
                            return post_date_data;
                        }

                    }, 
                ],
                "initComplete": function (settings, json) {
                    if (type == 'all') {
                        elAll.children().text(json.recordsTotal);
                        elTrash.removeClass('active-type');
                        elAll.addClass('active-type');
                    } else {
                        elTrash.children().text(json.recordsTotal);
                        elAll.removeClass('active-type');
                        elTrash.addClass('active-type');
                    }
                }
            });
        }

        runListDataTable(type);

        elAll.on('click', function () {
            $('#list_dataTable').removeClass('trashListData');
            type = 'all';
            listDatatable.destroy();
            runListDataTable(type);
        });

        elTrash.on('click', function () {
            $('#list_dataTable').addClass('trashListData');
            type = 'trash';
            listDatatable.destroy();
            runListDataTable(type);
        });

        // Edit a record
        $('#list_dataTable').on('click', 'a.listEdit', function (e) {
            e.preventDefault();
            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            var currentUrl = window.location.href;
            var redirect = currentUrl.replace(/\?page=.*/, '?page=elemailer-lists&action=create&list_id=' + id);
            if (redirect) {
                window.location.href = redirect;
            }

        });

        $('#list_dataTable').on('click', 'a.subscribed_select_btn', function (e) {
            e.preventDefault();
            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            var currentUrl = window.location.href;
            var redirect = currentUrl.replace(/\?page=.*/, '?page=elemailer-subscribers&list_id=' + id);
            if (redirect) {
                window.location.href = redirect;
            }

        });

        // Move to published a record
        $('#list_dataTable').on('click', 'a.listRestore', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            $.ajax({
                url: elemailer.restUrl + 'lists/change_status/' + id + '?status=published',
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
                        listDatatable.destroy();
                        runListDataTable(type);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });

        // Trash a record
        $('#list_dataTable').on('click', 'a.listMoveToTrash', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            $.ajax({
                url: elemailer.restUrl + 'lists/change_status/' + id + '?status=trash',
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
                        listDatatable.destroy();
                        runListDataTable(type);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });

        // Delete a record
        $('#list_dataTable').on('click', 'a.listPermanentremove', function (e) {
            e.preventDefault();

            var parent = $(this).parents('tr'),
                id = parent.children('td:first-child').find('input').val();

            $.ajax({
                url: elemailer.restUrl + 'lists/delete/' + id,
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
                        listDatatable.destroy();
                        runListDataTable(type);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });

        // Save new lists
        var buttonSave = $('.save-list'),
            form = $('.create-list-form'),
            id = form.data('id');

        buttonSave.on('click', function (e) {
            e.preventDefault();
            var rquired_msg = '';
            var count = 0;
            $('input[required], select[required]').each(function () {
                if (!$(this).val()) {
                    rquired_msg = 'Required fields are empty';
                    $(this).css('border-color', '#f00');
                    $('p.required-msg').css('display', 'block');
                    count++;
                }
            });

            $('input[required], select[required]').change(function () {
                if ($(this).val()) {
                    $(this).css('border-color', '#cdcdcd');

                }
            });

            if (count == 0) {
                form.trigger('submit');
            }

            $('.required-msg').text(rquired_msg);
        });

        form.on('submit', function (e) {
            e.preventDefault();
            var data = form.serialize();
            console.log(elemailer.restUrl);

            $.ajax({
                url: elemailer.restUrl + 'lists/update/' + id,
                type: 'POST',
                data: data,
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == 1) {
                        window.location.href = response.redirect_url;

                        $('.preloader').fadeIn('slow');
                    } else {
                        console.log(response);
                        alert(response.error);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });

        })

        function deleteRow(parent) {
            parent.remove();
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

        $('.elelist_dataTable').on('click', 'input.eleDataCheckBox', function () {
            if ($('.allEleList.active-type').length > 0) {
                if ($('.eleDataCheckBox').is(':checked')) {
                    $('.moveTrashSelected').removeClass('hide');
                } else {
                    $('.moveTrashSelected').addClass('hide');
                }
            }

            if ($('.trashNav.active-type').length > 0) {
                if ($('.eleDataCheckBox').is(':checked')) {
                    $('.deleteSelected').removeClass('hide');
                    $('.moveToPublishedSelected').removeClass('hide');
                } else {
                    $('.deleteSelected').addClass('hide');
                    $('.moveToPublishedSelected').addClass('hide');
                }
            }
        });

        // Select And Deselect All on All Check click 
        $('input.allCheckBtn').on('click', function () {
            if ($(this).is(':checked')) {
                //Check Footer Checkbox
                $('input.allCheckBtn').prop('checked', true);
                //Check Unheck All List 
                $('input.eleDataCheckBox').prop('checked', true);
            }
            if ($(this).is(":not(:checked)")) {
                $('input.allCheckBtn').prop('checked', false);
                $('input.eleDataCheckBox').prop('checked', false);;
            }

            if ($('.allEleList.active-type').length > 0) {
                if ($('.eleDataCheckBox').is(':checked')) {
                    $('.moveTrashSelected').removeClass('hide');
                } else {
                    $('.moveTrashSelected').addClass('hide');
                }
            }
            if ($('.trashNav.active-type').length > 0) {
                if ($('.eleDataCheckBox').is(':checked')) {
                    $('.deleteSelected').removeClass('hide');
                    $('.moveToPublishedSelected').removeClass('hide');
                } else {
                    $('.deleteSelected').addClass('hide');
                    $('.moveToPublishedSelected').addClass('hide');
                }
            }
        });

        //Select Checked values from the table    
        $('.elelist_dataTable').on('click', 'input[name="action_ids"]', function () {
            var totalCountOfCheckbox = $('input[name="action_ids"]').length;
            var totalChecked = $('input[name="action_ids"]:checked').length;
            if (totalCountOfCheckbox == totalChecked) {

                $('input[name="allCheckBtn"]').prop('checked', true);
                $('.check_all_footer .allCheckBtn').prop('checked', true);
            } else {
                $('input[name="allCheckBtn"]').prop('checked', false);
                $('.check_all_footer .allCheckBtn').prop('checked', false);
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
                url: elemailer.restUrl + 'lists/change_status_multiple/trash',
                type: 'POST',
                data: { selected: eleDataCheckedValues },
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == 1) {
                        listDatatable.destroy();
                        runListDataTable(type);
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
                url: elemailer.restUrl + 'lists/change_status_multiple/published',
                type: 'POST',
                data: { selected: eleDataCheckedValues },
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == 1) {
                        listDatatable.destroy();
                        runListDataTable(type);
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
                url: elemailer.restUrl + 'lists/change_status_multiple/delete',
                type: 'POST',
                data: { selected: eleDataCheckedValues },
                headers: {
                    'X-WP-Nonce': elemailer.nonce,
                },
                dataType: 'JSON',
                success: function (response) {
                    if (response.status == 1) {
                        listDatatable.destroy();
                        runListDataTable(type);
                    } else {
                        console.log(response.error);
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });

        });

    });

})(jQuery);