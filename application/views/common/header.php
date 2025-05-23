<!DOCTYPE html>
<html>
<head>
    <title>Interview Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar .nav-link {
            color: #333;
        }
        .sidebar .nav-link.active {
            color: #0d6efd;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3">
                    <h4>Admin Portal</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php echo uri_string() == 'admin' ? 'active' : ''; ?>" href="<?php echo site_url('admin'); ?>">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos(uri_string(), 'customers') !== false ? 'active' : ''; ?>" href="<?php echo site_url('customers'); ?>">
                            <i class="bi bi-people me-2"></i>Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo strpos(uri_string(), 'invoices') !== false ? 'active' : ''; ?>" href="<?php echo site_url('invoices'); ?>">
                            <i class="bi bi-receipt me-2"></i>Invoices
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('auth/logout'); ?>">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>