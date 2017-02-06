<?php 
session_start();
session_destroy();

setcookie("user_name", "" , time()-60*5);
header("Location:login.php?success=" . urlencode ("Logged Out Successfully"));
exit();

?>