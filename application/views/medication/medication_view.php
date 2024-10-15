<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2 class="mt-4">Medical History</h2>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Medical History
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="datatablesSimple">
    <thead>
        <tr>
            <th>Patient Name</th>
            <th>Address</th> 
            <th>Date Recorded</th>
            <th>View Details</th>
            <th>Add New Record</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($medications as $medication): ?>
        <tr>
            <td>
                <?php
                if (isset($medication['patient'])) {
                    $firstName = isset($medication['patient']['name']) ? $medication['patient']['name'] : '';
                    $middleName = isset($medication['patient']['mname']) ? $medication['patient']['mname'] : '';
                    $lastName = isset($medication['patient']['lname']) ? $medication['patient']['lname'] : '';
                    $fullName = trim($firstName . ' ' . $middleName . ' ' . $lastName);
                    echo $fullName ?: 'Unknown Patient'; 
                } else {
                    echo 'No Patient Info';
                }
                ?>
            </td>
            <td>
                <?php
                echo isset($medication['patient']['address']) ? $medication['patient']['address'] : 'No Address';
                ?>
            </td>
            <td>
                <?php
                // Display last_update timestamp
                echo isset($medication['last_update']) ? date('Y-m-d', strtotime($medication['last_update'])) : 'Not Updated';
                ?>
            </td>
            <td>
                <a href="<?php echo site_url('medication/view_all_details/' . $medication['id']); ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-eye"></i> View All Details
                </a>
            </td>
            <td>
                <a href="<?php echo site_url('medication/add/' . $medication['registration_id']); ?>" class="btn btn-warning btn-sm">
                    <i class="fas fa-plus"></i> Add New Record
                </a>
            </td>
            
        </tr>
    <?php endforeach; ?>
</tbody>

</table>

                </div>
            </div>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "order": [
                [1, "desc"], // Sort by Date
                [2, "desc"] // Then by Time
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": 5 // Make the Actions column not sortable
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>