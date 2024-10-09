<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your existing styles */
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Mendoza Clinic</h1>
            <h2>Monthly Report</h2>
            <p class="text-muted">For the month of <?= date('F Y'); ?></p>
        </div>

        <div class="section">
            <h2>Total Registrations</h2>
            <p>Total Registrations: <?= isset($totalRegistrations) ? $totalRegistrations : 'Data not available'; ?></p>
        </div>

        <div class="section">
            <h2>Online Appointments</h2>
            <p>Total Online Appointments: <?= isset($totalOnlineAppointments) ? $totalOnlineAppointments : 'Data not available'; ?></p>
            <p>Approved: <?= isset($onlineAppointmentsApproved) ? $onlineAppointmentsApproved : 'Data not available'; ?></p>
            <p>Rejected: <?= isset($onlineAppointmentsRejected) ? $onlineAppointmentsRejected : 'Data not available'; ?></p>
            <p>Pending: <?= isset($onlineAppointmentsPending) ? $onlineAppointmentsPending : 'Data not available'; ?></p>
        </div>

        <div class="section">
            <h2>Walk-In Appointments</h2>
            <p>Total Walk-In Appointments: <?= isset($totalWalkInAppointments) ? $totalWalkInAppointments : 'Data not available'; ?></p>
            <p>Approved: <?= isset($walkInAppointmentsApproved) ? $walkInAppointmentsApproved : 'Data not available'; ?></p>
            <p>Rejected: <?= isset($walkInAppointmentsRejected) ? $walkInAppointmentsRejected : 'Data not available'; ?></p>
            <p>Pending: <?= isset($walkInAppointmentsPending) ? $walkInAppointmentsPending : 'Data not available'; ?></p>
        </div>

        <button class="btn btn-primary no-print" onclick="printSummary()">Print Summary</button>
    </div>

    <script>
        function printSummary() {
            var originalContent = document.body.innerHTML;
            var printContent = document.querySelector('.container').innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
</body>
</html>
