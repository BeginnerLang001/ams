<div id="layoutSidenav_content">
    <div class="container mt-4">
        <h2 class="text-primary mb-3">Search Results</h2>

        <?php if (!empty($patients)): ?>
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Birthday</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($patients as $patient): ?>
                                <tr>
                                    <td><?= htmlspecialchars($patient->name . ' ' . $patient->mname . ' ' . $patient->lname); ?></td>
                                    <td><?= htmlspecialchars($patient->birthday); ?></td> 
                                    <td><?= htmlspecialchars($patient->address); ?></td>
                                    <td>
                                        <a href="<?= site_url('laboratorytests/create/' . $patient->id); ?>" class="btn btn-sm btn-outline-primary">Select</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No patients found.
            </div>
        <?php endif; ?>
    </div>
</div>
