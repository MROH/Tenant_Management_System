<?php
include 'config/config.php';
$type = $_GET['type'];
$msg = $_GET['msg'];

    $pageTitle = "Plots Manager";
    require 'main.php';
    require 'topbar.php';
    //require 'config/pdoOpt.php';

    if(isset($_POST['skip'])){ ?>
        <script type="text/javascript">
            window.open ('plots_manager.php','_self',false)
        </script>
   <?php  
    }else if(isset($_POST['submit'])){ 
        $msg = "Documents uploaded successfully";
        $type = "success"; ?>
        <script type="text/javascript">
            window.open ('plots_manager.php?msg=<?php echo $msg;?>&type=<?php echo $type; ?>','_self',false)
        </script>
    <?php }
?>
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Upload Plot Documents
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

    <form method="POST" enctype="multipart/form-data" class="row">
                        <div class="col-lg-6">

                            <!-- Default Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Land Documents</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        <div class="form-group">
                                        	<LABEL>Plot Map: </LABEL>
                                            <input type="file" class="form-control" name="mapDox">
                                        </div>
                                        <div class="form-group">
                                        	<label>Other: </label>
                                            <input type="file" class="form-control" name="otherDox">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                         <div class="col-lg-6" style="max-width: 300px;">
                             <input type="submit"  name="submit" class="btn-primary btn-block btn-sm" value="Submit">
                          <input type="submit" name="skip" class="btn-secondary btn-block btn-sm" value="Skip and upload later">
                          </div>

                    </form>

</div>

<?php
require 'footer.php';
?>