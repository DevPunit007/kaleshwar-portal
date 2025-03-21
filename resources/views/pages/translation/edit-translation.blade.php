@extends('templates.default')

@section('content')
    <div class="container">

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
                                                <form id="edit-translation-form" class="enable-able-form" action="{{ route('translation-edit', ['id' => $translation->id, 'language' => app()->getLocale()]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" id="translation_id" name="translation_id" value="{{$translation->id}}">

                                                    <div class="button-bar">
                                                        <!-- <form action="{{ route('translation-delete', ['language' => app()->getLocale(), 'id' => $translation->id]) }}" method="get" style="display:inline;">
                                                            @csrf
                                                            <input type="hidden" id="translation_id" name="translation_id" value="{{$translation->id}}">
                                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                        </form> -->
                                                        <button type="button" class="btn btn-outline-danger delete-button mx-1" onclick="deleteTranslation({{ $translation->id }})">
                                                            Delete
                                                        </button>
                                                        <!-- <button type="button" class="btn btn-outline-danger edit-button mx-1">Delete</button> -->
                                                        <button disabled hidden type="submit" class="btn btn-outline-success submit-button mx-1">Save</button>
                                                        <button type="button" class="btn btn-outline-secondary edit-button mx-1">Edit</button>
                                                        <button onclick="window.location.href = '{{ route('translation-list', ['language' => app()->getLocale()]) }}';" type="button" class="btn btn-outline-dark mx-1">Back</button>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-lg-4">
                                                            <label for="group">Group </label>
                                                            <input type="text" disabled id="group" name="group" class="form-control" value="{{$translation->group}}">
                                                            @error('group')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>

                                                        <div class="form-group col-lg-4">
                                                            <label for="key">Key </label>
                                                            <input type="text" disabled id="key" name="key" class="form-control" value="{{$translation->key}}">
                                                            @error('key')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-lg-4">
                                                            <label for="en">Text in English</label>
                                                            <textarea disabled id="en" name="text_en" class="form-control">{{$translation->text['en'] ?? ''}}</textarea>
                                                            @error('en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>

                                                        <div class="form-group col-lg-4">
                                                            <label for="de">Text in German</label>
                                                            <textarea disabled id="de" name="text_de" class="form-control">{{$translation->text['de'] ?? ''}}</textarea>
                                                            @error('de')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>

                                                        <div class="form-group col-lg-4">
                                                            <label for="fr">Text in French</label>
                                                            <textarea disabled id="fr" name="text_fr" class="form-control">{{$translation->text['fr'] ?? ''}}</textarea>
                                                            @error('fr')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-lg-4">
                                                            <label for="fi">Text in Finnish</label>
                                                            <textarea disabled id="fi" name="text_fi" class="form-control">{{$translation->text['fi'] ?? ''}}</textarea>
                                                            @error('fi')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>

                                                        <div class="form-group col-lg-4">
                                                            <label for="jp">Text in Japanese</label>
                                                            <textarea disabled id="jp" name="text_jp" class="form-control">{{$translation->text['jp'] ?? ''}}</textarea>
                                                            @error('jp')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>

                                                        <div class="form-group col-lg-4">
                                                            <label for="cz">Text in Czech</label>
                                                            <textarea disabled id="cz" name="text_cz" class="form-control">{{$translation->text['cz'] ?? ''}}</textarea>
                                                            @error('cz')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                                        </div>
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
    function deleteTranslation(translationId) {
        if (!confirm("Are you sure you want to delete this translation?")) {
            return;
        }

        let deleteUrl = "{{ route('translation-delete', ['language' => app()->getLocale(), 'id' => '__ID__']) }}";
        deleteUrl = deleteUrl.replace('__ID__', translationId); // Replace placeholder with real ID

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
                window.location.href = data.redirect_url; // ✅ Redirect using the correct URL
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            alert("Something went wrong! Check console for details.");
        });
    }
</script>


@endsection
