<?php
include 'config/img.php';
$id = $_GET['id'];
$serial = $_GET['serial'];

if(isset($_POST['submit'])){ 
    $targetDir = "uploads/"; 
    $allowTypes = array('jpg','png','jpeg','gif','PNG','JPEG','JPG'); 
     
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
                    //$time = time();
                    $insertValuesSQL = $fileName; 
                    $insertValuesSQL = trim($insertValuesSQL, ','); 
                    // Insert image file name into database 
                    $insert = $db->query("UPDATE clients SET profile_pic = '$insertValuesSQL' WHERE serial_code = '$serial'"); 
                    $msg = "submitted"; 
                }else{ 
                    $msg = "Error submitting records"; 
                    //$errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $msg = "Sorry, there was an error uploading your file."; 
                //$errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        }  
        header("Location:customer_details.php?client={$id}");
    }
}
else if(isset($_POST['skip'])){
	$stat = "saved";
    header("Location:customer_details.php?client={$id}");
}
    $pageTitle = "Clients Center";
    require 'main.php';
    require 'topbar.php';
    require 'config/pdoOpt.php';
?>
<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer Center
        </h1>
    </div>

    <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                               	    Total Clients</div>
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
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                New Clients</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Last 10</div>
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
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
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
                        </div>
                    </div>

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update client picture</h1>
    </div>

    <form method="POST" enctype="multipart/form-data" class="row">
                        <div class="col-lg-6">

                            <!-- Default Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Picture for <?php
                                      include 'config/config.php'; 

                                      $customC =$db->query("SELECT * from clients WHERE id = '$id'"); 
                                foreach ($customC as $keyC) { 

                                   echo $keyC->client_title."."." ".$keyC->client_names;
                                }
                                ?></h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        <div class="form-group">
                                        	<input type="file" name="files[]" class="form-control" multiple>
                                        </div>
                                       
                                </div>
                            </div>

                        </div>

                         <div class="col-lg-6" style="max-width: 300px;">
                             <input type="submit"  name="submit" class="btn-primary btn-block btn-sm" value="Submit">
                          <input type="submit" name="skip" class="btn-secondary btn-block btn-sm" value="Cancel">
                          </div>
                    </form>

                    <!-- Collapsable Card Example -->
                            <div class="card shadow">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Current Image</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
                                        <div class="col-md screens">
                                      <?php
                                      $customB =$db->query("SELECT * from clients WHERE id = '$id'"); 
                                foreach ($customB as $keyB) { ?> 
                                    <img src="uploads/<?php echo $keyB->profile_pic; ?>" style="width: 20%" class="img-thumbnail inline"/>

                                <?php }
                                ?>
                                </div>
                                    </div>
                                </div>
                            </div>

</div>

<?php
require 'footer.php';
?>