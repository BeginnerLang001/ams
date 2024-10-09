<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('disc/css/dashboard.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/datatables.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fullcalendar.print.css'); ?> " media='print' />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fullcalendar.css'); ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="icon" href="<?php echo base_url('assets/logo/favicon.ico'); ?>" type="image/gif">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.7.2/main.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='assets/js/jquery-1.10.2.js' type="text/javascript"></script>
    <script src='assets/js/jquery-ui.custom.min.js' type="text/javascript"></script>
    <script src='assets/js/fullcalendar.js' type="text/javascript"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .fas {
            margin-right: 4px;
        }

        .sidebar .nav-link.active {
            color: #007bff;
        }

        .sidebar .nav-link:hover .fas {
            color: inherit;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content {
            padding: 20px;
        }
    </style>
</head>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-bell"></i></a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-user"></i> Profile</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(''); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        </form>
    </div>
</nav>
<!-- End of Navbar -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo site_url('clinic/dashboard'); ?>">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('registration/create'); ?>">
                            <i class="fas fa-tasks"></i> Fill up Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('medication/add'); ?>">
                            <i class="fa fa-plus-square"></i> Add Medical History
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('registration/index'); ?>">
                                <i class="fas fa-users"></i> Patients
                            </a>
                        </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('appointments/create'); ?>">
                            <i class="fas fa-user"></i> Make an Appointment
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('calendar/index'); ?>">
                            <i class="fas fa-calendar"></i> Check Appointment Available
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url(''); ?>">
                                <i class="fas fa-diagnoses"></i> Diagnosis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-file"></i> File
                            </a>
                        </li>                        
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-flag"></i> Reports
                            </a>
                        </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('#'); ?>">
                            <i class="fas fa-diagnoses"></i> Diagnosis
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url(''); ?>">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Sidebar -->

        <!-- Content -->
        <!-- <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                lagay mo dito
            </main> -->

    </div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.7.2/main.min.js'></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.7.2/main.min.js'></script>