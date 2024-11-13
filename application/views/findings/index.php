<div id="layoutSidenav_content">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary">Diagnosis Records</h2>
            <div>
                <a href="<?= site_url('findings/search_patient'); ?>" class="btn btn-primary">Add New Diagnosis</a> <!-- Adjust the link based on your route -->
            </div>
        </div>

        <!-- Findings Records Table -->
        <div class="card">
            <div class="card-body">
                <table id="findingsTable" class="table table-striped table-bordered" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Birthday</th>
                            <!-- <th>Findings</th>
                            <th>Recommendations</th> -->
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($findings)): ?>
                            <?php foreach ($findings as $finding): ?>
                                <tr>
                                <td><?= htmlspecialchars(str_pad($finding->registration_id, 4, '0', STR_PAD_LEFT)); ?></td>

                                    <td><?= htmlspecialchars($finding->full_name); ?></td>
                                    <td><?= htmlspecialchars($finding->birthday); ?></td>
                                    <!-- <td><?= htmlspecialchars($finding->findings); ?></td>
                                    <td><?= htmlspecialchars($finding->recommendations); ?></td> -->
                                    <td><?= htmlspecialchars($finding->created_at); ?></td>
                                    <td>
                                        <a href="<?= site_url('findings/view/' . $finding->registration_id); ?>" class="btn btn-primary btn-sm">View</a>
                                        <!-- Uncomment the line below to enable the delete action -->
                                        <!-- <a href="<?= site_url('findings/delete/' . $finding->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No findings records found.</td>
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
        $('#findingsTable').DataTable({
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
