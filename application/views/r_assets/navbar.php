<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="icon" href="<?php echo base_url('assets/logo/favicon.ico'); ?>" type="image/gif">
    <link href="<?= base_url('disc/css/styles.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" /> 
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.1/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.5/css/select.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.3/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" href="/extensions/Editor/css/editor.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />

    <style>
        #sidebarToggle {
            transition: transform 0.3s ease;
        }

        #sidebarToggle.active {
            transform: rotate(180deg);
        }

        .invoice {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 30px;
            padding: 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            width: 100%;
            box-sizing: border-box;
        }

        .invoice-section {
            flex: 1 1 48%;
            margin-bottom: 20px;
        }

        .invoice-section p {
            margin: 8px 0;
        }

        .invoice strong {
            font-weight: 600;
        }

        .sb-sidenav {
            background-color: #ACE1AF;
        }
        .navbar-text {
    color: white;
    font-size: 1rem;
    margin-right: 1rem;
}

.navbar-text strong {
    color: #f8f9fa;
}

    </style>
</head>

<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-success">
    <a class="navbar-brand ps-3" href="<?php echo site_url('dashboard/admin'); ?>">OBGYN CLINIC</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Display user's name -->
    <div class="navbar-text ml-auto">
    Welcome, <strong><?php echo strtoupper($this->session->userdata('firstname')) . '!'; ?></strong>
        <!-- <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-sm btn-light">Logout</a> -->
    </div>
</nav>


    <!-- Include jQuery, Popper.js, and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script src="/DataTables/datatables.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector ('.sb-sidenav'); // Assuming you have a sidebar with this class

        sidebarToggle.addEventListener('click', () => {
            sidebarToggle.classList.toggle('active');
            sidebar.classList.toggle('active'); // This will toggle the sidebar visibility
        });
    </script>
</body>

</html>