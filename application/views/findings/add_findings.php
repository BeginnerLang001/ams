<div id="layoutSidenav_content">
    <div class="container mt-4">
        <h2 class="text-primary">Findings Form</h2>

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
            <p>No patient found.</p>
        <?php endif; ?>

        <!-- Vital Signs -->
        <h3 class="mt-4">Vital Signs</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Blood Pressure</th>
                        <th>Pulse Rate</th>
                        <th>Respiration Rate</th>
                        <th>Temperature</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($vital_signs)): ?>
                        <?php foreach ($vital_signs as $vital_sign): ?>
                            <tr>
                                <td><?= htmlspecialchars($vital_sign->created_at) ?></td>
                                <td><?= htmlspecialchars($vital_sign->blood_pressure_systolic . '/' . $vital_sign->blood_pressure_diastolic) ?></td>
                                <td><?= htmlspecialchars($vital_sign->pulse_rate) ?></td>
                                <td><?= htmlspecialchars($vital_sign->respiration_rate) ?></td>
                                <td><?= htmlspecialchars($vital_sign->temperature) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No vital signs available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

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
        
        <!-- Form for Adding Findings -->
        <h3 class="mt-4">Add Findings</h3>
        <form action="<?= site_url('findings/store') ?>" method="post" class="mb-4">
            <input type="hidden" name="registration_id" value="<?= isset($patient) ? $patient->id : ''; ?>">
            <div class="mb-3">
                <label for="findings" class="form-label">Findings:</label>
                <textarea name="findings" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="recommendations" class="form-label">Recommendations:</label>
                <textarea name="recommendations" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Findings</button>
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
