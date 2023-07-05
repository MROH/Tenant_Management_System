<?php
$pageTitle = "Payments Center";
require 'main.php';
require 'topbar.php';
require 'config/config.php';
$sCode = $cNames = "";

if(isset($_POST['updateBalance'])){
    $wed = $_POST['client_serial_code'];
    $cst = $_POST['plotCost'];
    $rsp = $db->query("UPDATE payments SET bal_amount = $cst WHERE serial_code = $wed");
    ?>
    <script type="text/javascript">
        alert('Balance updated successfully');
    </script>
    <?php
}
?>
<div class="container-fluid">
	
    <div class="card shadow mb-6">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Transactions</h6>
                        </div>
                        <?php
                            if(isset($_GET['userSerialCode'])){ ?>
                                 <form class="col col-sm-6" method="GET">
                                    <input type="text" class="form-control" name="userSerialCode">
                                  <button class="btn-sm btn-primary col-md-4" style="margin: 15px;" href="#">Get Client</button> 
                                    <?php
                                        $sCode = $_GET['userSerialCode'];
                                        $rst = $db->query("SELECT * from clients  WHERE serial_code = $sCode LIMIT 1"); 
                                        foreach ($rst as $keyN) {
                                            $cNames = $keyN->client_names;
                                            ?>
                                            <a class="btn-sm btn-danger col-md-6" data-toggle="modal" data-target="#exampleModalCenter" style="margin: 15px; max-width: 150px" href="#">Add Plot Cost for <?php echo $cNames; ?></a> 
                                            <?php
                                        }
                                    ?>
                                </form>
                            <?php 
                        }else{
                                ?>
                                <form class="col col-md-4" method="GET">
                            <input type="text" class="form-control" name="userSerialCode">
                          <button class="btn-sm btn-primary col-md-4" style="margin: 15px; max-width: 150px" href="#">Get Client</button>  
                        </form>
                            <?php
                        }
                        ?>
                          
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <th>Names</th>
                                            <th>Ref</th>
                                            <th>Village</th>
                                            <th>Receipt</th>
                                            <th>Amount Paid</th>
                                            <th>Balance</th>
                                            <th>Remarks</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $rs = $db->query("SELECT * from transactions ORDER BY id DESC"); 
                                    foreach ($rs as $key) {
                                    ?>
                                        <tr>
                                            <td><a href="customer_payments.php?payment=<?php echo $key->payment_id;?>"><?php echo $key->created_at; ?></a></td>
                                            <?php 
                                            $customC =$db->query("SELECT * from payments WHERE id = $key->payment_id"); 
                                            foreach ($customC as $keyC) {
                                                $clientCode = $keyC->serial_code;
                                                $customD =$db->query("SELECT * from clients WHERE serial_code =  $keyC->serial_code LIMIT 1");
                                                foreach ($customD as $keyD){
                                                    ?>
                                                        <td><?php echo $keyD->client_title." ".$keyD->client_names; ?></td>
                                                        <td><?php echo $keyC->area_code.$keyC->serial_code; ?></td>
                                                    <?php
                                                }

                                                $areaCode = $keyC->area_code;

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
                                                ?>
                                                <td> <?php echo $villageCode; ?> </td>
                                                <?php
                                            }
                                            ?>
                                            <td><?php echo $key->manual_receipt;?></td>
                                            <td><?php echo number_format($key->amount_paid);?></td>
                                            <td><?php echo number_format($key->balance_remained);?></td>
                                            <td><?php echo $key->remarks;?></td>
                                            <td><?php echo date('d-M-Y', $key->created_at); ?></td>
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

                <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Update Initial Plot Cost</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form method="POST">
                                      <div class="modal-body">
                                        <div class="form-group">
                                          <input type="text" class="form-control" value="<?php echo $sCode; ?>" placeholder="Serial Code" name="client_serial_code" hidden>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Cost" name="plotCost">
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="updateBalance" class="btn btn-success">Add</button>
                                      </div>
                                  </form>
                                </div>
                              </div>
                            </div>
    <?php
    require 'footer.php';