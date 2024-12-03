<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <title>Findings</title>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        table {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div id="layoutSidenav_content">
    <div class="container mt-4">
        <h2 class="text-primary">Diagnosis</h2>

        <!-- Patient Information -->
        <h3 class="mt-4">Patient Information</h3>
        <?php if (isset($patient) && !empty($patient)): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p><strong>Full Name:</strong> <?= htmlspecialchars($patient->name . ' ' . $patient->mname . ' ' . $patient->lname) ?></p>
                    <p><strong>Address:</strong> <?= htmlspecialchars($patient->address) ?></p>
                    <p><strong>Birthday:</strong> <?= htmlspecialchars($patient->birthday) ?></p>
                    <p><strong>Marital Status:</strong> <?= htmlspecialchars($patient->marital_status) ?></p>
                </div>
            </div>
        <?php else: ?>
            <p class="text-danger">No patient found.</p>
        <?php endif; ?>

        <!-- Vital Signs -->
        <h3 class="mt-4">Vital Signs</h3>
        <?php if (!empty($vital_signs)): ?>
            <table class="table table-bordered">
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
                            <td><?= htmlspecialchars($vital_sign->blood_pressure_systolic) ?></td>
                            <td><?= htmlspecialchars($vital_sign->blood_pressure_diastolic) ?></td>
                            <td><?= htmlspecialchars($vital_sign->pulse_rate) ?></td>
                            <td><?= htmlspecialchars($vital_sign->respiration_rate) ?></td>
                            <td><?= htmlspecialchars($vital_sign->temperature) ?></td>
                            <td><?= htmlspecialchars($vital_sign->oxygen_saturation) ?></td>
                            <td><?= htmlspecialchars($vital_sign->height) ?></td>
                            <td><?= htmlspecialchars($vital_sign->weight) ?></td>
                            <td><?= htmlspecialchars($vital_sign->bmi) ?></td>
                            <td><?= htmlspecialchars(date('Y-m-d H:i:s', strtotime($vital_sign->checkup_date))) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-warning">No vital signs found for this registration ID.</p>
        <?php endif; ?>

        <!-- Laboratory Tests Section -->
        <h3 class="mt-4">Ultrasound Record</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Ultrasound Findings</th>
                        <th>Baby's Height (cm)</th>
                        <th>Baby's Weight (kg)</th>
                        <th>Doctor's Notes</th>
                        <th>Test Date</th>
                        <th>Diagnosis Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($laboratory_tests)): ?>
                        <?php foreach ($laboratory_tests as $test): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($test->ultrasound); ?></td>
                                <td><?php echo htmlspecialchars($test->urinalysis); ?> cm</td> <!-- Baby's Height -->
                                <td><?php echo htmlspecialchars($test->pregnancy_test); ?> kg</td> <!-- Baby's Weight -->
                                <td><?php echo htmlspecialchars($test->results); ?></td>
                                <td><?php echo htmlspecialchars(date('F j, Y', strtotime($test->created_at))); ?></td>
                                <td>
                                    <?php
                                        $diagnosis_type = '';
                                        if ($test->diagnosis_type_id == 1) {
                                            $diagnosis_type = 'Pre-mature';
                                        } elseif ($test->diagnosis_type_id == 2) {
                                            $diagnosis_type = 'Placenta Previa';
                                        } elseif ($test->diagnosis_type_id == 3) {
                                            $diagnosis_type = 'Abruptio Placenta';
                                        } elseif ($test->diagnosis_type_id == 4) {
                                            $diagnosis_type = 'Cesarian Section';
                                        } elseif ($test->diagnosis_type_id == 6) {
                                            $diagnosis_type = 'Check Up';
                                        }
                                        echo htmlspecialchars($diagnosis_type);
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No Ultrasound tests found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Form for Adding/Updating Findings -->
        <h3 class="mt-4">Add/Update Findings</h3>
        <form method="POST" action="<?php echo site_url('findings/store'); ?>">
            <input type="hidden" name="registration_id" value="<?= isset($patient) ? $patient->id : ''; ?>">
            <input type="hidden" name="finding_id" value="<?= isset($finding) ? $finding->id : ''; ?>">

            <div class="form-group">
                <label for="findings">Findings:</label>
                <textarea name="findings" id="findings" class="form-control" required><?= isset($finding) ? htmlspecialchars($finding->findings) : ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="recommendations">Recommendations:</label>
                <textarea name="recommendations" id="recommendations" class="form-control" required><?= isset($finding) ? htmlspecialchars($finding->recommendations) : ''; ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary"><?= isset($finding) ? 'Update Findings' : 'Submit Findings' ?></button>
        </form>

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
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
