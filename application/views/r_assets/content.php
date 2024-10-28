<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Appointments: <?= $appointments_count; ?></div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Medical: <?= $medical_count; ?></div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Registration: <?= $registration_count; ?></div>
                    </div>
                </div>
            </div>
            <!-- Slot Counting Form -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-calendar-check me-1"></i>
        Count Available Appointment Slots
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="appointment_date" class="form-label">Select Appointment Date</label>
                        <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="count_slots" class="form-label">Count Available Slots</label>
                        <button type="submit" class="btn btn-primary">Check Slots</button>
                    </div>
                </div>
            </div>
        </form>
        
        <?php
        // Check if the form has been submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedDate = $_POST['appointment_date'];
            $totalSlots = 12;

            // Count appointments for the selected date
            $bookedSlots = 0;
            $bookedTimes = []; // Array to hold booked times

            foreach ($appointments as $appointment) {
                if (date('Y-m-d', strtotime($appointment['appointment_date'])) == $selectedDate) {
                    $bookedSlots++;
                    $bookedTimes[] = date('H:i', strtotime($appointment['appointment_time'])); // Store booked times
                }
            }

            foreach ($onlineappointments as $onlineappointment) {
                if (date('Y-m-d', strtotime($onlineappointment['appointment_date'])) == $selectedDate) {
                    $bookedSlots++;
                    $bookedTimes[] = date('H:i', strtotime($onlineappointment['appointment_time'])); // Store booked times
                }
            }

            $availableSlots = $totalSlots - $bookedSlots;
            echo "<div class='mt-3'>Available Slots for <strong>" . date('F d, Y', strtotime($selectedDate)) . "</strong>: <strong>$availableSlots</strong></div>";

            // Generate available times
            $allTimes = [];
            $currentTime = date('H:i'); // Get current time in H:i format

            for ($hour = 9; $hour <= 17; $hour++) { // 9 AM to 5 PM
                for ($minute = 0; $minute < 60; $minute += 30) {
                    $timeString = sprintf('%02d:%02d', $hour, $minute);
                    // Check if the time is 11:30 or 17:30 and skip them
                    if ($timeString == '11:30' || $timeString == '17:30') {
                        continue; // Skip these times
                    }
                    // Skip past times if the selected date is today
                    if ($selectedDate == date('Y-m-d') && $timeString < $currentTime) {
                        continue; // Skip times that are in the past for today
                    }
                    if (!in_array($timeString, $bookedTimes)) {
                        $allTimes[] = date('h:i A', strtotime($timeString)); // Store available times in 12-hour format
                    }
                }
            }

            // Display available times
            if (!empty($allTimes)) {
                echo "<div>Available Times:</div><ul>";
                foreach ($allTimes as $time) {
                    echo "<li>$time</li>";
                }
                echo "</ul>";
            } else {
                echo "<div>No available times for this date.</div>";
            }
        }
        ?>
    </div>
</div>



            <!-- Merged Appointments Table -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    All Appointments (Walk-In & Online)
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Appointment Date</th>
                                    <th>Appointment Time</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Array to hold all appointment times to detect duplicates
                                $appointmentTimes = [];
                                $currentDate = date('Y-m-d');

                                // Define status classes
                                $statusClasses = [
                                    'booked' => 'bg-success',
                                    'pending' => 'bg-warning text-dark',
                                    'approved' => 'bg-info',
                                    'completed' => 'bg-secondary',
                                    'cancelled' => 'bg-danger',
                                    'declined' => 'bg-danger',
                                ];

                                // Walk-In Appointments
                                foreach ($appointments as $appointment):
                                    $appointmentDate = date('Y-m-d', strtotime($appointment['appointment_date']));

                                    // Check if the appointment date is in the past
                                    if ($appointmentDate < $currentDate) {
                                        continue; // Skip past appointments
                                    }

                                    $appointmentDateTime = date('Y-m-d H:i', strtotime($appointment['appointment_date'] . ' ' . $appointment['appointment_time']));

                                    // Add appointment time to array
                                    if (!isset($appointmentTimes[$appointmentDateTime])) {
                                        $appointmentTimes[$appointmentDateTime] = 1;
                                    } else {
                                        $appointmentTimes[$appointmentDateTime]++;
                                    }

                                    // Skip hidden statuses
                                    $hiddenStatuses = ['approved', 'completed', 'declined', 'cancelled'];
                                    if (in_array($appointment['status'], $hiddenStatuses)) {
                                        continue;
                                    }

                                    // Check for duplicate time
                                    $highlightClass = $appointmentTimes[$appointmentDateTime] > 1 ? 'table-danger' : '';
                                ?>
                                    <tr class="<?= $highlightClass; ?>">
                                        <td><?= htmlspecialchars($appointment['patient_name']); ?></td>
                                        <td><?= date('F d, Y', strtotime($appointment['appointment_date'])); ?></td>
                                        <td><?= date('h:i A', strtotime($appointment['appointment_time'])); ?></td>
                                        <td>Walk-In</td>
                                        <td>
                                            <span class="badge <?= $statusClasses[$appointment['status']] ?? 'bg-secondary'; ?>">
                                                <?= ucfirst($appointment['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('appointments/edit/' . $appointment['id']); ?>" class="btn btn-warning btn-sm">Update Status</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <!-- Online Appointments -->
                                <?php foreach ($onlineappointments as $onlineappointment):
                                    $onlineAppointmentDate = date('Y-m-d', strtotime($onlineappointment['appointment_date']));

                                    // Check if the online appointment date is in the past
                                    if ($onlineAppointmentDate < $currentDate) {
                                        continue; // Skip past appointments
                                    }

                                    $onlineAppointmentDateTime = date('Y-m-d H:i', strtotime($onlineappointment['appointment_date'] . ' ' . $onlineappointment['appointment_time']));

                                    // Add online appointment time to array
                                    if (!isset($appointmentTimes[$onlineAppointmentDateTime])) {
                                        $appointmentTimes[$onlineAppointmentDateTime] = 1;
                                    } else {
                                        $appointmentTimes[$onlineAppointmentDateTime]++;
                                    }

                                    // Skip hidden statuses
                                    $status = $onlineappointment['STATUS'] ?? 'pending';
                                    if ($status !== 'cancelled' && $status !== 'completed'):
                                        // Check for duplicate time
                                        $highlightClass = $appointmentTimes[$onlineAppointmentDateTime] > 1 ? 'table-danger' : '';
                                ?>
                                        <tr class="<?= $highlightClass; ?>">
                                            <td><?= htmlspecialchars($onlineappointment['firstname']) . ' ' . htmlspecialchars($onlineappointment['lastname']); ?></td>
                                            <td><?= date('F d, Y', strtotime($onlineappointment['appointment_date'])); ?></td>
                                            <td><?= date('h:i A', strtotime($onlineappointment['appointment_time'])); ?></td>
                                            <td>Online</td>
                                            <td>
                                                <span class="badge <?= $statusClasses[$status] ?? 'bg-secondary'; ?>">
                                                    <?= ucfirst($status); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('onlineappointments/edit/' . $onlineappointment['id']); ?>" class="btn btn-warning btn-sm">Update Status</a>

                                                <!-- Email Button -->
                                                <?php
                                                $status_value = isset($onlineappointment['STATUS']) ? $onlineappointment['STATUS'] : 'Unknown Status';
                                                if ($status_value === 'booked'): ?>
                                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= urlencode($onlineappointment['email']); ?>&su=Appointment%20Booked&body=Good%20day%20Ms/Mrs!%20<?= urlencode($onlineappointment['firstname'] . ' ' . $onlineappointment['lastname']); ?>,%0AThis%20is%20from%20Mendoza%20OBGYN%20Clinic!%0AWe%20are%20pleased%20to%20confirm%20that%20your%20appointment%20is%20booked%20for%20the%20following:%0ADate:%20<?= urlencode(date('F d, Y', strtotime($onlineappointment['appointment_date']))); ?>%0AScheduled%20Time:%20<?= urlencode(date('h:i A', strtotime($onlineappointment['appointment_time']))); ?>%0AAddress:%20Mendoza%20General%20Hospital,%20A%20Morales%20St.%20Santa%20Maria%20Bulacan%0A%0APlease%20go%20on%20time%20or%20message%20us%20if%20you%20cancel%20your%20appointment%20at%20least%203%20business%20days%20in%20advance.%0A%0AThank%20you%20for%20choosing%20us!" target="_blank" class="btn btn-success btn-sm">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-muted">No Email Available</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
