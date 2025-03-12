
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
	<div class="card rounded mb-2">
		<form class="enable-able-form" method="post" @if($file) action="{{ route('edit-file', ['language' => app()->getLocale(), 'id' => $file->id]) }}" @else action="{{ route('add-file', app()->getLocale()) }}" @endif enctype="multipart/form-data">@csrf

		<div class="card-header rounded-top">
			<div class="row">
				<div class="col mr-auto">
					<h5 class="backend-title mt-2">@if($file) Edit @else Add @endif File Details in Media Center</h5>
				</div>
				<div class="col-auto text-right">
					@if($file)
					<button onclick="alert('Function Delete will come soon');" type="button" class="btn btn-outline-danger submit-button mx-1" disabled hidden>Delete</button>
					<button onclick="alert('Function Log will come soon');" type="button" class="btn btn-outline-secondary mx-1">Change log</button>
					@endif
					<button onclick="window.location.href='{{ route('file-list', app()->getLocale()) }}';" type="button" class="btn btn-outline-secondary mx-1">Back</a>
				</div>
			</div>
		</div>
		<div class="row">
        	<div class="col-lg-8 pr-0">
				<div class="card-body">
					<div class="form-row">
						<div class="form-group col-lg-8">
							<label for="title">Title *</label>
							<input required name="title" type="text" class="form-control" id="title" placeholder="Title for the content of the file" value="@if($file){{$file->title}}@else{{ old('content') }}@endif" @if($file) disabled @endif>
						</div>
						<div class="form-group col-lg-4">
							<label for="type">Type *</label>
							<select required name="type" id="type" class="form-control" @if($file) disabled @endif>
								<option value="" selected></option>
                                <option value="Document" @if($file && $file->type == 'Document') selected @endif>Document</option>
                                <option value="Picture" @if($file && $file->type == 'Picture') selected @endif>Picture</option>
                                <option value="Video" @if($file && $file->type == 'Video') selected @endif>Video</option>
                                <option value="Youtube" @if($file && $file->type == 'Youtube') selected @endif>Youtube</option>
                                <option value="Recording" @if($file && $file->type == 'Recording') selected @endif>Recording</option>
							</select>
						</div>
					</div>
					<div class="form-row">
                        <div class="form-group col-lg-8">
                            <label for="file_path">File name *</label>
                            <input required name="file_path" type="text" class="form-control" id="file_path" value="@if($file){{$file->file_path}}@else{{ old('file_path') }}@endif" @if($file) disabled @endif>
                        </div>
						<div class="form-group col-lg-4">
							<label for="file_name">Created at</label>
							<input name="file_name" type="text" class="form-control" id="file_name" value="@if($file){{$file->file_name}}@else{{ old('file_name') }}@endif" @if($file) disabled @endif>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-lg-6">
							<label for="file_extension">File Extension *</label>
							<input required name="file_extension" type="text" class="form-control" id="file_extension" value="@if($file){{$file->file_extension}}@else{{ old('file_extension') }}@endif" @if($file) disabled @endif>
						</div>
					</div>

                    <div class="form-group pb-0">
                        <label class="color-gray">* These fields are required</label>
                        @if($file)<button type="button" class="btn btn-outline-dark edit-button">Edit</button>@endif
                        <button @if($file) disabled hidden @endif type="submit" class="btn btn-primary submit-button">Save</button>
                    </div>

				</div>
			</div>
			<div class="col-lg-4 pl-0" style="border-left: 1px solid lightgray;">
				<div class="card-body">


				</div>
			</div>

		</form>

		</div>
	</div>
</div>

<pre>@php //print_r($file); @endphp </pre>

@endsection
