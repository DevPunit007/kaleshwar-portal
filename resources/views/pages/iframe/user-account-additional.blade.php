@extends('pages.iframe.user-account--frame')

@section('user-account')

<div class="col-md-9 user-account-section p-0">
    <div class="row m-0">

        @section('button')
            <div class="form-group mt-4">
                <button type="button" data-toggle="collapse" data-target="#card_new_phone" aria-expanded="false" aria-controls="card_new_phone" class="btn btn-outline-dark btn-header">{{ __('iframe-user-account.button-phone-number') }}</button>
            </div>
        @endsection

        @include('pages.user.form-partials.form-user-phone')

        <div class="col-lg-6 user-account-section p-0">
            <div class="card-body">
                <h6>{{ __('iframe-user-account.list-connected-groups') }}</h6>
                <ul class="list-group list-scroll">
                    @foreach($userOrganizers as $userOrganizer)
                        <li class="list-group-item bg-light">{{$userOrganizer->organizer->organizer_name ??''}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    /*
    //integer value validation
    $('input.floatNumber').on('input', function() {
        this.value = this.value.replace(/[^0-9\.\-]/g,'').replace(/(\..*)\./g, '$1');
    });

    // open and fill phone section
    $(function() {
        let $dataPhoneNumber = $('[data-value]');

        $dataPhoneNumber.on('click', function () {
            let $phoneData = jQuery.parseJSON($(this).attr('data-value'));
            let $section = $($(this).attr('data-target'));

            for (const[key, value] of Object.entries($phoneData)) {
                let $field = $section.find('#' + key);

                if($field.is('input') || $field.is('textarea')) {
                    $field.val(value);
                }

                if($field.is('select')) {
                    $field.val(value);
                }
            }
            $('#card_new_phone').collapse('show');
        });

        let $closePhoneSection = $('#close-phone-section');

        $closePhoneSection.on('click', function () {

            let $phoneSection = $('#card_new_phone')
            $phoneSection.collapse('hide');
            $phoneSection.find('input:not([type=hidden]), select:not([type=hidden])').val('');
        });

    });*/

</script>


@endsection
