<?php
$clID = $_GET['id'];
include 'config/pdoOpt.php';
$pageTitle = "Clients Center";
require 'main.php';
require 'topbar.php';

if(isset($_POST['update'])){
    if(!empty($_POST['plot_desc'])){
        $stat = 1;
    }else{
        $stat = 0;
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

    $data = array($_POST['client_names'],$_POST['client_nin'],$_POST['serial_number'],$_POST['area_code'],$_POST['cust_title'],$_POST['client_number'],$_POST['entity_type'],$_POST['plot_desc'],$_POST['plot_cost'],$_POST['client_type'],$stat,$_POST['prev_owner'],$villageCode,$clID);

    $sql = "update clients set client_names=?,client_nin=?,serial_code=?,area_code=?,client_title=?,client_contact=?,entity_type=?,plot_desc=?,plot_cost=?,client_type=?,reg_stat=?,prev_owner=?,village=? where id=?";        
    $msg = $pod->prepare($sql);
    $msg->execute($data);

    if($msg == true){
        //$Nokdata = array(trim($_POST['nxt_of_kin_name']),trim($_POST['next_of_kin_nin']),trim($_POST['next_of_kin_contact']),trim($_POST['next_of_kin_relationship']),$clID);

       // $sql = "update next_of_kin set nok_names=?,nok_nin=?,nok_contact=?,nok_rel=? WHERE client_id = ?";
        //$msg = $pod->prepare($sql);
        ///$msg->execute($Nokdata);
        if($msg == true){
            $witnessData = array(trim($_POST['witnesses']),$clID);
            $sql = "update witnesses set witnesses_list=? where client_id=?";
            $msg = $pod->prepare($sql);
            $msg->execute($witnessData);
            if($msg == true){
                $msg = "Client details updated successfully";
                $type = "success"; ?>
                <script type="text/javascript">
                    window.open("customer_id.php?msg=<?php echo $msg; ?>&type=<?php echo $type; ?>&id=<?php echo $clID; ?>","_self",false);
                </script>
                <?php
            }else{
                $msg = "Failed to update Witnesses details";
            $type = "danger"; ?>
            <script type="text/javascript">
                window.open("customer_id.php?msg=<?php echo $msg; ?>&type=<?php echo $type; ?>&id=<?php echo $clID; ?>","_self",false);
            </script>
            <?php
            }
        }else{
            $msg = "Failed to update Next of Kin details";
            $type = "danger"; ?>
            <script type="text/javascript">
                window.open("customer_id.php?msg=<?php echo $msg; ?>&type=<?php echo $type; ?>&id=<?php echo $clID; ?>","_self",false);
            </script>
            <?php
        }
    }else{
        $msg = "Failed to update client details";
        $type = "danger"; ?>
        <script type="text/javascript">
            window.open("customer_id.php?msg=<?php echo $msg; ?>&type=<?php echo $type; ?>&id=<?php echo $clID; ?>","_self",false);
        </script>
        <?php
    }

}

include 'config/config.php';
$custom=$db->query("SELECT * from clients WHERE id = $clID"); 
foreach ($custom as $key) {
?>
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit tenant details</h1>
    </div>

    <form method="POST" class="row">
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
                                          <input type="text" class="form-control" value="<?php echo $key->area_code; ?>" readonly name="area_code"/>
                                        </div>

                                         <div class="form-group">
                                            <label>Serial Number:</label>
                                          <input type="text" class="form-control" value="<?php echo $key->serial_code; ?>" name="serial_number" readonly>
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
                                          <input type="text" class="form-control" value="<?php echo $key->client_names; ?>" name="client_names" required>
                                        </div>
                                       <div class="form-group">
                                            <label>NIN Number:</label>
                                            <input type="text" class="form-control" placeholder="NIN number" value="<?php echo $key->client_nin; ?>" name="client_nin">
                                        </div>
                                        <div class="form-group">
                                            <label>Contacts:</label>
                                            <input type="text" class="form-control" placeholder="Telephone number" value="<?php echo $key->client_contact; ?>" name="client_number">
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
                                                <textarea class="form-control" name="plot_desc"><?php echo $key->plot_desc; ?></textarea>
                                         </div>

                                         <div class="form-group">
                                            <label>Plot Cost (For title only)</label>
                                                <input type="number" placeholder="50000" value="<?php echo $key->plot_cost; ?>" class="form-control" name="plot_cost">
                                         </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4">
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
                                                <textarea class="form-control" name="witnesses"><?php $customB=$db->query("SELECT * from witnesses WHERE client_id = $clID"); 
                                                foreach ($customB as $keyB) {
                                                    echo $keyB->witnesses_list; 
                                                }
                                                ?></textarea>
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
                                                <textarea class="form-control" name="prev_owner"><?php echo $key->prev_owner;?>
                                                </textarea>
                                         </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" style="max-width: 300px;">
                             <input type="submit"  name="update" class="btn-primary btn-block btn-sm" value="Update">
                           </div>

                        </div>

                    </form>

</div>

<?php
}
require 'footer.php';
?>