/* ######################################################## Basis ######################################################## */

// init JS functionality that is expected to appear on most pages
// (meant for stuff like 'on hover' functionality for widely used css classes)
$(function () {
    // init jQuery UI datepicker
    var $datepicker = $(".datepicker");
    $datepicker.datepicker(); // on small screens, the navbar is hidden on the left side.
    // The menu toggle button is used to show and hide this menu.

    $('.menu-toggle').on('click', function (e) {
        e.preventDefault();
        $('.header-topnav').toggleClass('open');
    });


    // Logic to warn user that some data is unsaved when he edited values of a form
    $('#edit-event-form').on('change keyup keydown', 'input, textarea, select', function (e) {
        $('#edit-event-form').addClass('data-was-changed');
    });

    var formSubmitFlag = false;
    $('#edit-event-form').on('submit', function () {
        formSubmitFlag = true;
    });

    $(window).on('beforeunload', function () {
        if ($('form.data-was-changed').length) {
            if (!formSubmitFlag) {
                return 'Changes you made may not be saved.';
            }
        }
    });


    /* ######################################################## User Account ######################################################## */
    var $disabledFormsThatCanBeEnabled = $('.enable-able-form');
    $disabledFormsThatCanBeEnabled.each(function () {
        let $this = $(this);
        $this.find('.edit-button').click(function () {
            enableForm($this);
        });
    });

    function enableForm(formObject) {
        formObject.find('.edit-button').prop({
            'hidden': true,
            'disabled': true
        });
        formObject.find('.submit-button').removeAttr('hidden disabled');
        formObject.find('input, select').each(function () {
            $(this).removeAttr('disabled');
        });
    }


    /* ######################################################## Register ######################################################## */

    $('#register-page #add-phone-number-button').click(function () {
        $('#phone-number-inputs-container').append('<input name="phone[]" placeholder="Enter phone" class="form-control">');
    });




    /* ######################################################## Edit Event ######################################################## */

    $('.edit-event-view select#location-id').change(function () {
        console.log($(this).val()); // var $country = $(this).val();

        $.get('/get-rooms/' + $(this).val(), function (locationRooms) {
            console.log(locationRooms);

            if (locationRooms) {
                $('.edit-event-view select#room-id').empty();
                jQuery.each(locationRooms, function (i, room) {
                    console.log(room);
                    $('.edit-event-view select#room-id').append('<option value="' + room['id'] + '">' + room['name'] + '</option>');
                });
            } // if(countryStates) {
            //     $('#state-name').hide();
            //     // $('#state-select').disable();
            //     $('#state-select').empty();
            //     jQuery.each(countryStates, function(i, state){
            //         $('#state-select').append('<option value="' + state +'">' + state +'</option>');
            //     });
            //     $('#state-select').show();
            //     // $('#state-select').enable();
            // } else {
            //     $('#state-select').hide();
            //     $('#state-name').show();
            // }

        });
    });



    /* ######################################################## Location Select ######################################################## */

    $('#country-select').change(function () {
        console.log($(this).val()); // var $country = $(this).val();

        $.get('/get-states/' + $(this).val(), function (countryStates) {
            console.log(countryStates);

            if (countryStates) {
                $('#state-name').hide(); // $('#state-select').disable();

                $('#state-select').empty();
                jQuery.each(countryStates, function (i, state) {
                    $('#state-select').append('<option value="' + state + '">' + state + '</option>');
                });
                $('#state-select').show(); // $('#state-select').enable();
            } else {
                $('#state-select').hide();
                $('#state-name').show();
            }
        });
    });


    /* ######################################################## Start Iframe ######################################################## */

    $('.iframe-view input#title-subtitle-introduction-search ').on("keyup", function () {
        var searchString = $(this).val().toLowerCase();
        $('.event:not(.d-none), .event.disabled-by-search').each(function () {
            var titleString = $(this).find('.title').text().toLowerCase();
            var subtitleString = $(this).find('.subtitle').text().toLowerCase();
            var introductionString = $(this).find('.introduction').text().toLowerCase();

            if (!titleString.includes(searchString) && !subtitleString.includes(searchString) && !introductionString.includes(searchString)) {
                $(this).addClass('d-none disabled-by-search');
            } else {
                $(this).removeClass('d-none disabled-by-search');
            }
        });
    });
    $('.iframe-view select#category').on("change", function () {
        var selectedCategories = $(this).find('option:selected').map(function () {
            return $(this).text().toLowerCase();
        }).get();
        $('.event:not(.d-none), .event.disabled-by-category').each(function () {
            var categoryString = $(this).find('.event-category').text().toLowerCase();

            if (selectedCategories[0] !== '' && !selectedCategories.includes(categoryString)) {
                $(this).addClass('d-none disabled-by-category');
            } else {
                $(this).removeClass('d-none disabled-by-category');
            }
        });
    });

    /* ######################################################## Help Sticker ######################################################## */

    $('.customizer .handle').click(function () {
        $('.customizer').toggleClass('open');
    });

    /* ######################################################## Mega Menu ######################################################## */

    $('.mega-menu #newsletter-button').click(function () {
        var prompt = window.prompt("Please enter a valid e-mail address to test the newsletter functionality.");
        if (prompt != null) {
            $.get('/mail/send/all-events/' + prompt, function () {
                window.alert('Newsletter has been send to ' + prompt + '.');
            });
        }
    });




    /* dataTables Settings */


    /* ######################################################## Default List ######################################################## */

    var defaultTable = $('#default-list-table').DataTable({
        order: [[0, "asc"]]
    });


    /* ######################################################## User List ######################################################## */

    var userListTable = $('#user-list-table').DataTable({
        order: [[1, "asc"]],
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0, 5],
            "responsive": true
        }]
    });
    $('#user-list-table tbody').on('click', 'i.fa-id-card', function () {
        var tr = $(this).closest('tr');
        var row = userListTable.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(row.data()[6]).show();
            tr.addClass('shown');
        }
    });


    /* ######################################################## Location List ######################################################## */

    var locationListTable = $('#location-list-table').DataTable({
        order: [[1, "asc"]],
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0, 6]
        }]
    });
    $('#location-list-table tbody').on('click', 'i.fa-map-marked-alt', function () {
        var tr = $(this).closest('tr');
        var row = locationListTable.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(row.data()[7]).show();
            tr.addClass('shown');
        }
    });


    /* ######################################################## Event List ######################################################## */

    var eventListTable = $('#event-list-table').DataTable({
        order: [[1, "asc"]],
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0, 8]
        }]
    });
    $('#event-list-table tbody').on('click', 'i.fa-calendar', function () {
        var tr = $(this).closest('tr');
        var row = eventListTable.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(row.data()[9]).show();
            tr.addClass('shown');
        }
    });


    /* ######################################################## Booking List ######################################################## */

    $('#booking-list-table').DataTable({
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": 0
        }]
    });

});

