@extends('emails.templates.default')

@section('content')

{{--    <h1>Dear {{$user->first_name}} {{$user->last_name}},</h1>--}}

{{--    <p>we would like to respond to some feedback on the booking process for the Mother Divine Program that we received from participants of the Guru Purnima 2011 program - Immortal Enlightenment (IE).</p>--}}

{{--    <p>During the booking process for the new website <a href="https://srikaleshwar.world">srikaleshwar.world</a>, an extra payment option for IE students could not be developed at such short notice before the program. For this purpose, the additional comment field (Message about your booking) should offer the opportunity to provide information about the booking. Some IE students have taken advantage of this option and announced that they were IE participants and would like to transfer a lower amount. From the feedback we’ve received, we could see that this possibility was not sufficiently clear. Therefore we have worked full speed on the completion of an individual payment option and are pleased that IE students are now able to freely choose the amount.</p>--}}


{{--    <h2>Regarding the amount of the program contribution for IE students:</h2>--}}

{{--    <p>In the previous programs at the ashram, there was a reduced fee for IE students, where only a contribution to expenses for food and operating costs was charged. With an online program, one could assume that such expenses will not arise because one is not there. In reality, however, the Ashram continues to incur high operating costs, even if none of us is on site.</p>--}}

{{--    <p>Due to the special worldwide situation it was not possible for anyone to visit the Ashram in the last 6 months and therefore important income has been lost. The investment in the new solar system for a sustainable infrastructure in the ashram, which was initiated before the Corona period, also increased the overall expenditure due to the installation effort.</p>--}}

{{--    <p>At the regular price for the online program, the challenging financial situation among the students caused by the Corona virus was addressed and a moderate contribution was set. We hope that as many students as possible will see this contribution not only as a program fee, but rather as a support for the Ashram and our soul home.</p>--}}

{{--    <p>Due to the situation described, we would like to give all IE students an option to decide how much can be added to the expenses or whether the regular price is paid as support. Simply enter your contribution in the new input field in the booking form and after booking you can pay this amount directly via PayPal or bank transfer.</p>--}}

{{--    <p>We are sincerely grateful for any support.</p>--}}

{{--    <p>If you have already paid the entire program amount because you did not notice the notification option described above and you are uncomfortable with the amount, please write the student office the desired amount and we will arrange for the repayment.</p>--}}


<p>Dear {{$user->first_name}} {{$user->last_name}},</p>
    <p>With great joy we have seen an increasing number of participants in the online programs. In this message today, we would like to ask for your active feedback. We are eager to hear your comments, suggestions, thoughts and ideas about the online programs.
    </p>
    <p>Gurupurnima 2020 was the first ever ashram online event. Since then various programs and special meditations / processes have been offered. Shivaratri, Sri Kaleshwar’s Mahasamadhi and the recent Easter program just to name a few. The Kumba Mela in honour of Sri Kaleshwar’s birthday at the beginning of the year has brought so many of us together in a very touching, heart opening and sharing way.
    </p>
<p>We see Penukonda as our<br>
    <ul>
    <li><b>Gurustan and as a unique place on this planet</b> where we can do energetic processes and have experiences.
    <li><b>Energetic source and unique power place.</b></li>
</ul>
    <p>We - Shilpa and the Penukonda core team - see it primarily as our task to facilitate programs and energetic processes on site and online. It is our task to support Sri Kaleshwar teachers with the programs on site in their own countries, to build an energetic bridge to all Swami students who’d like to connect to these unique and powerful vibrations. The teaching of Sri Kaleshwar’s vast knowledge and healing system we see as the responsibility of the teachers in the individual countries.
    </p>

<p><b>
        We are very happy that you have participated in one or more of the Ashram Online Events.
    </b></p>
    <p>Thank you for your feedback so far, some of your suggestions could already be implemented, others we are working on, like:
    </p>
<ul>
    <li>Program recordings (apart from special processes) will remain available in the Media center in your user account on the new website.
    </li>
    <li>Sending of the payment confirmation for your booking directly via the portal
    </li>
    <li>Event instructions will include in the booking confirmation for fire pujas and other online events.
    </li>
</ul>
<h4>
    PLANNED UNTIL GURU PURNIMA 2021</h4>
<ul>
    <li>Bilingual website (english and german)
    </li>
    <li>Listing of worldwide certified Sri Kaleshwar teachers and centers on the website with different filter possibilities.
    </li>
    <li>Extension and improvement of the structure in the Media Center
    </li>
    <li>Enhanced functionalities on YouTube. For this we ask you to subscribe to the Shiva Sai Mandir YouTube channel:<br>
        <a href="https://www.youtube.com/c/ShivaSaiMandir">https://www.youtube.com/c/ShivaSaiMandir</a><br>
        Only from a subscriber number of 1,000 these extensions can be used.
    </li>
</ul>

<h4>    WE NEED YOUR ACTIVE FEEDBACK</h4>
    Your opinions and feedback are very important to us. Only by knowing it, we can improve and change existing things and implement new ones.
    Please share your thoughts and ideas about the online programs - fire pujas, special events and other online events:
<ul>
    <li>What did you like / dislike?
    </li>
    <li>What can be improved in terms of content and/or implementation?
    </li>
    <li>Which special process would you like to see more often? (eg. special abisheks, meditations at certain places, pujas, …)
    </li>
    <li>What are you missing (in the online offers)?
    </li>
</ul>
<p>We have an <b>important question in regard to reading out the participants names</b> during fire pujas, meditations and processes. As there are different opinions we’d like to get an idea what the majority of participating students prefer. Should the names be read out loud (first name and 1st letter of the last name) or silent or is a placement of the namelist at the respective powerspot enough?
</p>
<p>    We look forward to hearing from you.</p>
   <p> Much love and greetings from your Gurusthan,<br>
        Shilpa, Penukonda core team, Ashram family</p>

    <hr>
    <p class="sub">You are receiving this email because you were participant of an event you had booked. If you don't want to receive further emails from the Sri Kaleshwar Ashram please send us a short message.</p>
@endsection
