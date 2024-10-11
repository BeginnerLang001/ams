<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2>Diagnosis List</h2>
        <a href="<?php echo site_url('diagnosis/search_form'); ?>" class="btn btn-primary mb-4">Add Diagnosis</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Diagnosis Type</th>
                        <th>Recommendation</th>
                        <th>Prescriptions</th>
                        <th>Date Released</th>
                        <th>Actions</th>
                        <th>Reccomendation</th>
                        <th>Prescription</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($diagnoses as $diagnosis): ?>
                        <tr id="row-<?php echo $diagnosis['id']; ?>">
                            <td><?php echo htmlspecialchars($diagnosis['name'] . ' ' . $diagnosis['mname'] . ' ' . $diagnosis['lname']); ?></td>
                            <td><?php echo htmlspecialchars($diagnosis['type']); ?></td>
                            <td><?php echo htmlspecialchars($diagnosis['recommendation']); ?></td>
                            <td><?php echo htmlspecialchars($diagnosis['prescriptions']); ?></td>
                            <td><?php echo htmlspecialchars($diagnosis['date_released']); ?></td>
                            <td>
                                <a href="<?php echo site_url('diagnosis/edit/' . $diagnosis['id']); ?>" class="btn btn-info" title="Edit Diagnosis">
                                    <i class="fas fa-edit"></i> <!-- Edit icon -->
                                </a>
                                <!-- <a href="<?php echo site_url('diagnosis/delete/' . $diagnosis['id']); ?>" class="btn btn-danger">Delete</a> -->
                            </td>
                            <td>
                                <button onclick="printReceipt(<?php echo $diagnosis['id']; ?>)" class="btn btn-secondary" title="Print Recommendation">
                                    <i class="fas fa-print"></i>
                                </button>
                            </td>
                            <td>
                                <button onclick="printSummary(<?php echo $diagnosis['id']; ?>)" class="btn btn-secondary" title="Print Prescription">
                                    <i class="fas fa-print"></i>
                                </button>
                            </td>
                            <a href="<?php echo site_url('ExportController/export_diagnosis_csv'); ?>" class="btn btn-secondary">Export CSV</a>
                            <a href="<?php echo site_url('ExportController/export_diagnosis_excel'); ?>" class="btn btn-secondary">Export Excel</a>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    function printReceipt(rowId) {
        var row = document.getElementById('row-' + rowId).children;
        var fullNameParts = row[0].innerText.split(' ');
        var firstName = fullNameParts[0] || '';
        var middleName = fullNameParts.length > 2 ? fullNameParts.slice(1, -1).join(' ') : '';
        var lastName = fullNameParts[fullNameParts.length - 1] || '';
        var diagnosisType = row[1].innerText;
        var recommendation = row[2].innerText;

        var receiptContent = `
        <div style="text-align: center; margin-top: 20px;">
            <h2>Mendoza Clinic</h2>
            <h4>Patient Diagnosis Receipt</h4>
            <hr style="border-top: 1px solid #000;">
        </div>
        <div style="padding: 10px; font-size: 16px;">
            <p><strong>Patient Name:</strong> ${firstName} ${middleName} ${lastName}</p>
            <p><strong>Diagnosis Type:</strong> ${diagnosisType}</p>
            <p><strong>Recommendation:</strong> ${recommendation}</p>
            <hr style="border-top: 1px solid #000;">
            <p><strong>Receipt ID:</strong> ${row[0].innerText}</p>
            <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>
            <hr style="border-top: 1px solid #000; margin-top: 20px;">
            <p>____________________________</p>
            <p><strong>Doctor:</strong> Dra. Chona Mendoza</p>
            <p><strong>Signature</strong></p>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <p>Thank you for visiting!</p>
        </div>
        `;

        var originalContent = document.body.innerHTML;
        document.body.innerHTML = receiptContent;
        window.print();
        document.body.innerHTML = originalContent;
    }

    function printSummary(rowId) {
        var row = document.getElementById('row-' + rowId).children;
        var fullNameParts = row[0].innerText.split(' ');
        var firstName = fullNameParts[0] || '';
        var middleName = fullNameParts.length > 2 ? fullNameParts.slice(1, -1).join(' ') : '';
        var lastName = fullNameParts[fullNameParts.length - 1] || '';
        var prescriptions = row[3].innerText;
        var dateReleased = row[4].innerText;

        var summaryContent = `
        <div style="text-align: center; margin-top: 20px;">
            <h2>Mendoza Clinic</h2>
            <h4>Prescription Summary</h4>
            <hr style="border-top: 1px solid #000;">
        </div>
        <div style="padding: 10px; font-size: 16px;">
            <p><strong>Patient Name:</strong> ${firstName} ${middleName} ${lastName}</p>
            <p><strong>Prescriptions:</strong> ${prescriptions}</p>
            <p><strong>Date Released:</strong> ${dateReleased}</p>
            <hr style="border-top: 1px solid #000;">
            <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>
            <hr style="border-top: 1px solid #000; margin-top: 20px;">
            <p>____________________________</p>
            <p><strong>Doctor:</strong> Dra. Chona Mendoza</p>
            <p><strong>Signature</strong></p>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <p>Thank you for visiting!</p>
        </div>
        `;

        var originalContent = document.body.innerHTML;
        document.body.innerHTML = summaryContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>

<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable({
            "order": [
                [1, "desc"], // Sort by Date
                [2, "desc"] // Then by Time
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": 5 // Make the Actions column not sortable
            }],
            paging: true,
            ordering: true,
            info: true
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/scripts.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script>