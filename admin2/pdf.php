<?php
require_once 'dbconfig.php';

$output='';
if (isset($_POST["export_excel"])) {

	$stmt = $db_con->prepare("SELECT * FROM applicant");
    $result=$stmt->execute();

	if ($result>0) {
	 	

		$output .= '
			<table class="table" bordered="1">
			<tr>
				<th>Ref No</th>
		        <th>School</th>
		        <th>math</th>
		        <th>english</th>
		        <th>kiswahili</th>
		        <th>biology</th>
		        <th>chemistry</th>
		        <th>physics</th>
		        <th>history</th>
		        <th>geography</th>
		        <th>c_h_ire</th>
		        <th>home_science</th>
		        <th>art</th>
		        <th>agric</th>
		        <th>aviation</th>
		        <th>computer</th>
				<th>metal</th>
				<th>wood</th>
				<th>building</th>
				<th>power</th>
				<th>electricity</th>
				<th>french</th>
				<th>german</th>
				<th>arabic</th>
				<th>music</th>
				<th>sign</th>
				<th>business</th>
			</tr>

		';
		while($row2=$stmt->fetch(PDO::FETCH_ASSOC)) {
		$output .='
			<tr>
				<td>'.$row2['user_refno'].'</td>
				<td>'. $row2['school'].'</td>
				<td>'
				$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[math]'");
       			$st->execute();
       			$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'
				$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[english]'");
       			$st->execute();
       			$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[kiswahili]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 	.$ro['grade_name'].'</td>
				<td>'
				$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[biology]'");
       			$st->execute();
       			$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'
				$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[chemistry]'");
       			$st->execute();
       			$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[physics]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[history]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'
				$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[geography]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[cre]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 .$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[home_science]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name']'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[art]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[agric]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       				.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[avaiation]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 .$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[computer]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 .$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[metal]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[wood]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[building]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[power]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[electricity]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[french]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 .$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[german]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[arabic]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 		.$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[music]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 .$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[sign]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 .$ro['grade_name'].'</td>
				<td>'$st = $db_con->prepare("SELECT * FROM cert_unit_grade where value='$row2[business]'");
       		$st->execute();
       		$ro=$st->fetch(PDO::FETCH_ASSOC);
       		 .$ro['grade_name'].'</td>
			</tr>

		';
	}
	$output .='</table>';
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=applicants.xls");
	echo $output;
	} 
	# code...
}


?>