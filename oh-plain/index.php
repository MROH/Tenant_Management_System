<?php
//include 'includes/Database.php';
    if(isset($_POST['submit'])){
        echo "somethinh";
    }else{
        echo "nothin";
    }
?>

<form method="post" enctype="multipart/form-data">
                                    <h6>Customer Details</h6>
                                        <div class="form-group">
                                          <input type="text" class="form-control" placeholder="Client names" name="client_names" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="NIN number" name="clinet_nin" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="Telephone number" name="client_number" required>
                                        </div>
                                        
                                    <h6 class="m-0 font-weight-bold text-primary">Next of Kin Details</h6>
                               
                              
                                        <div class="form-group">
                                          <input type="text" class="form-control" placeholder="Next of kin names" name="nxt_of_kin_name" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="next_of_kin_nin" placeholder="NIN number" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="Telephone number" name="next_of_kin_contact" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="relationship" name="next_of_kin_relationship" required>
                                        </div>
                                        
                         <div class="col-lg-6" style="max-width: 300px;">
                             <button type="submit"  name="submit" class="btn-primary btn-block btn-sm">submit</button>
                          <input type="reset" class="btn-secondary btn-block btn-sm" value="Reset">
                          </div>

                    </form>