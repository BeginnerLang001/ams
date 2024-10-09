<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Settings</title>
</head>
<body>
    <h2>Appointment Settings</h2>
    <?php echo validation_errors(); ?>
    <?php echo form_open('appointments/settings'); ?>

    <label for="open_days">Open Days</label>
    <input type="text" name="open_days" value="<?php echo set_value('open_days', $settings['open_days']); ?>"><br>

    <label for="open_hours">Open Hours</label>
    <input type="text" name="open_hours" value="<?php echo set_value('open_hours', $settings['open_hours']); ?>"><br>

    <input type="submit" name="submit" value="Save Settings">
    </form>
</body>
</html>
