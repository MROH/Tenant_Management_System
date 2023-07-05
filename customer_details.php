<?php
    $pageTitle = "Clients Center";
    require 'main.php';
    require 'topbar.php';
    require 'config/config.php';

if(isset($_POST['add_next_of_kin'])){
    $data = array(
            'nok_names' => trim($_POST['nxt_of_kin_name']),
            'nok_nin' => trim($_POST['next_of_kin_nin']),
            'nok_contact' => trim($_POST['next_of_kin_contact']),
            'client_id' => $_POST['nok_client_id'],
            'created_by' => 1,
            'created_at' => time()
        );

        $msg = $db->insert('next_of_kin',$data);

        $nok = $db->getLastInsertId();

        if($nok){
            ?>

            <script type="text/javascript">
                window.alert("Next of Kin added successfully");
            </script>
            <?php
        }else{ ?>
            <script type="text/javascript">
                window.alert("Error adding next of Kin details");
            </script>
            <?php
        }
}

?>
<script> 
    function printDiv() { 
        var divContents = document.getElementById("GFG").innerHTML; 
        var a = window.open('', '', 'height=500, width=500'); 
        a.document.write('<html>'); 
        a.document.write('<body > <h1>Div contents are <br>'); 
        a.document.write(divContents); 
        a.document.write('</body></html>'); 
        a.document.close(); 
        a.print(); 
    } 
</script> 
<link rel="stylesheet" type="text/css" href="css/img.css">
<div class="container-fluid">
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="printDiv()"><i class="fas fa-print fa-sm text-white-50"></i> Print Copy</button>
    <div id="GFG" class="col">
    <?php
    $clientID = $_GET['client'];
    $custom=$db->query("SELECT * from clients WHERE id = $clientID"); 
    foreach ($custom as $key) {
        ?>
                           <!-- Dropdown Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Details for <?php echo $key->client_names; ?></h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Actions:</div>
                                            <a class="dropdown-item" href="customer_edit.php?id=<?php echo $key->id;?>">Edit Details</a>
                                            <a class="dropdown-item" href="customer_image.php?id=<?php echo $key->id;?>&serial=<?php echo $key->serial_code; ?>">Edit Profile Picture</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <strong>Client Ref: </strong><?php echo $key->area_code.$key->serial_code; ?><br>
                                            <strong>Village: </strong><?php echo $key->village; ?><br>
                                            <strong>NIN No: </strong><?php echo $key->client_nin; ?><br>
                                        <strong>Contact: </strong><?php echo $key->client_contact; ?>
                                        <br>
                                        <strong>Date created:</strong> <?php echo date('l jS, F Y',$key->client_created_at); ?><br>

                                    <strong>Registration Status:</strong><?php $reg = $key->reg_stat;?>

                                    <?php
                                    if($reg == "1"){ ?>
                                        <span class="btn btn-sm btn-success text-white">Complete</span>
                                   <?php }else{ ?>
                                        <span class="btn btn-sm btn-warning text-white">Incomplete</span>
                                   <?php }
                                    ?>

                                     <br>
                                     <strong>Account Status:</strong><?php $reg = $key->del_stat;?>

                                    <?php
                                    if($reg == "1"){ ?>
                                        <span class="btn btn-sm btn-success text-white">Active</span>
                                   <?php }else{ ?>
                                        <span class="btn btn-sm btn-danger text-white">Deleted</span>
                                   <?php }
                                    ?>

                                     <br>

                                    <strong>Registered by: <?php echo $key->client_created_by; 

                                    $SID = $key->id;
                                    $SC = $key->serial_code;
                                    ?></strong>
                                        </div>
                                        <div class="col">
                                            <img src="uploads/<?php echo $key->profile_pic; ?>" alt="<?php echo $key->client_names; ?> Photo" width="30%" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Collapsable Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Plot Details for <?php echo $key->client_names; ?></h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                       <?php
                                       $customC =$db->query("SELECT * from clients WHERE serial_code = $SC"); 
                                foreach ($customC as $keyC) {
                            ?>
                            <span class="form-group"><?php echo $keyC->area_code.$keyC->serial_code; ?> </span><br>
                            <?php
                        }
                            ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                                
                                $customK =$db->query("SELECT * from next_of_kin WHERE client_id = $SID AND del_stat = 1"); 
                               
                            ?>

                            <!-- Collapsable Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample1">
                                    <h6 class="m-0 font-weight-bold text-primary">Next of Kin Details for <?php echo $key->client_names; ?></h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <?php 
                                foreach ($customK as $keyT) { ?>
                                <div class="collapse show" id="collapseCardExample1">
                                    <div class="card-body">
                                        <strong>Name: </strong> <?php echo $keyT->nok_names; ?><br>
                                        <strong>NIN: </strong><?php echo $keyT->nok_nin; ?><br>
                                        <strong>Contact: </strong><?php echo $keyT->nok_contact; ?>
                                            <a class="btn-sm btn-primary col-md-4" style="margin: 15px" href="#">Edit</a> 
                                            <a class="btn-sm btn-danger col-md-4" style="margin: 15px" href="action_nok.php?delete=1&client=<?php echo $key->id; ?>&id=<?php echo $keyT->id; ?>">Delete</a>
                                    </div>
                                    
                                </div>
                                <?php
                                   }
                                        ?>
                                        <a class="btn-sm btn-primary col-md-4" data-toggle="modal" data-target="#exampleModalCenter" style="margin: 15px; max-width: 150px" href="#">Add Next of Kin</a>
                            </div>

                            <!-- Collapsable Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample2">
                                    <h6 class="m-0 font-weight-bold text-primary">Attachments</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample2">
                                    <div class="card-body">
                                        <div class="col-md screens">
                                      <?php $customB =$db->query("SELECT * from attachements WHERE client_id = $SID"); 
                                foreach ($customB as $keyB) { ?> 
                                    <img src="uploads/<?php echo $keyB->img_scr; ?>" style="width: 20%" class="img-thumbnail inline"/>

                                <?php }
                                ?>
                                </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Collapsable Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample3">
                                    <h6 class="m-0 font-weight-bold text-primary">Witnesses</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample3">
                                    <div class="card-body">
                                        <div class="col-md screens">
                                      <?php $customC =$db->query("SELECT * from witnesses WHERE client_id = $SID"); 
                                foreach ($customC as $keyC) { ?> 
                                    <p>
                                    <?php echo $keyC->witnesses_list; ?>
                                    </p>
                                <?php }
                                ?>
                                </div>
                                    </div>
                                </div>
                            </div>
                             <!-- Collapsable Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample4" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample3">
                                    <h6 class="m-0 font-weight-bold text-primary">Previous Owner</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample4">
                                    <div class="card-body">
                                        <div class="col-md screens">
                                     <?php
                                     echo $key->prev_owner;
                                     ?>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add Next of Kin for <?php echo $key->client_names; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form method="POST">
                                      <div class="modal-body">
                                        <div class="form-group">
                                          <input type="text" class="form-control" placeholder="Next of kin names" name="nxt_of_kin_name">
                                        </div>NIN
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="next_of_kin_nin" placeholder=" Next of kin  number">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Next of kin Telephone number" name="next_of_kin_contact">
                                            <input type="hidden" name="nok_client_id" value="<?php echo $key->id; ?>">
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="add_next_of_kin" class="btn btn-success">Add</button>
                                      </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        <?php 
                            }
                            ?>

    <?php require 'footer.php';