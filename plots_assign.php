<?php
    session_start();
    $pageTitle = "Plots Manager";
    require 'main.php';
    require 'topbar.php';
    $plot_phase = null;
    $plot_number = null;
    require 'config/config.php';
    if(isset($_GET['step-1'])){
        $_SESSION['phase'] = $_GET['phase'];
    }

?>
<div class="container-fluid">
	 
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Assign Plot</h1>
    </div>

    <!--some card hia-->
     <div class="col-lg-6">

                           <!-- Phase 1 div -->
                           <?php if(empty(isset($_GET['step-1']))){
                            ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Choose Phase</h6>
                                </div>
                                <div class="card-body">
                                    <form method="GET">
                                          <div class="form-group mb-2">
                                            <select class="form-control" name="phase" required>
                                                <?php 
                                                $rs=$db->fetchAll('plots_table');
                                                foreach ($rs as $key) { ?>
                                                    <option><?php echo $key->plot_phase; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                          </div>

                                          <button type="submit" name="step-1" class="btn btn-primary mb-2">Continue</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                        } ///step-1 ends here
                        else if(isset($_GET['step-1'])){ ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Plot Number</h6>
                                </div>
                                <div class="card-body">
                                    <form method="GET" action="plot_step_2.php">
                                        <div class="form-group">
                                        <input type="text" name="phase" value="<?php echo $_SESSION['phase']; ?>" class="form-control" readonly>
                                    </div>
                                          <div class="form-group mb-2">
                                            <select class="form-control" name="plot_no" required>
                                                <?php 
                                                $vr=array('plot_phase'=>$_SESSION['phase']);
                                                $custom=$db->query("select DISTINCT * from plots_table where plot_phase=?",$vr);
                                                foreach ($custom as $key) { ?>
                                                    <option value="<?php echo $key->id; ?>"><?php echo $key->serial_number; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                          </div>

                                          <button type="submit" name="step-2" class="btn btn-primary mb-2">Continue</button>
                                    </form>
                                </div>
                            </div>
                        <?php 
                            } ?>
                            <!--end of phase 1 div-->
                        </div>
    <!--another card gia-->
</div>

<?php
require 'footer.php';
?>