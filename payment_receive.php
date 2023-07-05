<?php
    $pageTitle = "Payments Center";
    require 'main.php';
    require 'topbar.php';
    require 'config/config.php';
    $plot_phase = null;
    $plot_number = null;
    $alertData = $alertType = null;

    if(isset($_POST['pay'])){
        $payID = $_POST['payID'];
        $clientID = $_POST['clientID'];
        $balance = $_POST['currentBalance'];
        $paid = $_POST['deposit'];
        $payType = $_POST['mode'];
        $userID = 1;
        $manual_receipt = $_POST['manual_receipt'];
        $date = time();
        $newBalance = $balance - $paid;

        if($newBalance < 0){
            $alertType = "warning";
            $alertData = "Amount paid is greater than outstanding balance";
        }else{
            $transactionData = array(
                'payment_id' => $payID,
                'amount_paid' => $paid,
                'balance_remained' => $newBalance,
                'payment_type' => $payType,
                'remarks' => $_POST['remarks'],
                'created_by' => $userID,
                'created_at' => $date,
                'manual_receipt' => $manual_receipt,
                'receipt_date' => $_POST['trip_start']
            );
            $msg = $db->insert('transactions',$transactionData);

            if($msg == true){
                $paymentData = array(
                    'bal_amount' => $newBalance
                );
                $msgPay = $db->update('payments',$paymentData,'client_id',$clientID);
                if($msgPay == true){
                    ?>
                    <script type="text/javascript">
                        window.open ('payments_all.php','_self',false)
                    </script>
                    <?php
                }
            }
        }
    }
?>
<div class="container-fluid">
	 <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Payments Center</h1>
                        <?php
                        if($alertData != null){ ?>
                            <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade show" role="alert">
                                <?php echo $alertData; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                        <?php } 
                        ?>
                    </div>

                    <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                               	    Total Payments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">100,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                New Payments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">50000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-id-card fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tasks Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending Payments
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Overdue Payments</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add payment</h1>
    </div>
    <?php
    if(empty($_GET['status'])){ ?>
        <form method="GET" class="row">
            <div class="col-lg-6">
                <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Plot Details</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Area Code:</label>
                                        <select class="form-control" required name="area_code">
                                          	<option selected>101</option>
                                            <option>102</option>
                                            <option>103</option>
                                            <option>104</option>
                                            <option>105</option>
                                            <option>106</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" style="max-width: 300px; margin-left: 100px">
                            <input type="hidden" name="status" value="1">
                            <input type="submit" class="btn-primary btn-block btn-sm" value="Continue">
                        </div>
                    </div>
            </div>
        </form>
    <?php }

    else if($_GET['status'] == "1"){ 
        $AreaCode = $_GET["area_code"];
        ?>
        <form method="GET" class="row">
            <div class="col-lg-6">
                <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Plot Details</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Area Code</label>
                                        <input type="text" class="form-control"  name="area_code" value="<?php print_r($AreaCode); ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Serial Code:</label>
                                        <input type="text" class="form-control" required name="serial_code">
                                        <?php
                                            ///$custom=$db->query("SELECT DISTINCT serial_code from clients WHERE area_code = $AreaCode AND del_stat = 1"); 
                                            //foreach ($custom as $key) {
                                              //  ?>
                                          	<!--<option value="<?php echo $key->serial_code;?>"><?php echo $key->serial_code;?></option>-->
                                            <?php
                                            //    }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" style="max-width: 300px; margin-left: 100px">
                        <input type="hidden" name="status" value="2">
                            <input type="submit" class="btn-primary btn-block btn-sm" value="Continue">
                        </div>
                    </div>
            </div>
        </form>
   <?php }
    else if($_GET['status'] == "2"){ 
        $AreaCode = $_GET["area_code"];
        $SerialCode = $_GET["serial_code"];
        ?>
        <form method="GET" class="row">
            <div class="col-lg-6">
                <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">Plot Details</h6>
                            </a>
                            <!-- Card Content - Collapse -->
                            <div class="collapse show" id="collapseCardExample">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Area Code</label>
                                        <input type="text" class="form-control"  name="area_code" value="<?php print_r($AreaCode); ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Serial Code</label>
                                        <input type="text" class="form-control"  name="serial_code" value="<?php print_r($SerialCode); ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Plot Description:</label>
                                        <select class="form-control" required name="desc">
                                        <?php
                                            $custom=$db->query("SELECT * from clients WHERE area_code = $AreaCode AND serial_code = $SerialCode AND del_stat = 1"); 
                                            foreach ($custom as $key) {
                                                ?>
                                          	<option value="<?php echo $key->id;?>"><?php echo $key->plot_desc;?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" style="max-width: 300px; margin-left: 100px">
                        <input type="hidden" name="status" value="3">
                            <input type="submit" class="btn-primary btn-block btn-sm" value="Continue">
                        </div>
                    </div>
            </div>
        </form>
   <?php }
    else if($_GET['status'] == "3"){ 
        $clID = $_GET['desc'];

        $custom=$db->query("SELECT * from clients WHERE id = $clID"); 
        foreach ($custom as $key) {
            $plotDesc = trim($key->plot_desc);

            if(empty($plotDesc)){ ?>
                <form method="GET" class="row">
                    <div class="col-lg-6">
                        <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                        <h6 class="m-0 font-weight-bold text-primary">Plot Details</h6>
                                    </a>
                                    <!-- Card Content - Collapse -->
                                    <div class="collapse show" id="collapseCardExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Plot details are incomplete</label><br>
                                                <a href="customer_edit.php?id=<?php echo $clID;?>" class="btn btn-sm btn-primary">Continue to complete details here...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                    </div>
                </form>
            <?php }else{ ?>
                <form method="POST" class="row">
                    <div class="col-lg">
                        <!-- Collapsable Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                    <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                        <h6 class="m-0 font-weight-bold text-primary">Plot Details</h6>
                                    </a>
                                    <!-- Card Content - Collapse -->
                                    <div class="collapse show" id="collapseCardExample">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Plot Code</label>
                                                <input type="text" class="form-control" value="<?php echo $key->area_code.$key->serial_code; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Tenuership Type</label>
                                                <input type="text" class="form-control" value="<?php echo $key->client_type;?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Plot Description</label>
                                                <textarea class="form-control" readonly><?php echo $key->plot_desc;?></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Date Registered</label>
                                                <input type="text" class="form-control" value="<?php echo date('l jS, F Y', $key->client_created_at);?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                
                    </div>
                    <div class="col-lg">
                            <!-- Collapsable Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                    <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample1">
                                        <h6 class="m-0 font-weight-bold text-primary">Payment Details</h6>
                                    </a>
                                    <!-- Card Content - Collapse -->
                                    <div class="collapse show" id="collapseCardExample1">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Initial Cost</label>
                                                <input type="text" class="form-control" value="<?php echo number_format($key->plot_cost); ?>" readonly>
                                            </div>

                                            <?php
                                                $customB=$db->query("SELECT * from payments WHERE client_id = $clID"); 
                                                foreach ($customB as $keyB) { ?>
                                            
                                            <div class="form-group">
                                                <label>Current Balance</label>

                                                <?php
                                                    $balance = $keyB->bal_amount;
                                                    if(!empty($keyB->next_payment)){
                                                        $today = time();
                                                        $nxtyr = $keyB->next_payment;
                                                        if($nxtyr < time()){
                                                            $balance = $keyB->bal_amount + 50000;
                                                            $nxtYr = $nxtyr + (365 * 24 * 60 * 60);
                                                            /////
                                                            $data = array('bal_amount' => $balance,
                                                                'next_payment' => $nxtYr
                                                            );
                                                            $msgData = $db->update('payments',$data,'client_id',$clID);
                                                        }else{
                                                            $balance = $keyB->bal_amount;
                                                            $nxtYr = $nxtyr;
                                                        }
                                                    }
                                                ?>
                                                <input type="hidden" name="clientID" value="<?php echo $key->id;?>">
                                                <input type="hidden" name="payID" value="<?php echo $keyB->id;?>">
                                                <input type="hidden" name="currentBalance" value="<?php echo $balance; ?>">
                                                <input type="text" class="form-control" value="<?php echo number_format($balance); ?>" readonly>
                                            </div>

                                            <?php
                                            if(!empty($keyB->next_payment)){ ?>
                                            <div class="form-group">
                                                <label>Next Teneurship Payment</label>
                                                <input type="text" class="form-control" value="<?php echo date('l jS, F Y', $keyB->next_payment);?>" readonly>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            
                                            <?php
                                                }
                                            ?>
                                            <div class="form-group">
                                                <label>Payment Mode</label>
                                                <select class="form-control" name="mode">
                                                <option selected>Cash</option>
                                                <option selected>Cheque</option>
                                                <option selected>Mobile Money</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input type="number" class="form-control" name="deposit" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Manual Receipt Number</label>
                                                <input type="number" class="form-control" name="manual_receipt" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Payment remarks</label>
                                                <textarea class="form-control" name="remarks" required></textarea>
                                            </div>

                                             <div class="form-group">
                                                <label>Receipt Date</label>
                                                <input class="form-control" type="text" name="trip_start">
                                             </div>

                                            <div class="form-group">
                                               <input type="submit" name="pay" value="Make Payment" class="btn btn-primary btn-sm btn-block">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                    </div>
                </div>
                </form>
            <?php }
        }
        ?>
   <?php }
    ?>
    </div>
<?php
require 'footer.php';
?>