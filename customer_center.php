<?php
if(!empty($_GET['status']) && !empty($_GET['id'])){
    $stat = $_GET['status'];
    $clID = $_GET['id'];
}
$stat = null;
$clID = null;

include 'config/config.php';

if($stat == "saved"){
    $msg = "Client details saved, you can always complete the missing information <a href='customer_details.php?client={$clID}'> here</a>";
    $type = "warning";
}else if($stat == "submitted"){
    $msg = "Client details completed, you can always view completed details<a href='customer_details.php?client={$clID}'> here</a>";
    $type = "success";
}else{
    if(!empty($_GET['status'])){
        $type = "danger";
    $msg = $_GET['status'];
    }
    $type = null;
    $msg = null;
}

if(isset($_POST['submit'])){

    if(!empty($_POST['plot_desc'])){
        $stat = 1;
    }else{
        $stat = 0;
    }

    $kanzu = $_POST['kanzu_value'];

    if(!empty($_POST['plot_cost'])){
        $plotCost = $_POST['plot_cost'] + $kanzu;
    }else{
        $plotCost = 50000 + $kanzu;
    }

    $areaCode = $_POST['area_code'];
    $villageCode = null;
    switch ($areaCode) {
        case '101':
            $villageCode = "Kisozi B";
            break;
        case '102':
            $villageCode = "Kisozi A";
            break;
        case '103':
            $villageCode = "Ssumba";
            break;
        case '104':
            $villageCode = "Kivu";
            break;
        case '105':
            $villageCode = "Kitemu";
            break;
        case '106':
            $villageCode = "Nakangu";
            break;
    }

    $data = array('client_names' => $_POST['client_names'],
    'client_nin' => $_POST['client_nin'],
    'serial_code' => $_POST['serial_number'],
    'area_code' => $_POST['area_code'],
    'client_title' => $_POST['cust_title'],
    'client_contact' => $_POST['client_number'],
    'entity_type' => $_POST['entity_type'],
    'plot_desc' => $_POST['plot_desc'],
    'plot_cost' => $plotCost,
    'kanzu' => $kanzu,
    'client_type' => $_POST['client_type'],
    'client_created_by' =>1,
    'reg_stat' => $stat,
    'client_created_at' => time(),
    'prev_owner' => $_POST['prev_owner'],
    'village' => $villageCode);

    $msg = $db->insert('clients',$data);
    $client = $db->getLastInsertId();

    if($msg == true){
        $data = array(
            'nok_names' => trim($_POST['nxt_of_kin_name']),
            'nok_nin' => trim($_POST['next_of_kin_nin']),
            'nok_contact' => trim($_POST['next_of_kin_contact']),
            'client_id' => $client,'created_by' => 1,
            'created_at' => time()
        );

        $msg = $db->insert('next_of_kin',$data);

        $nok = $db->getLastInsertId();

        if($nok == true){
            $witnessData = array(
                'client_id' => $client,
                'witnesses_list' => trim($_POST['witnesses']),
                'date_created' => time()        
            );

            $msg = $db->insert('witnesses',$witnessData);
        }

        if($plotCost > 0){
            $nextYr = null;
            if($_POST['client_type'] == "Kibanja"){
                $nextYr = time() + (365 * 24 * 60 * 60);
            }

            $paymentData = array(
                'serial_code' => $_POST['serial_number'],
                'area_code' => $_POST['area_code'],
                'client_id' => $client,
                'rate' => $plotCost,
                'bal_amount' => $plotCost,
                'next_payment' => $nextYr
            );
            $msg = $db->insert('payments',$paymentData);
        }

        if($msg == true){
            $msg = "Successfully registered client please attach documents or skip to do it later";
            $type = "success";
            header("Location:customer_id.php?msg={$msg}&type={$type}&id={$client}");

        }else{
            $msg = "Error creating next of kin details";
            $type = "danger";
        }

    }else{
        $msg = "client registered with missing details";
        $type = "warning";
    }

}
    $pageTitle = "Clients Center";
    require 'main.php';
    require 'topbar.php';
    require 'config/pdoOpt.php';
?>
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tenants
        </h1>
        <?php
                if($type != null){ ?>

                    <div class="alert alert-<?php echo $type; ?> alert-dismissible fade show" role="alert">
                          <?php echo $msg; ?>
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
        <a href="customer_all.php">
            <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                               	    Total Tenants</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php 
                                                $count = $pod->query("SELECT COUNT(*) FROM clients")->fetchColumn();
                                                    echo $count;
                                            ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="customer_new.php">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                New Tenants</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Last 10</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-id-card fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                        <!-- Tasks Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="customer_unassigned.php">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Incomplete Registrations
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                                                $count = $pod->query("SELECT COUNT(*) from clients WHERE reg_stat = '0'")->fetchColumn();
                                                    echo $count;
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="customer_incomplete.php">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Complete Registrations</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                                                $count = $pod->query("SELECT COUNT(*) from clients WHERE reg_stat = '1'")->fetchColumn();
                                                    echo $count;
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add tenant</h1>
    </div>

    <form method="POST" action="customer_center.php" enctype="multipart/form-data" class="row">
                        <div class="col-lg-8">

                            <!-- Default Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Tenant Details</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                         <div class="form-group">
                                            <label>Area Code:</label>
                                          <select class="form-control" name="area_code" required>
                                                    <option>101</option>
                                                    <option>102</option>
                                                    <option>103</option>
                                                    <option>104</option>
                                                    <option>105</option>
                                                    <option>106</option>
                                                    
                                                  </select>
                                        </div>

                                         <div class="form-group">
                                            <label>Serial Number:</label>
                                          <input type="text" class="form-control" placeholder="Serial number" name="serial_number" required>
                                        </div>

                                        <div class="form-group">
                                          <label>Title:</label>
                                          <select class="form-control" required name="cust_title">
                                            <option selected>Mr</option>
                                            <option>Mrs</option>
                                            <option>Ms</option>
                                            <option>Other</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Names:</label>
                                          <input type="text" class="form-control" placeholder="Client names" name="client_names" required>
                                        </div>
                                       <div class="form-group">
                                            <label>NIN Number:</label>
                                            <input type="text" class="form-control" placeholder="NIN number" name="client_nin">
                                        </div>
                                        <div class="form-group">
                                            <label>Contacts:</label>
                                            <input type="text" class="form-control" placeholder="Telephone number" name="client_number">
                                        </div>
                                        <div class="form-group">
                                          <label>Entity type:</label>
                                          <select class="form-control" required name="entity_type">
                                            <option selected>Individual</option>
                                            <option>School</option>
                                            <option>Mosque</option>
                                            <option>Church</option>
                                            <option>Other</option>
                                          </select>
                                        </div>

                                        <div class="form-group">
                                          <label>Tenuership type:</label>
                                          <select class="form-control" required name="client_type">
                                            <option selected>Kibanja</option>
                                            <option>Title</option>
                                        </select>
                                        </div>

                                         <div class="form-group">
                                            <label>Plot Description</label>
                                                <textarea class="form-control" name="plot_desc"></textarea>
                                         </div>

                                         <div class="form-group">
                                            <label>Plot Cost (For title only)</label>
                                                <input type="number" placeholder="50000" class="form-control" name="plot_cost">
                                         </div>

                                        <div class="form-group">
                                            <label>Kanzu</label>
                                            <input type="number" placeholder="50000" class="form-control" name="kanzu_value">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4">
                            
                            <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample1">
                                    <h6 class="m-0 font-weight-bold text-primary">Next of Kin Details</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample1">
                                    <div class="card-body">
                                        <div class="form-group">
                                          <input type="text" class="form-control" placeholder="Next of kin names" name="nxt_of_kin_name">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="next_of_kin_nin" placeholder=" Next of kin NIN number">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Next of kin Telephone number" name="next_of_kin_contact">
                                        </div>
                                        <div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample2">
                                    <h6 class="m-0 font-weight-bold text-primary">Witnesses Details</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample2">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>All Witnesses</label>
                                                <textarea class="form-control" name="witnesses"></textarea>
                                         </div>
                                    </div>
                                </div>
                            </div>

                             <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample2">
                                    <h6 class="m-0 font-weight-bold text-primary">Previous Owner Details</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample3">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>All Previous Owners' List</label>
                                                <textarea class="form-control" name="prev_owner"></textarea>
                                         </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" style="max-width: 300px;">
                             <input type="submit"  name="submit" class="btn-primary btn-block btn-sm" value="Next">
                          <input type="reset" class="btn-secondary btn-block btn-sm" value="Reset">
                          </div>

                        </div>

                    </form>

</div>

<?php
require 'footer.php';
?>