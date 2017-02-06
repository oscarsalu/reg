<?php 
session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/log.php');
include('includes/browser_os.php');

//security to ensure only those who have logged in can view page
if(!loggedin()){
    header("Location:login.php?err=" . urlencode ("please login!!"));
    exit();
}
$user = $_SESSION['user_email'];
$sql = "select * from users where email='$user'";

$result = $db->query($sql);

$row = $result->fetch_assoc();

$u_id=$row['u_id'];
$first = $row['firstname'];
$sur = $row['surname'];
$ref = $row['user_refno'];
$bday = $row['b_day'];
$image = $row['image'];
$id_no = $row['id_no'];


function formarDate($date){
	return date('g:i a', strtotime($date));
}


			$query = "SELECT * FROM chat where user_refno = '$ref' ORDER BY id ASC";
			$run = $db-> query($query);

			while ($row = $run->fetch_array()) : 
		 ?>
			<div id="chat_data">
				<span style="color:green"><?= $row['name'];?>:</span>
				<span style="color:brown"><?= $row['message'];?></span>
				<span style="float:right;"><?= formarDate($row['date']);?></span>
			</div>
		<?php endwhile;  ?>