<div id="layoutSidenav_content"> 
    <div class="container mt-4">
        <h2 class="text-primary">Ultrasound Results</h2>
        
        <div class="card mb-4" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Patient Information</h5>
                        <ul class="list-unstyled">
                        <li><strong>Patient ID:</strong> <?= htmlspecialchars(str_pad($test['registration_id'], 4, '0', STR_PAD_LEFT)); ?></li>

                            <li><strong>Name:</strong> <?= htmlspecialchars($this->LaboratoryTest_model->get_patient_name($test['registration_id'])); ?></li>
                            <li><strong>Birthday:</strong> <?= htmlspecialchars($this->LaboratoryTest_model->get_birthday($test['registration_id'])); ?></li>
                            <li><strong>Address:</strong> <?= htmlspecialchars($this->LaboratoryTest_model->get_address($test['registration_id'])); ?></li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <h5 class="card-title">Ultrasound</h5>
                        <ul class="list-unstyled">
                            <li><strong>Ultrasound Result:</strong> <?= htmlspecialchars($test['ultrasound']); ?></li>
                            <!-- <li><strong>Pregnancy Test Result:</strong> <?= htmlspecialchars($test['pregnancy_test']); ?></li> -->
                            <!-- <li><strong>Urinalysis Result:</strong> <?= htmlspecialchars($test['urinalysis']); ?></li> -->
                            
                            <li><strong>Test Date:</strong> <?= htmlspecialchars(date('F j, Y', strtotime($test['test_date']))); ?></li>
                            <li><strong>Comments:</strong> <?= htmlspecialchars($test['results']); ?></li>
                            <li><strong>Date Recorded:</strong> <?= htmlspecialchars(date('F j, Y, g:i a', strtotime($test['created_at']))); ?></li>
                            <li><strong>Last Update:</strong> <?= htmlspecialchars(date('F j, Y, g:i a', strtotime($test['last_update']))); ?></li>
                        </ul>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= site_url('laboratorytests/index'); ?>" class="btn btn-secondary">Back to List</a>
                    <a href="<?= site_url('laboratorytests/create'); ?>" class="btn btn-success">Add New Test</a>
                </div>
            </div>
        </div>
    </div>
</div>
