<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?php echo base_url('assets/logo/favicon.ico'); ?>" type="image/gif">
    <title>Register</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #e0f7e0, #90ee90);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #2e7d32;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            display: none;
        }

        input {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #cfcfcf;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #4caf50;
            border: none;
            border-radius: 5px;
            color: #ffffff;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #388e3c;
        }

        .error {
            color: #e53935;
            margin-bottom: 10px;
        }

        .message {
            margin-top: 20px;
        }

        .message a {
            color: #388e3c;
            text-decoration: none;
        }

        .message a:hover {
            text-decoration: underline;
        }

        .password-container {
            position: relative;
            width: 100%;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <div class="error"><?php echo validation_errors(); ?></div>
        <?php echo form_open('auth/register'); ?>
            
            <input type="text" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" placeholder="First Name" value="<?php echo set_value('firstname'); ?>">
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" placeholder="Last Name" value="<?php echo set_value('lastname'); ?>">
            <label for="birthday4">Birthday:</label>
            <input type="date" name="birthday" placeholder="Birthday" value="<?php echo set_value('birthday'); ?>">
            <!-- <label for="email">Email:</label> -->
            <label for="mobile">Mobile:</label>
            <input type="text" name="mobile" placeholder="Mobile" value="<?php echo set_value('mobile'); ?>">
            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" placeholder="Create Password" name="password" id="register_password">
                <span class="toggle-password" onclick="togglePassword('register_password')">Show</span>
            </div>
            <label for="confirm_password">Confirm Password:</label>
            <div class="password-container">
                <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_register_password">
                <span class="toggle-password" onclick="togglePassword('confirm_register_password')">Show</span>
            </div>
            <button type="submit">Register</button>
        <?php echo form_close(); ?>
        <div class="message">
            Already Have Account? <a href="<?php echo site_url('auth/login'); ?>">Login Here!</a>
        </div>
    </div>
    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
</body>
</html>
