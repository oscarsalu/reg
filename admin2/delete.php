<?php
session_start();
require 'config.php';
require 'db.php';

if($_POST['del_id'])
{
	$id = $_POST['del_id'];
	$stmt="DELETE FROM course WHERE course_id=$id";
	$db->query($stmt);
}
?>
