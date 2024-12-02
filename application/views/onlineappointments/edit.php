<div id="layoutSidenav_content">
    <div class="">
        <h1 class="mb-4">Edit Appointment</h1>
        <form action="<?= base_url('onlineappointments/online_update/' . $registration['id']); ?>" method="POST">
            <div class="row">
                <!-- First column -->
                <div class="col-md-6">
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email', $registration['email']); ?>" placeholder="Enter email" required>
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= set_value('name', $registration['name']); ?>" placeholder="Enter first name" required>
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="mname" class="form-label">Middle Name:</label>
                        <input type="text" class="form-control" id="mname" name="mname" value="<?= set_value('mname', $registration['mname']); ?>" placeholder="Enter middle name">
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="lname" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lname" name="lname" value="<?= set_value('lname', $registration['lname']); ?>" placeholder="Enter last name" required>
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="philhealth_id" class="form-label">PhilHealth ID:</label>
                        <input type="text" class="form-control" id="philhealth_id" name="philhealth_id" value="<?= set_value('philhealth_id', $registration['philhealth_id']); ?>" placeholder="Enter PhilHealth ID (optional)" maxlength="50">
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="birthday" class="form-label">Birthday:</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?= set_value('birthday', $registration['birthday']); ?>" required>
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="age" class="form-label">Age:</label>
                        <input type="number" class="form-control" id="age" name="age" value="<?= set_value('age', $registration['age']); ?>" placeholder="Enter age" required>
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="status" class="form-label">Status</label>
                        <select name="appointment_status" id="appointment_status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="pending" <?= set_select('appointment_status', 'pending', $registration['appointment_status'] == 'pending'); ?>>Pending</option>
                            <option value="booked" <?= set_select('appointment_status', 'booked', $registration['appointment_status'] == 'booked'); ?>>Booked</option>
                            <option value="cancelled" <?= set_select('appointment_status', 'cancelled', $registration['appointment_status'] == 'cancelled'); ?>>Cancelled</option>
                            <!-- <option value="in_session" <?= set_select('appointment_status', 'in_session', $registration['appointment_status'] == 'in_session'); ?>>In Session</option> -->
                            <option value="completed" <?= set_select('appointment_status', 'completed', $registration['appointment_status'] == 'completed'); ?>>Completed</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a status.
                        </div>
                    </div>
                </div>
                

                <!-- Second column -->
                <div class="col-md-6">
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= set_value('address', $registration['address']); ?>" placeholder="Enter address" required>
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="patient_contact_no" class="form-label">Contact Number:</label>
                        <input type="tel" class="form-control" id="patient_contact_no" name="patient_contact_no" value="<?= set_value('patient_contact_no', $registration['patient_contact_no']); ?>" placeholder="Enter contact number" required>
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="marital_status" class="form-label">Marital Status:</label>
                        <select class="form-select" id="marital_status" name="marital_status" required>
                            <option value="single" <?= set_select('marital_status', 'single', $registration['marital_status'] == 'single'); ?>>Single</option>
                            <option value="married" <?= set_select('marital_status', 'married', $registration['marital_status'] == 'married'); ?>>Married</option>
                            <option value="divorced" <?= set_select('marital_status', 'divorced', $registration['marital_status'] == 'divorced'); ?>>Divorced</option>
                            <option value="widowed" <?= set_select('marital_status', 'widowed', $registration['marital_status'] == 'widowed'); ?>>Widowed</option>
                        </select>
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="husband" class="form-label">Name of Guardian (if applicable):</label>
                        <input type="text" class="form-control" id="husband" name="husband" value="<?= set_value('husband', $registration['husband']); ?>" placeholder="Enter Guardian name">
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="husband_phone" class="form-label">Contact Number:</label>
                        <input type="tel" class="form-control" id="husband_phone" name="husband_phone" value="<?= set_value('husband_phone', $registration['husband_phone']); ?>" placeholder="Enter Guardian phone number">
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="occupation" class="form-label">Relation to the Patient:</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" value="<?= set_value('occupation', $registration['occupation']); ?>" placeholder="Enter relation" required>
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="appointment_date" class="form-label">Appointment Date:</label>
                        <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?= set_value('appointment_date', $registration['appointment_date']); ?>" required>
                    </div>
                    <div class="mb-4 p-3 border border-light rounded shadow-sm">
                        <label for="appointment_time" class="form-label">Appointment Time:</label>
                        <select class="form-control" id="appointment_time" name="appointment_time" required>
                            <?php 
                            $times = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'];
                            foreach ($times as $time) {
                                $selected = ($registration['appointment_time'] == $time) ? 'selected' : '';
                                echo "<option value=\"$time\" $selected>$time</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="<?= base_url('dashboard/admin'); ?>" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    <!-- Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const appointmentDateInput = document.getElementById("appointment_date");
            const appointmentTimeSelect = document.getElementById("appointment_time");

            // Set min date to today and set today's date as default
            const today = new Date();
            const philippinesTimeOffset = 8 * 60; // Offset in minutes for UTC+8
            today.setMinutes(today.getMinutes() + today.getTimezoneOffset() + philippinesTimeOffset);

            const todayString = today.toISOString().split("T")[0];
            appointmentDateInput.setAttribute("min", todayString);
            appointmentDateInput.value = todayString; // Set current date as default

            // Define lunch break slots for exclusion
            const lunchBreakSlots = [{
                    hour: 11,
                    minute: 30
                },
                {
                    hour: 12,
                    minute: 0
                },
                {
                    hour: 17,
                    minute: 0
                },
                {
                    hour: 17,
                    minute: 30
                }

            ];

            // Helper function to check if the time is within lunch break
            function isLunchBreak(hour, minute) {
                return lunchBreakSlots.some(slot => slot.hour === hour && slot.minute === minute);
            }

            // Function to populate time slots based on selected date and current time
            function populateTimeSlots() {
                const selectedDate = new Date(appointmentDateInput.value);
                const now = new Date();
                now.setMinutes(now.getMinutes() + now.getTimezoneOffset() + philippinesTimeOffset); // Convert current time to Philippine time

                // Clear previous options
                appointmentTimeSelect.innerHTML = "";

                // Generate time options in 30-minute intervals from the current time to 5:00 PM Philippine time
                if (selectedDate.toDateString() === now.toDateString()) {
                    let startHour = now.getHours();
                    let startMinute = now.getMinutes() >= 30 ? 30 : 0;
                    const endHour = 17;

                    for (let hour = startHour; hour <= endHour; hour++) {
                        for (let minute = startMinute; minute < 60; minute += 30) {
                            if (isLunchBreak(hour, minute)) continue;

                            const option = document.createElement("option");
                            const formattedHour = hour > 12 ? hour - 12 : hour; // Convert to 12-hour format
                            const formattedMinute = minute === 0 ? '00' : minute;
                            const amPm = hour >= 12 ? 'PM' : 'AM';

                            option.value = `${hour.toString().padStart(2, '0')}:${formattedMinute}`; // Store as 'HH:MM'
                            option.textContent = `${formattedHour}:${formattedMinute} ${amPm}`; // Display in 12-hour format
                            appointmentTimeSelect.appendChild(option);
                        }
                        startMinute = 0; // Reset startMinute after the first hour
                    }
                } else {
                    // For other future dates, show all slots from 9:00 AM to 5:00 PM
                    for (let hour = 9; hour <= 17; hour++) {
                        for (let minute = 0; minute < 60; minute += 30) {
                            if (isLunchBreak(hour, minute)) continue;

                            const option = document.createElement("option");
                            const formattedHour = hour > 12 ? hour - 12 : hour;
                            const formattedMinute = minute === 0 ? '00' : minute;
                            const amPm = hour >= 12 ? 'PM' : 'AM';

                            option.value = `${hour.toString().padStart(2, '0')}:${formattedMinute}`;
                            option.textContent = `${formattedHour}:${formattedMinute} ${amPm}`;
                            appointmentTimeSelect.appendChild(option);
                        }
                    }
                }
            }

            // Update time slots every minute to ensure past times are removed
            setInterval(() => {
                if (appointmentDateInput.value === todayString) {
                    populateTimeSlots();
                }
            }, 60000); // Refresh every 60 seconds

            // Initial population of time slots
            appointmentDateInput.addEventListener("change", populateTimeSlots);
            populateTimeSlots();
        });
    </script>
    <script>
        // Function to set the current date and restrict it to today only
        function setCurrentDate() {
            const today = new Date();
            const dateInput = document.getElementById('appointment_date');
            dateInput.setAttribute('max', today.toISOString().split('T')[0]); // Max date is today
        }

        // Function to populate the appointment time slots
        function populateTimeSlots() {
            const timeInput = document.getElementById('appointment_time');
            const now = new Date();
            const availableSlots = [];

            // Loop from 9 AM to 4 PM in 30-minute intervals excluding lunch hour (11:30 AM - 12:30 PM)
            for (let hour = 9; hour <= 15; hour++) {
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

            // Populate the dropdown with available slots and pre-select the existing time
            filteredSlots.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot;
                option.textContent = slot;
                if (slot === '<?= $registration['appointment_time']; ?>') {
                    option.selected = true;
                }
                timeInput.appendChild(option);
            });
        }

        // Call functions on page load
        window.onload = function() {
            setCurrentDate();
            populateTimeSlots();
        };
    </script>
