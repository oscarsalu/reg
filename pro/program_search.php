<?php
include('includes/config.php');
include('includes/db.php');
include('includes/log.php');
include('includes/browser_os.php');
include('includes/access.php');

if (isset($_POST["query"])) {

	$output = '';
	$sql="SELECT * FROM course_qualification JOIN course ON course_qualification.course_id=course.course_id JOIN cert_unit ON course_qualification.unit_code=cert_unit.unit_code JOIN cert_unit_grade ON course_qualification.score=cert_unit_grade.value JOIN certification ON course_qualification.cert_id=certification.cert_id WHERE course_name LIKE '% ".$_POST["query"]."%'"; 
	$result = $db->query($sql);
	$output='<ul class="list-unstyled">';

	if (mysqli_num_rows($result)>0)
	{
		while ($row = mysqli_fetch_array($result)) {

			$output .='<li>'.$row["course_name"].'</li>';
			$output .='<li>'.$row["unit_name"].'</li>';
			$output .='<li>'.$row["grade_name"].'</li>';
			$output .='<li>'.$row["cert_name"].'</li>';
			# code...
		}

	}
	else
	{
		$output .= '<li> Course Not Found</li>';
	}
	$output .='</ul>';
	echo $output;
	# code...
}

?>