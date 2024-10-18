<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create  Appointment</title>
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
                        <label for="lastname" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">contact_number:</label>
                        <input type="number" class="form-control" id="contact_number" name="contact_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="appointment_date" class="form-label">Appointment Date:</label>
                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="appointment_time" class="form-label">Appointment Time:</label>
                        <input type="time" class="form-control" id="appointment_time" name="appointment_time" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <!-- <a href="<?= base_url('onlineappointments'); ?>" class="btn btn-secondary">Back</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('disc/js/scripts.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>

    <!-- Optional: Include timepicker if needed -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
</body>
</html>
<script>
// Function to set the current date and restrict it to today only
function setCurrentDate() {
    const today = new Date();
    const dateInput = document.getElementById('appointment_date');
    dateInput.value = today.toISOString().split('T')[0]; // Set to current date
    dateInput.setAttribute('max', today.toISOString().split('T')[0]); // Max date is today
}

// Function to restrict appointment time based on current time and allowed slots
function restrictTimeSlots() {
    const timeInput = document.getElementById('appointment_time');
    const now = new Date();

    // Set the available time slots in an array, excluding lunch hour (11:30 AM - 12:30 PM)
    const availableSlots = [];
    for (let hour = 9; hour <= 16; hour++) { // Loop from 9 AM to 4 PM (inclusive)
        for (let minute = 0; minute < 60; minute += 30) { // 30-minute intervals
            // Skip the lunch hour completely
            if (hour === 11 && minute >= 30) continue; // Skip 11:30 AM onwards
            if (hour === 12) continue; // Skip entire lunch hour

            // Exclude 5:30 PM
            if (hour === 16 && minute === 30) continue; // Skip 5:30 PM

            const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
            availableSlots.push(timeString);
        }
    }

    // Get current time in HH:MM format
    const currentHour = now.getHours();
    const currentMinute = now.getMinutes();
    const currentTimeString = `${currentHour.toString().padStart(2, '0')}:${currentMinute.toString().padStart(2, '0')}`;
    
    // Filter available slots based on current time
    const filteredSlots = availableSlots.filter(slot => slot >= currentTimeString);

    // Set the time input options dynamically
    timeInput.innerHTML = ''; // Clear existing options
    filteredSlots.forEach(slot => {
        const option = document.createElement('option');
        option.value = slot;
        option.textContent = slot;
        timeInput.appendChild(option);
    });
}

// Function to validate custom time input
function validateCustomTime() {
    const timeInput = document.getElementById('appointment_time');
    const customTime = timeInput.value;

    // Check if the input is in a valid format (HH:MM)
    const timePattern = /^([0-1][0-9]|2[0-3]):[0-5][0-9]$/; // Validates HH:MM format
    if (timePattern.test(customTime)) {
        const [hour, minute] = customTime.split(':').map(Number);

        // Validation against restrictions
        if ((hour === 11 && minute >= 30) || hour === 12 || (hour === 16 && minute === 30)) {
            alert('Invalid time selected. Please choose a different time.');
            timeInput.value = ''; // Reset the input
        }
    } else {
        alert('Invalid time format. Please use HH:MM format.');
        timeInput.value = ''; // Reset the input
    }
}

// Call functions on page load
window.onload = function() {
    setCurrentDate();
    restrictTimeSlots();
};

// Attach event listener to validate custom time input
document.getElementById('appointment_time').addEventListener('change', validateCustomTime);
</script>
