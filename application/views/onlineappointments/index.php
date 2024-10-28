<div id="layoutSidenav_content">
    <div class="container">
        <h1 class="my-4">Online Appointments</h1>

        <!-- Display success or error messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('warning')): ?>
            <div class="alert alert-warning">
                <?= $this->session->flashdata('warning'); ?>
            </div>
        <?php endif; ?>

        <!-- Status Mapping -->
        <?php
        $status_labels = [
            'pending' => 'Pending',
            'booked' => 'Booked',
            'arrived' => 'Arrived',
            'reschedule' => 'Reschedule',
            'follow_up' => 'Follow-up',
            'cancelled' => 'Cancelled',
            'in_session' => 'In Session',
            'completed' => 'Completed',
            // Add more statuses as needed
        ];
        ?>

        <!-- Appointment Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($onlineappointments)): ?>
                    <?php foreach ($onlineappointments as $onlineappointment): ?>
                        <tr>
                            <td><?= htmlspecialchars($onlineappointment['firstname']); ?></td>
                            <td><?= htmlspecialchars($onlineappointment['lastname']); ?></td>
                            <td><?= htmlspecialchars($onlineappointment['email']); ?></td>
                            <td><?= htmlspecialchars($onlineappointment['contact_number']); ?></td>
                            <td><?= date('F d, Y', strtotime($onlineappointment['appointment_date'])); ?></td>
                            <td><?= date('h:i A', strtotime($onlineappointment['appointment_time'])); ?></td>
                            <td>
                                <?php
                                $status_key = 'STATUS'; // or use 'STATUS' if that's your key
                                $status_value = isset($onlineappointment[$status_key]) ? $onlineappointment[$status_key] : 'Unknown Status';

                                echo htmlspecialchars(
                                    isset($status_labels[$status_value])
                                        ? $status_labels[$status_value]
                                        : ucfirst($status_value) // Fallback to the original status if not in labels
                                );
                                ?>
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
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No appointments found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "order": [
                [4, "desc"], // Sort by Appointment Date
                [5, "desc"] // Then by Appointment Time
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": 7 // Make the Actions column not sortable
            }],
            paging: true,
            ordering: true,
            info: true
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>