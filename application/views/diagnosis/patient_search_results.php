<head>
<title>Patient Assessment</title>
</head>
<div id="layoutSidenav_content">
    
    <main class="container mt-4">
        <h2>Search Results</h2>
        
        <?php if (!empty($patients)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Birthday</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($patients as $patient): ?>
                            <tr>
                                <td><?php echo $patient['name']; ?></td>
                                <td><?php echo $patient['mname']; ?></td>
                                <td><?php echo $patient['lname']; ?></td>
                                <td><?php echo $patient['birthday']; ?></td>
                                <td><?php echo $patient['address']; ?></td>
                                <td>
                                    <a href="<?php echo site_url('diagnosis/add/'.$patient['id'].'?name='.urlencode($patient['name']).'&mname='.urlencode($patient['mname']).'&lname='.urlencode($patient['lname'])); ?>" class="btn btn-primary">Add Information</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No patients found with that name. Please try again.</p>
        <?php endif; ?>
        
    </main>
</div>
