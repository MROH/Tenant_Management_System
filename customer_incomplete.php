<?php
    $pageTitle = "Clients Center";
    require 'main.php';
    require 'topbar.php';
    require 'config/config.php';
?>
<div class="container-fluid">
	
    <div class="card shadow mb-6">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Clients with incomplete details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                    $custom=$db->query("SELECT * from clients WHERE reg_stat = '1'");
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>NIN</th>
                                            <th>Contact</th>
                                            <th>Date regitered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($custom as $key) {
                                        ?>
                                        <tr>
                                            <td><?php echo $key->client_names; ?></td>
                                            <td><?php echo $key->client_nin; ?></td>
                                            <td><?php echo $key->client_contact; ?></td>
                                            <td><?php echo date('l jS, F Y',$key->client_created_at); ?></td>
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