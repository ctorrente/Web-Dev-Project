<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='../fullcalendar.css' rel='stylesheet' />
<link href='../jquery-ui-themes-1.11.4/themes/start/jquery-ui.css' rel='stylesheet' />
<link href='../fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='../lib/moment.min.js'></script>
<script src='../jquery-1.12.0.min.js'></script>
<script src='../fullcalendar.min.js'></script>
<script src='../jquery-ui-1.11.4/jquery-ui.js'></script>
<script src='../jquery-ui-1.11.4/jquery-ui.min.js'></script>
<script src='../jquery-dateFormat.js'></script>
<script src='../moment.js'></script>

<script>

	$(document).ready(function() {
		$('#calendar').fullCalendar({ 	
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '2016-01-12',
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				$("#addEventInfo").html(event.description);
				$("#addEventLink").attr('href', event.url);
				$("#addEventContent").dialog({ modal: true, width:350});
			},
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					title: 'All Day Event',
					start: '2016-01-01',
					description: 'This sucks',
					url: 'www.google.com'
				},
				{
					title: 'Long Event',
					start: '2016-01-07',
					end: '2016-01-10'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2016-01-09T16:00:00'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: '2016-01-16T16:00:00'
				},
				{
					title: 'Conference',
					start: '2016-01-11',
					end: '2016-01-13'
				},
				{
					title: 'Meeting',
					start: '2016-01-12T10:30:00',
					end: '2016-01-12T12:30:00'
				},
				{
					title: 'Lunch',
					start: '2016-01-12T12:00:00'
				},
				{
					title: 'Meeting',
					start: '2016-01-12T14:30:00'
				},
				{
					title: 'Happy Hour',
					start: '2016-01-12T17:30:00'
				},
				{
					title: 'Dinner',
					start: '2016-01-12T20:00:00'
				},
				{
					title: 'Birthday Party',
					start: '2016-01-13T07:00:00',
					color: '#ff6a6a'
				},
				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2016-01-28'
				}
			],
			eventRender: function (event, element) {
				element.attr('href', 'javascript:void(0);');
				element.click(function() {
					if (event.end)
						$("#eventDate").html($.format.date(event.start.toString(), "MMM d, yyyy") + " until " + $.format.date(event.end.toString(), "MMM d, yyyy") );
					else
						$("#eventDate").html($.format.date(event.start.toString(), "MMM d, yyyy ddd"));
					$("#eventInfo").html(event.description);
					$("#eventLink").attr('href', event.url);
					$("#eventContent").dialog({ modal: true, title: event.title, width:350});
				});
			}
		});
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
</head>
<body>

	<div id='calendar'></div>
	
	<div id="eventContent" title="Event Details" style="display:none;">
		<span id="eventDate"></span>
		<div id="eventInfo"></div>
		<p><strong><a id="eventLink" target="_blank">Read More</a></strong></p>
		<button>Delete Event</button>
		<button>Edit Event</button>
	</div>
	
	<div id="addEventContent" title="Add Event" style="display:none;">
		<div id="addEventInfo"></div>
		<p><strong><a id="addEventLink" target="_blank">Read More</a></strong></p>
	</div>

</body>
</html>
