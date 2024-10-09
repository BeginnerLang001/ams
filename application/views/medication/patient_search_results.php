<div id="layoutSidenav_content">
    <main class="container mt-4">
        
        <h2>Search Results</h2>
        <a href="<?php echo site_url('medication/store'); ?>">BACK</a>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Medical History
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="datatablesSimple">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($patients as $patient): ?>
                                <tr>
                                    <!-- <td><?php echo $patient['id']; ?></td> -->
                                    <td><?php echo $patient['name'] . ' ' . $patient['mname'] . ' ' . $patient['lname']; ?>
                                    </td>
                                    <td>
                                    <a href="<?php echo site_url('medication/add/' . $patient['id']); ?>">Add Medication</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
    crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>