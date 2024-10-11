<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mendoza OB-Gyn Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20mm;
            padding: 0;
            line-height: 1.5;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        h3 {
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin-top: 20px;
        }
        .report-section {
            margin-bottom: 20px;
        }
        .date-as-of {
            text-align: right;
            font-size: 12px;
            margin-bottom: 20px;
        }
        .signature {
            margin-top: 40px;
            text-align: left;
        }
        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .print-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
    <script>
        function printSection(sectionId) {
            var printContents = document.getElementById(sectionId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Mendoza OB-Gyn Reports</h2>
    
    <p class="date-as-of">As of: <?php echo date('Y-m-d'); ?></p>

    <!-- Monthly Report -->
    <div class="report-section" id="monthlyReport">
        <h3>Monthly Report</h3>
        <p>Total Registrations: <?php echo count($monthlyRegistrations); ?></p>
        <p>Total Online Appointments: <?php echo count($monthlyOnlineAppointments); ?></p>
        <p>Total Walk-In Appointments: <?php echo count($monthlyWalkInAppointments); ?></p>
        <p>Total Check-Ups: <?php echo count($monthlyCheckups); ?></p>
        <p>Total Diagnosis: <?php echo $monthlyDiagnoses; ?></p> 
    </div>
    <button class="print-button" onclick="printSection('monthlyReport');">Print Monthly Report</button>

    <!-- Weekly Report -->
    <div class="report-section" id="weeklyReport">
        <h3>Weekly Report</h3>
        <p>Total Registrations: <?php echo count($weeklyRegistrations); ?></p>
        <p>Total Online Appointments: <?php echo count($weeklyOnlineAppointments); ?></p>
        <p>Total Walk-In Appointments: <?php echo count($weeklyWalkInAppointments); ?></p>
        <p>Total Check-Ups: <?php echo count($weeklyCheckups); ?></p>
        <p>Total Diagnosis: <?php echo $weeklyDiagnoses; ?></p> 
    </div>
    <button class="print-button" onclick="printSection('weeklyReport');">Print Weekly Report</button>

    <!-- Daily Report -->
    <div class="report-section" id="dailyReport">
        <h3>Daily Report</h3>
        <p>Total Registrations: <?php echo count($dailyRegistrations); ?></p>
        <p>Total Online Appointments: <?php echo count($dailyOnlineAppointments); ?></p>
        <p>Total Walk-In Appointments: <?php echo count($dailyWalkInAppointments); ?></p>
        <p>Total Check-Ups: <?php echo count($dailyCheckups); ?></p>
        <p>Total Diagnosis: <?php echo $dailyDiagnoses; ?></p> 
    </div>
    <button class="print-button" onclick="printSection('dailyReport');">Print Daily Report</button>

    <div class="signature">
        <p>Signature: _______________________</p>
    </div>

    <button class="print-button" onclick="window.print();">Print All Reports</button>
</div>

</body>
</html>
