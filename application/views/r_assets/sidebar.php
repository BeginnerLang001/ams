<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .sb-sidenav-dark {
            background-color: #343a40;
            color: #ffffff;
        }

        .sb-sidenav-dark .nav-link {
            color: #ffffff;
        }

        .sb-sidenav-dark .nav-link:hover {
            background-color: #495057;
            transition: background-color 0.3s ease;
        }

        .sb-nav-link-icon {
            margin-right: 0.5rem;
        }

        .sb-sidenav-collapse-arrow {
            transition: transform 0.3s ease;
        }

        .sb-sidenav-collapse-arrow.rotate {
            transform: rotate(180deg);
        }
    </style>
</head>

<body>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Main</div>
                        <a class="nav-link" href="<?php echo site_url('clinic/dashboard'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Information</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInfo"
                            aria-expanded="false" aria-controls="collapseInfo">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Information
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseInfo" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo site_url('registration/create'); ?>">Registration</a>
                                <a class="nav-link" href="<?php echo site_url('registration/patients'); ?>">Patients</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Schedules and Medications</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSchedules"
                            aria-expanded="false" aria-controls="collapseSchedules">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Schedules and Medications
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseSchedules" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCheckup"
                                    aria-expanded="false" aria-controls="collapseCheckup">
                                    Check-Up
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseCheckup" data-bs-parent="#collapseSchedules">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo site_url('VitalSign/index'); ?>">Initial Check-Up</a>
                                        <a class="nav-link" href="<?php echo site_url('medication/index'); ?>">Patient History</a>
                                        <a class="nav-link" href="<?php echo site_url('laboratorytests/index'); ?>">Laboratory Record</a>
                                        <a class="nav-link" href="<?php echo site_url('diagnosis/index'); ?>">Treatments</a>
                                        
                                        <!-- Add more sub-items here if needed -->
                                    </nav>
                                </div>



                                <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosis"
                                    aria-expanded="false" aria-controls="collapseDiagnosis">
                                    Diagnosis
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseDiagnosis" data-bs-parent="#collapseSchedules">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo site_url('diagnosis/search_form'); ?>">Diagnose</a>
                                        <a class="nav-link" href="<?php echo site_url('diagnosis/index'); ?>">Diagnosis List</a>
                                    </nav>
                                </div> -->
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAppointments"
                                    aria-expanded="false" aria-controls="collapseAppointments">
                                    Appointments
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseAppointments" data-bs-parent="#collapseSchedules">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo site_url('appointments/index'); ?>">Appointments</a>
                                        <!-- <a class="nav-link" href="<?php echo site_url('onlineappointments/index'); ?>">Online Appointments</a> -->
                                        <a class="nav-link" href="<?php echo site_url('doctors_appointments/index'); ?>">Doctors Schedule</a>
                                    </nav>
                                </div>
                                <a class="nav-link" href="<?php echo site_url('calendar/index'); ?>">Calendar</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Findings</div>
                        <a class="nav-link" href="<?php echo site_url('findings/index'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-stethoscope"></i></div>
                            Findings
                        </a>

                        <div class="sb-sidenav-menu-heading">Reports</div>
                        <a class="nav-link" href="<?php echo site_url('report_view'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                            Reports
                        </a>
                        <!-- <a class="nav-link" href="<?php echo site_url('ReportController/weekly'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Weekly Report
                        </a>
                        <a class="nav-link" href="<?php echo site_url('ReportController/monthly'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Monthly Report
                        </a> -->
                    </div>
                </div>
            </nav>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.querySelectorAll('.nav-link.collapsed').forEach(link => {
                link.addEventListener('click', function() {
                    document.querySelectorAll('.sb-sidenav-collapse-arrow').forEach(arrow => {
                        arrow.classList.remove('rotate');
                    });
                    if (this.querySelector('.sb-sidenav-collapse-arrow')) {
                        this.querySelector('.sb-sidenav-collapse-arrow').classList.toggle('rotate');
                    }
                });
            });
        </script>
</body>

</html>