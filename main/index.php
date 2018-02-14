<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Graduate School Scheduling</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="../assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <style type="text/css">
        tr.hov:hover{
                background-color:#ededed;
            }
    </style>
</head>

<body onload="gload()">
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="./" class="simple-text">
                    GS Scheduling
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active" id="side1" >
                        <a href="javascript:void(0)" onclick="changeclass(1);
                        document.getElementById('toptitle').innerHTML = 'Scheduling';
                        $('#maincontent').html('<center><img src=\'../assets/load.gif\' width=\'100\'></center>').load('show_dashboard.php');">
                            <i class="material-icons">dashboard</i>
                            <p>Scheduling</p>
                        </a>
                    </li>
                    <li id="side3" >
                        <a href="javascript:void(0)" onclick="changeclass(3);
                        document.getElementById('toptitle').innerHTML = 'Buildings/Rooms';
                        $('#maincontent').html('<center><img src=\'../assets/load.gif\' width=\'100\'></center>').load('show_buildings.php');">
                            <i class="material-icons">domain</i>
                            <p>Buildings/Rooms</p>
                        </a>
                    </li>
                    <li id="side2" >
                        <a href="javascript:void(0)" onclick="changeclass(2);
                        document.getElementById('toptitle').innerHTML = 'Faculty';
                        $('#maincontent').html('<center><img src=\'../assets/load.gif\' width=\'100\'></center>').load('show_faculty.php');">
                            <i class="material-icons">supervisor_account</i>
                            <p>Faculty</p>
                        </a>
                    </li>
                    <li id="side4" >
                        <a href="javascript:void(0)" onclick="changeclass(4);
                        document.getElementById('toptitle').innerHTML = 'Program/Course';
                        $('#maincontent').html('<center><img src=\'../assets/load.gif\' width=\'100\'></center>').load('show_programs.php');">
                            <i class="material-icons">assignment</i>
                            <p>Program/Course</p>
                        </a>
                    </li>
                    <li id="side5" >
                        <a href="javascript:void(0)" onclick="changeclass(5);
                        document.getElementById('toptitle').innerHTML = 'Settings';
                        $('#maincontent').html('<center><img src=\'../assets/load.gif\' width=\'100\'></center>').load('show_settings.php');">
                            <i class="material-icons">settings</i>
                            <p>Settings</p>
                        </a>
                    </li>
                    
                    <!-- <li class="active-pro">
                        <a href="upgrade.html">
                            <i class="material-icons">unarchive</i>
                            <p>Upgrade to PRO</p>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#" id="toptitle">Scheduling
</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="javascript:void(0)" onclick="changeclass(5);
                                    document.getElementById('toptitle').innerHTML = 'Settings';
                                    $('#maincontent').load('show_settings.php');" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">settings</i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="hidden-lg hidden-md">Notifications</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">Mike John responded to your email</a>
                                    </li>
                                    <li>
                                        <a href="#">You have 5 new tasks</a>
                                    </li>
                                    <li>
                                        <a href="#">You're now friend with Andrew</a>
                                    </li>
                                    <li>
                                        <a href="#">Another Notification</a>
                                    </li>
                                    <li>
                                        <a href="#">Another One</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                </a>
                            </li>
                        </ul>
                        <form class="navbar-form navbar-right" role="search" style="padding-top: 10px">
                            <b id="settingsys"><?php //include('include_schoolyear_semester.php'); ?></b>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="content" id="maincontent">
                
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul>
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                    </p> -->
                </div>
            </footer>
        </div>
    </div>
</body>
<script type="text/javascript">
    function gload() {
        $('#settingsys').load('include_schoolyear_semester.php');
        $('#maincontent').load('show_dashboard.php');
        // body...
    }
    function changeclass(car){
       clearside();
        if (car==1) {
           $("#side1").attr('class', 'active');
        }if (car==2) {
           $("#side2").attr('class', 'active');
        }if (car==3) {
           $("#side3").attr('class', 'active');
        }if (car==4) {
           $("#side4").attr('class', 'active');
        }if (car==5) {
           $("#side5").attr('class', 'active');
        }
    }
    function clearside(){
        $("#side1").attr('class', '');
        $("#side2").attr('class', '');
        $("#side3").attr('class', '');
        $("#side4").attr('class', '');
        $("#side5").attr('class', '');
    }
</script>
<!--   Core JS Files   -->
<script src="../assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<!--  Dynamic Elements plugin -->
<script src="../assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="../assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<!-- Material Dashboard javascript methods -->
<script src="../assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
</script>

</html>