<div id="layoutSidenav_content">
    <style>
        .status-label {
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
            text-align: center;
        }

        .status-pending {
            background-color: #ffc107; /* Yellow */
        }

        .status-booked {
            background-color: #28a745; /* Green */
        }

        .status-cancelled {
            background-color: #dc3545; /* Red */
        }

        .status-in-session {
            background-color: #17a2b8; /* Teal */
        }

        .status-completed {
            background-color: #6c757d; /* Gray */
        }
    </style>

    <div class="container mt-5">
        <h1 class="mb-4">Online Appointment List</h1>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($registrations)): ?>
            <p>Appointments found: <?= count($registrations); ?></p>
            <table class="table table-bordered table-hover" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <!-- <th>Email</th> -->
                        <th>Fullname</th>
                        <th>Birthday</th>
                        <th>Age</th>
                        <th>Address</th>
                        <!-- <th>Contact Number</th> -->
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registrations as $registration): ?>
                        <?php
                            // Convert appointment date and time to Philippine Time (PHT)
                            $dateTime = new DateTime($registration['appointment_date'] . ' ' . $registration['appointment_time'], new DateTimeZone('Asia/Manila'));
                            $formattedDate = $dateTime->format(' F j, Y'); // Full name of the day and date
                            $formattedTime = $dateTime->format('h:i A'); // 12-hour format with AM/PM
                        ?>
                        <tr>
                        <td><?= htmlspecialchars(str_pad($registration['id'], 4, '0', STR_PAD_LEFT)); ?></td>
                            
                            <!-- <td><?= htmlspecialchars($registration['email']); ?></td> -->
                            <td><?= htmlspecialchars($registration['name']) . ' ' . htmlspecialchars($registration['lname']); ?></td>

                            <td><?= htmlspecialchars($registration['birthday']); ?></td>
                            <td><?= htmlspecialchars($registration['age']); ?></td>
                            <td><?= htmlspecialchars($registration['address']); ?></td>
                            <!-- <td><?= htmlspecialchars($registration['patient_contact_no']); ?></td> -->
                            <td><?= $formattedDate; ?></td>
                            <td><?= $formattedTime; ?></td>
                            <td>
                                <?php
                                    // Display status with appropriate class for styling
                                    $status = htmlspecialchars($registration['appointment_status']);
                                    $statusClass = 'status-label ';
                                    switch ($status) {
                                        case 'pending':
                                            $statusClass .= 'status-pending';
                                            break;
                                        case 'booked':
                                            $statusClass .= 'status-booked';
                                            break;
                                        case 'cancelled':
                                            $statusClass .= 'status-cancelled';
                                            break;
                                       
                                        case 'completed':
                                            $statusClass .= 'status-completed';
                                            break;
                                        default:
                                            $statusClass .= 'status-label';
                                    }
                                ?>
                                <span class="<?= $statusClass ?>"><?= ucfirst($status); ?></span>
                            </td>
                            <!-- <td>
                                <a href="<?= base_url('onlineappointments/edit/' . $registration['id']); ?>" class="btn btn-primary btn-sm">Update</a>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No appointments found.</p>
        <?php endif; ?>
    </div>

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
    $('#datatablesSimple').DataTable({
        "order": [
            [7, "desc"] // Assuming the "Appointment Date" column is at index 7
        ],
        "columnDefs": [{
            "orderable": false,
            "targets": 10 // Assuming the "Actions" column is at index 10
        }],
        paging: true,
        ordering: true,
        info: true
    });
});

</script>