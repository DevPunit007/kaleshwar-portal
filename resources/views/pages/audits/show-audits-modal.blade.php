<div class="modal-header">
    <h5 class="modal-title">Reports</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @foreach($audits as $audit)
        <div class="d-flex flex-row pb-5">
        @foreach($audit as $fieldName => $field)
            <div class="px-2" style="flex: 1 1 auto;">
                <div class="font-weight-bold">{{$fieldName}}</div>
            @if(is_array($field))
                @foreach($field as $fieldVaule)
                    {{$fieldVaule}}
                @endforeach
            @else
                {{$field}}
            @endif

            </div>
        @endforeach
        </div>
    @endforeach
</div>





