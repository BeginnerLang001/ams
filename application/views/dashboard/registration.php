<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration Form</title>
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
    </style>
</head>

<body>
    <div id="layoutSidenav_content">
        <main>
            <?php echo form_open('registration/submit', ['class' => 'form-horizontal']); ?>
                <div class="container">
                    <h1>New Patient Registration</h1>
                    <?php if ($this->session->flashdata('upld_err')): ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('upld_err') ?></div>
                    <?php endif; ?>
                    <div class="form-section">
                        <h5>Patient Information</h5>
                        <hr>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mname" class="col-sm-4 col-form-label">Middle Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mname" name="mname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lname" class="col-sm-4 col-form-label">Last Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="lname" name="lname" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="marital_status" class="col-sm-4 col-form-label">Marital Status:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="marital_status" name="marital_status" required>
                                    <option value="">Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birthday" class="col-sm-4 col-form-label">Birthday:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="birthday" name="birthday" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-sm-4 col-form-label">Age:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="age" name="age" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-4 col-form-label">Address:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="patient_contact_no" class="col-sm-4 col-form-label">Patient's Contact No:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="patient_contact_no" name="patient_contact_no">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="philhealth_id" class="col-sm-4 col-form-label">PhilHealth ID (if any):</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="philhealth_id" name="philhealth_id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_of_pregnancy" class="col-sm-4 col-form-label">Number of Pregnancies:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="no_of_pregnancy" name="no_of_pregnancy">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_menstrual" class="col-sm-4 col-form-label">Last Menstrual Period:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="last_menstrual" name="last_menstrual">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age_gestation" class="col-sm-4 col-form-label">Age of Gestation:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="age_gestation" name="age_gestation">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="expected_date_confinement" class="col-sm-4 col-form-label">Expected Date of Confinement:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="expected_date_confinement" name="expected_date_confinement">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5>Guardian Information</h5>
                        <hr>
                        <div class="form-group row">
                            <label for="husband" class="col-sm-4 col-form-label">Name of Guardian:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="husband" name="husband">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="husband_phone" class="col-sm-4 col-form-label">Contact Number:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="husband_phone" name="husband_phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="occupation" class="col-sm-4 col-form-label">Relation to the Patient:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="occupation" name="occupation">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-5 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </main>
    </div>

</body>
<script>
    document.getElementById('birthday').addEventListener('change', function() {
        const birthdayInput = this.value; // Get the value of the birthday input
        const birthday = new Date(birthdayInput); // Convert to Date object
        const today = new Date(); // Get today's date
        
        let age = today.getFullYear() - birthday.getFullYear(); // Calculate age
        
        // Check if the birthday has occurred this year
        const monthDiff = today.getMonth() - birthday.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
            age--; // Decrease age if birthday hasn't occurred yet this year
        }

        // Set the calculated age in the age input
        const ageInput = document.getElementById('age');
        ageInput.value = age; // Set the age value

        // Change text color to red if age is negative
        if (age < 0) {
            ageInput.style.color = 'red'; // Change text color to red
        } else {
            ageInput.style.color = ''; // Reset color if age is valid
        }
    });
</script>

</html>
