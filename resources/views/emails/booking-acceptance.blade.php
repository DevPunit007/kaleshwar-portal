@extends('emails.templates.default')

@section('content')

    <h2>Hello {{$user->first_name}} {{$user->last_name}},</h2>
    <p>we are very happy to confirm your stay at the ashram for the following event:</p>

    <table class="panel" width="90%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td class="panel-content">
                <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="panel-item">
                            <table class="table">
                                <tr>
                                    <td colspan="2"><strong>{{$eventDetail->title}}</strong></td>
                                </tr><tr>
                                    <td>Selection:</td><td>{{$booking->EventSectionDetailLanguage->title ??'(missing translation)'}}</td>
                                </tr><tr>
                                    <td>Ticket:</td><td>{{$booking->id}}</td>
                                </tr><tr>
                                    <td>Your arrival:</td><td>{{$booking->bookingDetail ? date_format(date_create($booking->bookingDetail->arrival_ashram), "d M Y") : ''}}</td>
                                </tr><tr>
                                    <td>Your departure:</td><td>{{$booking->bookingDetail ? date_format(date_create($booking->bookingDetail->departure_ashram), "d M Y") : ''}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p>
        Once your travel details are clear, please send us an email with your travel information, so airport pick up or transport from Bangalore can be arranged.
        We will provide you with all necessary information then.
    </p>
    @if(empty($eventDetail->after_booking))
        <p>You’ll receive further information about the programm before it starts.</p>
    @else
        <p>{!! $eventDetail->after_booking !!}</p>
    @endif

    <h2>
        We’d like to share the following information about your stay in the Ashram:
    </h2>
    <p>
        <strong>Rooms:</strong> There will be a bedsheet, pillow and pillow cover in your room. Please bring your own towels and a blanket for covering if you need. Please note the Ashram is not set-up like a hotel. There is a small shop at the ashram were essentials like toiletries, water, soft drinks, snacks, towels, blankets, meditation cushions, … can be purchased.
    </p>
    <p>
        <strong>Meals:</strong> Indian vegetarian Breakfast, Lunch and Dinner are served daily.
        Please inform us if you have certain food allergies so our cook can take care of this in advance.
    </p>
    <p>
        <strong>Clothing:</strong> To keep the energy up and high there is a certain dress code. Students wear white Punjabi’s/Kurtas, these are long trousers, white Punjabi dress (knee length with sleeves, women wear a scarf in addition).
        Punjabis can be either tailor made (takes minimum 2 days) or you purchase them in advance, before coming to the ashram. There will be a small stock in the shop, but large western sizes are difficult to get ready-made in India.
        During fire pujas men wear lunghis (long, sheet style cloths worn like a skirt), women can wear Punjabis or Saris in the red color scheme.
    </p>
    <p>
        When arriving or departing from the Ashram you should wear modest western clothes or the traditional Indian dresses. Please do not wear shorts or sleeveless tops. This applies to both men and women. Women should not wear short skirts or any see-through tops.
        Thank you for respecting the Indian traditional culture.
    </p>
    <p>
        <strong>Finances:</strong> The Guru Purnima program fee is: € 405 / $ 427.<br>
        The night before and after the program is included in the price.
        The fee for additional days is INR 1500 per person and night (this covers your sleeping accomodation, breakfast, lunch and dinner - indian vegetarian meals).
        If you should be planning to create a power spot during the program the fees are € 108 / $ 115.
    </p>
    <p>
        <strong>Please bring all the money in cash</strong> (either in €, $ or Indian Rupees).<br>
        You will also need personal money to pay for your transportation to and from the Ashram, and for personal items such as bottled water, snacks, items from the bookstore, dhobi (laundry man), … Those small purchases at the ashram (shop, dhobi, tailor,…) can only be made in INR.
    </p>
    <p>
        <strong>Health:</strong> When traveling anywhere, there is always a chance you will need medicine for conditions, such as, diarrhea or fever.
        Please remember to take all your medicines with you when you pack. There are doctors available at the ashram if you get sick.
    </p>
    <p>
        Please get in touch if you have any further questions.
    </p>
    <p>
        We look forward to seeing you soon and celebrating Guru Purnima with you.
    </p>
    <p>
        Much love and warm greetings,<br>
        Shilpa & Ashram family
    </p>
    <table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td>
                {{--General information by the ashram --}}
            </td>
        </tr>
    </table>
@endsection
