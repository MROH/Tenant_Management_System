<?php
require 'config/pdoOpt.php';
$type = null;
$msg = null;

if (isset($_POST['submit'])) {
    $serialCode = $_POST['phase'];
    $plotNumber = $_POST['plot_number'];
    $serialNo = $_POST['serial_number'];
    $serialNumber = $_POST['serial_number'];
    $plotCategory = $_POST['plot_category'];
    $plotSpec = $_POST['plot_spec'];
    $plotUnits = $_POST['plot_uts'];
    $plotDesc = $_POST['plot_desc'];
    $currentOWner = $_POST['current_owner'];
    $prevOwner = $_POST['prev_owner'];
    $plotLong = $_POST['plot_long'];
    $plotLat = $_POST['plot_lat'];
    $stat = 1;
    $createdBy = 1;
    $createdAt = time();
    if(empty($plotNumber)){
        $plotNumber = null;
    }

    if(($_POST['plot_category']) == "Kibanja"){
        $plotCost = 50000;
    }else{
        $plotCost = $_POST['plot_cost'];
    }
    try{
        $sql = "INSERT INTO plots_table(plot_phase,plot_number,plot_specifications,plot_measure_unit,plot_description,plot_lat,plot_long,prev_owner,serial_number,plot_category,plot_cost,plot_stat,plot_created_by,plot_created_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $pod->prepare($sql);
        $stmt->execute([$serialCode,$plotNumber,$plotSpec,$plotUnits,$plotDesc,$plotLat,$plotLong,$prevOwner,$serialNumber,$plotCategory,$plotCost,$stat,$createdBy,$createdAt]);

        if($sql){
        $msg = "Successfully added plot number : <strong>". $serialCode . $serialNumber."</strong> please attach documents or skip to do it later";
    $type = "success";
    header("Location:plot_docx.php?msg={$msg}&type={$type}");
    }


    }catch(PDOException $ex){
        print_r($ex);
    }
    
}


    $pageTitle = "Plots Manager";
    require 'main.php';
    require 'topbar.php';
?>
<div class="container-fluid">
	 <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Plot</h1>
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

               <form method="POST" class="row">
                       
                        <div class="col-lg">
                            
                            <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Plot Details</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        <div class="row">
                                        <!--Grid column-->
                                        <div class="col-md-3">
                                            <div class="md-form mb-0">
                                                <label>Serial Code</label>
                                                <select class="form-control" name="phase" required>
                                                    <option>101</option>
                                                    <option>102</option>
                                                    <option>103</option>
                                                    <option>104</option>
                                                    <option>105</option>
                                                    <option>106</option>
                                                    
                                                  </select>
                                            </div>
                                        </div>
                                        <!--Grid column-->
                                        <!--Grid column-->
                                        <div class="col-md-3">
                                            <div class="md-form mb-0">
                                                <label>Serial Number</label>
                                                <input type="number" name="serial_number" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="md-form mb-0">
                                                <label>Plot Number</label>
                                                <input type="number" name="plot_number" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="md-form mb-0">
                                                <label>Area size</label>
                                                <input type="text" name="plot_spec" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="md-form mb-0">
                                                <label>Units:</label>
                                                  <select class="form-control" name="plot_uts">
                                                    <option>Ft</option>
                                                    <option>Hectares</option>
                                                    <option>Decimals</option>
                                                  </select>
                                            </div>
                                        </div>
                                         
                                        <div class="col-sm-3">
                                            <div class="md-form mb-0">
                                                <label>Current owner:</label>
                                                <select class="form-control" name="current_owner" required>
                                                <?php 
                                                $rs = $pod->query("SELECT * from clients")->fetchAll();
                                                foreach ($rs as $key) { ?>
                                                    <option><?php echo $key['client_title'].". ".$key['client_names']; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="md-form mb-0">
                                                <label>Previous owner:</label>
                                                <input type="text" name="prev_owner" class="form-control">
                                            </div>
                                        </div>

                                         <div class="col-sm-3">
                                            <div class="md-form mb-0">
                                                <label>Plot Cost</label>
                                                <input class="form-control" name="plot_cost" type="number" placeholder="50000"><br>
                                            </div>
                                        <!--Grid column-->
                                    </div>

                                    <div class="col-sm-3">
                                            <div class="md-form mb-0">
                                                <label>Latitude</label>
                                                <input class="form-control" name="plot_long" type="text"><br>
                                            </div>
                                        <!--Grid column-->
                                    </div>
                                    <div class="col-sm-3">
                                            <div class="md-form mb-0">
                                                <label>Longitude</label>
                                                <input class="form-control" name="plot_lat" type="text"><br>
                                            </div>
                                        <!--Grid column-->
                                    </div>

                                    <div class="col-sm-3">
                                            <div class="md-form mb-0">
                                                <label>Description</label>
                                                <textarea class="form-control" name="plot_desc">
                                                    
                                                </textarea><br>
                                            </div>
                                        <!--Grid column-->
                                    </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                            <input type="submit" name="submit" class="btn-primary btn-block btn-sm" value="Next">
                                            <input type="reset" class="btn-secondary btn-block btn-sm" value="Reset">
                                        </div>
                                </div>
                            </div>

                        </div>
                        
                           

                    </form>

</div>

<?php
require 'footer.php';
?>