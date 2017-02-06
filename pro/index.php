<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Technical university</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

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
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" id="text"><span class="glyphicon glyphicon-home"></span>Home<span class="caret"></span></a>
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
                    <li>
                      <a href="Help.php" id="text"><span class="glyphicon glyphicon-info-sign"></span>  Help</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="h3">Technical University Of Kenya</h1>
                        <p class="intro-text">A new and easy way for people to apply for our school<br>Created by Oscar,Boniface,Marcel.</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
	<div class="about-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About the application process</h2>
                <p>First the applicant will check the courses we have to offer here at<a href="program.php"> Technical university of kenya</a>.
                  <br>If the student has the course he/she is willing to persue then he/she will come back to this site.
                  <br> Click sign in where you must have an email address to register,after confermation of your email address the applicant will go on to add some relivant asked information get a registration number after he/she will log in and get additional instructions.
                  <br>Click<a href="help.php"> Help </a>to contact us thank you for choosing us, the first technical university in kenya <a href="http://tukenya.ac.ke/">TUK</a>.</p>
                <p>Hope u enjoy as you register.</p>
            </div>
        </div>
	</div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
      <div class="contact-section">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>send message</h2>
                <p>If you have a problem contact us</p>
                <p><a href="contact.php">Admin</a>
                </p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://tukenya.ac.ke" class="btn btn-default btn-lg"><i class="fa fa-globe fa-fw"></i> <span class="network-name">Official website</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div id="map"></div>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Technical university of kenya 2016</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>

</body>

</html>
