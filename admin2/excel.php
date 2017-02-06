<?php
require_once 'dbconfig.php';

$output='';
if (isset($_POST["export_excel"])) {

	$stmt = $db_con->prepare("SELECT * FROM users");
    $result=$stmt->execute();

	if ($result>0) {
	 	

		$output .= '
			<table class="table" bordered="1">
			<tr>
				<th>First Name</th>
		        <th>Surname</th>
		        <th>Identification Number</th>
		        <th>Gender</th>
		        <th>Email</th>
		        <th>Refrence Number</th>
			</tr>

		';
		while($row2=$stmt->fetch(PDO::FETCH_ASSOC)) {
		$output .='
			<tr>
				<td>'.$row2['firstname'].'</td>
				<td>'.$row2['surname'].'</td>
				<td>'.$row2['id_no'].'</td>
				<td>'.$row2['gender'].'</td>
				<td>'.$row2['email'].'</td>
				<td>'.$row2['user_refno'].'</td>
			</tr>

		';
	}
	$output .='</table>';
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=users.xls");
	echo $output;
	} 
	# code...
}


?>