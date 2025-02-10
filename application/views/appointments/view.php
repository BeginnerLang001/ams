<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h1 class="mt-4 mb-4">Appointment Details</h1>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="patient_name" class="font-weight-bold">Patient Name:</label>
            </div>
            <div class="col-md-8">
                <p id="patient_name"><?php echo htmlspecialchars(ucwords($patient_name)); ?></p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="appointment_date" class="font-weight-bold">Appointment Date:</label>
            </div>
            <div class="col-md-8">
                <p id="appointment_date"><?php echo htmlspecialchars(ucwords($appointment['appointment_date'])); ?></p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="appointment_time" class="font-weight-bold">Appointment Time:</label>
            </div>
            <div class="col-md-8">
                <p id="appointment_time"><?php echo htmlspecialchars(ucwords($appointment['appointment_time'])); ?></p>
            </div>
        </div>
		<div class="row mb-3">
            <div class="col-md-4">
                <label for="doctor" class="font-weight-bold">Doctor:</label>
            </div>
            <div class="col-md-8">
                <p id="doctor"><?php echo htmlspecialchars(ucwords($appointment['doctor'])); ?></p>
            </div>
        </div>
    </main>
</div>

<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "order": [
                [1, "desc"], 
                [2, "desc"] 
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": 5 
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
