@extends('templates.default')

@section('content')
    <div class="container">
        <!-- Display validation errors if any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="row">
            <div class="col-12">
                <div class="card rounded mb-5">
                    <!-- Check if translation data exists -->
                    @if(!empty($translation))
                        <div class="card-header">
                            <div class="row">
                                <div class="col mr-auto">
                                    <h5 class="backend-title mt-2">Edit Translation :: {{$translation->key}}</h5>
                                </div>
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-md-12 p-0">
                                <div class="user-account-section p-0">
                                    <div class="tab-content p-0" id="myTabContent">
                                        <div class="tab-pane fade active show" id="translation-data-Form" role="tabpanel" aria-labelledby="translation-data-tab">
                                            <div class="card-body">
                                                <!-- Translation edit form -->
                                                <form id="edit-translation-form" class="enable-able-form" action="{{ route('translation-edit', ['id' => $translation->id, 'language' => app()->getLocale()]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" id="translation_id" name="translation_id" value="{{$translation->id}}">

                                                    <!-- Action buttons -->
                                                    <div class="button-bar">
                                                        <button type="button" class="btn btn-outline-danger delete-button mx-1" onclick="deleteTranslation({{ $translation->id }})">
                                                            Delete
                                                        </button>
                                                        <button disabled hidden type="submit" class="btn btn-outline-success submit-button mx-1">Save</button>
                                                        <button type="button" class="btn btn-outline-secondary edit-button mx-1">Edit</button>
                                                        <button onclick="window.location.href = '{{ route('translation-list', ['language' => app()->getLocale()]) }}';" type="button" class="btn btn-outline-dark mx-1">Back</button>
                                                    </div>

                                                    <!-- Display group and key fields (disabled) -->
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-4">
                                                            <label for="group">Group </label>
                                                            <input type="text" disabled id="group" name="group" class="form-control" value="{{$translation->group}}">
                                                        </div>
                                                        <div class="form-group col-lg-4">
                                                            <label for="key">Key </label>
                                                            <input type="text" disabled id="key" name="key" class="form-control" value="{{$translation->key}}">
                                                        </div>
                                                    </div>

                                                    <!-- Language-specific translation fields -->
                                                    <div class="form-row">
                                                        @foreach(['en' => 'English', 'de' => 'German', 'fr' => 'French', 'fi' => 'Finnish', 'jp' => 'Japanese', 'cz' => 'Czech'] as $code => $language)
                                                            <div class="form-group col-lg-4">
                                                                <label for="{{ $code }}">Text in {{ $language }}</label>
                                                                <textarea disabled id="{{ $code }}" name="text_{{ $code }}" class="form-control">{{$translation->text[$code] ?? ''}}</textarea>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label class="color-gray">* These fields are required</label>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <script>
        /**
         * Function to delete a translation entry.
         * Prompts the user for confirmation before sending a DELETE request.
         */
        function deleteTranslation(translationId) {
            if (!confirm("Are you sure you want to delete this translation?")) {
                return;
            }

            let deleteUrl = "{{ route('translation-delete', ['language' => app()->getLocale(), 'id' => '__ID__']) }}";
            deleteUrl = deleteUrl.replace('__ID__', translationId);

            fetch(deleteUrl, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Translation deleted successfully!");
                    window.location.href = data.redirect_url;
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error);
                alert("Something went wrong! Check console for details.");
            });
        }
    </script>
@endsection
