<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h1 class="mt-4">Appointment Details</h1>
        <div>
            <label>Patient Name:</label>
            <p><?php echo $appointment['patient_name']; ?></p>

        </div>
        <!--  <div>
        <label>Custom ID:</label>
        <p><?php echo $appointment['custom_id']; ?></p>
    </div> -->
        <div>
            <label>Appointment Date:</label>
            <p><?php echo $appointment['appointment_date']; ?></p>
        </div>
        <div>
            <label>Appointment Time:</label>
            <p><?php echo $appointment['appointment_time']; ?></p>
        </div>
        <div>
            <label>Doctor:</label>
            <p><?php echo $appointment['doctor']; ?></p>
        </div>
        <div>
            <label>Notes:</label>
            <p><?php echo $appointment['notes']; ?></p>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>