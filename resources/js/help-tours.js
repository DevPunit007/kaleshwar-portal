var eventListTour = {
    id: 'hello-hopscotch',
    steps: [
        {
            target: '#event-list-table_length select',
            title: 'Tour Example',
            content: 'This is An example box as part of a tour.',
            placement: 'bottom',
            arrowOffset: 0,
            xOffset: -10
        },
        {
            target: '#event-list-table tbody tr:nth-child(4) .fa-pencil-alt',
            title: '2nd Example Box',
            content: 'This is the 2nd and last box of the tour.',
            placement: 'left',
            yOffset: 25
        },
    ]
};

$(function () {
    $('#event-list-help-sticker #tour-button').click(function () {
        hopscotch.startTour(eventListTour);
    });
});
