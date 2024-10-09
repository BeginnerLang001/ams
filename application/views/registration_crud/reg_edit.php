<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php
    date_default_timezone_set('Asia/Manila'); // Set timezone to Philippine Time
    ?>
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
    </style>
    <script>
        // Function to calculate age based on birthday
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

        // Function to manage guardian fields based on marital status
        // function toggleGuardianInfo() {
        //     var maritalStatus = document.getElementById('marital_status').value;
        //     var isSingleDivorcedWidowed = (maritalStatus === 'Single' || maritalStatus === 'Divorced' || maritalStatus === 'Widowed');

        //     var fields = ['husband', 'husband_phone', 'occupation'];

        //     fields.forEach(function(field) {
        //         var element = document.getElementById(field);
        //         if (isSingleDivorcedWidowed) {
        //             element.value = 'N/A';
        //             element.setAttribute('readonly', 'readonly');
        //         } else {
        //             element.value = '';
        //             element.removeAttribute('readonly');
        //         }
        //     });
        // }
    </script>
</head>

<body>

    <div id="layoutSidenav_content">
        <main class="container mt-4">
            <h1>Update Information</h1>
            <hr>
            <?php echo form_open('registration/update/' . $registration->id); ?>
            <?php if (validation_errors()): ?>
                <div class="alert alert-danger"><?= validation_errors(); ?></div>
            <?php endif; ?>

            <div class="form-section">
                <h2>Patient Information</h2>
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">Name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name" value="<?= $registration->name ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mname" class="col-sm-4 col-form-label">Middle Name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="mname" name="mname" value="<?= $registration->mname ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lname" class="col-sm-4 col-form-label">Last Name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="lname" name="lname" value="<?= $registration->lname ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="marital_status" class="col-sm-4 col-form-label">Marital Status:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="marital_status" name="marital_status" value="<?= $registration->marital_status ?>">

                    </div>
                </div>


                <div class="form-group row">
                    <label for="birthday" class="col-sm-4 col-form-label">Birthday:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="birthday" name="birthday" onchange="calculateAge()" value="<?php echo $registration->birthday; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="age" class="col-sm-4 col-form-label">Age:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="age" name="age" readonly value="<?php echo $registration->age; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-4 col-form-label">Address:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address" name="address" value="<?= $registration->address ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="patient_contact_no" class="col-sm-4 col-form-label">Patients Contact No:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="patient_contact_no" name="patient_contact_no" value="<?= $registration->patient_contact_no ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="philhealth_id" class="col-sm-4 col-form-label">Philhealth ID:(IF ANY)</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" id="philhealth_id" name="philhealth_id" value="<?= $registration->philhealth_id ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_of_pregnancy" class="col-sm-4 col-form-label">Number of Pregnancies:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="no_of_pregnancy" name="no_of_pregnancy" value="<?= $registration->no_of_pregnancy ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_menstrual" class="col-sm-4 col-form-label">Last Menstrual:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="last_menstrual" name="last_menstrual" value="<?= $registration->last_menstrual ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="age_gestation" class="col-sm-4 col-form-label">Age of Gestation:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="age_gestation" name="age_gestation" value="<?= $registration->age_gestation ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expected_date_confinement" class="col-sm-4 col-form-label">Expected Date of Confinement:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="expected_date_confinement" name="expected_date_confinement" value="<?= $registration->expected_date_confinement ?>">
                    </div>
                </div>
            </div>

            <!-- Guardian's Information -->
            <div class="form-section">
                <h2>Guardian's Update</h2>
                <div class="form-group row">
                    <label for="husband" class="col-sm-4 col-form-label">Guardian's Name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="husband" name="husband" value="<?= $registration->husband ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="husband_phone" class="col-sm-4 col-form-label">Guardian's Phone:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="husband_phone" name="husband_phone" value="<?= $registration->husband_phone ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="occupation" class="col-sm-4 col-form-label">Relation to Guardian:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="occupation" name="occupation" value="<?= $registration->occupation ?>">
                    </div>
                </div>
            </div>
            <label for="created_at">Patient Created:</label>
            <span><?php echo isset($registration->created_at) ? date('Y-m-d H:i', strtotime($registration->created_at)) : ''; ?></span>
            <br>
            <label for="last_update">Last Update:</label>
            <span><?php echo isset($registration->last_update) ? date('Y-m-d H:i', strtotime($registration->last_update)) : ''; ?></span>




            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-danger" onclick="cancelUpdate()">Cancel</button>
            </div>

            <script>
                function cancelUpdate() {
                    // Redirect to the desired page
                    window.location.href = "<?php echo base_url('registration/patients'); ?>";
                }
            </script>

            <?php echo form_close(); ?>
        </main>
    </div>

</body>

</html>