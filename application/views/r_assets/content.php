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

                <!-- Walk-In Appointments Table -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Walk-In Appointments
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>Patient Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Doctor</th>
                                        <th>Notes</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($appointments)): ?>
                                        <?php foreach ($appointments as $appointment): ?>
                                            <?php
                                            // Define statuses to hide
                                            $hiddenStatuses = ['approved', 'completed', 'declined', 'cancelled'];

                                            // Check if the appointment status is in the hidden statuses
                                            if (in_array($appointment['status'], $hiddenStatuses)) {
                                                continue; // Skip this iteration if the status is to be hidden
                                            }
                                            ?>
                                            <tr>
                                                <!-- <td><?= htmlspecialchars($appointment['id']); ?></td> -->
                                                <td><?= htmlspecialchars($appointment['patient_name']); ?></td>
                                                <td><?= date('F d, Y', strtotime($appointment['appointment_date'])); ?></td>
                                                <td><?= date('h:i A', strtotime($appointment['appointment_time'])); ?></td>
                                                <td><?= htmlspecialchars($appointment['doctor']); ?></td>
                                                <td><?= htmlspecialchars($appointment['notes']); ?></td>
                                                <td>
                                                    <?php
                                                    $status = $appointment['status'];
                                                    switch ($status) {
                                                        case 'approved':
                                                            $badgeClass = 'bg-success';
                                                            break;
                                                        case 'declined':
                                                        case 'cancelled':
                                                            $badgeClass = 'bg-danger';
                                                            break;
                                                        case 'completed':
                                                            $badgeClass = 'bg-primary';
                                                            break;
                                                        case 'arrived':
                                                        case 'on-going':
                                                            $badgeClass = 'bg-info text-dark';
                                                            break;
                                                        case 'confirmed':
                                                            $badgeClass = 'bg-secondary';
                                                            break;
                                                        default:  // pending or fallback
                                                            $badgeClass = 'bg-warning text-dark';
                                                            break;
                                                    }
                                                    ?>
                                                    <span class="badge <?= $badgeClass; ?>">
                                                        <?= ucfirst($status); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('appointments/edit/' . $appointment['id']); ?>" class="btn btn-warning btn-sm">Update Status</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8">No walk-in appointments found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>

                            </table>

                            <a href="<?php echo site_url('ExportController/walkin_csv'); ?>" class="btn btn-primary">Export Walk-In Appointments CSV</a>
                            <a href="<?php echo site_url('ExportController/walkin_excel'); ?>" class="btn btn-success">Export Walk-In Appointments Excel</a>

                        </div>
                    </div>
                </div>


                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Online Appointments
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>Patient Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($onlineappointments as $onlineappointment): ?>
                                        <?php if (
                                            $onlineappointment['status'] === 'completed' ||
                                            $onlineappointment['status'] === 'declined' ||
                                            $onlineappointment['status'] === 'did not attend'
                                        ) continue; ?>
                                        <tr>
                                            <!-- <td><?= $onlineappointment['id']; ?></td> -->
                                            <td><?= htmlspecialchars($onlineappointment['firstname']) . ' ' . htmlspecialchars($onlineappointment['lastname']); ?></td>
                                            <td><?= htmlspecialchars($onlineappointment['email']); ?></td>
                                            <td><?= htmlspecialchars($onlineappointment['contact_number']); ?></td>
                                            <td><?= date('F d, Y', strtotime($onlineappointment['appointment_date'])); ?></td>
                                            <td><?= date('h:i A', strtotime($onlineappointment['appointment_time'])); ?></td>
                                            <td>
                                                <?php
                                                // Displaying different status badges
                                                switch ($onlineappointment['status']) {
                                                    case 'approved':
                                                        echo '<span class="badge bg-success">Approved</span>';
                                                        break;
                                                    case 'arrived':
                                                        echo '<span class="badge bg-dark">Arrived</span>';
                                                        break;
                                                    case 'booked':
                                                        echo '<span class="badge bg-secondary">Booked</span>';
                                                        break;
                                                    case 'attended':
                                                        echo '<span class="badge bg-dark">Attended</span>';
                                                        break;
                                                    case 'waiting list':
                                                        echo '<span class="badge bg-light text-dark">Waiting List</span>';
                                                        break;
                                                    default:
                                                        echo '<span class="badge bg-warning text-dark">Pending</span>';
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php if ($onlineappointment['status'] === 'booked'): ?>
                                                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= urlencode($onlineappointment['email']); ?>&su=Appointment%20Booked&body=Good%20day%20Ms/Mrs!%20<?= urlencode($onlineappointment['firstname'] . ' ' . $onlineappointment['lastname']); ?>,%0AThis%20is%20from%20Mendoza%20OBGYN%20Clinic!%0AWe%20are%20pleased%20to%20confirm%20that%20your%20appointment%20is%20booked%20for%20the%20following:%0ADate:%20<?= urlencode(date('F d, Y', strtotime($onlineappointment['appointment_date']))); ?>%0AScheduled%20Time:%20<?= urlencode(date('h:i A', strtotime($onlineappointment['appointment_time']))); ?>%0AAddress:%20(wait%20the%20info)%0A%0AThank%20you%20for%20choosing%20us!" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-envelope"></i></a>
                                                <?php endif; ?>

                                                <!-- <?php if ($onlineappointment['status'] === 'pending'): ?>
                        <a href="<?= base_url('onlineappointments/approve/' . $onlineappointment['id']); ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this appointment?')">Approve</a>
                        <a href="<?= base_url('onlineappointments/reject/' . $onlineappointment['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to reject this appointment?')">Reject</a>
                    <?php endif; ?> -->
                                                <a href="<?= base_url('onlineappointments/edit/' . $onlineappointment['id']); ?>" class="btn btn-warning btn-sm">Update Status</a>
                                                <!-- Uncomment this line if you want to allow deletion -->
                                                <!-- <a href="<?= base_url('onlineappointments/delete/' . $onlineappointment['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a> -->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <a href="<?php echo site_url('ExportController/online_csv'); ?>" class="btn btn-primary">Export Online Appointments CSV</a>
                            <a href="<?php echo site_url('ExportController/online_excel'); ?>" class="btn btn-success">Export Online Appointments Excel</a>
                        </div>
                    </div>
                </div>


    </main>
</div>