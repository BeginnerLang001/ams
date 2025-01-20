<div id="layoutSidenav_content">
	<div class="container mt-4">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<h1 class="text-primary">User Management</h1>
			<a href="<?php echo site_url('clinicuser/create'); ?>" class="btn btn-primary">Create Account</a>
		</div>

		<div class="card shadow">
			<div class="card-body">
				<table class="table table-bordered table-striped table-hover">
					<thead class="table-primary">
						<tr>
							<th>ID</th>
							<!-- <th>Email</th> -->
							<th>First Name</th>
							<th>Last Name</th>
							<!-- <th>Birthday</th> -->
							<th>Mobile</th>
							<th>Role</th>
							<th>Username</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>
							<tr>
								<td><?php echo ucwords($user['id']); ?></td>
								<!-- <td><?php echo ucwords($user['email']); ?></td> -->
								<td><?php echo ucwords($user['firstname']); ?></td>
								<td><?php echo ucwords($user['lastname']); ?></td>
								<!-- <td><?php echo ucwords($user['birthday']); ?></td> -->
								<td><?php echo ucwords($user['mobile']); ?></td>
								<td><?php echo ucwords($user['user_level']); ?></td>
								<td><?php echo ucwords($user['username']); ?></td>


								<td>
									<a href="<?php echo site_url('clinicuser/edit/' . $user['id']); ?>" class="btn btn-sm btn-warning">Update</a>
									<a href="<?php echo site_url('clinicuser/delete/' . $user['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>
