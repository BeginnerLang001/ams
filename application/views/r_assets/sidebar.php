<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <link rel="icon" href="<?php echo base_url('assets/logo/favicon.ico'); ?>" type="image/gif">
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

        /* New styles for scrollable sidebar */
        #layoutSidenav_nav {
            max-height: 100vh;
            /* Limit to viewport height */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }
    </style>

</head>

<body>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- Main Section -->
                        <div class="sb-sidenav-menu-heading">Main</div>
                        <a class="nav-link" href="<?php echo site_url('clinic/dashboard'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <!-- Information Section -->
                        <?php if (in_array($this->session->userdata('user_level'), ['admin', 'secretary'])) { ?>
                            <div class="sb-sidenav-menu-heading">Information</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInfo"
                                aria-expanded="false" aria-controls="collapseInfo">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Information
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseInfo" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo site_url('registration/create'); ?>">Registration</a>
                                    <a class="nav-link" href="<?php echo site_url('registration/patients'); ?>">Patients</a>
                                </nav>
                            </div>


                            <!-- Schedules Section -->
                            <div class="sb-sidenav-menu-heading">Schedules</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAppointments"
                                aria-expanded="false" aria-controls="collapseAppointments">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                                Appointments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseAppointments" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?php echo site_url('appointments/index'); ?>">Appointments</a>
                                    <a class="nav-link" href="<?php echo site_url('doctors_appointments/index'); ?>">Doctors Schedule</a>
									<!-- <a class="nav-link" href="<?php echo site_url('appointments/followup'); ?>">Follow Up</a> -->
                                </nav>
                            </div>
                        <?php } ?>
                        
                        <!-- Medications Section -->
                        <div class="sb-sidenav-menu-heading">Medications</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMedications"
                            aria-expanded="false" aria-controls="collapseMedications">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Medications
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseMedications" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                            
                                <a class="nav-link" href="<?php echo site_url('VitalSign/index'); ?>">Initial Check-Up</a>
                                <a class="nav-link" href="<?php echo site_url('medication/index'); ?>">Patient History</a>
                                <!-- ADMIN AND DOCTOR ONLY -->
                                <?php if (in_array($this->session->userdata('user_level'), ['admin', 'doctor'])) { ?>
                                    <a class="nav-link" href="<?php echo site_url('laboratorytests/index'); ?>">Ultrasound Record</a>
                                    <a class="nav-link" href="<?php echo site_url('diagnosis/index'); ?>">Prescription</a>
                                <?php } ?>
                            </nav>
                        </div>


                        <!-- Calendar Section -->
                        <div class="sb-sidenav-menu-heading">Calendar</div>
                        <a class="nav-link" href="<?php echo site_url('calendar/index'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                            Calendar
                        </a>

                        <!-- Diagnosis Section (Admin and Doctor only) -->
                        <?php if (in_array($this->session->userdata('user_level'), ['admin', 'doctor'])) { ?>
                            <div class="sb-sidenav-menu-heading">Diagnosis</div>
                            <a class="nav-link" href="<?php echo site_url('findings/index'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-stethoscope"></i></div>
                                Diagnosis
                            </a>
							<!-- <a class="nav-link" href="<?php echo site_url('findings_view/index'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-stethoscope"></i></div>
                                view
                            </a> -->
                        <?php } ?>
						<!-- Account Section -->
						<?php if (in_array($this->session->userdata('user_level'), ['admin', ''])) { ?>
    <div class="sb-sidenav-menu-heading">User Management</div>
    <a class="nav-link" href="<?php echo site_url('Clinicuser/index'); ?>">
        <div class="sb-nav-link-icon">
            <i class="fas fa-users"></i>
        </div>
        User Management
    </a>
<?php } ?>

                        <!-- Reports Section -->
                        <div class="sb-sidenav-menu-heading">Reports</div>
                        <a class="nav-link" href="<?php echo site_url('report_view'); ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                            Reports
                        </a>

                        <!-- Logout Section -->
                        <div class="sb-sidenav-menu-heading">Logout</div>
                        <a class="nav-link" href="<?php echo site_url('auth/logout'); ?>">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-sign-out-alt"></i>
                            </div>
                            Logout
                        </a>
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
