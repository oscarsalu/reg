<?php
session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/log.php');
include('includes/access.php');
include('includes/browser_os.php');

@$cat=$_GET['c'];
@$course=$_GET['co'];
@$program=$_GET['p'];
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


if (isset($_POST['select'])) {
	$_SESSION['course']=$_POST['course'];

	$course=$_POST['course'];
	$program=$_POST['program'];

	/*$law="SELECT * FROM `program_course`JOIN program ON program_course.progr_id=program.program_id JOIN course ON program_course.cour_id=course.course_id WHERE course_level=$cat && program_id=$program && course_id=$course";
	$rqw=$db->query($law);
	$kgb=$rqw->FETCH_ASSOC();*/
	

	$sql9="INSERT INTO appli_course( user_refno,intake_id , course_id, course_name) SELECT '$ref','$program' ,course_id,course_name FROM course WHERE course_id='$course';";

	$suc=$db->query($sql9);

   if ($suc){

        header("Location:unti.php?success=" . urlencode("You have selected $course as prefered course"));

   }
    else header("Location:search_course.php?err=" . urlencode("There is something wrong with the server try again later or u have selected the same course twice please contact the admin"));
}


?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>

	<title><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];} else echo $_COOKIE['user_name']; ?></title>
	<script language=Javascript>


		
		function reload2(form){
			var val=form.program.options[form.program.options.selectedIndex].value;

			self.location='app.php?p='+val ;
		}function reload1(form){
			var val=form.program.options[form.program.options.selectedIndex].value;
			var val2=form.cat.options[form.cat.options.selectedIndex].value;

			self.location='app.php?c='+val2+'&p='+val ;
		}
		function reload(form){
			var val=form.program.options[form.program.options.selectedIndex].value;
			var val2=form.cat.options[form.cat.options.selectedIndex].value;
			var val3=form.course.options[form.course.options.selectedIndex].value;

			self.location='app.php?c='+val2+'&co='+val3+'&p='+val ;
		}
		function disableselct()
		{
			<?php
			if (isset($cat) and strlen($cat)>0) {
				echo "document.f1.disabled = false;";}
				else{echo "document.f1.disabled= true;";}
			?>
		}

	</script>
</head>
<body onload=diableselect();>
<div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container"> 
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#"></a>
                
            </div>
            <div class="logo">
            <h4><a href="app.php"> The Technical University of Kenya</span></a></h4>
            </div>
        </div>
    </div>
 
<div class="container">

<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success"><?php echo $_GET['success'];?></div>

<?php } ?>
<?php if (isset($_GET['err'])) {?>

<div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

<?php } ?>
<br>
<br>
<div class="jumbotron">
	<table width="100%" class="table table-striped table-condensed table-responsive" style="margin-top:50px;">
        <thead>
        <tr>
        <th>Id</th>
        <th>Intake Name</th>
        <th>Academic Year</th>
        <th>Start date</th>
        <th>End date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt ="SELECT * FROM program";
        $str=$db->query($stmt);
        
        while($row = $str->FETCH_ASSOC())
        {
            ?>
            <tr>
            <td><?php echo $row['program_id']; ?></td>
            <td><?php echo $row['intake_name']; ?></td>
            <td><?php echo $row['academic_year']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        </table>
</div>

<?php

$lkj="SELECT DISTINCT program_id,intake_name,academic_year from program order by program_id";
///////// Getting the data from Mysql table for first list box//////////
$sql="SELECT DISTINCT level_id,level_name FROM course_level order by level_id ";

echo "<form method=post name=f1 action='app.php' 
' style='margin-top:80px;'>";

//////////        Starting of first drop downlist /////////
echo "<label>Intake</label>";
echo "<select class='form-control'  name='program' onchange=\"reload2(this.form)\"><option value=''>Select one</option>";
foreach ($db->query($lkj) as $raw){
	if ($raw['program_id']==@$program){
		echo "<option selected value = '$raw[program_id]'>$raw[intake_name]</option>"."<br>";
	}
	else { echo "<option value='$raw[program_id]'>$raw[intake_name]</option>";}
	}
echo "</select>";


echo"<label>Level</label>";
echo "<select class='form-control'  name='cat' onchange=\"reload1(this.form)\"><option value=''>Select one</option>";
 
foreach ($db->query($sql) as $row){
	if ($row['level_id']==@$cat){
		echo "<option selected value = '$row[level_id]'>$row[level_name]</option>"."<br>";
	}
	else { echo "<option value='$row[level_id]'>$row[level_name]</option>";}
	}
echo "</select>";

?>
<?php 
if (isset($cat) and strlen($cat) > 0) {
	$quer2="SELECT * FROM `program_course` JOIN program ON program_course.progr_id=program.program_id JOIN course ON program_course.cour_id=course.course_id where course_level=$cat && program_id=$program order by course_name";
}else{$quer2="SELECT * FROM `program_course`JOIN program ON program_course.program_id=program.program_id JOIN course ON program_course.course_id=course.course_id order by course_name"; }

	?>
	<br>
	<label>Course</label>
<select class="form-control" name="course" onchange="reload(this.form)">
<option value="">Select one</option>
<?php foreach ($db->query($quer2) as $row7){
	if ($row7['course_id']==@$course) {
		echo "<option selected value='$row7[course_id]'>$row7[course_name]</option>"."<br>";
	}else
	echo "<option value='$row7[course_id]'>$row7[course_name]</option>"."<br>";
	}
	?>
	<?php 
if (isset($course) and strlen($course) > 0) {
	$quer="SELECT DISTINCT dept_id FROM course where course_id=$course";
	$r=$db->query($quer);
	$ro=$r->FETCH_ASSOC();
	$dept=$ro['dept_id'];

	$q="SELECT dept_name,school_id FROM dept where dept_id='$dept'";
	$o=$db->query($q);
	$s=$o->FETCH_ASSOC();
	$depname=$s['dept_name'];
	$sch_id=$s['school_id'];

	$e="SELECT * FROM school where school_id='$sch_id'";
	$i=$db->query($e);
	$t=$i->FETCH_ASSOC();
	$sch_name=$t['school_name'];
	$fac=$t['faculty_id'];

	$a="SELECT * FROM faculty where faculty_id='$fac'";
	$k=$db->query($a);
	$l=$k->FETCH_ASSOC();
	$facna=$l['faculty_name'];

}else{
	$depname="department name";
	$sch_name="school name";
	$facna="faculty name";
 }
	?>
</select>
<?php ?>
	<br>
	<div class="form-group">
	<label>department</label>
	<?php 
	?>
	<input type="text" name="subcat" class="form-control" value="<?php echo $depname;?>" readonly>
	</div>
	<div class="form-group">
	<label>School Name</label>
	<input type="text" name="subname" class="form-control" value="<?php echo $sch_name;?>" readonly>
	</div>
	<div class="form-group">
	<label>facualty Name</label>
	<input type="text" name="subname" class="form-control" value="<?php echo $facna;?>" readonly>
	</div>

	<button class="btn btn-info" name="select" type="submit"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Add</button>
	
	<?php echo "</form>";?>
	
</select>
	

</form>
<br>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="js/jquery.easing.min.js"></script>

<!-- Google Maps API Key -->
<script type="text/javascript" src=""></script>

<!-- Custom Theme JavaScript -->
<script src="js/main.js"></script>

</body>
</html>