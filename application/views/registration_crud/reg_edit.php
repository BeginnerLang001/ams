<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-section {
            margin-bottom: 30px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .grid-item {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
    <script>
        function calculateAge() {
            var today = new Date();
            var birthDate = new Date(document.getElementById("birthday").value);
            var age = today.getFullYear() - birthDate.getFullYear();
            var monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById("age").value = age;
        }

        function cancelUpdate() {
            window.location.href = "<?php echo base_url('registration/patients'); ?>";
        }
    </script>
</head>

<body>
    <div id="layoutSidenav_content">
        <main>
            <div class="container">
                <h1>Update Patient Information</h1>
                <hr>
                <?php echo form_open('registration/update/' . $registration->id); ?>
                <?php if (validation_errors()): ?>
                    <div class="alert alert-danger"><?= validation_errors(); ?></div>
                <?php endif; ?>

                <!-- Patient Information Section -->
                <div class="form-section">
                    <h5>Patient Information</h5>
                    <hr>
                    <div class="grid-container">
                        <div class="grid-item form-group">
                            <label for="name">First Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $registration->name ?>" readonly>
                        </div>
                        <div class="grid-item form-group">
                            <label for="mname">Middle Name:</label>
                            <input type="text" class="form-control" id="mname" name="mname" value="<?= $registration->mname ?>" readonly>
                        </div>
                        <div class="grid-item form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" class="form-control" id="lname" name="lname" value="<?= $registration->lname ?>" readonly>
                        </div>
                        <div class="grid-item form-group">
                            <label for="marital_status">Marital Status:</label>
                            <input type="text" class="form-control" id="marital_status" name="marital_status" value="<?= $registration->marital_status ?>" readonly>
                        </div>
                        <div class="grid-item form-group">
                            <label for="birthday">Birthday:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $registration->birthday ?>" onchange="calculateAge()" readonly>
                        </div>
                        <div class="grid-item form-group">
                            <label for="age">Age:</label>
                            <input type="text" class="form-control" id="age" name="age" value="<?= $registration->age ?>" readonly>
                        </div>
                        <div class="grid-item form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $registration->address ?>" required>
                        </div>
                        <div class="grid-item form-group">
                            <label for="patient_contact_no">Patient's Contact No:</label>
                            <input type="text" class="form-control" id="patient_contact_no" name="patient_contact_no" value="<?= $registration->patient_contact_no ?>" required>
                        </div>
                        <div class="grid-item form-group">
                            <label for="philhealth_id">PhilHealth ID (if any):</label>
                            <input type="number" class="form-control" id="philhealth_id" name="philhealth_id" value="<?= $registration->philhealth_id ?>">
                        </div>
                    </div>
                </div>

                <!-- Obstetric History Section
                <div class="form-section">
                    <h5>Obstetric History</h5>
                    <hr>
                    <div class="grid-container">
                        <div class="grid-item form-group">
                            <label for="no_of_pregnancy">Number of Pregnancies:</label>
                            <input type="number" class="form-control" id="no_of_pregnancy" name="no_of_pregnancy" value="<?= $registration->no_of_pregnancy ?>">
                        </div>
                        <div class="grid-item form-group">
                            <label for="last_menstrual">Last Menstrual Period:</label>
                            <input type="date" class="form-control" id="last_menstrual" name="last_menstrual" value="<?= $registration->last_menstrual ?>">
                        </div>
                        <div class="grid-item form-group">
                            <label for="age_gestation">Age of Gestation:</label>
                            <input type="text" class="form-control" id="age_gestation" name="age_gestation" value="<?= $registration->age_gestation ?>">
                        </div>
                        <div class="grid-item form-group">
                            <label for="expected_date_confinement">Expected Date of Confinement:</label>
                            <input type="date" class="form-control" id="expected_date_confinement" name="expected_date_confinement" value="<?= $registration->expected_date_confinement ?>">
                        </div>
                    </div>
                </div> -->

                <!-- Guardian Information Section -->
                <div class="form-section">
                    <h5>Guardian Information</h5>
                    <hr>
                    <div class="grid-container">
                        <div class="grid-item form-group">
                            <label for="husband">Name of Guardian:</label>
                            <input type="text" class="form-control" id="husband" name="husband" value="<?= $registration->husband ?>">
                        </div>
                        <div class="grid-item form-group">
                            <label for="husband_phone">Contact Number:</label>
                            <input type="text" class="form-control" id="husband_phone" name="husband_phone" value="<?= $registration->husband_phone ?>">
                        </div>
                        <div class="grid-item form-group">
                            <label for="occupation">Relation to the Patient:</label>
                            <input type="text" class="form-control" id="occupation" name="occupation" value="<?= $registration->occupation ?>">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-danger" onclick="cancelUpdate()">Cancel</button>
                </div>

                <?php echo form_close(); ?>
            </div>
        </main>
    </div>
</body>

</html>
