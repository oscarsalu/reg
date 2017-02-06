<?php
session_start();
require 'config.php';
require 'db.php';

if(isset($_POST['add'])){
    $_SESSION['cat'] = $_POST['cat'];
    $_SESSION['subc'] = $_POST['subc'];


    $cat=$_POST['cat'];
    $coss=$_POST['subc'];

    $sql2 = "insert into program_course (cour_id,progr_id) values('$coss','$cat')";
        $resa=$db->query($sql2);
        if ($resa) {
            header("Location:prog_course.php?success=". urlencode ("You have successfully added course to that program"));
        }else
        header("Location:prog_course.php?err=". urlencode ("Check to ensure you don't add the same course twice in the same program"));
    exit();
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
<script type="text/javascript" src="bootstrap/js/admin.js"></script>

    <title>ADD COURSE</title>
    <script language=Javascript>
        
        function reload(form){
            var val=form.cat.option[form.cat.input.selectedIndex].value;
        }
    </script>
     <style type="text/css">
        td{
            cursor: pointer;
        }
    </style>
</head>
<body onload="diableselect();">
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
<div class="handle"></div>
</nav>
<div class="container">

<?php if(isset($_GET['success'])) { ?>

<div class="alert alert-success"><?php echo $_GET['success'];?></div>

<?php } ?>
<?php if (isset($_GET['err'])) {?>

<div class="alert alert-danger"><?php echo $_GET['err']; ?></div>

<?php } ?>

<?php
///////// Getting the data from Mysql table for first list box//////////
$sql="SELECT DISTINCT program_id,intake_name,academic_year FROM program order by program_id ";

echo "<form method=post name=f1 action='prog_course.php' 
' style='margin-top:80px;'>";
/// Add your form processing page address to action in above line. Example  action=dd-check.php////
//////////        Starting of first drop downlist /////////
echo"<label>Program</label>";
echo "<select class='form-control'  name='cat' onchange=\"reload(this.form)\">
<option value=''>Select one</option>";
 
foreach ($db->query($sql) as $row){
    if ($row['program_id']==@$cat){
        echo "<option selected value = '$row[program_id]'>$row[intake_name],$row[academic_year]</option>"."<br>";
    }
    else { echo "<option value = '$row[program_id]'>$row[intake_name],$row[academic_year]</option>";}
    }
echo "</select>";
?>
<?php
$quer="SELECT DISTINCT course_id,course_name FROM course order by course_id";
 ?>
    <br>
    <div class="form-group">
    <label>Course</label>
    <select class="form-control" name="subc">
<option value="">Select one</option>
<?php foreach ($db->query($quer) as $row7){
    echo "<option value='$row7[course_id]'>$row7[course_name]</option>"."<br>";
    }
    ?>
    </select>
    </div>

    <button class="btn btn-info" name="add" type="submit"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Add Courses</button>
    
    <?php echo "</form>";?>
    
</select>
    

</form>
<br>
<br>
<div id="result">
<table width="100%" class="table table-striped table-condensed table-responsive" style="margin-top:50px;">
        <thead>
        <tr>
        <th>Id</th>
        <th>Course Name</th>
        <th>Intake Name</th>
        <th>Academic Year</th>
        <th>Course level</th>
        <th>Start date</th>
        <th>End date</th>
        <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt ="SELECT * FROM `program_course`JOIN program ON program_course.progr_id=program.program_id JOIN course ON program_course.cour_id=course.course_id JOIN course_level ON course.course_level=course_level.level_id order by prog_id";
        $str=$db->query($stmt);
        
        while($row = $str->FETCH_ASSOC())
        {
            ?>
            <tr>
            <td><?php echo $row['prog_id']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['intake_name']; ?></td>
            <td><?php echo $row['academic_year']; ?></td>
            <td><?php echo $row['level_name']; ?></td>
            <td><?php echo $row['start_date']; ?></td>
            <td><?php echo $row['end_date']; ?></td>
            <td align="center"><a id="<?php echo $row['prog_id']; ?>" class="delete-link" href="#" title="Delete">
            <img src="delete.png" width="20px" />
            </a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
        </table>
        </div>
</div>

<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(".delete-link").click(function()
    {
        var id = $(this).attr("id");
        var del_id = id;
        var parent = $(this).parent("td").parent("tr");
        if(confirm('Sure to Delete ID no = ' +del_id))
        {
            $.post('delete2.php', {'del_id':del_id}, function(data)
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