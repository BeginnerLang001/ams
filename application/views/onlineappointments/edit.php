<div id="layoutSidenav_content">
    <div class="container my-4">
        <h1 class="mb-4 text-center">Update Appointment Status</h1>
        
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        
        <style>
    .form-container {
        background-color: #f8f9fa; /* Light background */
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
    }
    .form-label {
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-section {
        margin-bottom: 20px; /* Spacing between sections */
        border-bottom: 1px solid #e0e0e0; /* Divider line */
        padding-bottom: 15px; /* Space below the section */
    }
</style>

<form action="<?= base_url('onlineappointments/update/' . $appointment['id']); ?>" method="POST" class="form-container">
    <!-- CSRF token -->
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

    <div class="row">
        <div class="col-md-12 form-section">
            <h4>Patient Information</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email', $appointment['email']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="firstname" class="form-label">First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?= set_value('firstname', $appointment['firstname']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastname" class="form-label">Last Name:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?= set_value('lastname', $appointment['lastname']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="contact_number" class="form-label">Contact Number:</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?= set_value('contact_number', $appointment['contact_number']); ?>" required>
                </div>
            </div>
        </div>

        <div class="col-md-12 form-section">
            <h4>Appointment Details</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="appointment_date" class="form-label">Appointment Date:</label>
                    <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?= set_value('appointment_date', $appointment['appointment_date']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="appointment_time" class="form-label">Appointment Time:</label>
                    <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?= set_value('appointment_time', $appointment['appointment_time']); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select class="form-select" id="status" name="status" required>
                        <?php 
                        // Use null coalescing operator to provide a default value for status
                        $current_status = $appointment['status'] ?? 'pending'; 
                        ?>
                        <option value="pending" <?= set_select('status', 'pending', $current_status === 'pending'); ?>>Pending</option>
                        <option value="booked" <?= set_select('status', 'booked', $current_status === 'booked'); ?>>Booked</option>
                        <option value="arrived" <?= set_select('status', 'arrived', $current_status === 'arrived'); ?>>Arrived</option>
                        <option value="reschedule" <?= set_select('status', 'reschedule', $current_status === 'reschedule'); ?>>Reschedule</option>
                        <option value="follow_up" <?= set_select('status', 'follow_up', $current_status === 'follow_up'); ?>>Follow-up</option>
                        <option value="cancelled" <?= set_select('status', 'cancelled', $current_status === 'cancelled'); ?>>Cancelled</option>
                        <option value="in_session" <?= set_select('status', 'in_session', $current_status === 'in_session'); ?>>In Session</option>
                        <option value="completed" <?= set_select('status', 'completed', $current_status === 'completed'); ?>>Completed</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('onlineappointments'); ?>" class="btn btn-secondary">Back</a>
    </div>
</form>

    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>

<!-- Optional: Include timepicker if needed -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
