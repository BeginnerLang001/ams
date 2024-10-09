<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2>Edit Diagnosis</h2>
        <form action="<?php echo site_url('diagnosis/update/'.$diagnosis['id']); ?>" method="post">
            <div class="form-group">
                <label for="diagnosis_type_id">Diagnosis Type:</label>
                <select name="diagnosis_type_id" id="diagnosis_type_id" class="form-control">
                    <?php foreach ($diagnosis_types as $type): ?>
                        <option value="<?php echo $type['id']; ?>" <?php if($type['id'] == $diagnosis['diagnosis_type_id']) echo 'selected'; ?>>
                            <?php echo $type['type']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="recommendation">Recommendation:</label>
                <textarea name="recommendation" id="recommendation" class="form-control"><?php echo $diagnosis['recommendation']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="prescription">Prescription:</label>
                <textarea name="prescription" id="prescriptions" class="form-control"><?php echo $diagnosis['prescriptions']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Diagnosis</button>
        </form>
    </main>
</div>
