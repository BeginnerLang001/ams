<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <br>
            <div class="row mb-4">
                <div class="col-xl-4 col-md-6">
                    <div class="card shadow bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-calendar-alt me-2 fa-2x"></i>
                            <div>
                                <h5 class="card-title">Appointments</h5>
                                <p class="card-text"><?= $appointments_count + $onlineappointments_count; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card shadow bg-warning text-white mb-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-medkit me-2 fa-2x"></i>
                            <div>
                                <h5 class="card-title">Initial Check up</h5>
                                <p class="card-text"><?= $vitalsign_count; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card shadow bg-success text-white mb-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-user-check me-2 fa-2x"></i>
                            <div>
                                <h5 class="card-title">Registration</h5>
                                <p class="card-text"><?= $registration_count; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card shadow bg-success text-white mb-4">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-user-check me-2 fa-2x"></i>
                            <div>
                                <h5 class="card-title">Findings</h5>
                                <p class="card-text"><?= $findings_count; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-4">
                <div class="row mb-4">
                    <!-- Patients Statistics Chart -->
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Patients Statistic</h5>
                                <canvas id="linearChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Available Appointment Slots Form -->
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-header">
                                <i class="fas fa-calendar-check me-1"></i>
                                Available Appointment Slots
                            </div>
                            <div class="card-body">
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="appointment_date" class="form-label">Select Appointment Date</label>
                                                <input type="date" name="appointment_date" id="appointment_date" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">&nbsp;</label>
                                                <button type="submit" class="btn btn-primary w-100">Check Slots</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $selectedDate = $_POST['appointment_date'];
                                    $totalSlots = 14;

                                    $bookedSlots = 0;
                                    $bookedTimes = [];

                                    foreach ($appointments as $appointment) {
                                        if (date('Y-m-d', strtotime($appointment['appointment_date'])) == $selectedDate) {
                                            $bookedSlots++;
                                            $bookedTimes[] = date('H:i', strtotime($appointment['appointment_time']));
                                        }
                                    }

                                    foreach ($onlineappointments as $onlineappointment) {
                                        if (date('Y-m-d', strtotime($onlineappointment['appointment_date'])) == $selectedDate) {
                                            $bookedSlots++;
                                            $bookedTimes[] = date('H:i', strtotime($onlineappointment['appointment_time']));
                                        }
                                    }

                                    $availableSlots = $totalSlots - $bookedSlots;
                                    echo "<div class='mt-3'>Available Slots for <strong>" . date('F d, Y', strtotime($selectedDate)) . "</strong>: <strong>$availableSlots</strong></div>";

                                    $allTimes = [];
                                    $currentTime = date('H:i');

                                    for ($hour = 9; $hour <= 17; $hour++) {
                                        for ($minute = 0; $minute < 60; $minute += 30) {
                                            $timeString = sprintf('%02d:%02d', $hour, $minute);

                                            if ($timeString == '11:30' || $timeString == '17:30' || $timeString == '17:00' || $timeString == '12:00') {
                                                continue; // Skip unavailable times
                                            }

                                            if ($selectedDate == date('Y-m-d') && $timeString < $currentTime) {
                                                continue; // Skip past times on the current day
                                            }

                                            if (!in_array($timeString, $bookedTimes)) {
                                                $allTimes[] = date('h:i A', strtotime($timeString));
                                            }
                                        }
                                    }

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
                    </div>
                </div>
            </div>

            <!-- Merged Appointments Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 shadow">
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
                                            if ($appointmentDate < $currentDate) continue; // Skip past appointments

                                            $appointmentDateTime = date('Y-m-d H:i', strtotime($appointment['appointment_date'] . ' ' . $appointment['appointment_time']));
                                            $appointmentTimes[$appointmentDateTime] = ($appointmentTimes[$appointmentDateTime] ?? 0) + 1;

                                            // Skip hidden statuses
                                            if (in_array($appointment['status'], ['approved', 'completed', 'declined', 'cancelled'])) continue;

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
                                            if ($onlineAppointmentDate < $currentDate) continue; // Skip past appointments

                                            $onlineAppointmentDateTime = date('Y-m-d H:i', strtotime($onlineappointment['appointment_date'] . ' ' . $onlineappointment['appointment_time']));
                                            $appointmentTimes[$onlineAppointmentDateTime] = ($appointmentTimes[$onlineAppointmentDateTime] ?? 0) + 1;

                                            $status = $onlineappointment['STATUS'] ?? 'pending';
                                            if ($status === 'cancelled' || $status === 'completed') continue;

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
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    const linearCtx = document.getElementById('linearChart').getContext('2d');
    const linearChart = new Chart(linearCtx, {
        type: 'line',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'], // Example labels (you can replace with actual dates)
            datasets: [{
                    label: 'Appointments',
                    data: [<?= $appointments_count; ?>], // Example data; replace with actual data
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Light blue fill
                    borderColor: 'rgba(54, 162, 235, 1)', // Blue line
                    borderWidth: 2,
                    fill: false, // Set to false for a line chart without fill
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointRadius: 5
                },
                {
                    label: 'Online',
                    data: [<?= $onlineappointments_count; ?>], // Example data; replace with actual data
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Light red fill
                    borderColor: 'rgba(255, 99, 132, 1)', // Red line
                    borderWidth: 2,
                    fill: false, // Set to false for a line chart without fill
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                    pointRadius: 5
                }, // Added comma here
                {
                    label: 'Registration',
                    data: [<?= $registration_count; ?>], // Example data; replace with actual data
                    backgroundColor: 'rgba(255, 206, 86, 0.2)', // Light yellow fill
                    borderColor: 'rgba(255, 206, 86, 1)', // Yellow line
                    borderWidth: 2,
                    fill: false, // Set to false for a line chart without fill
                    pointBackgroundColor: 'rgba(255, 206, 86, 1)',
                    pointRadius: 5
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Days'
                    }
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Overview'
                }
            }
        }
    });
</script>
<script>
$(document).ready(function() {
    $('#datatablesSimple').DataTable({
        "rowCallback": function(row, data, index) {
            var status = data[4]; // Adjust based on your actual data
            // Check your condition to apply class
            if (status === 'booked') { // Example condition
                $(row).addClass('table-danger');
            }
        }
    });
});
</script>


<!-- Include your script files here -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="https://cdnjs.cloudflare .com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<!-- <script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script> -->