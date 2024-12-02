<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }
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
</head>
<body>
    <div id="layoutSidenav_content">
        <div class="container">
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

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Birthday</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registrations as $registration): ?>
                        <!-- Check if both appointment_date and appointment_time are not empty -->
                        <?php if (!empty($registration['appointment_date']) && !empty($registration['appointment_time'])): ?>
                            <tr>
                            <td><?= sprintf('%04d', htmlspecialchars($registration['id'])); ?></td>

                                <td><?= isset($registration['email']) ? htmlspecialchars($registration['email']) : 'N/A'; ?></td>
                                <td><?= isset($registration['name']) ? htmlspecialchars($registration['name']) : 'N/A'; ?></td>
                                <td><?= isset($registration['lname']) ? htmlspecialchars($registration['lname']) : 'N/A'; ?></td>
                                <td><?= isset($registration['birthday']) ? htmlspecialchars($registration['birthday']) : 'N/A'; ?></td>
                                <td><?= htmlspecialchars($registration['age']); ?></td>
                                <td><?= htmlspecialchars($registration['address']); ?></td>
                                <td><?= htmlspecialchars($registration['patient_contact_no']); ?></td>
                                <td><?= htmlspecialchars($registration['appointment_date']); ?></td>
                                <td><?= htmlspecialchars($registration['appointment_time']); ?></td>
                                <td>
                                    <?php
                                        $status = isset($registration['appointment_status']) ? $registration['appointment_status']:'';
                                        $status_labels = [
                                            'pending' => 'Pending',
                                            'booked' => 'Booked',
                                            'cancelled' => 'Cancelled',
                                            'in_session' => 'In Session',
                                            'completed' => 'Completed',
                                        ];
                                        $status_class = 'status-label ';
                                        if (array_key_exists($status, $status_labels)) {
                                            $status_text = $status_labels[$status];
                                            switch ($status) {
                                                case 'pending':
                                                    $status_class .= 'status-pending';
                                                    break;
                                                case 'booked':
                                                    $status_class .= 'status-booked';
                                                    break;
                                                case 'cancelled':
                                                    $status_class .= 'status-cancelled';
                                                    break;
                                                case 'in_session':
                                                    $status_class .= 'status-in-session';
                                                    break;
                                                case 'completed':
                                                    $status_class .= 'status-completed';
                                                    break;
                                            }
                                        } else {
                                            $status_text = 'Unknown';
                                            $status_class .= 'status-label'; // Default styling for unknown status
                                        }
                                    ?>
                                    <span class="<?= $status_class ?>"><?= htmlspecialchars($status_text); ?></span>
                                </td>
                                <td>
                                    <a href="<?= base_url('onlineappointments/edit/' . $registration['id']); ?>" class="btn btn-primary btn-sm">Update</a>
                                    <!-- <a href="<?= base_url('registrations/delete/' . $registration['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this registration?');">Delete</a> -->
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
