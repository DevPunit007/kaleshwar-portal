@extends('templates.default')

@section('content')
@include('pages.event.help-partials.list')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col mr-auto">
                    <h5 class="backend-title mt-2">Media Center</h5>
                </div>
                <div class="col-auto text-right">
                    <span id="select-filter-table"></span>
                    @if (auth()->user()['rule_id'] > 3)
                    <button onclick="window.location.href = '{{ route('file-add', app()->getLocale()) }}';" type="button" class="btn btn-outline-success btn-header">Add Link</button>
                        @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="group-table" class="display">
                <thead>
                <tr>
                    <th style="width: 40px;"></th>
                    <th>Event</th>
                    <th id="select-filter-row">Type</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th style="display: none;"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $file)
                    <tr>
                        <td class="details-control nowrap table-icon">
                            <i class="fas fa-chevron-circle-down fa-lg mx-1 color-green op-7"></i>
                            <a href="{{ route('file-show', ['language' => app()->getLocale(), 'id' => $file->id]) }}">
                                <i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i>
                            </a>
                        </td>

                        <td>Mother Divine 2020</td>
                        <td>{{$file->type ??''}}</td>
                        <td>{{$file->title ??''}}</td>
                        <td>{{$file->file_name ??''}}</td>
                        <td style="display: none;">
                            <table>
                                <tr><th>File name</th><td>{{$file->file_path ??''}}</td></tr>
                                <tr><th>Format</th><td>{{$file->file_extension ??''}}</td></tr>
                            </table>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                var groupColumn = 1;
                var table = $('#group-table').DataTable({

                    "columnDefs": [
                        { "visible": false, "targets": groupColumn },
                        { "orderable": false, "targets": [0] }
                    ],
                    "order": [[ groupColumn, 'asc' ]],
                    "displayLength": 25,
                    "drawCallback": function ( settings ) {
                        var api = this.api();
                        var rows = api.rows( {page:'current'} ).nodes();
                        var last=null;

                        api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                            if ( last !== group ) {
                                $(rows).eq( i ).before(
                                    '<tr class="group"><td colspan="4">'+group+'</td></tr>'
                                );

                                last = group;
                            }
                        } );
                    },
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
                } );

                // Order by the grouping
                $('#group-table tbody').on( 'click', 'tr.group', function () {
                    var currentOrder = table.order()[2];
                    if ( currentOrder[2] === groupColumn && currentOrder[3] === 'asc' ) {
                        table.order( [ groupColumn, 'desc' ] ).draw();
                    }
                    else {
                        table.order( [ groupColumn, 'asc' ] ).draw();
                    }
                } );
                $('#group-table tbody').on('click', 'i.fa-chevron-circle-down', function () {
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);

                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        // Open this row
                        row.child(row.data()[5]).show();
                        tr.addClass('shown');
                    }
                });
            } );
        </script>
    </div>
</div>
@endsection
