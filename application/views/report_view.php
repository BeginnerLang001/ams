<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Statistic Reports</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .date-picker-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .date-picker-container input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .date-picker-container button {
            padding: 10px 15px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .date-picker-container button:hover {
            background-color: #0056b3;
        }

        h2 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        #reportSection {
            display: none; /* Hide report section initially */
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Clinic Management Reports</h1>
        </header>

        <div class="date-picker-container">
        <div class="mb-3">
    <label for="startDate" class="form-label">Start Date</label>
    <input type="date" id="startDate" class="form-control" required onchange="updateDate()">
</div>

<div class="mb-3">
    <label for="endDate" class="form-label">End Date</label>
    <input type="date" id="endDate" class="form-control" required onchange="updateDate()">
</div>

            <button onclick="printReport()">Print Report</button>
        </div>

        <section id="reportSection">
            <?php if (isset($dailyRegistrations) || isset($weeklyRegistrations) || isset($monthlyRegistrations)): ?>
                <h2>Daily Report</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Report Type</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Registrations</td>
                            <td><?php echo count($dailyRegistrations); ?></td>
                        </tr>
                        <tr>
                            <td>Online Appointments</td>
                            <td><?php echo count($dailyOnlineAppointments); ?></td>
                        </tr>
                        <tr>
                            <td>Walk-In Appointments</td>
                            <td><?php echo count($dailyWalkInAppointments); ?></td>
                        </tr>
                        <!-- <tr>
                            <td>Treatments</td>
                            <td><?php echo count($dailyCheckups); ?></td>
                        </tr> -->
                        <tr>
                            <td>Treatments</td>
                            <td><?php echo $dailyDiagnoses; ?></td>
                        </tr>
                    </tbody>
                </table>

                <h2>Weekly Report</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Report Type</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Registrations</td>
                            <td><?php echo count($weeklyRegistrations); ?></td>
                        </tr>
                        <tr>
                            <td>Online Appointments</td>
                            <td><?php echo count($weeklyOnlineAppointments); ?></td>
                        </tr>
                        <tr>
                            <td>Walk-In Appointments</td>
                            <td><?php echo count($weeklyWalkInAppointments); ?></td>
                        </tr>
                        <!-- <tr>
                            <td>Checkups</td>
                            <td><?php echo count($weeklyCheckups); ?></td>
                        </tr> -->
                        <tr>
                            <td>Treatments</td>
                            <td><?php echo $weeklyDiagnoses; ?></td>
                        </tr>
                    </tbody>
                </table>

                <h2>Monthly Report</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Report Type</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Registrations</td>
                            <td><?php echo count($monthlyRegistrations); ?></td>
                        </tr>
                        <tr>
                            <td>Online Appointments</td>
                            <td><?php echo count($monthlyOnlineAppointments); ?></td>
                        </tr>
                        <tr>
                            <td>Walk-In Appointments</td>
                            <td><?php echo count($monthlyWalkInAppointments); ?></td>
                        </tr>
                        <!-- <tr>
                            <td>Checkups</td>
                            <td><?php echo count($monthlyCheckups); ?></td>
                        </tr> -->
                        <tr>
                            <td>Treatments</td>
                            <td><?php echo $monthlyDiagnoses; ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No reports available. Please select a date range to filter the data.</p>
            <?php endif; ?>
        </section>
    </div>

    <script>
        function updateDate() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            if (startDate && endDate) {
                // Show the report section only if both dates are selected
                document.getElementById('reportSection').style.display = 'block';

                const url = new URL(window.location.href);
                url.searchParams.set('startDate', startDate);
                url.searchParams.set('endDate', endDate);
                window.history.replaceState({}, '', url); // Update the URL without reloading the page
            } else {
                // Hide the report section if dates are not selected
                document.getElementById('reportSection').style.display = 'none';
            }
        }

        function printReport() {
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            if (!startDate || !endDate) {
                alert('Please select a start and end date to print the report.');
                return;
            }
            window.print();
        }

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const startDate = urlParams.get('startDate');
            const endDate = urlParams.get('endDate');
            if (startDate) {
                document.getElementById('startDate').value = startDate;
            }
            if (endDate) {
                document.getElementById('endDate').value = endDate;
            }

            updateDate();
        };
    </script>
</body>
</html>
