<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2>Search Results</h2>
        <a href="<?php echo site_url('medication/store'); ?>" 
           style="
               display: inline-block; 
               padding: 10px 20px; 
               background-color: #6c757d; 
               color: white; 
               text-decoration: none; 
               border-radius: 5px; 
               font-size: 16px; 
               font-weight: bold; 
               transition: background-color 0.3s ease; 
               margin-bottom: 20px;
           " 
           onmouseover="this.style.backgroundColor='#5a6268';" 
           onmouseout="this.style.backgroundColor='#6c757d';">
           BACK
        </a>
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
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($patients as $patient): ?>
                                <tr>
                                    <td><?php echo $patient['name'] . ' ' . $patient['mname'] . ' ' . $patient['lname']; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('medication/add/' . $patient['id']); ?>" 
                                           style="
                                               display: inline-block; 
                                               padding: 8px 16px; 
                                               background-color: #007BFF; 
                                               color: white; 
                                               text-decoration: none; 
                                               border-radius: 5px; 
                                               font-size: 14px; 
                                               font-weight: bold; 
                                               transition: background-color 0.3s ease;
                                               margin-top: 5px;
                                           " 
                                           onmouseover="this.style.backgroundColor='#0056b3';" 
                                           onmouseout="this.style.backgroundColor='#007BFF';">
                                           Add Medication
                                        </a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>
