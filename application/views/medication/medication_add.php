<div id="layoutSidenav_content">
    <main class="container mt-4">
        <div class="container">

            <h3>Health Conditions</h3>
            <h4>Name: <span style="text-decoration: underline;"><?php echo strtoupper($patient_name); ?></span></h4>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <?php echo validation_errors(); // Display validation errors ?>
            <input type="hidden" name="registration_id" value="<?php echo $registration_id; ?>">
            
            <form action="<?php echo site_url('medication/store'); ?>" method="post">

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="ent_yes">Ear, Nose, Throat Disorders:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ear_nose_throat_disorders" id="ent_yes" value="1" required>
                                <label class="form-check-label" for="ent_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ear_nose_throat_disorders" id="ent_no" value="2" required>
                                <label class="form-check-label" for="ent_no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="heart_yes">Heart Conditions / High Blood Pressure:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="heart_conditions_high_blood_pressure" id="heart_yes" value="1" required>
                                <label class="form-check-label" for="heart_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="heart_conditions_high_blood_pressure" id="heart_no" value="2" required>
                                <label class="form-check-label" for="heart_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="respiratory_yes">Respiratory Issues (Tuberculosis, Asthma):</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="respiratory_tuberculosis_asthma" id="respiratory_yes" value="1" required>
                                <label class="form-check-label" for="respiratory_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="respiratory_tuberculosis_asthma" id="respiratory_no" value="2" required>
                                <label class="form-check-label" for="respiratory_no">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="neurologic_yes">Neurologic Issues (Migraines, Frequent Headaches):</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="neurologic_migraines_frequent_headaches" id="neurologic_yes" value="1" required>
                                <label class="form-check-label" for="neurologic_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="neurologic_migraines_frequent_headaches" id="neurologic_no" value="2" required>
                                <label class="form-check-label" for="neurologic_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-outline">
                            <label class="form-label" for="std_yes">Gonorrhea / Chlamydia / Syphilis:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gonorrhea_chlamydia_syphilis" id="std_yes" value="1" required>
                                <label class="form-check-label" for="std_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gonorrhea_chlamydia_syphilis" id="std_no" value="2" required>
                                <label class="form-check-label" for="std_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="registration_id" value="<?php echo $registration_id; ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </main>
</div>
