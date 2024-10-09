<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="<?php echo site_url('user/update'); ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" value="<?php echo set_value('firstname', $user['firstname']); ?>">
        <br>
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo set_value('lastname', $user['lastname']); ?>">
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
