<?php
include('includes/config.php');
include('includes/db.php');
$output='';
if (isset($_POST["export_excel"])) {

	$sql = "SELECT * FROM course_qualification JOIN course ON course_qualification.course_id=course.course_id JOIN cert_unit ON course_qualification.unit_code=cert_unit.unit_code JOIN cert_unit_grade ON course_qualification.score=cert_unit_grade.value JOIN certification ON course_qualification.cert_id=certification.cert_id";
	$result = $db->query($sql);

	if (mysqli_num_rows($result)>0) {

		$output .= '
			<table class="table" bordered="1">
			<tr>
                <th>Course Name</th>
                <th>Subject</th>
                <th>Grade</th>
                <th>Certification</th>
			</tr>

		';
		while ($row3 = mysqli_fetch_array($result)) {
		$output .='
			<tr>
				<td>'.$row3["course_name"].'</td>
				<td>'.$row3["unit_name"].'</td>
				<td>'.$row3["grade_name"].'</td>
				<td>'.$row3["cert_name"].'</td>
			</tr>

		';
	}
	$output .='</table>';
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=course.xls");
	echo $output;
	} 
	# code...
}


?>