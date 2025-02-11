<div id="layoutSidenav_content">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary">Ultrasound Record</h2>
            <div>
                <a href="<?= site_url('laboratorytests/search_patient'); ?>" class="btn btn-primary">Select New Patient</a>
            </div>
        </div>

        <!-- Laboratory Test Records Table -->
        <div class="card">
            <div class="card-body">
                <!-- <form method="post" action="<?= site_url('laboratorytests/search_patient'); ?>" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Search Patient Name" aria-label="Search Patient Name">
                        <button type="submit" class="btn btn-outline-secondary">Search</button>
                    </div>
                </form> -->

                <table id="laboratoryTestsTable" class="table table-striped table-bordered" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Birthday</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tests)): ?>
                            <?php foreach ($tests as $test): ?>
                                <tr>
                                <td><?= htmlspecialchars(str_pad($test['registration_id'], 4, '0', STR_PAD_LEFT)); ?></td>

									<td><?= strtoupper(htmlspecialchars($this->LaboratoryTest_model->get_patient_name($test['registration_id']))); ?></td>
									<td><?= strtoupper(htmlspecialchars($this->LaboratoryTest_model->get_birthday($test['registration_id']))); ?></td>
									<td><?= strtoupper(htmlspecialchars($this->LaboratoryTest_model->get_address($test['registration_id']))); ?></td>
                                    <td>
                                        <a href="<?= site_url('laboratorytests/view/' . $test['id']); ?>" class="btn btn-primary btn-sm">View</a>
                                        <!-- Uncomment the line below to enable the delete action -->
                                        <!-- <a href="<?= site_url('laboratorytests/delete/' . $test['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No Ultrasound test records found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#laboratoryTestsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50, 100],
            "pageLength": 10,
            "language": {
                "lengthMenu": "Display _MENU_ records per page",
                "zeroRecords": "No records found",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Search:",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    });
</script>
