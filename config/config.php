<?php

ini_set("display_errors", true);


$host = "localhost";
$db_username = "root";
//$port = "443";
$db_password = "";

$db_name = "oh";


require_once("Database.php");


$db = new Database($host, $db_username, $db_password, $db_name);



function handleException($exception)
{
    
	echo  $exception->getMessage();

}


set_exception_handler('handleException');
