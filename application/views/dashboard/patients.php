<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h1>Registered Patients</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Patient's Information
            </div>
            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Birthday</th>
                                <th>Age</th>
                                <th>Address</th>
                                <!-- <th>Contact</th> -->
                                <!-- <th>Patient Record Date</th>
                                <th>Patient Record Update</th> -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($registrations as $registration): ?>
                                <tr>
                                    <td>
                                        <?= isset($registration->id) ? htmlspecialchars(str_pad($registration->id, 4, '0', STR_PAD_LEFT)) : 'No ID'; ?>
                                    </td>

                                    <td><?= $registration->name ?></td>
                                    <td><?= $registration->lname ?></td>
                                    <td><?= $registration->birthday ?></td>
                                    <td><?= $registration->age ?></td>
                                    <td><?= $registration->address ?></td>
                                    <!-- <td><?= $registration->patient_contact_no ?></td> -->
                                    <!-- <td><?= $registration->created_at ?></td>
                                    <td><?= $registration->last_update ?></td> -->
                                    <td>
                                        <a href="<?php echo site_url('registration/edit/' . $registration->id); ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo site_url('registration/details/' . $registration->id); ?>" class="btn btn-info btn-sm" title="View Details"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Export Buttons -->
                <div class="mt-3">
                    <a href="<?php echo site_url('exportcontroller/export_registration_csv'); ?>" class="btn btn-primary">Export to CSV</a>
                    <a href="<?php echo site_url('exportcontroller/export_registration_excel'); ?>" class="btn btn-success">Export to Excel</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>