<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2>Search Results</h2>

        <?php if (!empty($patients)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Birthday</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($patient['name']); ?></td>
                                <td><?php echo htmlspecialchars($patient['mname']); ?></td>
                                <td><?php echo htmlspecialchars($patient['lname']); ?></td>
                                <td><?php echo htmlspecialchars(date('F j, Y', strtotime($patient['birthday']))); ?></td> <!-- Format birthday -->
                                <td><?php echo htmlspecialchars($patient['address']); ?></td>
                                <td>
                                    <a href="<?php echo site_url('appointments/create/' . $patient['id'] . '?name=' . urlencode($patient['name']) . '&mname=' . urlencode($patient['mname']) . '&lname=' . urlencode($patient['lname'])); ?>" class="btn btn-primary">Add Appointment</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">
                <strong>No patients found!</strong> No patients found with the name "<?php echo htmlspecialchars($search_name); ?>". Please try again.
            </div>
        <?php endif; ?>
    </main>
</div>