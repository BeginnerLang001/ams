<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2 class="mb-4 text-center">Create Check-up</h2>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Check-up Information</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('checkup/store'); ?>" method="post">
                    <div class="row">
                        <!-- Patient Selection -->
                        <div class="col-md-12 form-group mb-3">
                            <label for="registration_id">Patient:</label>
                            <select class="form-control" id="registration_id" name="registration_id" required>
                                <option value="">Select a patient</option>
                                <?php foreach ($patients as $patient): ?>
                                    <option value="<?php echo $patient->id; ?>"><?php echo $patient->full_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Vital Signs -->
                        <div class="col-md-6 form-group mb-3">
                            <label for="blood_pressure">BP:</label>
                            <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="Blood Pressure" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="pulse_rate">PR:</label>
                            <input type="text" class="form-control" id="pulse_rate" name="pulse_rate" placeholder="Pulse Rate" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="respiration_rate">RR:</label>
                            <input type="text" class="form-control" id="respiration_rate" name="respiration_rate" placeholder="Respiration Rate" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="temperature">Temp.:</label>
                            <input type="number" class="form-control" id="temperature" name="temperature" step="0.1" placeholder="Temperature" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="oxygen_saturation">OS:</label>
                            <input type="text" class="form-control" id="oxygen_saturation" name="oxygen_saturation" placeholder="Oxygen Saturation" required>
                        </div>
                        <!-- <div class="col-md-6 form-group mb-3">
                            <label for="pregnancy_test">Pregnancy Test (PT):</label>
                            <select class="form-control" id="pregnancy_test" name="pregnancy_test" required>
                                <option value="-">Select Result</option>
                                <option value="Positive">Positive (+)</option>
                                <option value="Negative">Negative (-)</option>
                            </select>
                        </div> -->

                        <!-- Physical Measurements -->
                        <div class="col-md-6 form-group mb-3">
                            <label for="height">Height (cm):</label>
                            <input type="number" class="form-control" id="height" name="height" step="0.01" placeholder="Height in cm" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="weight">Weight (kg):</label>
                            <input type="number" class="form-control" id="weight" name="weight" step="0.01" placeholder="Weight in kg" required>
                        </div>

                        <!-- Additional Information -->
                        <div class="col-md-6 form-group mb-3">
                            <label for="ultrasoundCheckbox">Ultrasound (Optional):</label>
                            <input type="checkbox" id="ultrasoundCheckbox" onchange="toggleUltrasoundInput()">
                            <textarea class="form-control mt-2" name="ultrasound" id="ultrasound" placeholder="Enter ultrasound details" disabled></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="prescription">Prescription:</label>
                            <textarea class="form-control" id="prescription" name="prescription" placeholder="Enter prescription details"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="recommendation">Recommendation:</label>
                            <textarea class="form-control" id="recommendation" name="recommendation" placeholder="Enter recommendations"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="doctor_comment">Doctor's Comment:</label>
                            <textarea class="form-control" id="doctor_comment" name="doctor_comment" placeholder="Enter doctor's comments"></textarea>
                        </div>

                        <!-- Next Check-Up Date -->
                        <div class="col-md-6 form-group mb-3">
                            <label for="next_checkup_date">Next Check-Up:</label>
                            <input type="date" class="form-control" id="next_checkup_date" name="next_checkup_date">
                        </div>
                    </div>

                    <!-- Form Submit Button -->
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    function toggleUltrasoundInput() {
        const checkbox = document.getElementById('ultrasoundCheckbox');
        const ultrasoundInput = document.getElementById('ultrasound');
        ultrasoundInput.disabled = !checkbox.checked;
    }
</script>
