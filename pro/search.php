<?php
error_reporting(0);
include('includes/config.php');
include('includes/db.php');
include('includes/log.php');
include('includes/browser_os.php');
include('includes/access.php');


$output='';
$sql="SELECT * FROM course_qualification JOIN course ON course_qualification.course_id=course.course_id JOIN cert_unit ON course_qualification.unit_code=cert_unit.unit_code JOIN cert_unit_grade ON course_qualification.score=cert_unit_grade.value JOIN certification ON course_qualification.cert_id=certification.cert_id WHERE course_name LIKE '% ".$_POST["query"]."%'";
/*$sql="Select * from course where course_name LIKE '% ".$_POST["search"]."%'";*/

$result = $db->query($sql);


if (mysqli_num_rows($result)>0) 

{
	
	$output .= '<h4 align="center">SEARCH RESULT</h4>';
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Course Name</th>
			                <th>Subject</th>
			                <th>Grade</th>
			                <th>Certification</th>
							</tr>';
	while ($row = mysqli_fetch_array($result)) {
		$output .='
			<tr>
				<td id="cos">'.$row["course_name"].'</td>
				<td>'.$row["unit_name"].'</td>
				<td>'.$row["grade_name"].'</td>
				<td>'.$row["cert_name"].'</td>
			</tr>

		';
	}
	echo $output;
}
else
{
	echo "Course not available";
}

?>