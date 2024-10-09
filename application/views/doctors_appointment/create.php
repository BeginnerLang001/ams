<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 20px;
        }

        .container {
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create New Appointment</h1>

        <?php if (validation_errors()): ?>
            <div class="alert alert-danger">
                <?php echo validation_errors(); ?>
            </div>
        <?php endif; ?>

        <form action="<?php echo site_url('doctors_appointments/create'); ?>" method="post">
            <div class="form-group">
                <label for="appointment_date">Appointment Date:</label>
                <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="appointment_time">Appointment Time:</label>
                <input type="time" id="appointment_time" name="appointment_time" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="appointment_reason">Reason:</label>
                <textarea id="appointment_reason" name="appointment_reason" class="form-control"></textarea>
            </div>

            <!-- <a href="<?php echo site_url('doctors_appointments/index'); ?>" class="btn btn-primary">
                <i class="fas fa-calendar-plus me-1"></i> Create New Appointment

            </a> -->
            <button type="submit" class="btn btn-primary">Create Appointment</button>


        </form>
    </div>

    <script>
        document.querySelector('#appointment_time').addEventListener('change', function() {
            var appointmentDate = document.querySelector('#appointment_date').value;
            var appointmentTime = this.value;

            if (appointmentDate && appointmentTime) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo site_url('doctors_appointments/check_availability'); ?>', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.responseText === 'Not Available') {
                        alert('This time slot is not available. Please choose another.');
                    }
                };
                xhr.send('appointment_date=' + appointmentDate + '&appointment_time=' + appointmentTime);
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>