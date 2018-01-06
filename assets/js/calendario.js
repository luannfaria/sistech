<script>

  $(function() { // document ready

    $('#calendario').fullCalendar({
      defaultView: 'agendaDay',
      defaultDate: '2017-12-07',
      editable: true,
      selectable: true,
      eventLimit: true, // allow "more" link when too many events
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'agendaDay,agendaTwoDay,agendaWeek,month'
      },
      views: {
        agendaTwoDay: {
          type: 'agenda',
          duration: { days: 2 },

          // views that are more than a day will NOT do this behavior by default
          // so, we need to explicitly enable it
          groupByResource: true

          //// uncomment this line to group by day FIRST with resources underneath
          //groupByDateAndResource: true
        }
      },

      //// uncomment this line to hide the all-day slot
      //allDaySlot: false,

      resources: [
        { id: 'a', title: 'Room A' },
        { id: 'b', title: 'Room B', eventColor: 'green' },
        { id: 'c', title: 'Room C', eventColor: 'orange' },
        { id: 'd', title: 'Room D', eventColor: 'red' }
      ],
      events: [
        { id: '1', resourceId: 'a', start: '2017-12-06', end: '2017-12-08', title: 'event 1' },
        { id: '2', resourceId: 'a', start: '2017-12-07T09:00:00', end: '2017-12-07T14:00:00', title: 'event 2' },
        { id: '3', resourceId: 'b', start: '2017-12-07T12:00:00', end: '2017-12-08T06:00:00', title: 'event 3' },
        { id: '4', resourceId: 'c', start: '2017-12-07T07:30:00', end: '2017-12-07T09:30:00', title: 'event 4' },
        { id: '5', resourceId: 'd', start: '2017-12-07T10:00:00', end: '2017-12-07T15:00:00', title: 'event 5' }
      ],

      select: function(start, end, jsEvent, view, resource) {
        console.log(
          'select',
          start.format(),
          end.format(),
          resource ? resource.id : '(no resource)'
        );
      },
      dayClick: function(date, jsEvent, view, resource) {
        console.log(
          'dayClick',
          date.format(),
          resource ? resource.id : '(no resource)'
        );
      }
    });

  });

</script>
