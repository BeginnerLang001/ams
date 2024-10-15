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

                <!-- Patient Information Section -->
                <div class="form-section">
                    <h5>Patient Information</h5>
                    <hr>
                    <div class="grid-container">
                        <div class="grid-item form-group">
                            <label for="name">First Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="grid-item form-group">
                            <label for="mname">Middle Name:</label>
                            <input type="text" class="form-control" id="mname" name="mname">
                        </div>
                        <div class="grid-item form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" class="form-control" id="lname" name="lname" required>
                        </div>
                        <div class="grid-item form-group">
                            <label for="marital_status">Marital Status:</label>
                            <select class="form-control" id="marital_status" name="marital_status" required>
                                <option value="">Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                            </select>
                        </div>
                        <div class="grid-item form-group">
                            <label for="birthday">Birthday:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                        </div>
                        <div class="grid-item form-group">
                            <label for="age">Age:</label>
                            <input type="text" class="form-control" id="age" name="age" readonly>
                        </div>
                        <div class="grid-item form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="grid-item form-group">
                            <label for="patient_contact_no">Patient's Contact No:</label>
                            <input type="text" class="form-control" id="patient_contact_no" name="patient_contact_no">
                        </div>
                        <div class="grid-item form-group">
                            <label for="philhealth_id">PhilHealth ID (if any):</label>
                            <input type="number" class="form-control" id="philhealth_id" name="philhealth_id">
                        </div>
                    </div>
                </div>

                <!-- Obstetric History Section -->
                <div class="form-section">
                    <h5>Obstetric History</h5>
                    <hr>
                    <div class="grid-container">
                        <div class="grid-item form-group">
                            <label for="no_of_pregnancy">Number of Pregnancies:</label>
                            <input type="number" class="form-control" id="no_of_pregnancy" name="no_of_pregnancy">
                        </div>
                        <div class="grid-item form-group">
                            <label for="last_menstrual">Last Menstrual Period:</label>
                            <input type="date" class="form-control" id="last_menstrual" name="last_menstrual">
                        </div>
                        <div class="grid-item form-group">
                            <label for="age_gestation">Age of Gestation:</label>
                            <input type="text" class="form-control" id="age_gestation" name="age_gestation">
                        </div>
                        <div class="grid-item form-group">
                            <label for="expected_date_confinement">Expected Date of Confinement:</label>
                            <input type="date" class="form-control" id="expected_date_confinement" name="expected_date_confinement">
                        </div>
                    </div>
                </div>

                <!-- Guardian Information Section -->
                <div class="form-section">
                    <h5>Guardian Information</h5>
                    <hr>
                    <div class="grid-container">
                        <div class="grid-item form-group">
                            <label for="husband">Name of Guardian:</label>
                            <input type="text" class="form-control" id="husband" name="husband">
                        </div>
                        <div class="grid-item form-group">
                            <label for="husband_phone">Contact Number:</label>
                            <input type="text" class="form-control" id="husband_phone" name="husband_phone">
                        </div>
                        <div class="grid-item form-group">
                            <label for="occupation">Relation to the Patient:</label>
                            <input type="text" class="form-control" id="occupation" name="occupation">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </main>

    </div>

</body>
<script>
    document.getElementById('birthday').addEventListener('change', function() {
        const birthdayInput = this.value; 
        const birthday = new Date(birthdayInput); 
        const today = new Date(); 

        let age = today.getFullYear() - birthday.getFullYear(); 
        
        const monthDiff = today.getMonth() - birthday.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
            age--; 
        }

     
        const ageInput = document.getElementById('age');
        ageInput.value = age; 

        
        if (age < 0) {
            ageInput.style.color = 'red'; 
        } else {
            ageInput.style.color = ''; 
        }
    });
</script>

</html>