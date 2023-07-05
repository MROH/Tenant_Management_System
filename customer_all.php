<?php
    $pageTitle = "Clients Center";
    require 'main.php';
    require 'topbar.php';
    require 'config/config.php';
?>
<div class="container-fluid">
	
    <div class="card shadow mb-6">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All customers</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                    $rs=$db->query("SELECT * from clients WHERE del_stat = 1");
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Client Ref</th>
                                            <th>Plot Description</th>
                                            <th>Village</th>
                                            <th>Contact</th>
                                            <th>Date regitered</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($rs as $key) {
                                        ?>
                                        <tr>
                                            <td><a href="customer_details.php?client=<?php echo $key->id;?>"> <?php echo $key->client_names; ?></a></td>
                                            <td><?php echo $key->area_code.$key->serial_code; ?></td>
                                            <td><?php echo $key->plot_desc; ?></td>
                                            <td><?php echo $key->village; ?></td>
                                            <td><?php echo $key->client_contact; ?></td>
                                            <td><?php echo date('l jS, F Y', $key->client_created_at); ?></td>
                                            <td><a href="action_nok.php?client_delete=1&id=<?php echo $key->id;?>" class="btn btn-sm btn-danger">Delete</a></td>
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