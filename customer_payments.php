<?php
$pageTitle = "Payments Center";
require 'main.php';
require 'topbar.php';
require 'config/config.php';
?>
<div class="container-fluid">
    <div class="col">
        <?php
        $paymentID = $_GET['payment'];
    $custom=$db->query("SELECT * from payments WHERE id = $paymentID"); 
    foreach ($custom as $key) {

    	$clientID = $key->client_id;
    	$customA=$db->query("SELECT * from clients WHERE id = $clientID"); 
    foreach ($customA as $keyA) {

        ?>
                           <!-- Dropdown Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Personal Details for <?php echo $keyA->client_names; ?></h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Actions:</div>
                                            <a class="dropdown-item" href="customer_edit.php?id=<?php echo $keyA->id;?>">Edit Details</a>
                                            <a class="dropdown-item" href="customer_image.php?id=<?php echo $keyA->id;?>&serial=<?php echo $key->serial_code; ?>">Edit Profile Picture</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <strong>Client Ref: </strong><?php echo $keyA->area_code.$key->serial_code; ?><br>
                                            <strong>NIN No: </strong><?php echo $keyA->client_nin; ?><br>
                                        <strong>Contact: </strong><?php echo $keyA->client_contact; ?><br>
                                        <strong>Date created:</strong> <?php echo date('l jS, F Y',$keyA->client_created_at); ?><br>
                                        <a class="btn btn-primary" href="customer_details.php?client=<?php echo $keyA->id;?>" >View complete profile...</a>
                                        </div>
                                        <div class="col">
                                            <img src="uploads/<?php echo $keyA->profile_pic; ?>" alt="<?php echo $keyA->client_names; ?> Photo" width="30%" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Collapsable Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Plot Details</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                    	<div class="form-group">
                                    		<strong>Area Code: </strong> <?php echo $keyA->area_code; ?><br>
                                    	</div>
                                      <div class="form-group">
                                      	<strong>Serial Code: </strong> <?php echo $keyA->serial_code; ?><br>
                                      </div>
                                      <div class="form-group">
                                      	<strong>Plot description: </strong> <?php echo $keyA->plot_desc; ?><br>
                                      </div>
                                      <div class="form-group">
                                      	<strong>Ownership type: </strong> <?php echo $keyA->client_type; ?><br>
                                      </div>
                                      <div class="form-group">
                                        <strong>Kanzu value: </strong> <?php echo number_format($keyA->kanzu); ?><br>
                                      </div>
                                      <div class="form-group">
                                      	<strong>Plot initial balance: </strong> <?php echo number_format($keyA->plot_cost); ?><br>
                                      </div>
                                      <div class="form-group">
                                      	<strong>Current balance: </strong> <?php echo number_format($key->bal_amount); ?><br>
                                      </div>
                                      
                                  </div>
                                </div>
                            </div>
                            <!-- Collapsable Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample2">
                                    <h6 class="m-0 font-weight-bold text-primary">Payment History</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample2">
                                    <div class="card-body">
                                        <div class="col-md screens">
                                        	<div class="table-responsive">
				                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				                                    <thead>
				                                        <tr>
				                                            <th>Transaction ID</th>
				                                            <th>Amount Paid</th>
				                                            <th>Balance</th>
				                                            <th>Payment type</th>
                                                            <th>Payment remarks</th>
				                                            <th>Date</th>
				                                        </tr>
				                                    </thead>
				                                    <tbody>
				                                    <?php
				                                    $rs = $db->query("SELECT * from transactions WHERE payment_id = $paymentID ORDER BY id DESC"); 
				                                    foreach ($rs as $keyT) {
				                                    ?>
				                                        <tr>
				                                            <td><?php echo $keyT->created_at; ?></td>
				                                            <td><?php echo number_format($keyT->amount_paid);?></td>
				                                            <td><?php echo number_format($keyT->balance_remained);?></td>
				                                            <td><?php echo $keyT->payment_type;?></td>
                                                            <td><?php echo $keyT->remarks;?></td>
				                                            <td><?php echo $keyT->receipt_date; ?></td>
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
                            </div>
                        </div>
                    </div>
                        <?php 
                    }
                }
            ?>
    <?php require 'footer.php';
?>