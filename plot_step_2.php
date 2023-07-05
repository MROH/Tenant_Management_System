<?php
    session_start();
    $pageTitle = "Plots Manager";
    require 'main.php';
    require 'topbar.php';
    $plot_phase = null;
    $plot_number = null;
    require 'config/config.php';

    if (isset($_GET['step-2'])) {
        $_SESSION['plot_number'] = $_GET['plot_no'];
        # code...
    }else if(isset($_GET['back'])){
      ?>
      <script type="text/javascript">
            window.open ('plots_assign.php','_self',false)
        </script>
      <?php
    	//header("Location: plot_assign.php");
    }else{
    	//header("Location: plot_assign.php");
    }
?>

<div class="container-fluid">
	 
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Assign Plot</h1>
    </div>

    <!--some card hia-->
     <div class="col">
     	<?php
     	if(isset($_GET['step-2'])){ 
     		$phase = $_SESSION['phase'];
     		$nmber = $_SESSION['plot_number'];
        $custom=$db->query("SELECT * from plots_table WHERE id = '$nmber'"); 
    	foreach ($custom as $key) {
        ?>                      <form method="POST" action="assign_hundle.php">
                                <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Plot Details</h6>
                                </div>
                                <div class="card-body">
                                    
                                        <div class="form-group">
                                          <input type="hidden" value="<?php echo $key->id; ?>" name="plot_id">
                                        <input type="text" name="phase" value="<?php echo $key->plot_phase.$key->serial_number; ?>" class="form-control" readonly>
                                    </div>
                                          <div class="form-group">
                                          	<input type="text" class="form-control" value="<?php echo $key->plot_specifications.$key->plot_measure_unit; ?>" readonly>
                                          </div>

                                          <div class="form-group">
                                            <textarea class="form-control"readonly>
                                              <?php echo $key->plot_description; ?>
                                            </textarea>
                                          </div>

                                          <div class="form-group">
                                            <input type="text" class="form-control" value="<?php echo number_format($key->plot_cost); ?>" readonly>
                                          </div>
                                        </div>
                              </div>


                              <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
                                </div>
                                <div class="card-body">
                                  <div class="form-group">
                                    <select class="form-control" name="client_id" required>
                                                <?php 
                                                $rs=$db->fetchAll('clients');
                                                foreach ($rs as $kes) { ?>
                                                    <option value="<?php echo $kes->id; ?>"><?php echo $kes->client_title.". ".$kes->client_names; ?></option>
                                                <?php }
                                                ?>
                                    </select>
                                  </div>

                                    <div class="form-group">
                                      <label>Usage:</label>
                                        <select class="form-control" name="plot_usage">
                                         <option>Residential</option>
                                         <option>Commercial</option>
                                        <option>Rental</option>
                                         <option>Garden</option>
                                          <option>Others</option>
                                      </select>
                                            </div>

                                      <div class="form-group">
                                                <label>Category:</label>
                                                  <select class="form-control" name="plot_category">
                                                    <option>Kibanja</option>
                                                    <option>Land Title</option>
                                                </select>
                                        </div>
                                  </div>
                              </div>


                              <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Witness Details</h6>
                                </div>
                                <div class="card-body">
                                  <div class="form-group">
                                    Witness 1
                                  </div>
                                 
                                  <div class="form-group">
                                    <input type="text" class="form-control"name="witness-1" placeholder="First and last names">
                                  </div>

                                   <div class="form-group">
                                    <input type="text" class="form-control"name="witness-1-nin" placeholder="NIN Number">
                                  </div>

                                  <div class="form-group">
                                    <input type="text" class="form-control"name="witness-1-phone" placeholder="Telephone 1,Telephone number 2">
                                  </div>

                                  <div class="form-group">
                                    Witness 2
                                  </div>
                                  <div class="form-group">
                                    <input type="text" class="form-control"name="witness-2" placeholder="First and last names">
                                  </div>

                                   <div class="form-group">
                                    <input type="text" class="form-control"name="witness-2-nin" placeholder="NIN Number">
                                  </div>

                                  <div class="form-group">
                                    <input type="text" class="form-control"name="witness-2-phone" placeholder="Telephone 1,Telephone number 2">
                                  </div>

                                  <div class="form-group">
                                    Witness 3
                                  </div>
                                  <div class="form-group">
                                    <input type="text" class="form-control"name="witness-3" placeholder="First and last names">
                                  </div>

                                   <div class="form-group">
                                    <input type="text" class="form-control"name="witness-3-nin" placeholder="NIN Number">
                                  </div>

                                  <div class="form-group">
                                    <input type="text" class="form-control"name="witness-3-phone" placeholder="Telephone 1,Telephone number 2">
                                  </div>

                                  <div class="form-group">
                                    Witness 4
                                  </div>
                                  <div class="form-group">
                                    <input type="text" class="form-control"name="witness-4" placeholder="First and last names">
                                  </div>

                                   <div class="form-group">
                                    <input type="text" class="form-control"name="witness-4-nin" placeholder="NIN Number">
                                  </div>

                                  <div class="form-group">
                                    <input type="text" class="form-control"name="witness-4-phone" placeholder="Telephone 1,Telephone number 2">
                                  </div>

                                <button type="submit" name="step-3" class="btn btn-primary mb-2">Continue</button>
                                  </div>
                              </div>

                            </form>
                           <?php
                           }
                       }
                        ?>
                            <!--end of phase 1 div-->
                        </div>
    <!--another card gia-->
</div>

<?php
require 'footer.php';
?>