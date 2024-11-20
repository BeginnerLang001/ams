<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="<?php echo base_url('assets/logo/favicon.ico'); ?>" type="image/gif">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    /* General Body Styling */
    body {
        background: linear-gradient(45deg, #28a745, #34d058, #20c997); /* Green gradient */
        background-size: 400% 400%; /* Set the gradient size */
        animation: gradientAnimation 10s ease infinite; /* Animation for smooth gradient transition */
        font-family: 'Arial', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
    }

    /* Keyframe for gradient animation */
    @keyframes gradientAnimation {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    /* Login Container Styling */
    .login-container {
        background-color: #ffffff; /* Clean white background */
        border-radius: 0.75rem; /* Soft rounded corners */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        max-width: 420px;
        width: 100%;
        padding: 3rem 2rem;
        opacity: 0;
        transform: translateY(-30px);
        animation: fadeIn 0.8s ease-out forwards; /* Animation for smooth appearance */
    }

    /* Keyframe animation for fade-in effect */
    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Form Header Styling */
    .login-container h2 {
        font-size: 1.75rem;
        text-align: center;
        color: #495057;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }

    /* Input Fields Styling */
    input[type="text"],
    input[type="password"],
    input[type="email"] {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #ced4da;
        border-radius: 0.5rem;
        margin-bottom: 1.25rem;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    /* Input Focus Styling */
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="email"]:focus {
        border-color: #007bff; /* Blue border on focus */
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.4);
    }

    /* Password Toggle Icon */
    .password-toggle {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
    }

    .password-toggle i {
        color: #007bff; /* Blue color for the icon */
        font-size: 1.2rem;
    }

    /* Hover Effect on Icon */
    .password-toggle:hover i {
        color: #0056b3; /* Darker blue on hover */
    }

    /* Submit Button Styling */
    .btn-submit {
        width: 100%;
        padding: 12px 16px;
        background-color: #007bff;
        color: #ffffff;
        font-size: 1.1rem;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Button Hover Effect */
    .btn-submit:hover {
        background-color: #0056b3;
    }

    /* Forgot Password Link Styling */
    .forgot-password {
        font-size: 0.9rem;
        text-align: center;
        display: block;
        color: #007bff;
        text-decoration: none;
        margin-top: 1rem;
        transition: color 0.3s ease;
    }

    /* Forgot Password Hover Effect */
    .forgot-password:hover {
        color: #0056b3;
    }

    /* Animation for "Fade In" */
    .fadeIn {
        animation: fadeIn 0.8s ease-out forwards;
    }

    /* Responsive Styles */
    @media (max-width: 576px) {
        .login-container {
            padding: 2rem;
        }

        .login-container h2 {
            font-size: 1.5rem;
        }
    }
</style>


</head>
<body>
<main class="login-container">
    <?php echo form_open('auth/login'); ?>
        <h2 class="text-center mb-4">Login</h2>
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" id="username" name="username" class="form-control" placeholder="Enter your Username" required>
            <div class="invalid-feedback">
                Please enter a valid username.
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <div class="position-relative">
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                <button type="button" class="password-toggle" aria-label="Toggle password visibility">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                </button>
                <div class="invalid-feedback">
                    Please enter your password.
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success w-100">Login</button> <!-- Green button -->
    <?php echo form_close(); ?>
</main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.querySelector('.password-toggle');
            const toggleIcon = document.getElementById('toggleIcon');

            toggleButton.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('bi-eye-slash');
                    toggleIcon.classList.add('bi-eye');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('bi-eye');
                    toggleIcon.classList.add('bi-eye-slash');
                }
            });

            const form = document.getElementById('loginForm');
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    </script>
</body>
</html>
