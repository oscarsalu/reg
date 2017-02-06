<?php 

include('includes/config.php');
include('includes/db.php');

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $sql = "update users set status='1' where token='$token'";
    if($db -> query($sql)){
        header("Location:login.php?success=Account Activated!!");
        exit();
    }
    }

?>