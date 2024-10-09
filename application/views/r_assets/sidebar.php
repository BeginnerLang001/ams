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
        .collapse {
            transition: max-height 0.3s ease;
            overflow: hidden;
            max-height: 0;
        }
        .collapse.show {
            max-height: 500px; /* Adjust as necessary */
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
                       <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Information
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo site_url('registration/create'); ?>">Registration</a>
                                <a class="nav-link" href="<?php echo site_url('registration/patients'); ?>">Patients</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Schedules and Medications
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Medications
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#collapsePages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo site_url('checkup/index'); ?>" class="btn btn-primary mb-3">Check Up</a>
                                        <a class="nav-link" href="<?php echo site_url('medication/search_form'); ?>" class="btn btn-primary mb-3">Add New Medication</a>
                                        <a class="nav-link" href="<?php echo site_url('medication/index'); ?>">Medical History</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#appointmentsCollapse"
                                    aria-expanded="false" aria-controls="appointmentsCollapse">
                                    Diagnosis
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="appointmentsCollapse" aria-labelledby="headingOne" data-bs-parent="#collapsePages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="<?php echo site_url('diagnosis/search_form'); ?>">Diagnose</a>
                                        <a class="nav-link" href="<?php echo site_url('diagnosis/index'); ?>">Diagnosis List</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Schedules
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#collapsePages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                            data-bs-target="#appointmentsCollapse" aria-expanded="false"
                                            aria-controls="appointmentsCollapse">
                                            Appointments
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="appointmentsCollapse">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="<?php echo site_url('appointments/index'); ?>">Walk-in Appointments</a>
                                                <a class="nav-link" href="<?php echo site_url('onlineappointments/index'); ?>">Online Appointments</a>
                                                <a class="nav-link" href="<?php echo site_url('doctors_appointments/index'); ?>">Doctors Schedule</a>
                                            </nav>
                                        </div>
                                        <a class="nav-link" href="<?php echo site_url('calendar/index'); ?>">Calendar</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">REPORTS</div>
                        <a class="nav-link" href="<?php echo site_url('report_view'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
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
                link.addEventListener('click', function () {
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
