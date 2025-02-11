<div id="layoutSidenav_content">
    <div class="container mt-4">
        <h2 class="text-primary mb-3">Select Patient</h2>

        <?php if (!empty($patients)): ?>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="patientsTable" class="table table-striped table-bordered">
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
                                            <a href="<?= site_url('laboratorytests/create/' . urlencode($patient->id)); ?>" class="btn btn-sm btn-outline-primary">Select</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center" role="alert">
                No patients found.
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Required Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>

<!-- DataTables Initialization -->
<script>
    $(document).ready(function() {
        $('#patientsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });
    });
</script>
