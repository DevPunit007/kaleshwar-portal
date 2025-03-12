@extends('emails.templates.default')

@section('content')

    <h2>Dear {{$user->first_name}} {{$user->last_name}},</h2>

    <p>
        We hope you have all spent a nice Easter weekend with your loved ones and could connect to the powerful energies from your Gurusthan during this special weekend.
        This year we had the auspicious coincidence that the 9th Indian Mahasamadhi and Easter Sunday were celebrated on the same day.
    </p>

    <img src="{{$_ENV['APP_URL']}}/images/easter_program.jpg" class="img_border" alt="Picture from Program">

    <p>
        We connected strongly to the light on both days, on Saturday with the Easter fire puja and
        Sunday with a candle meditation in the Jesus Temple. It was wonderful that so many of you joined. The auspicious number of 504 candles have been lit.
    </p>

    <p>Both program recordings can be accessed in the media center in your user account:</p>

    <p><a href="https://srikaleshwar.world/en/user/account">https://srikaleshwar.world/en/user/account</a></p>

    <p>
        We are happy to share some pictures of the Easter program with you via Dropbox:<br>
        <a href="https://www.dropbox.com/sh/4ttyatskyhawx91/AABC4QYxCwMLNyoK7pLCOr9pa?dl=0">https://www.dropbox.com/sh/4ttyatskyhawx91/AABC4QYxCwMLNyoK7pLCOr9pa?dl=0</a><br>
        They will be available till 15th May 2021.

    </p>
    <p>Sending you much love and blessings,<br>
        Shilpa, Penukonda core team, Ashram family</p>

    <hr>
    <p class="sub">You are receiving this email because you were participant of an event you had booked. If you don't want to receive further emails from the Sri Kaleshwar Ashram please send us a short message.</p>
@endsection
