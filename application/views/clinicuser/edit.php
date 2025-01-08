<div id="layoutSidenav_content">
    <div class="container mt-4">
            <div class="card-header text-center bg-warning text-dark">
                <h2>Edit User</h2>
            </div>
            <div class="card-body">
                <form action="<?php echo site_url('clinicuser/update/'.$user['id']); ?>" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                        <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>" required>
                        <div class="invalid-feedback">Please enter the first name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>" required>
                        <div class="invalid-feedback">Please enter the last name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday:</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $user['birthday']; ?>" required>
                        <div class="invalid-feedback">Please select a valid date.</div>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile:</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>" required>
                        <div class="invalid-feedback">Please enter a valid mobile number.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Change Password:</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
                        <div class="invalid-feedback">Please enter a password.</div>
                    </div>
                    <div class="mb-3">
                        <label for="user_level" class="form-label">User Level:</label>
                        <select class="form-select" id="user_level" name="user_level" required>
                            <option value="admin" <?php echo ($user['user_level'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="user" <?php echo ($user['user_level'] == 'user') ? 'selected' : ''; ?>>User</option>
                            <option value="secretary" <?php echo ($user['user_level'] == 'secretary') ? 'selected' : ''; ?>>Secretary</option>
                            <option value="doctor" <?php echo ($user['user_level'] == 'doctor') ? 'selected' : ''; ?>>Doctor</option>
                        </select>
                        <div class="invalid-feedback">Please select a user level.</div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                        <div class="invalid-feedback">Please enter a username.</div>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Update</button>
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


