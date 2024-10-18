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
            'booked' => 'Approved',
            'cancelled' => 'Cancelled',
            'declined' => 'Declined',
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
                    <?= htmlspecialchars(
                        isset($onlineappointment['STATUS']) && isset($status_labels[$onlineappointment['STATUS']]) 
                            ? $status_labels[$onlineappointment['STATUS']] 
                            : (isset($onlineappointment['STATUS']) ? ucfirst($onlineappointment['STATUS']) : 'Unknown Status')
                    ); ?>
                </td>

                <td>
                    <a href="<?= base_url('onlineappointments/edit/' . $onlineappointment['id']); ?>" class="btn btn-warning btn-sm">Update Status</a>
                    <!-- <a href="<?= base_url('onlineappointments/approve/' . $onlineappointment['id']); ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this appointment?');">Approve</a>
                    <a href="<?= base_url('onlineappointments/reject/' . $onlineappointment['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to reject this appointment?');">Reject</a>
                    <a href="<?= base_url('onlineappointments/delete/' . $onlineappointment['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</a> -->
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