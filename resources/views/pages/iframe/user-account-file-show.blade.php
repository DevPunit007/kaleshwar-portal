@extends('templates.iframe')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="row iframe-view">
    <div class="col-12">
        <div class="card rounded mb-2">
            <div class="card-header rounded-top">
                <div class="row">
                    <div class="col mr-auto">
                        <h5 class="backend-title mt-2">{{$file->title ??''}}</h5>
                    </div>
                    <div class="col-auto text-right">
                        <button onclick="window.location.href='{{ route('iframe-user-files', app()->getLocale()) }}';" type="button" class="btn btn-outline-primary mx-1">Back</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <style>
                            #frame {
                                border: 2px solid #ccc;
                            }
                        </style>
                        @if($file)
                            @switch($file->type)
                                @case('Document')
                                <iframe src="https://shirdi-sai-global-trust.org/videos/{{$file->file_path ??''}}" name="iframe" id="iframe" scrolling="no" height="768px" width="100%">
                                </iframe>
                                @break
                                @case('Video')
                                <video id="frame" src="https://shirdi-sai-global-trust.org/videos/{{$file->file_path ??''}}" width="100%" height="auto"
                                       allowfullscreen="allowfullscreen" autoplay controls controlsList="nodownload"><div>Your browser not support HTML5</div>
                                </video>
                                @break
                                @case('Recording')
                                <video id="frame" src="https://shirdi-sai-global-trust.org/videos/{{$file->file_path ??''}}" width="100%" height="auto"
                                       allowfullscreen="allowfullscreen" autoplay controls controlsList="nodownload fullscreen"><div>Your browser not support HTML5</div>
                                </video>
                                @break
                                @case('Picture')
                                <picture>
                                      <img id="frame" src="https://shirdi-sai-global-trust.org/videos/{{$file->file_path ??''}}" alt="Picture" style="width:auto;">
                                </picture>
                                @break
                                @case('Youtube')
                                <div id="frame">
                                    <iframe width="100%" height="768" src="https://www.youtube.com/embed/{{$file->file_path ??''}}" frameborder="0" allowfullscreen="allowfullscreen" allow="accelerometer; autoplay; encrypted-media; gyroscope"></iframe>
                                </div>
                                @break
                            @endswitch
                        @else
                            <div class="alert alert-warning">Selected file could not found.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // $video contains a reference to the video tag

    // disable browser context menu on video
    $('#frame').on('contextmenu', function(e) {
        e.preventDefault();
    });
</script>

@endsection
