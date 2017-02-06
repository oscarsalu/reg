<?php


session_start();
include('includes/config.php');
include('includes/db.php');
include('includes/log.php');
include('includes/browser_os.php');


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Technical University of kenya</title>
<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/main.css" />
<meta name="viewport" content="width=device-width, initial-scale=1,user-scaleable=no">
<script src="js/jquery.easing.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/classie.js"></script>
<script src="js/main.js"></script>

  <script src="js/jquery.js"></script>
  
</head>
<body body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" background="images/patterns/10.png">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                    <br>
                    <br>
          <br>
          <br>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <span class="light"><a href="index.php" class="navbar-brand page-scroll" id="text1"><div id="image1"></div></a></span>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="dropdown-toggle">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text">Home<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#home">Application Portal</a></li>
                          <li><a href="tukenya.ac.ke">Technical University Of Kenya</a></li>
                          <li><a href="#">Current students</a></li>
                          <li><a href="#">Former students</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                      <a href="program" class="dropdown-toggle" data-toggle="dropdown" id="text">welcome<span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                      <li><a href="available_course.php">Available programs</a></li>
                        <li><a href="program.php">course offered</a></li>
                        <li><a href="search_course.php">Search course</a></li>
                      </ul>
                    </li>
                    <li>
                        <a href="login.php" id="text"><span class="glyphicon glyphicon-log-in"></span>  login</a>
                    </li>
                    <li>
                      <a href="register.php" id="text"><span class="glyphicon glyphicon-user"></span>  Sign up</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<div style="margin-top:150px;">

<!-- Editable Table - START -->
            <div class="col-md-11 col-sm-11 col-xs-11">
              <div class="x_panel">
                <div class="x_title">
                <div id="datatable_filter" class="dataTables_filter">
                  <h2>Courses available <small>2016</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="btn-group">
                <div id="live_data"></div>
                    <form action="pdf.php" method="post">
                        <input type="submit" name="export_excel" class="btn btn-default" value="Export to Excel">
                    </form>
                    </div>
                  <p class="text-muted font-13 m-b-30">
                    Below are the courses offered:
                  </p>
                  <div style="margin-top:50px;">
                  <?php
               $sql2 = "SELECT * FROM course join dept on course.dept_id=dept.dept_id join course_level on course.course_level=course_level.level_id";

               $result2 = $db->query($sql2);

               if ($result2->num_rows >0){

                   echo
               "<table class='table table-condensed table-responsive'>
                <thead>
                <tr>
                <th>Course id</th>
                <th>Course Name</th>
                <th>Department</th>
                <th>Course Level</th>
                </tr>
                </thead>";

                //output data of each row

                while ($row2 = $result2->fetch_assoc())
                {
                    echo "<tbody>
                    <tr>
                    <td>" .$row2["course_id"]. "</td>
                    <td>" .$row2["course_name"]. "</td>
                    <td>" .$row2["dept_name"]."</th>
                    <td>" .$row2["level_name"]."</th>
                    </tr>" ;
                }
                echo "</tbody></table>";
                   }else echo " NO courses in the database"
                ?>
                </div>
              </div>
            </div>
<!-- Editable Table - END -->
</div>


</div>


        <script type="text/javascript">
        $(document).ready(function(){
          $('#course').keyup(function(){
            /*value of course textbox*/
            var query = $(this).val();
            if (query != '') {

              $.ajax({
                url:"program_search.php",
                method:"post",
                data:(query:query),
                success:function(data)
                {
                  $('#courseList').fadeIn();
                  $('#courseList').html(data);
                }
              });
            }
          });
          //on click the suggestions fade out
          $(document).on('click','li',function(){
            $('#course').val($(this).text());
            $('#courseList').fadeOut();

          });

        });
          
        </script>


</body>

</html>
