<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2 class="mb-4 text-center">Update Vital Sign Record</h2>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Update Vital Sign Details</h5>
            </div>
            <div class="card-body">
                <form action="<?= site_url('VitalSign/update_action'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $vital_sign->id; ?>">
                    <input type="hidden" name="registration_id" value="<?= $vital_sign->registration_id; ?>">

                    <div class="row">
                        <!-- Vital Signs -->
                        <div class="col-md-6 form-group mb-3">
                            <label for="blood_pressure_systolic">Systolic BP:</label>
                            <input type="text" class="form-control" id="blood_pressure_systolic" name="blood_pressure_systolic" value="<?= $vital_sign->blood_pressure_systolic; ?>" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="blood_pressure_diastolic">Diastolic BP:</label>
                            <input type="text" class="form-control" id="blood_pressure_diastolic" name="blood_pressure_diastolic" value="<?= $vital_sign->blood_pressure_diastolic; ?>" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="pulse_rate">Pulse Rate:</label>
                            <input type="text" class="form-control" id="pulse_rate" name="pulse_rate" value="<?= $vital_sign->pulse_rate; ?>" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="respiration_rate">Respiration Rate:</label>
                            <input type="text" class="form-control" id="respiration_rate" name="respiration_rate" value="<?= $vital_sign->respiration_rate; ?>" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="temperature">Temperature:</label>
                            <input type="text" class="form-control" id="temperature" name="temperature" value="<?= $vital_sign->temperature; ?>" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="oxygen_saturation">Oxygen Saturation:</label>
                            <input type="text" class="form-control" id="oxygen_saturation" name="oxygen_saturation" value="<?= $vital_sign->oxygen_saturation; ?>" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="height">Height:</label>
                            <input type="text" class="form-control" id="height" name="height" value="<?= $vital_sign->height; ?>" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="weight">Weight:</label>
                            <input type="text" class="form-control" id="weight" name="weight" value="<?= $vital_sign->weight; ?>" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="bmi">BMI:</label>
                            <input type="text" class="form-control" id="bmi" name="bmi" value="<?= $vital_sign->bmi; ?>" required>
                        </div>
                    </div>

                    <!-- Form Submit Button -->
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                    <a href="<?= site_url('VitalSign/view/' . $vital_sign->id); ?>" class="btn btn-secondary mt-3">Cancel</a>
                </form>
            </div>
        </div>
    </main>
</div>
