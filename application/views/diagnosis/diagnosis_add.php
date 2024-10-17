<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2>Patient Assesstment</h2>
        
        <h4>
    Patient Name:<span style="text-decoration: underline; text-transform: uppercase;">
    <?php echo $patient_name . ' ' . $patient_mname . ' ' . $patient_lname; ?></span>
</h4>


        <form action="<?php echo site_url('diagnosis/store'); ?>" method="post">
            <input type="hidden" name="registration_id" value="<?php echo $patient_id; ?>">

            <div class="form-group">
                <label for="diagnosis_type_id">Service Type:</label>
                <select name="diagnosis_type_id" id="diagnosis_type_id" class="form-control">
                    <option value="0">Select</option>
                    <option value="1">Pre-mature</option>
                    <option value="2">Placenta Previa</option>
                    <option value="3">Abruptio Placenta</option>
                    <option value="4">Cesarian Section</option>
                    <option value="6">Check Up</option>
                </select>
            </div>

            <div class="form-group">
                <label for="recommendation">Recommendation:</label>
                <textarea name="recommendation" id="recommendation" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="prescriptions">Prescription:</label>
                <textarea name="prescriptions" id="prescriptions" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="date_released">Date Released:</label>
                <input type="date" name="date_released" id="date_released" class="form-control" value="<?php echo date('Y-m-d'); ?>">
            </div>


            <button type="submit" class="btn btn-primary">Save Diagnosis</button>
        </form>
    </main>
</div>