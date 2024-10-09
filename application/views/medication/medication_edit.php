<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h3>Medical Record</h3>
        <hr>

        <form action="<?= site_url('medication/update'); ?>" method="post">
            <input type="hidden" name="id" value="<?= htmlspecialchars($medication['id']); ?>">

            <!-- Error Message -->
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <!-- Success Message -->
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

                <div class="row mb-3">
                    <label class="col-sm-6 col-form-label">Ear, Nose, Throat Disorders:</label>
                    <div class="col-sm-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ear_nose_throat_disorders" id="ent_yes" value="1" <?= $medication['ear_nose_throat_disorders'] == 1 ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="ent_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ear_nose_throat_disorders" id="ent_no" value="2" <?= $medication['ear_nose_throat_disorders'] == 2 ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="ent_no">No</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-6 col-form-label">Heart Conditions / High Blood Pressure:</label>
                    <div class="col-sm-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="heart_conditions_high_blood_pressure" id="heart_yes" value="1" <?= $medication['heart_conditions_high_blood_pressure'] == 1 ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="heart_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="heart_conditions_high_blood_pressure" id="heart_no" value="2" <?= $medication['heart_conditions_high_blood_pressure'] == 2 ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="heart_no">No</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-6 col-form-label">Respiratory Issues (Tuberculosis, Asthma):</label>
                    <div class="col-sm-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="respiratory_tuberculosis_asthma" id="respiratory_yes" value="1" <?= $medication['respiratory_tuberculosis_asthma'] == 1 ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="respiratory_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="respiratory_tuberculosis_asthma" id="respiratory_no" value="2" <?= $medication['respiratory_tuberculosis_asthma'] == 2 ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="respiratory_no">No</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-6 col-form-label">Neurologic Issues (Migraines, Frequent Headaches):</label>
                    <div class="col-sm-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="neurologic_migraines_frequent_headaches" id="neurologic_yes" value="1" <?= $medication['neurologic_migraines_frequent_headaches'] == 1 ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="neurologic_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="neurologic_migraines_frequent_headaches" id="neurologic_no" value="2" <?= $medication['neurologic_migraines_frequent_headaches'] == 2 ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="neurologic_no">No</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-6 col-form-label">Gonorrhea / Chlamydia / Syphilis:</label>
                    <div class="col-sm-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gonorrhea_chlamydia_syphilis" id="std_yes" value="1" <?= $medication['gonorrhea_chlamydia_syphilis'] == 1 ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="std_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gonorrhea_chlamydia_syphilis" id="std_no" value="2" <?= $medication['gonorrhea_chlamydia_syphilis'] == 2 ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="std_no">No</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </main>
</div>

<script>
    function updateCheckboxValue(id) {
        // Get the checkbox and corresponding hidden input elements by dynamic ID
        var checkbox = document.getElementById(id + '_checkbox');
        var hiddenInput = document.getElementById(id + '_hidden');

        // Update hidden input value based on checkbox state
        if (checkbox.checked) {
            hiddenInput.value = '1'; // Set value to 1 if checked (Yes)
        } else {
            hiddenInput.value = '2'; // Set value to 2 if unchecked (No)
        }
    }
</script>