{{-- Form for the spirituel information in iframe.user account and user.edit in admin console --}}
<div class="table-responsive">

    <table class="table table-hover" id="no_booking-list-table" class="display">
        <thead>
            <tr>
                <th>{{ __('iframe-user-account.title') }}</th>
                <th>{{ __('iframe-user-account.type') }}</th>
                <th>{{ __('iframe-user-account.date') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($files as $key => $file_group)
            <tr><td class="bg-light text-center" colspan="3"><b>{{$key ??''}}</b></td></tr>
            @foreach($file_group as $file)
                <tr>
                    <td><a href="{{ route('iframe-user-file-show', ['language' => app()->getLocale(), 'id' => $file->id]) }}">
                            @if(strlen($file->title) > 55) {{ substr($file->title, 0, 55) }}... @else {{$file->title}} @endif
                        </a></td>
                    <td>{{$file->type ??''}}</td>
                    <td>{{date_format(date_create($file->created_at), 'd M Y H:i')}}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>



