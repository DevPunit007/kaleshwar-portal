@extends('templates.default')

@section('content')
@include('pages.event.help-partials.list')
<!-- Bootstrap CSS (If not already included) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons for Better UI -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<!-- Bootstrap JS (Required for modal to work) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between py-2">
            <h5 class="backend-title mt-2">Translations</h5>
            <div class="d-flex align-items-center gap-2 flex-wrap mt-2 mb-2">
                @if (auth()->user()['rule_id'] > 3)
                    <!-- Import Form -->
                    <form action="{{ route('translation-import', app()->getLocale()) }}" method="POST" class="d-flex align-items-center gap-2" onsubmit="return validateImportForm()">
                        @csrf
                        <select class="form-select form-select-sm" name="language" id="languageSelectImport" style="width: 150px;">
                            <option value="" disabled selected>Language</option>
                            <option value="en">English</option>
                            <option value="de">German</option>
                            <option value="cz">Czech</option>
                            <option value="fi">Finnish</option>
                            <option value="fr">French</option>
                            <option value="jp">Japanese</option>
                        </select>
                        <button type="submit" class="btn btn-outline-dark btn-sm">Import</button>
                    </form>
                    <!-- Upload File Button -->
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadImportModal">
                        Upload File
                    </button>
                    <!-- Add Translation Button -->
                    <button onclick="window.location.href = '{{ route('translation-add', app()->getLocale()) }}';" type="button" class="btn btn-outline-success btn-sm">
                        Add Translation
                    </button>
                @endif
            </div>
        </div>
        <div class="card-body">
            <table id="translation-table" class="display">
                <thead>
                    <tr>
                        <th style="display: none;">ID</th> <!-- Hidden ID column -->
                        <th>Edit</th>
                        <th>Group</th>
                        <th>Key</th>
                        <th>Text (English)</th>
                        <th>Text (German)</th>
                        <th>Text (Czech)</th>
                        <th>Text (Finnish)</th>
                        <th>Text (French)</th>
                        <th>Text (Japanese)</th>
                    </tr>
                </thead>
                <tbody>
                @if($translations->isEmpty())
                    <tr>
                        <td colspan="10" class="text-center">No translations found.</td>
                    </tr>
                @else
                    @foreach($translations as $translation)
                        <tr data-id="{{ $translation->id }}" class="parent-row">
                            <td style="display: none;">{{ $translation->id }}</td>
                            <td class="nowrap table-icon">
                                <i class="fas fa-chevron-circle-down fa-lg mx-1 color-green op-7 toggle-row"></i>

                                <!-- <i class="fas fa-chevron-circle-down fa-lg mx-1 color-green op-7 toggle-row"></i> -->
                                <a href="{{ route('translation-edit', ['language' => app()->getLocale(), 'id' => $translation->id]) }}"><i class="fas fa-chevron-circle-right fa-lg mx-1 color-theme-dark op-7"></i></a>
                            </td> <!-- Keep ID for DataTables -->
                            <td>{{$translation->group ??''}}</td>
                            <td>{{$translation->key ??''}}</td>
                            <td>{{ Str::limit($translation->text['en'] ?? '', 10) }}</td>
                            <td>{{ Str::limit($translation->text['de'] ?? '', 10) }}</td>
                            <td>{{ Str::limit($translation->text['cz'] ?? '', 10) }}</td>
                            <td>{{ Str::limit($translation->text['fi'] ?? '', 10) }}</td>
                            <td>{{ Str::limit($translation->text['fr'] ?? '', 10) }}</td>
                            <td>{{ Str::limit($translation->text['jp'] ?? '', 10) }}</td>
                        </tr>
                        <tr class="details-row d-none" data-id="{{ $translation->id }}">
                            <td style="display: none;">{{ $translation->id }}</td> 
                            <td colspan="1"></td> 
                            <td colspan="1">{{$translation->group ?? ''}}</td>
                            <td colspan="1">{{$translation->key ?? ''}}</td>
                            <td colspan="1">{{ $translation->text['en'] ?? 'N/A' }}</td>
                            <td colspan="1">{{ $translation->text['de'] ?? 'N/A' }}</td>
                            <td colspan="1">{{ $translation->text['cz'] ?? 'N/A' }}</td>
                            <td colspan="1">{{ $translation->text['fi'] ?? 'N/A' }}</td>
                            <td colspan="1">{{ $translation->text['fr'] ?? 'N/A' }}</td>
                            <td colspan="1">{{ $translation->text['jp'] ?? 'N/A' }}</td>
                        </tr>

                    @endforeach
                @endif
                </tbody>
            </table>
            <!-- Upload & Import Modal -->
            @include('partials.uploadmodal')
        </div>
           
        <script>
            $(document).ready(function() {
                let table = $('#translation-table').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "lengthMenu": [10, 25, 50, 100],
                    "pageLength": 25,
                    "columnDefs": [
                        { "targets": 0, "visible": false }, // Hide the first (ID) column
                        { "orderable": false, "targets": 1 } // Disable sorting on 'Edit' column
                    ]
                });

                // Ensure search works dynamically
                $('#translation-table_filter input').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });

        </script>
        <!-- JavaScript for Validation -->
        <script>
            function validateImportForm() {
                let language = document.getElementById("languageSelect").value;
                if (!language) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Please select a language before importing!',
                    });
                    return false; // Prevent form submission
                }
                return true; // Allow form submission
            }
        </script>      
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".toggle-row").forEach(button => {
                    button.addEventListener("click", function() {
                        let parentRow = this.closest("tr");
                        let detailsRow = parentRow.nextElementSibling;

                        if (detailsRow.classList.contains("d-none")) {
                            detailsRow.classList.remove("d-none"); // Show row
                            this.classList.remove("fa-chevron-circle-down");
                            this.classList.add("fa-chevron-circle-up"); // Change icon
                        } else {
                            detailsRow.classList.add("d-none"); // Hide row
                            this.classList.remove("fa-chevron-circle-up");
                            this.classList.add("fa-chevron-circle-down"); // Reset icon
                        }
                    });
                });
            });
        </script>
    </div>
</div>
@endsection