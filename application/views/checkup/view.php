<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2 class="mb-4 text-center">Check-Up Details</h2>

        <!-- Patient Information Card -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Patient Information</h4>
            </div>
            <div class="card-body">
                <p class="mb-1">
                    <strong>Full Name:</strong> 
                    <?= htmlspecialchars($checkup->name . ' ' . ($checkup->mname ? $checkup->mname . ' ' : '') . $checkup->lname); ?>
                </p>
                <p class="mb-1"><strong>Birthday:</strong> <?= date('Y-m-d', strtotime($checkup->birthday)); ?></p>
                <p class="mb-1"><strong>Age:</strong> <?= htmlspecialchars($checkup->age); ?></p>
                <p class="mb-1"><strong>Address:</strong> <?= htmlspecialchars($checkup->address); ?></p>
            </div>
        </div>

        <!-- Check-Up Information Card -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Check-Up Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6 mb-3">
                        <p><strong>Blood Pressure:</strong> <?= htmlspecialchars($checkup->blood_pressure); ?></p>
                        <p><strong>Pulse Rate:</strong> <?= htmlspecialchars($checkup->pulse_rate); ?></p>
                        <p><strong>Respiration Rate:</strong> <?= htmlspecialchars($checkup->respiration_rate); ?></p>
                        <p><strong>Check-Up Date:</strong> <?= date('Y-m-d H:i', strtotime($checkup->created_at)); ?></p>
                        <p><strong>Height:</strong> <?= htmlspecialchars($checkup->height); ?> cm</p>
                        <p><strong>Weight:</strong> <?= htmlspecialchars($checkup->weight); ?> kg</p>
                        <p><strong>Doctor's Comment:</strong> <?= nl2br(htmlspecialchars($checkup->doctor_comment)); ?></p>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6 mb-3">
                        <p><strong>Temperature:</strong> <?= htmlspecialchars($checkup->temperature); ?></p>
                        <p><strong>Oxygen Saturation:</strong> <?= htmlspecialchars($checkup->oxygen_saturation); ?></p>
                        <p><strong>Ultrasound:</strong> <?= htmlspecialchars($checkup->ultrasound); ?></p>
                        <p><strong>Pregnancy Test:</strong> <?= htmlspecialchars($checkup->pregnancy_test); ?></p>
                        <p><strong>Next Check-Up:</strong> <?= htmlspecialchars($checkup->next_checkup_date); ?></p>
                        <p><strong>Prescription:</strong> <?= nl2br(htmlspecialchars($checkup->prescription)); ?></p>
                        <p><strong>Recommendation:</strong> <?= nl2br(htmlspecialchars($checkup->recommendation)); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center">
            <a href="<?= site_url('checkup'); ?>" class="btn btn-secondary btn-lg">Back to Check-Up List</a>
        </div>
    </main>
</div>

<!-- DataTable Initialization Script -->
<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "order": [
                [1, "desc"], // Sort by Date
                [2, "desc"]  // Then by Time
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

<!-- Required JS Scripts -->
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
