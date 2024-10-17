<!-- patient_search_results.php -->
<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2 class="mb-4 text-center">Patient Search Results</h2>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Results</h5>
            </div>
            <div class="card-body">
                <?php if (!empty($patients)): ?>
                    <ul class="list-group">
                        <?php foreach ($patients as $patient): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= htmlspecialchars($patient->name . ' ' . $patient->mname . ' ' . $patient->lname); ?>
                                <a href="<?= site_url('VitalSign/create?registration_id=' . $patient->id); ?>" class="btn btn-primary btn-sm">Select</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No patients found with that name.</p>
                <?php endif; ?>
                <a href="<?= site_url('VitalSign/search_form'); ?>" class="btn btn-secondary mt-3">Back to Search</a>
            </div>
        </div>
    </main>
</div>
