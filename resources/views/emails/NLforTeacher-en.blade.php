@extends('emails.templates.default')

@section('content')

    <p>Dear {{$user->first_name}},</p>
    <p>We wish you and your loved ones health and happiness.</p>
    <p>Already two years has passed since we sent a request to all certified teachers inviting them to provide us with any data they would like to include for our new website.</p>
    <p>However, the special situation and the associated travel restrictions brought us new tasks, such as switching to online events, managing bookings in the Ashram portal and expanding the media library for the participants.</p>
    <p>Now the time has finally come to offer all certified teachers the opportunity to create their own profile, which will appear on the ashram website.
        This will help many students to find a teacher in their area or on a specific topic.<p>
    <p>In your teacher profile you can publish your contact details, including a description about yourself, your work and teaching topics.
        You can also decide when to make your profile visible on the homepage.</p>
    <p>To edit your profile, first go to your <a href="https://www.srikaleshwar.world/en/user/account"> user account </a> and click on "Ashram Portal" in the left side menu:</p>

    <img src="{{$_ENV['APP_URL']}}/images/newsletters/tutorial_teacher_student_account_english.png" class="img_border" alt="Picture from User account">

    <p>In the Ashram Portal you will find the entry "Teacher" in the menu bar. Here you can open and edit your profile.
        Please see more detailed instructions for editing the teacher profile via the following link:</p>
    <p>
        <a href="https://youtu.be/vTqffFChAJY" target="_blank">Instructions on YouTube</a>
    </p>
    <p>After you make your profile visible, you can see it in the teacher list on the ashram website:</p>
    <p>
        <a href="https://www.srikaleshwar.world/en/events/teachers-groups" target="_blank">https://www.srikaleshwar.world/en/events/teachers-groups</a>
    </p>
    <p>
        If you have any questions, please contact the technical team:<br>
        <table class="table">
            <tr>
                <td>Email:</td><td class="px-3"><a href="mailto:admin@srikaleshwar.world">admin@srikaleshwar.world</a></td>
            </tr>
            <tr>
                <td>Phone:</td><td class="px-3">+49 177 7878300</td>
            </tr>
            <tr>
                <td colspan="2">(only for questions about the ashram portal)</td>
            </tr>
        </table>
    </p>
    <p>
        Future expansion for the teacher area is being planned.
        In the next step, teachers will be able to enter information on their events and seminars, which will be published on the ashram website.
        Also, there will be a feature to provide appointment bookings through the portal, thus providing many useful functions for booking management.
    </p>
    <p>
        We are always happy to receive feedback if you have a suggestion for improvements.
    </p>
    <p>Best regards,<br>Thomas for the technical team</p>

    <hr>
    <p class="sub">You are receiving this email because you are registered as teacher in the Ashram. If you don't want to receive further emails from the Sri Kaleshwar Ashram please send us a short message.</p>

@endsection
