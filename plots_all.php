<?php
include 'config/config.php';
    $pageTitle = "Plots Manager";
    require 'main.php';
    require 'topbar.php';
    $rs=$db->fetchAll('plots_table');

?>
<div class="container-fluid">
	
    <div class="card shadow mb-6">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All plots</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Phase</th>
                                            <th>Plot No</th>
                                            <th>Date Registered</th>
                                            <th>Plot Cost</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($rs as $key) {
                                        ?>
                                        <tr>
                                            <td><a href="plot_details.php?plot=<?php echo $key->id;?>"> <?php echo $key->plot_phase; ?></a></td>
                                            <td><?php echo $key->plot_number; ?></td>
                                            <td><?php echo date('l jS, F Y', $key->plot_created_at); ?></td>
                                            <td>
                                                <?php echo "Ugx ".number_format($key->plot_cost); ?>
                                            </td>
                                            <td>
                                                <?php
                                                    $st = $key->plot_stat;
                                                    if($st == "1"){
                                                        ?>
                                                        <span class="btn btn-sm btn-success text-white">Available</span>
                                                    <?php } else{
                                                        ?>
                                                            <span class="btn btn-sm btn-secondary text-white">Occupied</span>
                                                    <?php }
                                                ?>
                                            </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
    <?php require 'footer.php';