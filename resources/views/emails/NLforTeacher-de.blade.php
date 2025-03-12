@extends('emails.templates.default')

@section('content')
    <p>Hallo {{$user->first_name}},</p>
    <p>über das neue Ashram Portal können nun alle zertifizierten Lehrer ein eigenes Profil erstellen, das dann auf der Webseite vom Ashram angezeigt wird.
        Dies wird vielen Studenten helfen, einen Lehrer aus der Umgebung oder zum passenden Thema zu finden.<p>
    <p>In deinem eigenen Lehrer-Profil kannst du deine Kontaktdaten, eine ausführliche Beschreibung über dich und deine Arbeit veröffentlichen und angeben welche Themen du anbietest.
        Dabei kannst du selbst entscheiden ab wann das Profil auf der Homepage sichtbar ist.</p>
    <p>Um das Profil zu bearbeiten, gehst du zuerst zu deinem <a href="https://www.srikaleshwar.world/de/benutzer/konto">Benutzerkonto</a> und klickst hier auf "Ashram Portal" im linken Seitenmenü:</p>

    <img src="{{$_ENV['APP_URL']}}/images/newsletters/tutorial_teacher_student_account.png" class="img_border" alt="Bild der Ansicht vom Benutzerkonto">

    <p>Im Ashram Portal findest du in der Menüzeile den Eintrag "Lehrer", über diesen kannst du dein Profil öffnen und bearbeiten. Eine genaue Anleitung für das Bearbeiten des Lehrer-Profils findest du über folgenden Link:</p>

    <p>
        <a href="https://youtu.be/jzwwmse7-KE" target="_blank">Anleitung auf YouTube</a>
    </p>
    <p>
        Sobald du dein Profil sichtbar gestellt hast, kannst du es in der Liste auf der Webseite vom Ashram ansehen:
    </p>
    <p>
        <a href="https://www.srikaleshwar.world/de/events/lehrer-gruppen" target="_blank">https://www.srikaleshwar.world/de/events/lehrer-gruppen</a>
    </p>
    <p>
        Bei Fragen wende dich bitte an das Technik-Team:<br>
        <table class="table">
            <tr>
                <td>Email:</td><td class="px-3"><a href="mailto:admin@srikaleshwar.world">admin@srikaleshwar.world</a></td>
            </tr>
            <tr>
                <td>Telefon:</td><td class="px-3">0049 177 7878300</td>
            </tr>
            <tr>
                <td colspan="2">(bitte nur bei Fragen rund um das Ashram Portal)</td>
            </tr>
        </table>
    </p>
    <p>
        Zukünftig sind weitere Ausbaustufen des Ashram Portals für Lehrer geplant.
        Im nächsten Schritt können Lehrer ihre eigenen Events und Seminare einstellen, die dann auf der Homepage vom Ashram veröffentlicht werden.
        Weiterhin ist geplant, dass über das Portal auch Buchungen der Teilnehmer verwaltet werden können und somit viele nützliche Funktionen zur Buchungsverwaltung zur Verfügung stehen.
    </p>
    <p>
        Wir freuen uns immer über Feedback wenn du einen Vorschlag für Verbesserungen hast.
    </p>
    <p>Beste Grüße, Thomas für das Technik-Team </p>

    <hr>
    <p class="sub">Du erhältst diese Nachricht weil Du als Lehrer im Ashram registriert bist. Wenn Du keine weiteren Nachrichten vom Sri Kaleshwar Ashram erhalten möchtest, schreib uns einfach eine kurze Nachricht.</p>
@endsection
