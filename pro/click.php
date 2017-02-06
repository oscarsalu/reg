<?php

include('includes/config.php');
include('includes/db.php');

if (isset($_POST["search"])){

    $cos=$_POST["search"];

    $sql="insert into appli_course (course_name) value ('$cos')";
    $a=$db->query($sql);
    if ($a) {
    	echo "success";
    }else
    echo "no success";

}







?>