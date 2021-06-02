<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Focus Admin: Creative Admin Dashboard</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/helper.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
</head>

<body>

     <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="index.php">
                            <img src="assets/images/logo.png" alt="" /> <span>THE QUIZ APP</span></a></div>
                    <li><a  href="index.php"><i class="ti-home"></i> Dashboard</a></li>
                    <?php if(isset($_SESSION['id'])){ 
                    echo '<li><a href="add_question.php"><i class="fa fa-plus-square" aria-hidden="true"></i>Add Quesion</a></li>';
                    echo '<li><a href="personal-questions.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>Personal Questions</a></li>';
                    echo '<li><a href="previous-contests-details.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>View Performances in Contests</a></li>';
                                      
                                       }?>

                    <?php if(isset($_SESSION['id']) and !isset($_SESSION['contest'])){ 
                    echo '<li><a href="contest-page.php"><i class="fa fa-plus-square" aria-hidden="true"></i>Contest</a></li>';
                                       }?>
                  
                    <li><a href="problem-set.php"><i class="fa fa-list" aria-hidden="true"></i>Problem Set</a></li>

                        
                    
                </ul>
            </div>
        </div>
    </div>


    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="float-right">
                    <?php 
                      // echo $_SESSION['name'];
                     if(!isset($_SESSION['id']))
                                 {
                                       echo '<span class="user-avatar"><a href="page-login.php">LOGIN</a>
                                            
                                            </span>';
                                        // echo "";
                                            
                                            echo "<span>&nbsp&nbsp&nbsp&nbsp&nbsp</span>";

                                            echo '<span class="user-avatar"><a href="page-register.php">REGISTER</a>
                                            
                                            </span>';
                                        // echo "<a href='page-register.php'>register</a>";

                                 }
                    
                           else{
                                  
                                   echo '<div class="dropdown dib">
                                            <div class="header-icon" data-toggle="dropdown">
                                                <span class="user-avatar">'.$_SESSION['name'].'
                                                    <i class="ti-angle-down f-s-10"></i>
                                                </span>
                                            </div>
                                            <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                                
                                                <div class="dropdown-content-body">
                                                    <ul>
                                                        <li>
                                                            <a href="app-profile.php">
                                                            <i class="ti-user"></i>
                                                                <span>Profile</span>
                                                            </a>
                                                        </li>

                                
                                                        <li>
                                                            <a href="logout.php">
                                                                <i class="ti-power-off"></i>
                                                                <span>Logout</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        
                                    </div>';
                                }

                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <!-- <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title container"> -->