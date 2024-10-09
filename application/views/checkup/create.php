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
                        <div class="col-md-12 form-group">
                            <label for="registration_id">Patient:</label>
                            <select class="form-control" id="registration_id" name="registration_id" required>
                                <option value="">Select a patient</option>
                                <?php foreach ($patients as $patient): ?>
                                    <option value="<?php echo $patient->id; ?>"><?php echo $patient->full_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="blood_pressure">BP:</label>
                            <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="Blood Pressure" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="pulse_rate">PR:</label>
                            <input type="text" class="form-control" id="pulse_rate" name="pulse_rate" placeholder="Pulse Rate" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="respiration_rate">RR:</label>
                            <input type="text" class="form-control" id="respiration_rate" name="respiration_rate" placeholder="Respiration Rate" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="temperature">Temp.:</label>
                            <input type="number" class="form-control" id="temperature" name="temperature" step="0.1" placeholder="Temperature" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="oxygen_saturation">OS:</label>
                            <input type="text" class="form-control" id="oxygen_saturation" name="oxygen_saturation" placeholder="Oxygen Saturation" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="ultrasoundCheckbox">Ultrasound:(Optional)</label>
                            <input type="checkbox" id="ultrasoundCheckbox" onchange="toggleUltrasoundInput()">
                            <label for="ultrasound"></label>
                            <textarea class="form-control" name="ultrasound" id="ultrasound" disabled></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="doctor_comment">Doctor Comment</label>
                            <textarea name="doctor_comment" id="doctor_comment" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="next_checkup_date" class="form-label">Next Check-Up</label>
                            <input type="date" name="next_checkup_date" id="next_checkup_date" class="form-control" required>
                        </div>



                        <script>
                            function toggleUltrasoundInput() {
                                const checkbox = document.getElementById('ultrasoundCheckbox');
                                const ultrasoundInput = document.getElementById('ultrasound');
                                ultrasoundInput.disabled = !checkbox.checked;
                            }
                        </script>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>
</div>