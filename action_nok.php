<?php
include 'config/pdoOpt.php';
if(isset($_GET['delete'])){
	$id = $_GET['id'];
	$stat = 2;
	$client = $_GET['client'];
	$data = array($stat,$id);
	$sql = "update next_of_kin set del_stat=? where id=?"; 
    $msg = $pod->prepare($sql);
    $msg->execute($data);

    header("Location:customer_details.php?client={$client}");

}

if(isset($_GET['client_delete'])){
	$id = $_GET['id'];
	$stat = 2;
	$data = array($stat,$id);
	$sql = "update clients set del_stat=? where id=?"; 
    $msg = $pod->prepare($sql);
    $msg->execute($data);

    header("Location:customer_all.php");

}
?>