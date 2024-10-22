<div id="layoutSidenav_content">
    <main class="container mt-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Update Status</h1>
        </div>

        <div class="container">
          
            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

            
            <?php echo form_open('appointments/edit/' . $appointment['id'], ['class' => 'needs-validation', 'novalidate' => '']); ?>

            <div class="mb-3">
                <label for="patient_name" class="form-label">Patient</label>
                <input type="text" name="patient_name" id="patient_name" class="form-control" value="<?php echo htmlspecialchars($appointment['patient_name']); ?>" readonly aria-label="Patient Name">
            </div>

            <div class="form-group mb-3">
                <label for="appointment_date">Date</label>
                <input type="date" name="appointment_date" class="form-control" value="<?php echo set_value('appointment_date', $appointment['appointment_date']); ?>" required aria-label="Appointment Date">
                <div class="invalid-feedback">Please select a date.</div>
            </div>

            <div class="form-group mb-3">
                <label for="appointment_time">Time</label>
                <input type="time" name="appointment_time" id="appointment_time" class="form-control" value="<?php echo set_value('appointment_time', $appointment['appointment_time']); ?>" required aria-label="Appointment Time">
                <div class="invalid-feedback">Please select a time.</div>
            </div>

            <div class="form-group mb-3">
                <label for="doctor">Doctor</label>
                <input type="text" name="doctor" id="doctor" class="form-control" value="<?php echo htmlspecialchars($doctor_name); ?>" readonly aria-label="Doctor Name">
            </div>

            <div class="form-group mb-3">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control" required>
    <option value="pending" <?php echo set_select('status', 'pending', isset($appointment['status']) && $appointment['status'] == 'pending'); ?>>Pending</option>
    <option value="booked" <?php echo set_select('status', 'booked', isset($appointment['status']) && $appointment['status'] == 'booked'); ?>>Booked</option>
    <option value="arrived" <?php echo set_select('status', 'arrived', isset($appointment['status']) && $appointment['status'] == 'arrived'); ?>>Arrived</option>
    <option value="reschedule" <?php echo set_select('status', 'reschedule', isset($appointment['status']) && $appointment['status'] == 'reschedule'); ?>>Reschedule</option>
    <option value="follow_up" <?php echo set_select('status', 'follow_up', isset($appointment['status']) && $appointment['status'] == 'follow_up'); ?>>Follow Up</option>
    <option value="cancelled" <?php echo set_select('status', 'cancelled', isset($appointment['status']) && $appointment['status'] == 'cancelled'); ?>>Cancelled</option>
    <option value="in_session" <?php echo set_select('status', 'in_session', isset($appointment['status']) && $appointment['status'] == 'in_session'); ?>>In Session</option>
    <option value="completed" <?php echo set_select('status', 'completed', isset($appointment['status']) && $appointment['status'] == 'completed'); ?>>Completed</option>
</select>

    <div class="invalid-feedback">Please select a status.</div>
</div>


            <div class="form-group mb-3">
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" class="form-control" rows="4" aria-label="Notes"><?php echo set_value('notes', $appointment['notes']); ?></textarea>
            </div>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Update Appointment</button>
            <?php echo form_close(); ?>
        </div>
    </main>
</div>

<script>
    
    (function() {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>
