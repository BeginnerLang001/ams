<div id="layoutSidenav_content">
    <div class="container">
        <h2>Search Results</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Full Name</th>
                    <th>Birthday</th> <!-- New Column for Birthday -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                <tr>
                <td><?= htmlspecialchars(str_pad($patient->id, 4, '0', STR_PAD_LEFT)) ?></td>

                    <td><?= htmlspecialchars($patient->name . ' ' . $patient->mname . ' ' . $patient->lname) ?></td>
                    <td><?= htmlspecialchars($patient->birthday) ?></td> <!-- Displaying Birthday -->
                    <td>
                        <a href="<?= site_url('findings/add_findings/' . $patient->id) ?>" class="btn btn-primary btn-sm">Add Findings</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#resultsTable').DataTable({
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