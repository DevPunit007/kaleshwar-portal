
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