<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-Up List</title>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="layoutSidenav_content">
        <main class="container mt-4">
            <h1 class="text-center mb-4">Check-Up List</h1>
            <div class="text-right mb-3">
                <a href="<?= site_url('checkup/create'); ?>" class="btn btn-success">Add New Check-Up</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="checkupTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Patient Full Name</th>
                                <th>Birthday</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Date Recorded</th> 
                                <th>Patient Next Check Up</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($checkups as $checkup): ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($checkup->name . ' ' . ($checkup->mname ? htmlspecialchars($checkup->mname) . ' ' : '') . htmlspecialchars($checkup->lname)); ?>
                                    </td>
                                    <td><?= htmlspecialchars(date('Y-m-d', strtotime($checkup->birthday))); ?></td>
                                    <td><?= htmlspecialchars($checkup->age); ?></td>
                                    <td><?= htmlspecialchars($checkup->address); ?></td>
                                    <td><?= date('Y-m-d H:i', strtotime($checkup->created_at)); ?></td>
                                    <td><?= htmlspecialchars($checkup->next_checkup_date); ?></td>
                                    <td>
                                        <a href="<?= site_url('checkup/view/' . $checkup->id); ?>" class="btn btn-info" aria-label="View Check-Up">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="<?= site_url('registration/patients'); ?>" class="btn btn-secondary" aria-label="Back to Patients">
                    <i class="fas fa-arrow-left"></i> Back to Patients
                </a>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $('#checkupTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                order: [[0, 'asc']],
                lengthMenu: [5, 10, 25, 50],
                language: {
                    lengthMenu: "Display _MENU_ records per page",
                    zeroRecords: "No matching records found",
                    info: "Showing page _PAGE_ of _PAGES_",
                    infoEmpty: "No records available",
                    infoFiltered: "(filtered from _MAX_ total records)",
                    search: "Search:",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });
        });
    </script>
</body>

</html>
