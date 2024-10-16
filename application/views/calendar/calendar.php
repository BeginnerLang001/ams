<!DOCTYPE html>
<html>

<head>
    <title>Calendar</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
    <!-- Include FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <!-- Include jQuery UI CSS and JS for dialog -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Custom CSS for better styling -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #header {
            background-color: #28a745;
            /* Green background for header */
            color: white;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
        }

        .buttons-container {
            text-align: center;
            margin-top: 20px;
        }

        .buttons-container a {
            background-color: #28a745;
            /* Green background for buttons */
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 5px;
            transition: background-color 0.3s;
        }

        .buttons-container a:hover {
            background-color: #218838;
            /* Darker green for hover effect */
        }
    </style>

</head>

<body>
    <div id="layoutSidenav_content">
        <main>
            <div id="header">
                <h1>Calendar</h1>
            </div>
            <div id="calendar"></div>

            <!-- Dialog for event actions -->
            <div id="eventDialog" title="Mendoza Clinic Appointments" style="display: none;">
                <p id="eventDetails"></p>
                <!-- <button id="editEvent">Edit Appointment</button>
                <button id="deleteEvent">Delete Appointment</button> -->
            </div>

            <div class="buttons-container">
                <a href="<?php echo site_url('appointments/create'); ?>">Add Appointment</a>
                <a href="<?php echo site_url('clinic/dashboard'); ?>">Back</a>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: <?php echo json_encode($all_appointments); ?>,
                dayClick: function(date, jsEvent, view) {
                    $('#eventDialog').dialog({
                        modal: true,
                        title: 'Add Appointment',
                        buttons: {
                            Cancel: function() {
                                $(this).dialog('close');
                            },
                            'Make an Appointment': function() {
                                window.location.href = '<?php echo site_url('appointments/search_form'); ?>?date=' + date.format();
                            }
                        }
                    });
                },
                eventClick: function(event) {
                    $('#eventDetails').html('<strong>' + event.title + '</strong><br>' + event.notes);
                    $('#eventDialog').data('event', event).dialog({
                        modal: true,
                        // buttons: {
                        //     Close: function() {
                        //         $(this).dialog('close');
                        //     },
                        //     Edit: function() {
                        //         window.location.href = event.url;
                        //     },
                        //     Delete: function() {
                        //         if (confirm('Are you sure you want to delete this appointment?')) {
                        //             window.location.href = '<?php echo site_url('calendar/delete/'); ?>' + event.id;
                        //         }
                        //     }
                        // }
                    });
                    return false;
                },
                eventRender: function(event, element) {
                    element.append('<br>' + event.notes);
                }
            });
        });
    </script>
</body>

</html>