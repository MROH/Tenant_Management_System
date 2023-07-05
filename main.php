<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>System - <?php echo $pageTitle ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <!--<div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>-->
                <div class="sidebar-brand-text mx-3"><img src="img/logo-one.JPG" style="width: 100%"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php
                if($pageTitle == "Dashboard"){ 
                    ?>
                    <li class="nav-item active">
                <?php
            }else{
                ?>
                    <li class="nav-item">
                <?php
            }
            ?>
            
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <?php
                if($pageTitle == "Clients Center"){ 
                    ?>
                    <li class="nav-item active">
                <?php
            }else{
                ?>
                    <li class="nav-item">
                <?php
            }
            ?>
                <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Tenants</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="customer_center.php" >Add Tenant</a>
                        <a class="collapse-item" href="customer_all.php" >View tenants</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - payments Collapse Menu -->
            <?php
                if($pageTitle == "Payments Center"){ 
                    ?>
                    <li class="nav-item active">
                <?php
            }else{
                ?>
                    <li class="nav-item">
                <?php
            }
            ?>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-money-bill-alt"></i>
                    <span>Payments</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="payment_receive.php">Add payment</a>
                        <a class="collapse-item" href="payments_all.php">View payments</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu 
            <?php
                if($pageTitle == "Plots Manager"){ 
                    ?>
                    <li class="nav-item active">
                <?php
            }else{
                ?>
                    <li class="nav-item">
                <?php
            }
            ?>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Plots</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="plots_manager.php">Add plot</a>
                        <a class="collapse-item" href="plots_assign.php" >Assign plot</a>
                        <a class="collapse-item" href="plots_all.php">View plots</a>
                    </div>
                </div>
            </li> -->


            <!-- Nav Item - Utilities Collapse Menu -->
            <?php
                if($pageTitle == "Plots Manager"){ 
                    ?>
                    <li class="nav-item active">
                <?php
            }else{
                ?>
                    <li class="nav-item">
                <?php
            }
            ?>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Reports</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#collapsePages">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="">Tenants reports</a>
                        <a class="collapse-item" href="" >Plots reports</a>
                        <a class="collapse-item" href="">Payment reports</a>
                        <a class="collapse-item" href="">System reports</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="">
                <p class="text-center mb-2">Feel free to get in touch for any queries. Our lines are always open</p>
                <a class="btn btn-success btn-sm">Request Support</a>
            </div>

        </ul>
        <!-- End of Sidebar -->