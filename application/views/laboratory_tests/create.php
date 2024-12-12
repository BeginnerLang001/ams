<div id="layoutSidenav_content">
    <div class="mb-4">
        <h2 class="text-primary">Ultrasound</h2>
        <form method="post" action="<?= site_url('laboratorytests/search_patient'); ?>" class="mb-3">
            <div class="input-group">
                <input type="text" name="name" class="form-control" placeholder="Search Patient Name" aria-label="Search Patient Name">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>
        <?php if ($patient): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Selected Patient</h5>
                    <p class="card-text">
                        Name: <?= htmlspecialchars($patient['name']); ?>
                        <?= !empty($patient['mname']) ? htmlspecialchars($patient['mname']) . ' ' : ''; ?>
                        <?= htmlspecialchars($patient['lname']); ?>
                    </p>
                    <p class="card-text">Birthday: <?= date('F j, Y', strtotime($patient['birthday'])); ?></p>
                    <p class="card-text">Address: <?= htmlspecialchars($patient['address']); ?></p>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                No patient selected.
            </div>
        <?php endif; ?>
    </div>

    <!-- Laboratory Test Form -->
    <?php if ($patient): ?>
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?= site_url('laboratorytests/store'); ?>">
                    <input type="hidden" name="registration_id" value="<?= htmlspecialchars(str_pad($patient['id'], 4, '0', STR_PAD_LEFT)); ?>">

                    <div class="form-group mb-3">
                        <label for="diagnosis_type_id">Diagnosis Type:</label>
                        <select name="diagnosis_type_id" id="diagnosis_type_id" class="form-control">
                            <option value="0">Select</option>
                            <option value="1">Pre-mature</option>
                            <option value="2">Placenta Previa</option>
                            <option value="3">Abruptio Placenta</option>
                            <option value="4">Cesarian Section</option>
                            <option value="6">Check Up</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ultrasound" class="form-label">Ultrasound Result:</label>
                            <input type="text" name="ultrasound" id="ultrasound" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="results" class="form-label">Comments:</label>
                            <textarea name="results" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="pregnancy_test" class="form-label">Baby's Height:</label>
                            <input type="text" name="pregnancy_test" id="pregnancy_test" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="urinalysis" class="form-label">Baby's Weight:</label>
                            <input type="text" name="urinalysis" id="urinalysis" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="test_date" class="form-label">Test Date:</label>
                            <input type="date" name="test_date" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="created_at" class="form-label">Date Record:</label>
                            <input type="datetime-local" name="created_at" class="form-control"
                                value="<?= isset($test) && !empty($test['created_at']) ? date('Y-m-d\TH:i', strtotime($test['created_at'] . ' +8 hours')) : date('Y-m-d\TH:i'); ?>"
                                readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="last_update" class="form-label">Last Update:</label>
                            <input type="datetime-local" name="last_update" class="form-control"
                                value="<?= isset($test) && !empty($test['last_update']) ? date('Y-m-d\TH:i', strtotime($test['last_update'] . ' +8 hours')) : date('Y-m-d\TH:i'); ?>"
                                readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>
