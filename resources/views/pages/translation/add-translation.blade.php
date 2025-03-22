@extends('templates.default')

@section('content')
<div class="container">
    <!-- Display validation errors, if any -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="card rounded mb-3">
        <form class="enable-able-form" method="post">
            @csrf

            <!-- Card Header: Title & Back Button -->
            <div class="card-header rounded-top">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="backend-title mt-2">Add Translation</h5>
                    </div>
                    <div class="col-auto">
                        <button onclick="window.location.href='{{ route('translation-list', app()->getLocale()) }}';" 
                                type="button" class="btn btn-outline-secondary">Back</button>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <!-- Group Input Field -->
                    <div class="col-lg-4 mb-3">
                        <label for="group">Group *</label>
                        <input required name="group" type="text" class="form-control" id="group" 
                               placeholder="Translation group" 
                               value="@if($translation){{$translation->group}}@else{{ old('group') }}@endif">
                    </div>

                    <!-- Key Input Field -->
                    <div class="col-lg-4 mb-3">
                        <label for="key">Key *</label>
                        <input required name="key" type="text" class="form-control" id="key" 
                               placeholder="Unique key (e.g., welcome_message)" 
                               value="@if($translation){{$translation->key}}@else{{ old('key') }}@endif">
                    </div>
                </div>

                <!-- Translation Fields for Multiple Languages -->
                <div class="row">
                    <!-- English Translation -->
                    <div class="col-lg-4 mb-3">
                        <label for="text_en">Text (English) </label>
                        <textarea name="text_en" class="form-control" id="text_en" 
                                  placeholder="Enter English translation">@if($translation){{$translation->text['en'] ?? ''}}@else{{ old('text_en') }}@endif</textarea>
                    </div>
                    <!-- Finnish Translation -->
                    <div class="col-lg-4 mb-3">
                        <label for="text_fi">Text (Finnish) </label>
                        <textarea name="text_fi" class="form-control" id="text_fi" 
                                  placeholder="Enter Finnish translation">@if($translation){{$translation->text['fi'] ?? ''}}@else{{ old('text_fi') }}@endif</textarea>
                    </div>
                    <!-- Japanese Translation -->
                    <div class="col-lg-4 mb-3">
                        <label for="text_jp">Text (Japanese) </label>
                        <textarea name="text_jp" class="form-control" id="text_jp" 
                                  placeholder="Enter Japanese translation">@if($translation){{$translation->text['jp'] ?? ''}}@else{{ old('text_jp') }}@endif</textarea>
                    </div>
                </div>

                <div class="row">
                    <!-- German Translation -->
                    <div class="col-lg-4 mb-3">
                        <label for="text_de">Text (German) </label>
                        <textarea name="text_de" class="form-control" id="text_de" 
                                  placeholder="Enter German translation">@if($translation){{$translation->text['de'] ?? ''}}@else{{ old('text_de') }}@endif</textarea>
                    </div>
                    <!-- Czech Translation -->
                    <div class="col-lg-4 mb-3">
                        <label for="text_cz">Text (Czech) </label>
                        <textarea name="text_cz" class="form-control" id="text_cz" 
                                  placeholder="Enter Czech translation">@if($translation){{$translation->text['cz'] ?? ''}}@else{{ old('text_cz') }}@endif</textarea>
                    </div>
                    <!-- French Translation -->
                    <div class="col-lg-4 mb-3">
                        <label for="text_fr">Text (French) </label>
                        <textarea name="text_fr" class="form-control" id="text_fr" 
                                  placeholder="Enter French translation">@if($translation){{$translation->text['fr'] ?? ''}}@else{{ old('text_fr') }}@endif</textarea>
                    </div>
                </div>

                <!-- Save & Edit Buttons -->
                <div class="form-group pt-4">
                    <div class="text-left">
                        <label class="text-muted">* Required fields</label> <br>
                        @if($translation)
                            <button type="button" class="btn btn-outline-dark edit-button">Edit</button>
                        @endif
                        <button @if($translation) disabled hidden @endif type="submit" class="btn btn-primary submit-button">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
