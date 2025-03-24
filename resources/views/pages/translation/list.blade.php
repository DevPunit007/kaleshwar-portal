@extends('templates.default')

@section('content')
@include('pages.event.help-partials.list')

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
            <div class="modal fade" id="uploadImportModal" tabindex="-1" aria-labelledby="uploadImportModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-light border-0 shadow-sm">
                        <div class="modal-header bg-dark text-white" style="background-color: rgb(129 135 141) !important;">
                            <h5 class="modal-title" id="uploadImportModalLabel">Manage Translation Files</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <!-- Download Section -->
                            <div class="mb-4">
                                <h5 class="text-secondary mb-3"><i class="bi bi-download"></i> Download Translation File</h5>
                                <form action="{{ route('translation-download', app()->getLocale()) }}" method="GET">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="languageSelectDownload" class="form-label fw-semibold">Select Language</label>
                                            <select class="form-select border-dark" name="language" id="languageSelectDownload" required>
                                                <option value="" disabled selected>Select Language</option>
                                                <option value="en">English</option>
                                                <option value="de">German</option>
                                                <option value="cz">Czech</option>
                                                <option value="fi">Finnish</option>
                                                <option value="fr">French</option>
                                                <option value="jp">Japanese</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="groupSelectDownload" class="form-label fw-semibold">Select File</label>
                                            <select class="form-select border-dark" name="group" id="groupSelectDownload" required>
                                                <option value="" disabled selected>Select File</option>
                                                @foreach($groups as $group)
                                                    <option value="{{ $group }}">{{ ucfirst(str_replace('-', ' ', $group)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button type="submit" class="btn btn-outline-dark"><i class="bi bi-cloud-download"></i> Download</button>
                                    </div>
                                </form>
                            </div>
                            <hr class="my-4"> <!-- Gray separator -->
                            <!-- Upload & Import Section -->
                            <h5 class="text-secondary mb-3"><i class="bi bi-upload"></i> Upload & Import Translation File</h5>
                            <form id="uploadImportForm" action="{{ route('translations-upload-import', app()->getLocale()) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="languageSelectUploadImport" class="form-label fw-semibold">Select Language</label>
                                        <select class="form-select border-dark" name="language" id="languageSelectUploadImport" required>
                                            <option value="" disabled selected>Select Language</option>
                                            <option value="en">English</option>
                                            <option value="de">German</option>
                                            <option value="cz">Czech</option>
                                            <option value="fi">Finnish</option>
                                            <option value="fr">French</option>
                                            <option value="jp">Japanese</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fileUploadImport" class="form-label fw-semibold">Upload File (Optional)</label>
                                        <input type="file" class="form-control border-dark" name="file" id="fileUploadImport">
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-dark"><i class="bi bi-cloud-upload"></i> Upload & Import</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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