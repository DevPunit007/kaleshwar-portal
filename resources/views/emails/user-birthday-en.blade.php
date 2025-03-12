@extends('emails.templates.default')

@section('content')

    <h2>Dear {{$user->first_name}} {{$user->last_name}},</h2>

    <p>on your special day we are thinking of you and sending you many heartfelt wishes and blessings from your soul home.</p>

    <img src="https://portal.srikaleshwar.world/images/birthday-message.jpg" class="img_border" alt="Picture from Swami">

    <p><i>"You have to make your life like a kind of lotus leaf. The lotus leaf always stays in the water, in the mud, but water never touches it. Ignore things, take only the positive things and release out the negative things."</i> - Sri Kaleshwar</p>
{{--    <p><i>"Open your heart to those around you and I will be there. The blessings of the Guru Parampara will find you wherever you are on the globe."</i> - Sri Kaleshwar</p>--}}
    <p>We wish you a very HAPPY BIRTHDAY</p>
    <p>పుట్టిన రోజు శుభాకాంక్షలు<br>
        PUTINA ROJU SHUBHAKANSHALU</p>

    <p>Much much love, joy and blessings<br>
        Shilpa & Ashram family</p>

    <hr>
    <p class="sub">You are receiving this email because you were participant of an event in the Ashram in Penukonda. If you don't want to receive further emails from the Sri Kaleshwar Ashram please send us a short message.</p>
@endsection
