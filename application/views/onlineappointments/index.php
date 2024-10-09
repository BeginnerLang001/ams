<div id="layoutSidenav_content">
    <main class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="mb-4">Online Appointments</h1>
                <!-- <a href="<?= base_url('onlineappointments/create'); ?>" class="btn btn-primary mb-3">Create New Appointment</a> -->

                <table class="table table-bordered table-striped" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
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
                            <tr>
                                <td><?= htmlspecialchars($onlineappointment['id']); ?></td>
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
                                            case 'declined':
                                                echo '<span class="badge bg-danger">Declined</span>';
                                                break;
                                            case 'arrived':
                                                echo '<span class="badge bg-info">Arrived</span>';
                                                break;
                                            case 'completed':
                                                echo '<span class="badge bg-primary">Completed</span>';
                                                break;
                                            case 'booked':
                                                echo '<span class="badge bg-secondary">Booked</span>';
                                                break;
                                            case 'attended':
                                                echo '<span class="badge bg-dark">Attended</span>';
                                                break;
                                            case 'did not attend':
                                                echo '<span class="badge bg-warning text-dark">Did Not Attend</span>';
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
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('onlineappointments/edit/' . $onlineappointment['id']); ?>" class="btn btn-warning btn-sm" aria-label="Update Status">
                                            Update Status
                                        </a>
                                        <!-- Optional: Uncomment if you want to allow deletion -->
                                        <!-- <a href="<?= base_url('onlineappointments/delete/' . $onlineappointment['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" aria-label="Delete Appointment">Delete</a> -->
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "order": [
                [4, "desc"], // Sort by Appointment Date
                [5, "desc"]  // Then by Appointment Time
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
