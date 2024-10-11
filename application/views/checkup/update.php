<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2 class="mb-4 text-center">Update Check-Up</h2>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Check-up Information</h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('checkup/update_action'); ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $checkup->id; ?>">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="registration_id">Patient:</label>
                            <p class="form-control-plaintext">
                                <?= isset($patient) ? $patient->name . ' ' .
                                    ($patient->mname ? $patient->mname . ' ' : '') .
                                    $patient->lname : 'N/A';
                                ?>
                            </p>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="blood_pressure">BP:</label>
                            <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" value="<?= $checkup->blood_pressure; ?>" placeholder="Blood Pressure" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="pulse_rate">PR:</label>
                            <input type="text" class="form-control" id="pulse_rate" name="pulse_rate" value="<?= $checkup->pulse_rate; ?>" placeholder="Pulse Rate" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="respiration_rate">RR:</label>
                            <input type="text" class="form-control" id="respiration_rate" name="respiration_rate" value="<?= $checkup->respiration_rate; ?>" placeholder="Respiration Rate" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="temperature">Temp.:</label>
                            <input type="number" class="form-control" id="temperature" name="temperature" step="0.1" value="<?= $checkup->temperature; ?>" placeholder="Temperature" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="oxygen_saturation">OS:</label>
                            <input type="text" class="form-control" id="oxygen_saturation" name="oxygen_saturation" value="<?= $checkup->oxygen_saturation; ?>" placeholder="Oxygen Saturation" required>
                        </div>

                        <!-- New fields for height and weight -->
                        <div class="col-md-6 form-group">
                            <label for="height">Height (cm):</label>
                            <input type="number" class="form-control" id="height" name="height" step="0.01" value="<?= $checkup->height; ?>" placeholder="Height in cm" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="weight">Weight (kg):</label>
                            <input type="number" class="form-control" id="weight" name="weight" step="0.01" value="<?= $checkup->weight; ?>" placeholder="Weight in kg" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="ultrasoundCheckbox">Enable Ultrasound:</label>
                            <input type="checkbox" id="ultrasoundCheckbox" onchange="toggleUltrasoundInput()">
                            <label for="ultrasound"></label>
                            <textarea class="form-control" name="ultrasound" value="<?= $checkup->ultrasound; ?>" id="ultrasound" disabled></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="next_checkup_date" class="form-label">Next Check-Up</label>
                            <input type="date" name="next_checkup_date" id="next_checkup_date" class="form-control" value="<?= $checkup->next_checkup_date; ?>" required>
                        </div>

                        <script>
                            function toggleUltrasoundInput() {
                                const checkbox = document.getElementById('ultrasoundCheckbox');
                                const ultrasoundInput = document.getElementById('ultrasound');
                                ultrasoundInput.disabled = !checkbox.checked;
                            }
                        </script>

                    </div>
                    <button type="submit" class="btn btn-primary">Update Check-Up</button>
                </form>
            </div>
        </div>
    </main>
</div>
