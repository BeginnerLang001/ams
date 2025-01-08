
<div id="layoutSidenav_content">
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header text-center bg-success text-white">
                <h2>Create User</h2>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('clinicuser/store'); ?>" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                        <div class="invalid-feedback">Please enter the first name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                        <div class="invalid-feedback">Please enter the last name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday:</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" required>
                        <div class="invalid-feedback">Please select a valid date.</div>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile:</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" required>
                        <div class="invalid-feedback">Please enter a valid mobile number.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="invalid-feedback">Please enter a password.</div>
                    </div>
                    <div class="mb-3">
                        <label for="user_level" class="form-label">User Type:</label>
                        <select class="form-select" id="user_level" name="user_level" required>
                            <option value="">Select User Type</option>
                            <option value="admin">Admin</option>
                            
                            <option value="secretary">Secretary</option>
                            <option value="doctor">Doctor</option>
                        </select>
                        <div class="invalid-feedback">Please select a User Type.</div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                        <div class="invalid-feedback">Please enter a username.</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Bootstrap validation script
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>

