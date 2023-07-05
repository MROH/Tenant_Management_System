<?php
    $pageTitle = "Plots Manager";
    require 'main.php';
    require 'topbar.php';
    require 'config/config.php';
?>
<div class="container-fluid">
    <div class="col-lg-6">
        <?php
        $plotID = $_GET['plot'];
        $rs=$db->fetchSingleRow('plots_table','id',$plotID);
            
?>
                            <!-- Dropdown Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Details for Plot Number : <?php echo $rs->plot_phase.$rs->plot_number; ?></h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Actions:</div>
                                            <a class="dropdown-item" href="#">Edit Details</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <strong>Phase : </strong> <?php echo $rs->plot_phase; ?><br>
                                    <strong>Number : </strong> <?php echo $rs->plot_number; ?><br>
                                    <strong>Specifications : </strong> <?php echo $rs->plot_specifications.$rs->plot_measure_unit; ?><br>
                                    <strong>Description : </strong> <?php echo $rs->plot_description; ?><br>
                                    <strong>Cost : </strong>Ugx: <?php echo number_format($rs->plot_cost); ?> <br>
                                    <strong>Date registered : </strong> <?php echo date('l jS, F Y',$rs->plot_created_at); ?><br>
                                    <strong>Registered by : </strong> <?php echo $rs->plot_created_by; ?><br>
                                    <strong>Status : </strong><?php $reg = $rs->plot_stat;?>

                                    <?php
                                    if($reg == "1"){ ?>
                                        <span class="btn btn-sm btn-success text-white">Available</span>
                                   <?php }else{ ?>
                                        <span class="btn btn-sm btn-secondary text-white">Occupied</span>
                                   <?php }
                                    ?> <br>

                                </div>
                            </div>

                            <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Plot assignment details</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        <strong>Name: </strong> <br>
                                        
                                    </div>
                                </div>
                            </div>

                            <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Attached Transaction Details</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        <strong>File name 1: </strong> <a href="">View</a> <a href="">Download</a><br>
                                        <strong>File name 2: </strong> <a href="">View</a> <a href="">Download</a><br>
                                        <strong>File name 3: </strong> <a href="">View</a> <a href="">Download</a><br>
                                        <strong>File name 4: </strong> <a href="">View</a> <a href="">Download</a><br>
                                    </div>
                                </div>
                            </div>

                        </div>
    <?php require 'footer.php';