<?php
session_start();
require 'config.php';
require 'db.php';

if($_POST['del_id'])
{
	$id = $_POST['del_id'];
	$stmt="DELETE FROM school WHERE school_id=$id";
	$db->query($stmt);
}
?>
