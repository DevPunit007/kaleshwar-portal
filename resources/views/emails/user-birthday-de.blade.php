@extends('emails.templates.default')

@section('content')

    <h2>Hallo {{$user->first_name}} {{$user->last_name}},</h2>

    <p>an deinem speziellen Tag denken wir an dich und senden herzliche Wünsche und Segen von deiner Seelenheimat in Penukonda.</p>

    <img src="https://portal.srikaleshwar.world/images/birthday-message.jpg" class="img_border" alt="Bild von Swami">
    <p><i>"Ihr müsst euer Leben wie eine Art Lotusblatt gestalten. Das Lotusblatt bleibt immer im Wasser, im Schlamm, aber das Wasser berührt es nie. Ignoriere die Dinge, nimm nur das Positive an und lass die negativen Dinge weg."</i> - Sri Kaleshwar</p>
{{--    <p><i>"Öffne dein Herz für die um dich herum und ich werde da sein. Der Segen des Guru Parampara wird dich überall auf der Welt finden."</i> - Sri Kaleshwar</p>--}}
    <p>Wir wünschen dir alles Gute zum Geburtstag</p>
    <p>పుట్టిన రోజు శుభాకాంక్షలు<br>
        PUTINA ROJU SHUBHAKANSHALU</p>

    <p>Alles Liebe, Freude und viele Segnungen<br>
        Shilpa & Ashram-Familie</p>

    <hr>
    <p class="sub">Du erhälst diese Nachricht weil du als Teilnehmer an einem Programm im Ashram teilgenommen hast. Wenn du keine weiteren Nachrichten vom Sri Kaleshwar Ashram bekommen möchtest dann sende uns eine kurze Nachricht.</p>
@endsection
