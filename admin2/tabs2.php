<html>
<head>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="admin.css">
<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/admin.js"></script>
 <?php

$con = mysqli_connect("localhost", "root", "") or die("Connection Failed");
mysqli_select_db($con, "registration") or die("Connection Failed");
?>
  <link href = "tabs1.css" rel = "stylesheet" type = "text/css">
  <script src ="tabs1.js"></script>
  
</head>
<body>
<header>
  <a href="tabs2.php"> The Technical University Of Kenya</a>
</header>
<nav class="navbar navbar-inverse ">
<div class="navbar-inner">
            <div class="container"> 
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#"></a>
                </div>
              
  <ul>
    <li>
      <a href="tabs2.php" style="color:white;"><span class="glyphicon glyphicon-home"></span> Home</a>
    </li>
    <li>
    <a href="appli.php">grades</a>
    </li>
        <li>
        <a href="aplica2.php">Documents</a>
        </li>
        <li>
        <a href="courses.php">Qualified</a>
        </li>
      <li>
      <a href="prog.php">Add program</a>
      </li>
        <li>
        <a href="add.php">Add course</a>
        </li>
        <li>
        <a href="prog_course.php">Add course to program</a></li>
    <li>
      <a href="admin_chat.php" style="color:white;">Messages</a>
    </li>
    <li>
      <a href="bank.php" style="color:white;">Bank</a>
    </li>
    </ul>
    </div>
</nav>
<ul class="tab">
  <li><a href="#" class="tablinks"  onclick="openCity(event, 'Faculty')" selected="true"><h2>Faculty</h2></a></li>
  <li><a href="#" class="tablinks" onclick="openCity(event, 'School')"><h2>School</h2></a></li>
  <li><a href="#" class="tablinks" onclick="openCity(event, 'Department')"><h2>Department</h2></a></li>
  <li><a href="#" class="tablinks" onclick="openCity(event, 'Course')"><h2>Course Level</h2></a></li>
  <li><a href="#" class="tablinks" onclick="openCity(event, 'Certification')"><h2>Certification</h2></a></li>
  <li><a href="#" class="tablinks" onclick="openCity(event, 'Cluster')"><h2>Cluster</h2></a></li>
  <li><a href="#" class="tablinks" onclick="openCity(event, 'Units')"><h2>Units</h2></a></li>
  </ul>
<div id="Faculty" class="tabcontent" >

  <h3>Faculty</h3>

<fieldset>
<legend>Create </legend>
  <form  action = "tabs2.php" method = "post">
<!-- Faculty ID:  <br> <input type="text" name="facultyid"  ><br><br> -->
Faculty Name: <br> <input class="form-control" type="text" name="facultyname"  ><br><br>
 <button  type="submit" name = "add">ADD</button><h3 align ="center"><a href="review.php">Review</a></h3>
  
 </form></fieldset> 
</div>
  

<div id="School" class="tabcontent">
  <h3>School</h3>

  <?php

if(isset($_POST['add'])){
    // $facultyid = $_POST['facultyid'];
	// $facultyname = $_POST['facultyname'];
    
	
         /*$facultyid = mysqli_real_escape_string($con , $_POST['facultyid']);*/
        $facultyname = mysqli_real_escape_string($con , $_POST['facultyname']);
        $sql3 = "insert into faculty ( faculty_name) values('$facultyname')";
        $re=$con->query($sql3);
		if($re){
			echo"facualty was successfully saved";
		}
		else
		   echo "not successful"; 
}

?>
 
 
  <fieldset>
<legend>Create </legend>


  <form  action = "tabs2.php" method = "post">
  <?php
  
  ///////// Getting the data from Mysql table for first list box//////////
$sql="SELECT DISTINCT faculty_id,faculty_name FROM faculty order by faculty_id ";


/// Add your form processing page address to action in above line. Example  action=dd-check.php////
//////////        Starting of first drop downlist /////////
echo"<label></label>";
echo "<select class='form-control'  name='cat' onchange=\"reload(this.form)\"><option value=''>Select Faculty name</option>";
 
foreach ($con->query($sql) as $row)
{{ echo "<option value='$row[faculty_id]'>$row[faculty_name]</option>";}
	}
echo "</select>";
  
  
  ?>
 
<br><br>
<!-- School ID:  <br> <input type="text" name="schoolid" autocomplete <br><br>
 -->School Name: <br> <input class="form-control" type="text" name="schoolname" autocomplete ><br><br>
   <input type="submit" name = "adds">
  
 </form>
<h3 align ="center"><a href="reviewschool.php">Review</a></h3>
 </fieldset>
  
  

  
</div>

<div id="Department" class="tabcontent">
  <h3>Department</h3>

  <?php

if(isset($_POST['adds'])){
    // $schoolid = $_POST['schoolid'];
	// $schoolname = $_POST['schoolname'];
    
	     $cat = $_POST['cat'];
        /* $schoolid = mysqli_real_escape_string($con , $_POST['schoolid']);*/
        $schoolname = mysqli_real_escape_string($con , $_POST['schoolname']);
        $sql4 = "insert into school (faculty_id, school_name) values('$cat','$schoolname')";
        $re=$con->query($sql4);
		
		if($re){
                echo "School was successfully saved";
				// header (Location:);
		}
		else
		{
			echo "Try again there was an error"; 
		}
}

?>
  
  <fieldset>
<legend>Create </legend>
  <form  action = "tabs2.php" method = "post">
  
   <?php
  
  ///////// Getting the data from Mysql table for first list box//////////
$sql="SELECT DISTINCT school_id,school_name FROM school order by school_id ";


/// Add your form processing page address to action in above line. Example  action=dd-check.php////
//////////        Starting of first drop downlist /////////
echo"<label></label>";
echo "<select class='form-control'  name='cats' onchange=\"reload(this.form)\"><option value=''>Select School name</option>";
 
foreach ($con->query($sql) as $row)
{{ echo "<option value='$row[school_id]'>$row[school_name]</option>";}
	}
echo "</select>";
  
  
  ?>
  <br><br>
<!-- Department ID:  <br> <input type="text" name="departmentid" autocomplete <br><br> -->
Department Name: <br> <input class="form-control" type="text" name="departmentname" autocomplete ><br><br>
   <input type="submit" name = "added">
  
 </form>
 <h3 align ="center"><a href="reviewdept.php">Review</a></h3>

 </fieldset>
</div>

<div id="Course" class="tabcontent" >

<?php

if(isset($_POST['added'])){
    // $departmentid = $_POST['departmentid'];
	// $departmentname = $_POST['departmentname'];
    
	    $cats = $_POST['cats'];
         /*$departmentid = mysqli_real_escape_string($con , $_POST['departmentid']);*/
         $departmentname = mysqli_real_escape_string($con , $_POST['departmentname']);
        $sql1 = "insert into dept (school_id, dept_name) values('$cats','$departmentname')";
        $re=$con->query($sql1);
		if($re){
			echo "Department was successfully saved";
			//header(""Location: <class="tablinks" ='School')"><h2>School</h2></a> );
		}
		else
		{
			echo "not successful"; 
		}
}

?>


  <h3>Course Level</h3>
  <fieldset>
  <legend><p>Enter Course level:</p></legend>
  <form  action = "tab2.php" method = "post">
<!-- Level ID:  <br> <input type="text" name="levelid"  ><br> --><br>
Level Name: <br> <input type="text" class="form-control" name="levelname" placeholder= "Eg:Diploma,Masters" ><br><br>
   <button  type="submit" name = "addes" >ADD</button>
  
 </form>
 </fieldset>
</div>


<div id="Certification" class="tabcontent">

<?php

if(isset($_POST['addes'])){
       
	     $cats = $_POST['cats'];
         /*$levelid = mysqli_real_escape_string($con , $_POST['levelid']);*/
        $levelname	= mysqli_real_escape_string($con , $_POST['levelname']);
        $sql5 = "insert into course_level (level_name) values ('$levelname')";
        $re=$con->query($sql5);
		if($re){
			echo"course level was successfully saved";
		}
		else
		{
			echo "not successful"; 
		}
}

?>

 <h3>Certifications</h3>
 <fieldset> <legend><p>Enter Certification</p></legend>
  <form  action = "" method = "post">
<!-- Certification ID:  <br> <input type="text" name="certid"  ><br> --><br>
Certification Name: <br> <input type="text" class="form-control" name="certname" placeholder="Eg:KCSE,KNEC CERT."  ><br><br>
   <button  type="submit" name = "addcert">ADD</button>

</div>


<div class="tabcontent" id="Cluster">
<?php

if(isset($_POST['addcert'])){

	
         /*$certid = mysqli_real_escape_string($con , $_POST['certid']);*/
         $certname = mysqli_real_escape_string($con , $_POST['certname']);
        $sql6 = "insert into certification (cert_name) values('$certname')";
        $re=$con->query($sql6);
		if($re){
			echo "Certification was successfully added";
			//header(""Location: <class="tablinks" ='School')"><h2>School</h2></a> );
		}
		else
		{
			echo "not successful"; 
		}
}

?>
<h3>Cluster</h3>
 <fieldset>
 <legend><p>Enter Cluster</p></legend>
  <form  action = "" method = "post">

  <?php
  
  ///////// Getting the data from Mysql table for first list box//////////
$sql5="SELECT DISTINCT cert_id,cert_name FROM Certification order by cert_id ";


/// Add your form processing page address to action in above line. Example  action=dd-check.php////
//////////        Starting of first drop downlist /////////
echo"<label></label>";
echo "<select class='form-control'  name='ts' onchange=\"reload(this.form)\"><option value=''>Select certification name</option>";
 
foreach ($con->query($sql5) as $rpw)
{{ echo "<option value='$rpw[cert_id]'>$rpw[cert_name]</option>";}
  }
echo "</select>";
  
  
  ?>
  <br><br>
<!-- Cluster ID:  <br> <input type="text" name="certid"  ><br> --><br>
Cluster Name: <br> <input type="text" class="form-control" name="clustername" placeholder="Eg:Languages,Sciences"  ><br><br>
   <button  type="submit" name = "addcluster">ADD</button>
   </fieldset>
   </div>



<div id="Units" class="tabcontent">
<?php

if(isset($_POST['addcluster'])){

	
         /*$clusterid = mysqli_real_escape_string($con , $_POST['clusterid']);*/
         $ts=$_POST['ts'];
         $clustername = mysqli_real_escape_string($con , $_POST['clustername']);
        $sql7 = "insert into cluster (cert_id,cluster_name) values('$ts','$clustername')";
        $re=$con->query($sql7);
		if($re){
			echo "Cluster was successfully added";
			//header(""Location: <class="tablinks" ='School')"><h2>School</h2></a> );
		}
		else
		{
			echo "not successful"; 
		}
}

?>

  <h3>Units</h3>
   <fieldset>
 <legend><p>Enter Unit name: </p></legend>
 
   <?php
  
  ///////// Getting the data from Mysql table for first list box//////////
$sql="SELECT DISTINCT cert_id,cert_name FROM certification order by cert_id ";


/// Add your form processing page address to action in above line. Example  action=dd-check.php////
//////////        Starting of first drop downlist /////////
echo " Certificate Name: \n";
echo"<label></label>";
echo "<select class='form-control'  name='catse' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
 
foreach ($con->query($sql) as $row)
{{ echo "<option value='$row[cert_id]'>$row[cert_name]</option>";}
	}
echo "</select>";
  
  
  ?>
     <?php
  
  ///////// Getting the data from Mysql table for first list box//////////
$sql="SELECT DISTINCT cluster_id,cluster_name FROM cluster order by cluster_id ";


/// Add your form processing page address to action in above line. Example  action=dd-check.php////
//////////        Starting of first drop downlist /////////
echo " Cluster name: \n";
echo"<label></label>";
echo "<select class='form-control'  name='catse' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
 
foreach ($con->query($sql) as $row)
{{ echo "<option value='$row[cluster_id]'>$row[cluster_name]</option>";}
	}
echo "</select>";
  
  
  ?>
  <br><br>
 <form  action = "" method = "post">
Unit ID:  <br> <input type="text" name="certid"  ><br><br>
Unit Name: <br> <input type="text" name="certname" placeholder="Eg:Bilogy,english"  ><br><br>
   <button  type="submit" name = "addunit">ADD</button>
   </fieldset>
</div>
<div id="course_cluster" class="tabcontent">

<?php
if(isset($_POST['addunit'])){

	     $caton=$_POST['caton'];
		 $catout=$_POST['catout'];
         $unitid = mysqli_real_escape_string($con , $_POST['unitid']);
         $unitname = mysqli_real_escape_string($con , $_POST['unitname']);
        $sql8 = "insert into cert_unit (cert_id,cluster_name,unit_code,unit_code) values('$caton','$catout','$unitid','$unitname')";
        $re=$con->query($sql8);
		if($re){
			echo "Unit was successfully added";
			//header(""Location: <class="tablinks" ='School')"><h2>School</h2></a> );
		}
		else
		{
			echo "not successful"; 
		}
}

?>
</div>
<script type="text/javascript">
	$('.handle').on('click',function(){
		$('nav ul').toggleClass('showing');
	});
</script>
</body>

</html>