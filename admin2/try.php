<?php
session_start();
require 'config.php';
require 'db.php';

function optional(){
$sch="SELECT * FROM `course_qualification` INNER JOIN cert_unit on course_qualification.unit_code=cert_unit.unit_code WHERE course_id=5 && required=0";
$b=$db->query($sch);

$c=0;
while ($j=$b->fetch_assoc()) {

	$k[$c]=$j['cluster_id'];
	$c++;
}
//loop for checking the cluster id with required option 0
for ($c=0; $c <$k[0] ; $c++) { 
	if ($k[$c]==$k[$c++]) {
		echo $k[$c];
		echo "<br>";
		$scho="SELECT * FROM course_qualification INNER JOIN cert_unit on course_qualification.unit_code=cert_unit.unit_code WHERE course_id=5 && required=0 && cluster_id='$k[$c]'";
		$raa=$db->query($scho);

		}
//fetch the unit name and score of all the of tht checked cluster id 
		$m=0;
		while ($na=$raa->fetch_assoc()) {
			$t[$m]=$na['unit_name'];
			$y[$m]=$na['score'];

			$opp="SELECT $t[$m] FROM applicant WHERE user_refno='REF52ac1b'";
			$ropp=$db->query($opp);

			$boo=$ropp->fetch_assoc();
				$pas[$m]=$boo[$t[$m]];
				$da[$m]=$pas[$m]>=$y[$m];
				$ba[$m]=$pas[$m]<$y[$m];
			$m++;
			
		}
		//checks to see if either one has passed
				if ($da[0]) {
					echo "You passed ".$t[0];
					echo "<br>";
					$big = 1;
				}elseif ($ba[0]) {
					echo "You failed ".$t[0];
					echo " ";
					$big = 0;
					if ($da[1]) {
					echo "but you passed ".$t[1];
					echo "<br>";
					$big = 1;
				}elseif ($ba[1]) {
					$big = 0;
					echo "and you also failed ".$t[1];
					echo "<br>";
					exit();
				}	
				}
		/*echo $t[0];
		echo "<br>";
		echo $t[1];
		echo "<br>";*/

	
}
}

echo $big;
if ($big==1) {
	echo "You have passed ";
}else echo "You have failed";

?>