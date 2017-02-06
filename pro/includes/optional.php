<?php
function optional($course){
error_reporting(0);
require ('includes/config.php');
require ('includes/db.php');

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
$pass=$row['password'];
$big=0;


$qwe="SELECT course_name FROM course WHERE course_id='$course';";
$rwa=$db->query($qwe);

$wer= $rwa->fetch_assoc();
$coursename=$wer['course_name'];

$sch="SELECT * FROM `course_qualification` INNER JOIN cert_unit on course_qualification.unit_code=cert_unit.unit_code WHERE course_id='$course' && required=0";
global $db;
$b=$db->query($sch);
if ($b->num_rows>1) {
	# code...

	$c=0;
while ($j=$b->fetch_assoc()) {

	$k[$c]=$j['cluster_id'];
	$c++;
}

//loop for checking the cluster id with required option 0
for ($c=0; $c<$k[$c] ; $c++) { 
	if ($k[$c]==$k[$c++]) {
		echo $k[$c];
		echo "<br>";
		$scho="SELECT * FROM course_qualification INNER JOIN cert_unit on course_qualification.unit_code=cert_unit.unit_code WHERE course_id='$course' && required=0 && cluster_id='$k[$c]'";
		$raa=$db->query($scho);

		}
//fetch the unit name and score of all the of tht checked cluster id 
		$m=0;
		while ($na=$raa->fetch_assoc()) {
			$t[$m]=$na['unit_name'];
			$y[$m]=$na['score'];

			$opp="SELECT $t[$m] FROM applicant WHERE user_refno='$ref'";
			$ropp=$db->query($opp);

			$boo=$ropp->fetch_assoc();
				$pas[$m]=$boo[$t[$m]];
				$da[$m]=$pas[$m]>=$y[$m];
				$ba[$m]=$pas[$m]<$y[$m];
			$m++;
			
		}
		//checks to see if either one has passed
		if ($pas[0]==0 && $pas[1]==0) {
			if ($da[2]) {
					echo "you passed ".$t[2];
					echo "<br>";
					$big = 1;
				}elseif ($ba[2]) {
					echo "and you also failed ".$t[2];
					echo "<br>";
					header("Location:profile.php?err=" . urlencode("Sorry you have not qualified for $coursename,you have not done $t[0] and $t[1] and you failed $t[2];"));
					exit();

				}
		}
		else if ($pas[0]==0 && $pas[2]==0) {
			if ($da[1]) {
					echo "You passed ".$t[1];
					echo "<br>";
					$big = 1;
				}elseif ($ba[1]) {
					echo "and you also failed ".$t[1];
					echo "<br>";
					header("Location:profile.php?err=" . urlencode("Sorry you have not qualified for $coursename,you have not done $t[0] and $t[2] and you failed $t[1];"));
					exit();

				}
		}else if ($pas[1]==0 && $pas[2]==0) {
			if ($da[0]) {
					echo "you passed ".$t[0];
					echo "<br>";
					$big = 1;
				}elseif ($ba[0]) {
					echo "and you also failed ".$t[0];
					echo "<br>";
					header("Location:profile.php?err=" . urlencode("Sorry you have not qualified for $coursename,you have not done $t[1] and $t[2] and you failed $t[0];"));
					exit();

				}
		}else if ($pas[0]==0) {
			if ($da[1]) {
					echo "You passed ".$t[1];
					echo "<br>";
					$big = 1;
				}elseif ($ba[1]) {
					echo "You failed ".$t[1];
					echo " ";
					if ($da[2]) {
					echo "but you passed ".$t[2];
					echo "<br>";
					$big = 1;
				}elseif ($ba[2]) {
					echo "and you also failed ".$t[2];
					echo "<br>";
					header("Location:profile.php?err=" . urlencode("Sorry you have not qualified for $coursename,you failed $t[1], you also failed $t[2];"));
					exit();

				}
			}
		}
		else if ($pas[1]==0) {
			if ($da[0]) {
					echo "You passed ".$t[0];
					echo "<br>";
					$big = 1;
				}elseif ($ba[0]) {
					echo "You failed ".$t[0];
					echo " ";
					if ($da[2]) {
					echo "but you passed ".$t[2];
					echo "<br>";
					$big = 1;
				}elseif ($ba[2]) {
					echo "and you also failed ".$t[2];
					echo "<br>";
					header("Location:profile.php?err=" . urlencode("Sorry you have not qualified for $coursename,you failed $t[0], you also failed $t[2];"));
					exit();

				}
			}
		}else if ($pas[2]==0) {
			if ($da[0]) {
					echo "You passed ".$t[0];
					echo "<br>";
					$big = 1;
				}elseif ($ba[0]) {
					echo "You failed ".$t[0];
					echo " ";
					if ($da[1]) {
					echo "but you passed ".$t[1];
					echo "<br>";
					$big = 1;
				}elseif ($ba[1]) {
					echo "and you also failed ".$t[1];
					echo "<br>";
					header("Location:profile.php?err=" . urlencode("Sorry you have not qualified for $coursename,you failed $t[0], you also failed $t[1];"));
					exit();

				}
			}
		} else 
		if ($da[0]) {
					echo "You passed ".$t[0];
					echo "<br>";
					$big = 1;
				}elseif ($ba[0]) {
					echo "You failed ".$t[0];
					echo " ";
					if ($da[1]) {
					echo "but you passed ".$t[1];
					echo "<br>";
					$big = 1;
				}elseif ($ba[1]) {
					echo "and you also failed ".$t[1];
					echo "<br>";
					header("Location:profile.php?err=" . urlencode("Sorry you have not qualified for $coursename,you failed $t[0], you also failed $t[1];"));
					exit();

				}
			}	
	}
	if ($big==1) {
                    //register
                    $register="UPDATE appli_course SET qualified = 1 where course_id='$course' && user_refno='$ref'";
                    $success=$db->query($register);
                    //invitation
                    if ($success) {
                        $message = "Hi $first $sur you have qualified for $coursename.You are welcomed to our school, the adminstration block , come with ur original certicates ";
                        mail($user, 'Invitation to persue $coursename', $message , 'From:oscarsalu@gmail.com');
                        /*echo "You have passed ";
                        echo "<br>";*/
                       /* header("Location:unti.php?success=" . urlencode("Congratulations!! You have qualified for $coursename"));
                        exit();*/
                        echo "<script>alert('Congratulations!! You have qualified for $coursename')</script>";
                        header("Location:u.php?success=" . urlencode("Congratulations!! You have qualified for $coursename"));
                        exit();
                }else 
                header("Location:unti.php?err=" . urlencode("Try again. if the problem continue contact the admin")); 
                
        }else
        echo "<script>alert('Sorry but you did not qualify for $coursename select another course')</script>";	
        exit();		
}elseif($b->num_rows>0) {
	
	$j=$b->fetch_assoc();
	$k=$j['cluster_id'];
	$nameu=$j['unit_name'];
	$scor=$j['score'];

	$qsc="SELECT $nameu FROM applicant WHERE user_refno='$ref'";
	$ter=$db->query($qsc);
	
	$na=$ter->fetch_assoc();

	$t=$na[$nameu];

	if ($t<$scor) {
		
		echo "You also failed ".$nameu;
					echo "<br>";
					header("Location:profile.php?err=" . urlencode("Sorry you have not qualified for $coursename you failed $nameu"));
					exit();
	}else if ($t>=$scor) {
		echo "You passed ".$nameu;
		$big=1;
		echo "<br>";
	}
if ($big==1) {
                    //register
                    $register="UPDATE appli_course SET qualified = 1 where course_id='$course' && user_refno='$ref'";
                    $success=$db->query($register);
                    //invitation
                    if ($success) {
                        $message = "Hi $first $sur you have qualified for $coursename.You are welcomed to our school, the adminstration block , come with ur original certicates ";
                        mail($user, 'Invitation to persue $coursename', $message , 'From:oscarsalu@gmail.com');
                        /*echo "You have passed ";
                        echo "<br>";*/
                       /* header("Location:unti.php?success=" . urlencode("Congratulations!! You have qualified for $coursename"));
                        exit();*/
                        echo "<script>alert('Congratulations!! You have qualified for $coursename')</script>";
                        header("Location:u.php?success=" . urlencode("Congratulations!! You have qualified for $coursename"));
                        exit();
                }else 
                header("Location:unti.php?err=" . urlencode("Try again. if the problem continue contact the admin")); 
                
        }else
        echo "<script>alert('Sorry but you did not qualify for $coursename select another course')</script>";
}
				


}
?>