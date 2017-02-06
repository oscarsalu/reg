<?php
session_start();
require 'config.php';
require 'db.php';

if($_POST['del_id'])
{
	$id = $_POST['del_id'];
	$stmt="DELETE FROM dept WHERE dept_id=$id";
	$db->query($stmt);
}
?>
