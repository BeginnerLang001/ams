<div id="layoutSidenav_content">
    <div class="container mt-4">
        <h2>Patient List</h2>
        <a href="<?php echo site_url('diagnosis/search_form'); ?>" class="btn btn-primary mb-4">Add Prescription</a>

        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Date Released</th>
                        <th>Actions</th>
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
                            <td><?php echo htmlspecialchars($diagnosis['date_released']); ?></td>
                            <td>
                                <button onclick="printSummary(<?php echo $diagnosis['id']; ?>)" class="btn btn-success btn-sm" title="Print Prescription">
                                    <i class="fas fa-prescription-bottle-alt"></i> Prescription
                                </button>
                            </td>
                        </tr>

                        <!-- Hidden div for the prescription summary -->
                        <div id="summary-<?php echo $diagnosis['id']; ?>" style="display:none;">
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
    </div>

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize DataTable with specified settings
        $('#datatablesSimple').DataTable({
            "paging": true, // Enable pagination
            "ordering": true, // Allow sorting of columns
            "info": true, // Display table information
            "order": [
                [2, "desc"], // Sort by Date Released (3rd column) in descending order
                [1, "asc"] // Then by Patient Name (2nd column) in ascending order
            ],
            "language": {
                // "lengthMenu": "Display _MENU_ records per page",
                "zeroRecords": "No records found",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                // "search": "Search:",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    });

    // Function to print the summary content of a specific row
    function printSummary(rowId) {
        // Get the content of the summary element
        var summaryContent = document.getElementById('summary-' + rowId);
        if (!summaryContent) {
            alert("Summary content not found!");
            return; // Exit if no content is found
        }

        // Save original body content and replace with summary content
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = summaryContent.innerHTML;

        // Trigger the print dialog
        window.print();

        // Restore the original content after printing
        document.body.innerHTML = originalContent;
    }
    </script>
</div>
