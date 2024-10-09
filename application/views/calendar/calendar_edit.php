<h1>Edit Appointment</h1>

<?php echo form_open('calendar/update/' . $appointment['id']); ?>

<label for="appointment_date">Appointment Date:</label>
<input type="date" name="appointment_date" id="appointment_date" value="<?php echo $appointment['appointment_date']; ?>" required>
<br>
<label for="appointment_time">Appointment Time:</label>
<input type="time" name="appointment_time" id="appointment_time" value="<?php echo $appointment['appointment_time']; ?>" required>
<br>
<label for="doctor">Doctor:</label>
<input type="text" name="doctor" id="doctor" value="<?php echo $appointment['doctor']; ?>" required>
<br>
<label for="notes">Notes:</label>
<textarea name="notes" id="notes" required><?php echo $appointment['notes']; ?></textarea>
<br>
<input type="submit" value="Update Appointment">

<?php echo form_close(); ?>