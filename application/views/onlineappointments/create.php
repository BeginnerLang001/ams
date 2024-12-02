<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            background-color: #ffffff; /* White background */
            border: 1px solid #ddd; /* Light gray border */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Light shadow */
        }
    </style>
</head>
<body>
    <div id="layoutSidenav_content">
        <div class="container my-4">
            <div class="form-container p-4">
                <h1 class="mb-4">Create New Appointment</h1>
                <form action="<?= base_url('onlineappointments/store'); ?>" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name" required>
                    </div>
                    <div class="mb-3">
                        <label for="mname" class="form-label">Middle Name:</label>
                        <input type="text" class="form-control" id="mname" name="mname" placeholder="Enter middle name">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name" required>
                    </div>
                    <div class="mb-3">
                        <label for="philhealth_id" class="form-label">PhilHealth ID:</label>
                        <input type="text" class="form-control" id="philhealth_id" name="philhealth_id" placeholder="Enter PhilHealth ID (optional)" maxlength="50">
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday:</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age:</label>
                        <input type="number" class="form-control" id="age" name="age" placeholder="Enter age" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required>
                    </div>
                    <div class="mb-3">
                        <label for="patient_contact_no" class="form-label">Contact Number:</label>
                        <input type="tel" class="form-control" id="patient_contact_no" name="patient_contact_no" placeholder="Enter contact number" required>
                    </div>
                    <div class="mb-3">
                        <label for="marital_status" class="form-label">Marital Status:</label>
                        <select class="form-select" id="marital_status" name="marital_status" required>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="husband" class="form-label">Name of Guardian (if applicable):</label>
                        <input type="text" class="form-control" id="husband" name="husband" placeholder="Enter husband's name">
                    </div>
                    <div class="mb-3">
                        <label for="husband_phone" class="form-label">Contact Number:</label>
                        <input type="tel" class="form-control" id="husband_phone" name="husband_phone" placeholder="Enter husband's phone number">
                    </div>
                    <div class="mb-3">
                        <label for="occupation" class="form-label">Relation to the Patient:</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" placeholder="Enter occupation" required>
                    </div>
                    
                    
                    <div class="mb-3">
                        <label for="appointment_date" class="form-label">Appointment Date:</label>
                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="appointment_time" class="form-label">Appointment Time:</label>
                        <select class="form-control" id="appointment_time" name="appointment_time" required>
                            <!-- Time options will be populated by JavaScript -->
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="<?= base_url('onlineappointments'); ?>" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Function to set the current date and restrict it to today only
        function setCurrentDate() {
            const today = new Date();
            const dateInput = document.getElementById('appointment_date');
            dateInput.value = today.toISOString().split('T')[0]; // Set to current date
            dateInput.setAttribute('max', today.toISOString().split('T')[0]); // Max date is today
        }

        // Function to restrict appointment time slots
        function populateTimeSlots() {
            const timeInput = document.getElementById('appointment_time');
            const now = new Date();
            const availableSlots = [];
            
            // Loop from 9 AM to 4 PM in 30-minute intervals excluding lunch hour (11:30 AM - 12:30 PM)
            for (let hour = 9; hour <= 16; hour++) {
                for (let minute = 0; minute < 60; minute += 30) {
                    if ((hour === 11 && minute >= 30) || hour === 12 || (hour === 16 && minute === 30)) {
                        continue;
                    }
                    const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    availableSlots.push(timeString);
                }
            }

            const currentTimeString = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
            const filteredSlots = availableSlots.filter(slot => slot >= currentTimeString);

            // Populate the dropdown with available slots
            filteredSlots.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot;
                option.textContent = slot;
                timeInput.appendChild(option);
            });
        }

        // Call functions on page load
        window.onload = function() {
            setCurrentDate();
            populateTimeSlots();
        };
    </script>
</body>
</html>
