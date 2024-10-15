<div id="layoutSidenav_content">
    <main class="container mt-4">
        <div class="container h-10">
            <div class="row justify-content-center">
                <div class="col-lg-10  h-10">
                    <div>
                        <h1 class="mt-4">Create Appointment</h1>
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php echo form_open('appointments/create', ['class' => 'needs-validation', 'novalidate' => '']); ?>

                        <div class="mb-3">
                            <label for="patient_id" class="form-label">Patient</label>
                            <select name="patient_id" id="patient_id" class="form-control" required>
                                <option value="">Select Patient</option>
                                <?php foreach ($patients as $patient): ?>
                                    <option value="<?php echo $patient['id']; ?>">
                                        <?php echo $patient['full_name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select a patient.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="appointment_date" class="form-label">Date</label>
                            <input type="date" name="appointment_date" id="appointment_date" class="form-control" required>
                            <div class="invalid-feedback">
                                Please select a date.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="appointment_time" class="form-label">Time</label>
                            <input type="time" name="appointment_time" id="appointment_time" class="form-control" required>
                            <div class="invalid-feedback">
                                Please select a time.
                            </div>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="email_account" class="form-label">Email Account</label>
                            <input type="email" name="email_account" id="email_account" class="form-control" required>
                            <div class="invalid-feedback">

                            </div>
                        </div> -->

                        <div class="mb-3">
                            <label for="doctor" class="form-label">Doctor</label>
                            <input type="text" name="doctor" id="doctor" class="form-control"
                                value="<?php echo set_value('doctor', $doctor); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" id="notes" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <!-- <option value="pending">Pending</option> -->
                                <!-- <option value="approved">Approved</option> -->
                                <option value="">Sekect Status</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="completed">Completed</option>
                                <option value="arrived">Arrived</option>
                                <option value="on-going">On-going</option>
                                <option value="confirmed">Confirmed</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a status.
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">Create Appointment</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
<script>
    $(document).ready(function() {
        $('#appointment_time').timepicker({
            timeFormat: 'hh:mm p',
            interval: 30, // Time intervals (30 mins)
            minTime: '12:00am',
            maxTime: '11:59pm',
            defaultTime: '09:00am',
            startTime: '12:00am',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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