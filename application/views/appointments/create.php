<!-- fromcpupdate -->
<div id="layoutSidenav_content">
<main class="container mt-4">
    <div class="container h-10">
        <div class="row justify-content-center">
            <div class="col-lg-10 h-10">
                <div>
                    <h1 class="mt-4">Set Appointment</h1>
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <?php echo form_open('appointments/create', ['class' => 'needs-validation', 'novalidate' => '']); ?>
                    
                    <!-- Hidden input for patient_id -->
                    <input type="hidden" name="patient_id" value="<?php echo isset($patient) && $patient ? $patient['id'] : ''; ?>">

                    <div>
            <label>Patient Name:</label>
            <p><?php echo htmlspecialchars($patient['name'] . ' ' . $patient['mname'] . ' ' . $patient['lname']); ?></p>
        </div>

                    <div class="mb-3">
                        <label for="appointment_date" class="form-label">Date</label>
                        <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
                        <div class="invalid-feedback">
                            Please select a date.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="appointment_time" class="form-label">Time</label>
                        <select name="appointment_time" id="appointment_time" class="form-control" required>
                            <option value="">Select a time slot</option>
                            <!-- Time slot options will be added dynamically via JavaScript -->
                        </select>
                        <div class="invalid-feedback">
                            Please select a time.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="doctor" class="form-label">Doctor</label>
                        <input type="text" name="doctor" id="doctor" class="form-control" 
                            value="<?php echo set_value('doctor', $doctor); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                            <option value="arrived">Arrived</option>
                            <option value="on-going">On-going</option>
                            <option value="confirmed">Confirmed</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a status.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Appointment</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#appointment_time').timepicker({
            timeFormat: 'hh:mm p',
            interval: 30, // Time intervals (30 mins)
            minTime: '12:00am',
            maxTime: '11:59pm',
            defaultTime: '09:00am',
            startTime: '12:00am',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>
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

        appointmentDateInput.addEventListener("change", function() {
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
                        // Skip the lunch break
                        if ((hour === 11 && minute === 30) || (hour === 12 && minute === 0)) {
                            continue; // Skip 11:30 AM and 12:00 PM
                        }

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
                        if ((hour === 11 && minute === 30) || (hour === 12 && minute === 0)) {
                            continue; // Skip 11:30 AM and 12:00 PM
                        }

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
        });

        // Trigger change event to populate initial time slots
        appointmentDateInput.dispatchEvent(new Event("change"));
    });
</script>
<script>
    $(document).ready(function() {
        // Trigger search when typing in the search box
        $('#patient_search').on('input', function() {
            const query = $(this).val();

            if (query.length >= 2) { // Only search if at least 2 characters are typed
                $.ajax({
                    url: '<?php echo site_url('appointments/search_patient'); ?>',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        // Clear previous results
                        $('#patient_list').empty();

                        const patients = JSON.parse(response);

                        // Populate the list with search results
                        patients.forEach(patient => {
                            const listItem = $('<a>')
                                .addClass('list-group-item list-group-item-action')
                                .text(patient.full_name)
                                .attr('data-id', patient.id)
                                .attr('href', '#');

                            $('#patient_list').append(listItem);
                        });

                        $('#patient_list').show();
                    }
                });
            } else {
                $('#patient_list').hide();
            }
        });

        // Handle patient selection from the list
        $('#patient_list').on('click', 'a', function(e) {
            e.preventDefault();
            const selectedPatient = $(this).text();
            const selectedPatientId = $(this).data('id');

            $('#patient_search').val(selectedPatient);
            $('#patient_id').val(selectedPatientId);
            $('#patient_list').hide();
        });

        // Hide patient list when clicking outside
        $(document).click(function(event) {
            if (!$(event.target).closest('#patient_search, #patient_list').length) {
                $('#patient_list').hide();
            }
        });
    });
</script>