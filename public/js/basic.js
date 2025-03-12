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


    /* ######################################################## Enable Forms ######################################################## */
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
        formObject.find('input, select, textarea').each(function () {
            $(this).removeAttr('disabled');
        });

        tinymce.init({
        selector: 'textarea.edit_tinymce',
        menubar: false,
        plugins: "lists, link",
        toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | link | forecolor backcolor casechange permanentpen formatpainter | removeformat',
        statusbar: false,
        });

        formObject.find('div.show_tinymce').each(function () {
            $(this).addClass('d-none');
        });
        formObject.find('textarea.edit_tinymce').each(function () {
            $(this).removeClass('d-none');
        });
    }

    $(document).ready(function() {
        if($('textarea.add_tinymce')[0]) {
            tinymce.init({
                selector: 'textarea.add_tinymce',
                menubar: false,
                plugins: "lists, link",
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | link | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat',
                statusbar: false,
            });
        }
    });


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
            var introductionString = $(this).find('.introduction').text().toLowerCase();

            if (!titleString.includes(searchString) && !introductionString.includes(searchString)) {
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

            if (selectedCategories[0] !== '' && !categoryString.includes(selectedCategories)) {
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

} );

//integer value validation
$(function() {
    let input_nuber = $('input.floatNumber');
    input_nuber.on('input', function() {
    this.value = this.value.replace(/[^0-9\+\-]/g,'');
    });
});

// open and fill phone section
$(function() {
    let $dataPhoneNumber = $('.click-for-edit-phone');

    $dataPhoneNumber.on('click', function () {
        let $phoneData = jQuery.parseJSON($(this).attr('data-value'));
        let $section = $($(this).attr('data-target'));

        for (const[key, value] of Object.entries($phoneData)) {
            let $field = $section.find('#' + key);

            if($field.is('input') || $field.is('textarea')) {
                $field.val(value);
            }

            if($field.is('select')) {
                $field.val(value);
            }
        }
        $('#card_new_phone').collapse('show');
    });

    let $closePhoneSection = $('#close-phone-section');

    $closePhoneSection.on('click', function () {

        let $phoneSection = $('#card_new_phone')
        $phoneSection.collapse('hide');
        $phoneSection.find('input:not([type=hidden]), select:not([type=hidden])').val('');
    });

});

/* dataTables Settings */

$(document).ready(function() {

    /* ######################################################## Default List ######################################################## */
    var defaultTable = $('#default-list-table').DataTable({
        order: [[0, "asc"]],
        lengthMenu: [ [ 20, 50, 100, -1 ], [ 20, 50, 100, "All" ] ]
    });


    /* ######################################################## Default Desc List ######################################################## */

    var defaultDescTable = $('#default-desc-list-table').DataTable({
        order: [[0, "desc"]],
        lengthMenu: [ [ 20, 50, 100, -1 ], [ 20, 50, 100, "All" ] ]
    });


    /* ######################################################## Select List ######################################################## */
    var selectTable = $('#select-list-table').DataTable( {
        order: [[0, "asc"]],
        lengthMenu: [ [ 20, 50, 100, -1 ], [ 20, 50, 100, "All" ] ],
        initComplete: function () {
            this.api().columns([4, 5, 6, 7]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );





    /* ######################################################## User List ######################################################## */

    var userListTable = $('#user-list-table').DataTable({
        order: [[1, "asc"]],
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0],
            "responsive": true
        }],
        lengthMenu: [ [ 20, 50, 100, -1 ], [ 20, 50, 100, "All" ] ],
        initComplete: function () {
            this.api().columns('#select-filter-row').every( function () {
                var column = this;
                var select = $('<select><option value="">Select filter</option></select>')
                    .appendTo( $('#select-filter-table'))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? val : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    var val = $.fn.dataTable.util.escapeRegex(d);
                    if (column.search() === val ) {
                        select.append(
                            '<option value="' + d + '" selected="selected">' + d + "</option>"
                        );
                    } else {
                        select.append('<option value="' + d + '">' + d + "</option>");
                    }
                } );
            } );
        }
    });
    $('#user-list-table tbody').on('click', 'i.fa-chevron-circle-down', function () {
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
            "targets": [0]
        }],
        lengthMenu: [ [ 20, 50, 100, -1 ], [ 20, 50, 100, "All" ] ],
        initComplete: function () {
            this.api().columns('#select-filter-row').every( function () {
                var column = this;
                var select = $('<select><option value="">Select filter</option></select>')
                    .appendTo( $('#select-filter-table'))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? val : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    var val = $.fn.dataTable.util.escapeRegex(d);
                    if (column.search() === val ) {
                      select.append(
                        '<option value="' + d + '" selected="selected">' + d + "</option>"
                      );
                    } else {
                      select.append('<option value="' + d + '">' + d + "</option>");
                    }
                } );
            } );
		}
    });
    $('#location-list-table tbody').on('click', 'i.fa-chevron-circle-down', function () {
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
        order: [[6, "desc"]],
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0]
        }],
        lengthMenu: [ [ 20, 50, 100, -1 ], [ 20, 50, 100, "All" ] ],
        initComplete: function () {
            this.api().columns('#select-filter-row').every( function () {
                var column = this;
                var select = $('<select><option value="">Select filter</option></select>')
                    .appendTo( $('#select-filter-table'))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? val : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    var val = $.fn.dataTable.util.escapeRegex(d);
                    if (column.search() === val ) {
                      select.append(
                        '<option value="' + d + '" selected="selected">' + d + "</option>"
                      );
                    } else {
                      select.append('<option value="' + d + '">' + d + "</option>");
                    }
                } );
            } );
		}
    });
    $('#event-list-table tbody').on('click', 'i.fa-chevron-circle-down', function () {
        var tr = $(this).closest('tr');
        var row = eventListTable.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(row.data()[8]).show();
            tr.addClass('shown');
        }
    });



    /* ######################################################## Booking List ######################################################## */

    var bookingListTable = $('#booking-list-table').DataTable( {
        order: [[1, "desc"]],
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0, 6]
        }],
        lengthMenu: [ [ 20, 50, 100, -1 ], [ 20, 50, 100, "All" ] ],
        initComplete: function () {
            this.api().columns('.select-filter-row').every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );

    $('#booking-list-table tbody').on('click', 'i.fa-chevron-circle-down', function () {
        var tr = $(this).closest('tr');
        var row = bookingListTable.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(row.data()[8]).show();
            tr.addClass('shown');
        }
    });

    /* ######################################################## File List ######################################################## */

    var fileListTable = $('#file-list-table').DataTable({
        order: [[1, "asc"]],
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0]
        }],
        lengthMenu: [ [ 20, 50, 100, -1 ], [ 20, 50, 100, "All" ] ],
        initComplete: function () {
            this.api().columns('#select-filter-row').every( function () {
                var column = this;
                var select = $('<select><option value="">Select filter</option></select>')
                    .appendTo( $('#select-filter-table'))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? val : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    var val = $.fn.dataTable.util.escapeRegex(d);
                    if (column.search() === val ) {
                        select.append(
                            '<option value="' + d + '" selected="selected">' + d + "</option>"
                        );
                    } else {
                        select.append('<option value="' + d + '">' + d + "</option>");
                    }
                } );
            } );
        }
    });
    $('#file-list-table tbody').on('click', 'i.fa-chevron-circle-down', function () {
        var tr = $(this).closest('tr');
        var row = fileListTable.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(row.data()[4]).show();
            tr.addClass('shown');
        }
    });

	/* ######################################################## Timeline List ######################################################## */

    var timelineListTable = $('#timeline-list-table').DataTable({
        order: [[1, "asc"]],
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0]
        }],
        lengthMenu: [ [ 20, 50, 100, -1 ], [ 20, 50, 100, "All" ] ],
        initComplete: function () {
            this.api().columns('#select-filter-row').every( function () {
                var column = this;
                var select = $('<select><option value="">Select filter</option></select>')
                    .appendTo( $('#select-filter-table'))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search( val ? val : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    var val = $.fn.dataTable.util.escapeRegex(d);
                    if (column.search() === val ) {
                      select.append(
                        '<option value="' + d + '" selected="selected">' + d + "</option>"
                      );
                    } else {
                      select.append('<option value="' + d + '">' + d + "</option>");
                    }
                } );
            } );
		}
    });
    $('#timeline-list-table tbody').on('click', 'i.fa-chevron-circle-down', function () {
        var tr = $(this).closest('tr');
        var row = timelineListTable.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(row.data()[8]).show();
            tr.addClass('shown');
        }
    });

    /* ######################################################## Section List ######################################################## */
    $('#section-list-table').DataTable({
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": 0,
        }],
        "paging": false,
        "searching": false,
        "info": false
    });

});
