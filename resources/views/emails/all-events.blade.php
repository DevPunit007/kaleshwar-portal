<!DOCTYPE html>
<html>
<head>
    <title>Test E-Mail Title</title>
</head>
<body>
<div>

</div>
<div style="font-family: Arial, sans-serif">
    <h2 style="text-align: center;">
        Upcoming programs 2019 & 2020 and Registration links:
    </h2>
    <table id="event-list-table" class="display" style="width: 100%; margin-bottom: 20px;">
        <thead>
        <tr>
            <th>Title</th>
            <th>Location</th>
            <th>Category</th>
            <th>Organizer</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
            <tr style="background-color: #eee;">
                <td style="padding: 10px;"><a href="https://portal.srikaleshwar.world/en/event/details/{{$event->id}}">{{$event->eventDetails[0]->title}}</a></td>
                <td style="padding: 10px;">{{$event->locationDetails->name}}</td>
                <td style="padding: 10px;">{{$event->eventCategory->event_category_name}}</td>
                <td style="padding: 10px;">{{$event->organizer->organizer_name}}</td>
                <td style="padding: 10px;">{{$event->start_date}}</td>
                <td style="padding: 10px;">{{$event->end_date}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div style="font-size: 20px;">
        Please note, that you cannot arrive during a program. It is very important that everyone arrives
        minimum one day before the start of any program to ensure a peaceful program flow. If you are visiting
        the ashram for the first time we highly recommend you to arrive minimum 2 or 3 days earlier to ensure
        to settle in and get adjusted to the ashram life smoothly as well as receive a proper orientation before
        the program starts.
    </div>
</div>
</body>
</html>
