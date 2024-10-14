<div id="layoutSidenav_content">
    <div class="container my-4">
        <h1 class="mb-4">Update Status</h1>
        <form action="<?= base_url('onlineappointments/update/' . $appointment['id']); ?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $appointment['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $appointment['firstname']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $appointment['lastname']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="contact_number" class="form-label">contact_number:</label>
                <input type="number" class="form-control" id="contact_number" name="contact_number" value="<?= $appointment['contact_number']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="appointment_date" class="form-label">Appointment Date:</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="<?= $appointment['appointment_date']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="appointment_time" class="form-label">Appointment Time:</label>
                <input type="time" class="form-control" id="appointment_time" name="appointment_time" value="<?= $appointment['appointment_time']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select class="form-select" id="status" name="status">
                    <!-- <option value="pending" <?= $appointment['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option> -->
                    <!-- <option value="approved" <?= $appointment['status'] === 'approved' ? 'selected' : ''; ?>>Approved</option> -->
                    <option value="declined" <?= $appointment['status'] === 'declined' ? 'selected' : ''; ?>>Declined</option>
                    <option value="arrived" <?= $appointment['status'] === 'arrived' ? 'selected' : ''; ?>>Arrived</option>
                    <option value="completed" <?= $appointment['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                    <option value="booked" <?= $appointment['status'] === 'booked' ? 'selected' : ''; ?>>Booked</option>
                    <option value="attended" <?= $appointment['status'] === 'attended' ? 'selected' : ''; ?>>Attended</option>
                    <option value="did not attend" <?= $appointment['status'] === 'did not attend' ? 'selected' : ''; ?>>Did Not Attend</option>
                    <!-- <option value="waiting list" <?= $appointment['status'] === 'waiting list' ? 'selected' : ''; ?>>Waiting List</option> -->
                </select>

            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('onlineappointments'); ?>" class="btn btn-secondary">Back</a>
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