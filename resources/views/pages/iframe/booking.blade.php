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
    <div class="col-md-8 col-sm-12">
        <div class="row event-details">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        {{ __('iframe-events.booking-title') }} {{$event->eventDetailLanguage->title}}
                    </div>
                    <div class="card-body">

                        <form method="post" action="{{ route('add-booking', app()->getLocale()) }}" enctype="multipart/form-data">@csrf
                            <input type="hidden" name="event_id" value="{{$event['id']}}">

                            <div class="flex-row">
                                <h5 class="col-12 mb-1 mt-2 card-subtitle">{{ __('iframe-events.event-offer-title') }}</h5>
                            </div>
                            @if(count($event->eventSections) > 0)
                                <p class="mt-4">{{ __('iframe-events.booking-section-info') }}</p>
                            @endif
                            <div class="row">
                                <div class="col-sm-12">
                                    <hr class="divider">
                                    <input type="radio" name="event_section_id" value="" required hidden>
                                    @foreach($event->eventSections as $eventSection)
                                        @if($eventSection->is_visible === 1)
                                            <div class="row">
                                                <div class="col-xl-9 col-lg-8 col-md-7 col-sm-8 col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input mt-2" type="radio" name="event_section_id" id="event_section_radio_{{$eventSection->id}}" value="{{$eventSection->id}}" onclick="custom_price_button(this)" required @if($event->has_date && $booking_event_sections->contains($eventSection->id)) disabled @endif>

                                                            <table class="w-100">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="event_offer_title"><label class="form-check-label" for="event_section_radio_{{$eventSection->id}}"><strong>{{$eventSection->eventSectionDetailLanguage->title ??'(missing translation)'}}</strong></label></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="2">
                                                                        @if($event->has_date && $booking_event_sections->contains($eventSection->id))
                                                                            <div class="alert alert-warning text-small mb-0" role="alert"><strong>{{ __('iframe-events.booked-already') }}</strong></div>
                                                                        @else
                                                                            <span class="text-small">{{$eventSection->eventSectionDetailLanguage->description ??''}} &nbsp;</span>
                                                                        @endif
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                    </div>
                                                </div>
                                                @if($event->has_date && $booking_event_sections->contains($eventSection->id)) {{-- später noch einbauen: $eventSection->is_bookable === 1 --}}
                                                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-4 col-8">
                                                    </div>
                                                @else
                                                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-4 col-8">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <select class="form-control input-group-text currency" name="currency" onchange="currencyChange(this)">
                                                                    <option value="1">$</option>
                                                                    <option value="2">€</option>
                                                                </select>
                                                            </div>
                                                            <input disabled type="text" id="section_price_{{$eventSection->id}}_1" class="form-control event_input section_amount_{{$eventSection->id}} currency1" value="{{$eventSection->price_usd}}" aria-describedby="addon">
                                                            <input disabled type="text" id="section_price_{{$eventSection->id}}_2" class="form-control event_input section_amount_{{$eventSection->id}} currency2 d-none" value="{{$eventSection->price_euro}}" aria-describedby="addon">
                                                            <input disabled name="event_section_price" type="text" id="custom_price_{{$eventSection->id}}" class="form-control event_input custom_amount bg-white floatNumber d-none" value="" placeholder="enter here" pattern="[1-9]{1}[0-9]{0,5}" title="Please enter a valid number that has at least the value 1" aria-describedby="addon">

                                                            <div class="input-group-append">
                                                                <a class="form-control input-group-text custom-price-link" id="addon_{{$eventSection->id}}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" id="icon_{{$eventSection->id}}" color="lightgrey" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <hr class="divider">
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            @if($event->eventDetailLanguage->intro_booking) <p class="mt-4">{!! $event->eventDetailLanguage->intro_booking !!}</p> @endif

                            @if(count($event->eventSections) > 0)

                                @if($user->ashramData && $user->ashramData->attend_ie2011 == 1)
                                <h5 class="card-subtitle">{{ __('iframe-events.option-ie2011-title') }}:</h5>

                                <p>{{ __('iframe-events.option-ie2011-intro') }}</p>

                                <p>{{ __('iframe-events.option-ie2011-info') }}</p>

                                <p>{{ __('iframe-events.special-thanks') }}</p>
                                @else

                                <p>{{ __('iframe-events.custom-amount-intro') }}</p>

                                <p>{{ __('iframe-events.custom-amount-message') }}</p>
                                @endif

                                <h5 class="card-subtitle">{{ __('iframe-events.booking-message-title') }}</h5>
                                <p>{{ __('iframe-events.booking-message-text') }}</p>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <textarea class="form-control" id="booking_message" name="booking_message" rows="3"></textarea>
                                    </div>
                                </div>

                                @if($event->eventDetailLanguage->closing_booking) <p>{{$event->eventDetailLanguage->closing_booking}}</p> @endif


                            @endif

                            <div class="mt-5 mb-3">
                                @if(count($event->eventSections) > 0)
                                    <button class="btn btn-outline-primary" type="submit" >{{ __('iframe-events.button-confirm') }}</button>
                                @endif
                                <a class="btn btn-outline-dark mx-2" href="{{ route('iframe-details', ['language' => app()->getLocale(), 'id' => $event->id]) }}">{{ __('iframe-events.button-back') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="col-12">
                @isset($event->picture_link)
                    <div class="card mb-4">
                        <img class="card-img" src="{{$event->picture_link}}" alt="Card image">
                    </div>
                @endisset

                <div class="card mb-4">
                    <div class="card-body">
                        <table class="event-details-table-sidebar">
                            @if($event->has_date)
                                @if($event->start_date)
                                    <tr><td>{{ __('iframe-events.start-date') }}:</td><td>{{date("d M Y", strtotime($event->start_date))}} </td></tr>
                                    <tr><td>{{ __('iframe-events.end-date') }}:</td><td>{{date("d M Y", strtotime($event->end_date))}}</td></tr>
                                @else
                                    <tr><td>{{__('iframe-user-account.date')}}:</td><td>{{date("d M Y", strtotime($event->end_date))}}</td></tr>
                                @endif
                            @endif
                            <tr><td>{{ __('iframe-events.organizer') }}:</td><td>{{$event->organizer->organizer_name}}</td></tr>
                            <tr><td>{{ __('iframe-events.contact') }}:</td><td>{{$event->userInformation->first_name}} {{$event->userInformation->last_name}} </td></tr>
                            <tr><td>{{ __('iframe-events.location') }}:</td><td>{{$event->locationDetails->name}}{{$event->locationDetails->country ? ', ' . $event->locationDetails->country : ''}} </td></tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <pre>
    @php //print_r($event); @endphp
    </pre>

    <script>
        /* Change currency during booking process */
        function currencyChange(option) {
            var currencyValue = option.value;
            let currencySelect = $('select.currency');
            let eventInputFields = $('.event_input');
            //console.log(currencySelect);
            switch (currencyValue) {
                case '1':
                    eventInputFields.addClass('d-none');
                    eventInputFields.attr('disabled', 'disabled');
                    $('.currency1').removeClass('d-none');
                    $('select.currency').val('1');
                    break;
                case '2':
                    eventInputFields.addClass('d-none');
                    eventInputFields.attr('disabled', 'disabled');
                    $('.currency2').removeClass('d-none');
                    $('select.currency').val('2');
                    break;
                default:
                    eventInputFields.addClass('d-none');
                    eventInputFields.attr('disabled', 'disabled');
                    break;
            }
        }

        function custom_price_button(radio) {
            var checkboxValue = radio.value;
            var currenySelected = $('select.currency').val();
            let customPriceCurrency = $('#section_price_' + checkboxValue + '_' + currenySelected);
            let customPriceInput = $('#custom_price_' + checkboxValue);
            let sectionAmount = $('.section_amount_' + checkboxValue);
            //all icons will set at gray and the selected row will change to black
            $('.bi-pencil').css('color', 'lightgrey');
            $('#icon_' + checkboxValue).css('color', 'black');

            //all custom_price_links lost the click event and bg-color is gray and set disabled to all input fields
            $('.custom-price-link').off('click');
            $('.custom_offer_amount').removeClass('bg-white');
            $('.custom_offer_amount').addClass('bg-gray-300');
            $('.custom_offer_amount').attr('disabled', 'disabled');

            //custom input display none and selected currency display block
            customPriceCurrency.removeClass('d-none');
            customPriceInput.addClass('d-none');

            // the selected row get the event to enable the input field and bg-color is white
            $('#addon_' + checkboxValue).click(function (e) {
                sectionAmount.addClass('d-none');
                customPriceInput.removeAttr('disabled', 'disabled');
                customPriceInput.removeClass('d-none');
                customPriceInput.removeClass('bg-gray-300');
                customPriceInput.addClass('bg-white');
            })
            //console.log();
        }


    </script>

</div>
@endsection

