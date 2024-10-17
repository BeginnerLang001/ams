<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosis List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        @media print {
            /* Hide elements that should not be printed */
            .no-print {
                display: none;
            }
            body {
                font-size: 12pt;
            }
        }
    </style>
</head>
<body>
    <div id="layoutSidenav_content">
        <main class="container mt-4">
            <h2>Diagnosis List</h2>
            <a href="<?php echo site_url('diagnosis/search_form'); ?>" class="btn btn-primary mb-4">Add Diagnosis</a>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="datatablesSimple" aria-describedby="diagnosisListTable">
                    <thead>
                        <tr>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Diagnosis Type</th>
                            <th>Recommendation</th>
                            <th>Prescriptions</th>
                            <th>Date Released</th>
                            <th>Recommendation</th>
                            <th>Prescription</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($diagnoses as $diagnosis): ?>
                            <tr id="row-<?php echo $diagnosis['id']; ?>">
                                <td>
                                    <?php
                                    if (isset($diagnosis['registration_id'])) {
                                        $registration_id = $diagnosis['registration_id'];
                                        echo htmlspecialchars(str_pad($registration_id, 4, '0', STR_PAD_LEFT));
                                    } else {
                                        echo 'No ID';
                                    }
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars($diagnosis['name'] . ' ' . $diagnosis['mname'] . ' ' . $diagnosis['lname']); ?></td>
                                <td><?php echo htmlspecialchars($diagnosis['type']); ?></td>
                                <td><?php echo htmlspecialchars($diagnosis['recommendation']); ?></td>
                                <td><?php echo htmlspecialchars($diagnosis['prescriptions']); ?></td>
                                <td><?php echo htmlspecialchars($diagnosis['date_released']); ?></td>
                                <td>
                                    <button onclick="printReceipt(<?php echo $diagnosis['id']; ?>)" class="btn btn-info btn-sm" title="Print Recommendation">
                                        <i class="fas fa-file-alt"></i> Recommendation
                                    </button>
                                    
                                </td>
                                <td>
                                <button onclick="printSummary(<?php echo $diagnosis['id']; ?>)" class="btn btn-success btn-sm" title="Print Prescription">
                                        <i class="fas fa-prescription-bottle-alt"></i> Prescription
                                    </button>
                                </td>
                            </tr>

                            <!-- Hidden receipt and summary divs -->
<div id="receipt-<?= $diagnosis['id'] ?>" style="display:none; padding: 20px; font-family: Arial, sans-serif;">
    <h1 style="text-align: center; color: #007bff;">Mendoza Clinic</h1>
    <h4 style="text-align: center;">Patient Diagnosis Receipt</h4>
    <hr style="border: 1px solid #007bff; margin: 20px 0;">
    
    <div style="margin: 10px 0;">
        <p><strong>Patient ID:</strong> <?= htmlspecialchars(str_pad($registration_id, 4, '0', STR_PAD_LEFT)); ?></p>
        <p><strong>Patient Name:</strong> <?= htmlspecialchars($diagnosis['name'] . ' ' . $diagnosis['mname'] . ' ' . $diagnosis['lname']); ?></p>
        <p><strong>Diagnosis Type:</strong> <?= htmlspecialchars($diagnosis['type']); ?></p>
        <p><strong>Recommendation:</strong> <?= htmlspecialchars($diagnosis['recommendation']); ?></p>
        <p><strong>Date:</strong> <?= date('Y-m-d'); ?></p>
    </div>
    
    <div style="text-align: center; margin-top: 40px;">
        <p>____________________________</p>
        <p><strong>Doctor:</strong> Dra. Chona Mendoza</p>
        <p><strong>Signature</strong></p>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <p>Thank you for visiting!</p>
    </div>
</div>

<div id="summary-<?= $diagnosis['id'] ?>" style="display:none; padding: 20px; font-family: Arial, sans-serif;">
    <h1 style="text-align: center; color: #007bff;">Mendoza Clinic</h1>
    <h4 style="text-align: center;">Prescription Summary</h4>
    <hr style="border: 1px solid #007bff; margin: 20px 0;">

    <div style="margin: 10px 0;">
        <p><strong>Patient ID:</strong> <?= htmlspecialchars(str_pad($registration_id, 4, '0', STR_PAD_LEFT)); ?></p>
        <p><strong>Patient Name:</strong> <?= htmlspecialchars($diagnosis['name'] . ' ' . $diagnosis['mname'] . ' ' . $diagnosis['lname']); ?></p>
        <p><strong>Prescriptions:</strong> <?= htmlspecialchars($diagnosis['prescriptions']); ?></p>
        <p><strong>Date Released:</strong> <?= htmlspecialchars($diagnosis['date_released']); ?></p>
        <p><strong>Date:</strong> <?= date('Y-m-d'); ?></p>
    </div>

    <div style="text-align: center; margin-top: 40px;">
        <p>____________________________</p>
        <p><strong>Doctor:</strong> Dra. Chona Mendoza</p>
        <p><strong>Signature</strong></p>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <p>Thank you for visiting!</p>
    </div>
</div>


                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({
                "order": [
                    [5, "desc"], // Sort by Date Released
                    [1, "asc"] // Then by Patient Name
                ],
                "columnDefs": [{
                    "orderable": false,
                    "targets": 6 // Make the Actions column not sortable
                }],
                paging: true,
                ordering: true,
                info: true
            });
        });

        function printReceipt(rowId) {
            var receiptContent = document.getElementById('receipt-' + rowId).innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = receiptContent;
            window.print();
            document.body.innerHTML = originalContent;
        }

        function printSummary(rowId) {
            var summaryContent = document.getElementById('summary-' + rowId).innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = summaryContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
</body>
</html>
<!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('disc/js/datatables-simple-demo.js') ?>"></script> -->