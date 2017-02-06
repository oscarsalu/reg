<?php
session_start();
require 'config.php';
require 'db.php';

if($_GET['view_id'])
{
	$id = $_GET['view_id'];
    @$cert=$_GET['cert'];
    @$certi=$_SESSION[$_GET['cert']];
    @$cluster=$_GET['cluster'];
//to insert the valuse into the database

if (isset($_POST['clu'])) {
    $_SESSION['unit']=$_POST['unit'];
    $_SESSION['grade']=$_POST['grade'];
    $_SESSION['cluster']=$_POST['cluster'];
    $_SESSION['cert']=$_POST['cert'];
    $_SESSION['required']=$_POST['required'];

    if (strlen($_POST['cert'])<=0) {
        header("Location:add.php?err=" . urlencode("Please select the Certification"));
        exit();
    }else if (strlen($_POST['cluster'])<=0) {
        header("Location:add.php?err=" . urlencode("Please select Cluster required"));
        exit();
    }else if(strlen($_POST['unit'])<=0){
        header("Location:add.php?err=" . urlencode("Please select a Subject"));
        exit();
    }else if (strlen($_POST['grade'])<=0) {
        header("Location:add.php?err=" . urlencode("Please select Grade required"));
        exit();
    }else if (strlen($_POST['required'])<=0) {
        header("Location:add.php?err=" . urlencode("Please select if it's a Must, Optional or A Mean Grade"));
        exit();
    }
    else{

    $unit=$_POST['unit'];
    $grade=$_POST['grade'];
    $cluster=$_POST['cluster'];
    $cert=$_POST['cert'];
    $required=$_POST['required'];

    $sql9="insert into course_qualification (course_id,unit_code,score, cert_id,required ) values('$id','$unit','$grade','$cert','$required')";
    $red=$db->query($sql9);
    if ($red) {
        header("Location:add.php?success=" . urlencode("Qualification added"));
    }else header("Location:add.php?err=" . urlencode("Please Try Again later"));
    exit();

}


}
}
	
    ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="admin.css">
<script type="text/javascript" src="bootstrap/js/jquery-1.11.3-jquery.min.js"></script>

</head>
<body>
<script type="text/javascript">
    function reload(form)
    {
    var val=form.cert.options[form.cert.options.selectedIndex].value;
    self.location='view.php?view_id='+view_id+ '&cert='+ val ;
    /*self.Location='add.php?cert='+val;*/
    }

    function reload1(form)
    {
    var val=form.cert.options[form.cert.options.selectedIndex].value;
    var val2=form.cluster.options[form.cluster.options.selectedIndex].value;
    self.location='view.php?view_id='+view_id+ '&cert='+ val +'&cluster=' +val2 ;
    /*self.location='add.php?cert='+val+'$cluster'=$val2+;*/
    }
</script>
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
    <ul>
    <li>
        <a href="tabs2.php" style="color:white;"><span class="glyphicon glyphicon-home"></span> Home</a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Applicant's<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
        <li><a href="appli.php">grade</a></li>
        <li><a href="aplica2.php">Documents</a></li>
        <li><a href="courses.php">Qualification</a></li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Course<span class="caret"></span></a>
        <ul class="dropdown-menu">
        <li><a href="prog.php">Add program</a></li>
        <li><a href="add.php">Add course</a></li>
        <li><a href="prog_course.php">Add course to program</a></li>
        </ul>
    </li>
    <li>
        <a href="admin_chat.php" style="color:white;">Messages</a>
    </li>
    <li>
      <a href="bank.php" style="color:white;">Bank</a>
    </li>
    </ul>
</div>
</div>
<div class="handle"></div>
</nav>
    
<div class="container">
<br>
<br>
<br>
<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success"><?php echo $_GET['success'];?></div>

<?php } ?>
<?php if (isset($_GET['err'])) {?>

<div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

<?php } ?>

    <form method="post" action="view.php?view_id=<?php echo $id;?>" class="form-inline form-horizontal" name="f2" style="margin-top:80px;">
<div class="form-group">
<?php
$qu="SELECT * from course where course_id=$id";
$re=$db->query($qu);
$row2=$re->fetch_assoc();

$name=$row2['course_name'];
?>
<div class="col-sm-8 col-xs-8 col-md-8 col-lg-8">
<label>Course name</label>
<input class="form-control" type="text" id="course" name="course" value="<?php echo "$name";?>" readonly>
</div>
</div>

<?php

$quer4="SELECT DISTINCT cert_id, cert_name FROM Certification order by cert_id";
?>
<br>
<br>
<label>Certificate</label>
<select class="form-control" name="cert" onchange="reload(this.form)" >
<option value="">Select one</option>
<?php foreach ($db->query($quer4) as $row4){
    if ($row4['cert_id']==@$cert || $row4['cert_id'] ==@$certi ) {
        echo "<option selected value='$row4[cert_id]'>$row4[cert_name]</option>"."<br>";
    }else
    echo "<option value='$row4[cert_id]'>$row4[cert_name]</option>"."<br>";
    }
    ?>
    <?php 
if (isset($cert) and strlen($cert) > 0) {
    $quer2="SELECT DISTINCT cluster_id, cluster_name FROM cluster where cert_id=$cert order by cluster_name";
}else{$quer2="SELECT DISTINCT cluster_id, cluster_name FROM cluster order by cluster_name"; }

    ?>
    
</select>

<label>Cluster</label>
<select class="form-control" name="cluster" onchange="reload1(this.form)">
<option value="">Select one</option>
<?php foreach ($db->query($quer2) as $row7){
    if ($row7['cluster_id']==@$cluster) {
        echo "<option selected value='$row7[cluster_id]'>$row7[cluster_name]</option>"."<br>";
    }else
    echo "<option value='$row7[cluster_id]'>$row7[cluster_name]</option>"."<br>";
    }
    ?>
    <?php 
if (isset($cert) and strlen($cert) > 0) {
    $quer="SELECT DISTINCT cert_id,unit_name,unit_code FROM cert_unit where cluster_id=$cluster  order by unit_code";
}else{$quer="SELECT DISTINCT cert_id,unit_code,unit_name FROM cert_unit order by unit_code"; }
    ?>
</select>
<!-- //////////////////  This will end the first drop down list ///////////

//////////        Starting of second drop downlist ///////// -->
<label>Subject</label>
<Select name="unit" class="form-control" >
<option value="">Select One</option>
<?php foreach ($db->query($quer) as $row5){
    echo "<option value='$row5[unit_code]'>$row5[unit_name]</option>";
    }?>
</Select>
<?php 
if (isset($cert) and strlen($cert) > 0) {

    $quer4="SELECT DISTINCT value,grade_name FROM cert_unit_grade order by grade_id";
}else{$quer4="SELECT DISTINCT value,grade_name FROM cert_unit_grade order by grade_id";}
?>

<label>Grades</label>
<Select name="grade" class="form-control">
<option value="">Select One</option>
<?php foreach ($db->query($quer4) as $row6) {
    echo "<option value='$row6[value]'>$row6[grade_name]</option>";
} ?>
</Select>
<label>Requirement</label>
<select name="required" class="form-control">
    <option value="" selected>Select One</option>
    <option value="0">Optional</option>
    <option value="1">Must Subject</option>
    <option value="2">Mean Grade</option>
</select>
<br>
<br>
<br>
<button class="btn btn-info" name="clu" type="submit"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Add Details</button>
</form>
<br>
<br>

	<table width="100%" class="table table-striped table-condensed table-responsive" style="margin-top:50px;">
        <thead>
        <tr>
        <th>Course ID</th>
        <th>Unit</th>
        <th>Score</th>
        <th>Certification</th>
        <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt ="SELECT * from course_qualification where course_id=$id";
        $str=$db->query($stmt);
        
		while($row = $str->FETCH_ASSOC())
		{
			?>
			<tr>
			<td><?php echo $row['course_id']; ?></td>
			<td><?php $s="select * from cert_unit where unit_code='$row[unit_code]'";
			 $r=$db->query($s);
			 $ro=$r->FETCH_ASSOC();
			 $uname=$ro['unit_name'];
			 echo $uname;?></td>
			<td><?php $s="select * from cert_unit_grade where value= $row[score]";
			 $r=$db->query($s);
			 $ro=$r->FETCH_ASSOC();
			 $uname=$ro['grade_name'];
			 echo $uname; ?></td>
			<td><?php $s="select * from certification where cert_id=$row[cert_id]";
			 $r=$db->query($s);
			 $ro=$r->FETCH_ASSOC();
			 $uname=$ro['cert_name'];
			 echo $uname;?></td>
			<td align="center"><a id="<?php echo $row['qualification_id']; ?>" class="delete-link" href="#" title="Delete">
			<img src="delete.png" width="20px" />
            </a></td>
			</tr>
			<?php
		}
		?>
        </tbody>
        </table>
</div>
<script type="text/javascript">
    $(".delete-link").click(function()
    {
        var id = $(this).attr("id");
        var del_id = id;
        var parent = $(this).parent("td").parent("tr");
        if(confirm('Sure to Delete ID no = ' +del_id))
        {
            $.post('del.php', {'del_id':del_id}, function(data)
            {
                parent.fadeOut('slow');
            }); 
        }
        return false;
    });
    $('.handle').on('click',function(){
        $('nav ul').toggleClass('showing');
    });
</script>
</body>
</html>