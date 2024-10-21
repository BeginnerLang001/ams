<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
            }

            .container {
                width: 100%;
                padding: 0;
            }

            h2, h3 {
                color: #000;
            }

            .card, .table {
                border: none;
                box-shadow: none;
                margin-bottom: 20px;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table th, .table td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }

            .table th {
                background-color: #f2f2f2;
            }

            /* Hide non-printable elements */
            button, .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div id="layoutSidenav_content">
        <div class="container mt-4">
            
            <h2 class="text-primary">Findings Details</h2>

            <!-- Patient Information -->
            <h3 class="mt-4">Patient Information</h3>
            <?php if (isset($patient) && !empty($patient)): ?>
                <div class="card mb-3">
                    <div class="card-body">
                    <p><strong>Patient ID:</strong> <?= htmlspecialchars(str_pad($patient->id, 4, '0', STR_PAD_LEFT)) ?></p>

                        <p><strong>Full Name:</strong> <?= htmlspecialchars($patient->name . ' ' . $patient->mname . ' ' . $patient->lname) ?></p>
                        <p><strong>Address:</strong> <?= htmlspecialchars($patient->address) ?></p>
                        <p><strong>Birthday:</strong> <?= htmlspecialchars($patient->birthday) ?></p>
                        <p><strong>Marital Status:</strong> <?= htmlspecialchars($patient->marital_status) ?></p>
                    </div>
                </div>
            <?php else: ?>
                <p>No patient found.</p>
            <?php endif; ?>

            <!-- Vital Signs -->
            <h3 class="mt-4">Vital Signs</h3>
            <?php if (!empty($vital_signs)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Blood Pressure (Systolic)</th>
                            <th>Blood Pressure (Diastolic)</th>
                            <th>Pulse Rate</th>
                            <th>Respiration Rate</th>
                            <th>Temperature</th>
                            <th>Oxygen Saturation</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>BMI</th>
                            <th>Checkup Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vital_signs as $vital_sign): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($vital_sign->blood_pressure_systolic); ?></td>
                                <td><?php echo htmlspecialchars($vital_sign->blood_pressure_diastolic); ?></td>
                                <td><?php echo htmlspecialchars($vital_sign->pulse_rate); ?></td>
                                <td><?php echo htmlspecialchars($vital_sign->respiration_rate); ?></td>
                                <td><?php echo htmlspecialchars($vital_sign->temperature); ?></td>
                                <td><?php echo htmlspecialchars($vital_sign->oxygen_saturation); ?></td>
                                <td><?php echo htmlspecialchars($vital_sign->height); ?></td>
                                <td><?php echo htmlspecialchars($vital_sign->weight); ?></td>
                                <td><?php echo htmlspecialchars($vital_sign->bmi); ?></td>
                                <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($vital_sign->checkup_date))); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No vital signs found for this registration ID.</p>
            <?php endif; ?>

            <!-- Laboratory Tests Section -->
            <h3 class="mt-4">Laboratory Tests</h3>
            <div class="table-responsive">
                <table class="table table-striped">
 <thead class="table-light">
                        <tr>
                            <th>Urinalysis</th>
                            <th>Results</th>
                            <th>Test Date</th>
                            <th>Pregnancy Test</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laboratory_tests)): ?>
                            <?php foreach ($laboratory_tests as $test): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($test->urinalysis); ?></td>
                                    <td><?php echo htmlspecialchars($test->results); ?></td>
                                    <td><?php echo htmlspecialchars(date('F j, Y', strtotime($test->created_at))); ?></td>
                                    <td><?php echo htmlspecialchars($test->pregnancy_test); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No laboratory tests found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Display Previous Findings -->
            <h3 class="mt-4">Previous Findings</h3>
            <?php if (isset($findings) && !empty($findings)): ?>
                <ul class="list-group mb-4">
                    <?php foreach ($findings as $finding): ?>
                        <li class="list-group-item"><?= htmlspecialchars($finding->findings) ?> - <?= htmlspecialchars($finding->created_at) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No findings recorded yet.</p>
            <?php endif; ?>
            <button onclick="window.print()" class="btn btn-primary no-print">Print Report</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>