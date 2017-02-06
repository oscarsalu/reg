<?php
session_start();
include('includes/optional.php');
include('includes/config.php');
include('includes/db.php');

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

$sql2= "SELECT * from applicant where user_refno= '$ref'";
$res=$db->query($sql2);
$ra =  $res->fetch_assoc();
$grade=$ra['mean_grade'];


$course=$_SESSION['course'];

$qwe="SELECT course_name FROM course WHERE course_id='$course';";
$rwa=$db->query($qwe);

$wer= $rwa->fetch_assoc();
$coursename=$wer['course_name'];
echo $coursename;
echo "<br>";

//checks the mean grade first
$ask="select * from course_qualification where course_id='$course' && unit_code='010'";

$result2 = $db->query($ask);

$row2 = $result2->fetch_assoc();

$score=$row2['score'];
//checks the mean grade 
if ($score<=0) {
	echo "The mean_grade has not been set";
	exit();
}elseif ($grade<=0) {
	echo "please insert your mean grade";
	exit();
}elseif ($grade<$score) {
	echo "you have not qualified for this course";
	exit();
}elseif ($grade>=$score) {
	$ask2="SELECT * FROM `course_qualification` INNER JOIN cert_unit on course_qualification.unit_code=cert_unit.unit_code WHERE course_id='$course' && required=1";
	$r= $db->query($ask2);

    if ($r->num_rows >2) {
   $al=0;
    while ( $q= $r->fetch_assoc()) {
        $code[$al]=$q['unit_code'];
        $s[$al]=$q['score'];
        $name[$al]=$q['unit_name'];

        $l="SELECT * from applicant where user_refno='$ref'";
        $t=$db->query($l);
        $y=$t->fetch_assoc();
        $m[$al]=$y[$name[$al]];
        $al++;
    }



        if ($m[0]<$s[0]) {
            header("Location:profile.php?err=" . urlencode("Sorry but you did not qualify for $coursename,you failed $name[0] select another course"));
            exit();

        }else if ($m[0]>=$s[0]) {
            echo "you passed ".$name[0];
            echo " ";
            if ($m[1]<$s[1]) {
                header("Location:profile.php?err=" . urlencode("Sorry but you did not qualify for $coursename,you failed $name[1] select another course"));
                exit();
            }
            else
                echo " and you passed ".$name[1];
                if ($m[2]<$s[2]) {
                   header("Location:profile.php?err=" . urlencode("Sorry but you did not qualify for $coursename,you failed $name[2] select another course"));
                exit();
                }else if ($m[2]>=$s[2]) {
                   echo " and you passed ".$name[2];
                    echo "<br>";
                    $big = 1; 

        $scho="SELECT * FROM course_qualification INNER JOIN cert_unit on course_qualification.unit_code=cert_unit.unit_code WHERE course_id='$course' && required=0 ";
        $raa=$db->query($scho);
        if ($raa->num_rows >0) {
            optional($course);
            exit();
        }else if ($big==1) {
                    //register
                    $register="UPDATE appli_course SET qualified = 1 where course_id='$course' && user_refno='$ref'";
                    $success=$db->query($register);
                    //invitation
                    if ($success) {
                        $message = "Hi $first $sur you have qualified for $coursename.You are welcomed to our school, the adminstration block , come with ur original certicates ";
                        mail($user, 'Invitation to persue $coursename', $message , 'From:oscarsalu@gmail.com');
                        /*echo "You have passed ";
                        echo "<br>";*/
                        /*header("Location:unti.php?success=" . urlencode("Congratulations!! You have qualified for $coursename"));
                        exit();*/
                        echo "<script>alert('Congratulations!! You have qualified for $coursename')</script>";
                }else 
                header("Location:unti.php?err=" . urlencode("Try again. if the problem continue contact the admin")); 
                
        }else
        echo "<script>alert('Sorry but you did not qualify for $coursename select another course')</script>";
        }
        }
    }
else if ($r->num_rows >1) {
        $al=0;
    while ( $q= $r->fetch_assoc()) {
        $code[$al]=$q['unit_code'];
        $s[$al]=$q['score'];
        $name[$al]=$q['unit_name'];

        $l="SELECT * from applicant where user_refno='$ref'";
        $t=$db->query($l);
        $y=$t->fetch_assoc();
        $m[$al]=$y[$name[$al]];
        $al++;
    }



        if ($m[0]<$s[0]) {
            header("Location:profile.php?err=" . urlencode("Sorry but you did not qualify for $coursename,you failed $name[0] select another course"));
            exit();

        }else if ($m[0]>=$s[0]) {
            echo "you passed ".$name[0];
            echo " ";
            if ($m[1]<$s[1]) {
                header("Location:profile.php?err=" . urlencode("Sorry but you did not qualify for $coursename,you failed $name[1] select another course"));
                exit();
            }
            elseif ($m[1]>=$s[1]) {
                echo " and you passed ".$name[1];
                echo "<br>";
                $big = 1;
                $scho="SELECT * FROM course_qualification INNER JOIN cert_unit on course_qualification.unit_code=cert_unit.unit_code WHERE course_id='$course' && required=0";
        $raa=$db->query($scho);
        if ($raa->num_rows >0) {
            optional($course);
            exit();
        }else if ($big==1) {
                    //register
                    $register="UPDATE appli_course SET qualified = 1 where course_id='$course' && user_refno='$ref'";
                    $success=$db->query($register);
                    //invitation
                    if ($success) {
                        $message = "Hi $first $sur you have qualified for $coursename.You are welcomed to our school, the adminstration block , come with ur original certicates ";
                        mail($user, 'Invitation to persue $coursename', $message , 'From:oscarsalu@gmail.com');
                        /*echo "You have passed ";
                        echo "<br>";*/
                        /*header("Location:unti.php?success=" . urlencode("Congratulations!! You have qualified for $coursename"));
                        exit();*/
                        echo "<script>alert('Congratulations!! You have qualified for $coursename')</script>";
                }else 
                header("Location:unti.php?err=" . urlencode("Try again. if the problem continue contact the admin")); 
                
        }else
        echo "<script>alert('Sorry but you did not qualify for $coursename select another course')</script>";
        }
    }
}else if ($r->num_rows >0) {
    $q= $r->fetch_assoc();

    $code=$q['unit_code'];
    $s=$q['score'];
    $name=$q['unit_name'];

    $l="SELECT * from applicant where user_refno='$ref'";
        $t=$db->query($l);
        $y=$t->fetch_assoc();
        $m=$y[$name];

        if ($m<$s) {
            header("Location:profile.php?err=" . urlencode("Sorry but you did not qualify for $coursename,you failed $name[0] select another course"));
            exit();

        }else if ($m>=$s) {
            echo "you passed ".$name;
            echo " ";
            $big = 1;
                $scho="SELECT * FROM course_qualification INNER JOIN cert_unit on course_qualification.unit_code=cert_unit.unit_code WHERE course_id='$course' && required=0";
        $raa=$db->query($scho);
        if ($raa->num_rows >0) {
            optional($course);
            exit();
        }else if ($big==1) {
                    //register
                    $register="UPDATE appli_course SET qualified = 1 where course_id='$course' && user_refno='$ref'";
                    $success=$db->query($register);
                    //invitation
                    if ($success) {
                        $message = "Hi $first $sur you have qualified for $coursename.You are welcomed to our school, the adminstration block , come with ur original certicates ";
                        mail($user, 'Invitation to persue $coursename', $message , 'From:oscarsalu@gmail.com');
                        /*echo "You have passed ";
                        echo "<br>";*/
                        /*header("Location:unti.php?success=" . urlencode("Congratulations!! You have qualified for $coursename"));
                        exit();*/
                        echo "<script>alert('Congratulations!! You have qualified for $coursename')</script>";
                }else 
                header("Location:unti.php?err=" . urlencode("Try again. if the problem continue contact the admin")); 
                
        }else
        echo "<script>alert('Sorry but you did not qualify for $coursename select another course')</script>";
}
}
}
	

?>
<!-- $sch="SELECT * FROM `course_qualification` INNER JOIN cert_unit on course_qualification.unit_code=cert_unit.unit_code WHERE course_id='$course' && required=0";
            $b=$db->query($sch);

            $c=0;
            while ($j=$b->fetch_assoc()) {

                $k[$c]=$j['cluster_id'];
                $c++;
            }
//loop for checking the cluster id with required option 0
                for ($c=0; $c <$k[0] ; $c++) { 
                    if ($k[$c]==$k[$c++]) {
                        /*echo $k[$c];
                        echo "<br>";*/
                        $scho="SELECT * FROM course_qualification INNER JOIN cert_unit on course_qualification.unit_code=cert_unit.unit_code WHERE course_id='$course' && required=0 && cluster_id=".$k[$c];
                        $raa=$db->query($scho);
                //fetch the unit name and score of all the of tht checked cluster id 
                    }
                        $po=0;
                        //this section checks the optional subjects
               while ($na=$raa->fetch_array()) {
                            $t=$na['unit_name'];
                            $y=$na['score'];

                            $opp="SELECT $t FROM applicant WHERE user_refno='$ref'";
                            $ropp=$db->query($opp);

                            $boo=$ropp->fetch_assoc();
                                $pas=$boo[$t];
                                $da=$pas>=$y;
                                $ba=$pas<$y;
                            if ($ba) {
                                   /* echo "You failed ".$t;
                                    echo "<br>";*/
                                    $flow = 0;

                                }elseif ($da) {
                                    /*echo "You passed ".$t;
                                    echo "<br>";*/
                                    $big = 1;
                                }
                            
                        }
                        //checks to see if either one has passed
                                
                                    /*if ($da[1]) {
                                    echo "but you passed ".$t[1];
                                    echo "<br>";
                                    $big = 1;
                                }elseif ($ba[1]) {
                                    $big = 0;
                                    echo "and you also failed ".$t[1];
                                    echo "<br>";
                                    exit();
                                }   
                                */
                        /*echo $t[0];
                        echo "<br>";
                        echo $t[1];
                        echo "<br>";*/

                
                } -->