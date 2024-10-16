<h1>Add Appointment</h1>

<?php echo form_open('appointments/search_form'); ?>

<label for="appointment_date">Appointment Date:</label>
<input type="date" name="appointment_date" id="appointment_date" required>
<br>
<label for="appointment_time">Appointment Time:</label>
<input type="time" name="appointment_time" id="appointment_time" required>
<br>
<label for="doctor">Doctor:</label>
<input type="text" name="doctor" id="doctor" required>
<br>
<label for="notes">Notes:</label>
<textarea name="notes" id="notes" required></textarea>
<br>
<input type="submit" value="Add Appointment">

<?php echo form_close(); ?>