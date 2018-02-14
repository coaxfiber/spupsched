<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include_once('../config/database.php');
    include_once('../objects/buildings.php');
    include_once('../objects/rooms.php');
    include_once('../objects/programs.php');
    include_once('../objects/subjects.php');
    include_once('../objects/faculty.php');
    include_once('../objects/options.php');
    $database = new Database(); 
    $db = $database->getConnection();

        if (isset($_POST['module'])) {
            # code...

            if ($_POST['module']==1) {
                $bldg = new Buildings($db);
                $bldg->bldg = $_POST['bldg'];

                    if ($bldg->create()) {
                        echo 'show_buildings.php';
                        exit();
                    }else {
                        
                    }
            }elseif ($_POST['module']==2) {
                $bldg = new Buildings($db);
                $bldg->id=$_POST['id'];
                $bldg ->remove();
                echo "show_buildings.php";
                exit();
            }elseif ($_POST['module']==3) {
                $bldg = new Buildings($db);
                $bldg->id=$_POST['id'];
                $bldg->bldg=$_POST['bldg'];
                if($bldg->update()){
                echo "show_buildings.php";
                }else
                {
                echo "y.php";

                }
                exit();
            }elseif ($_POST['module']==4) {
                $room = new Rooms($db);
                $room->room=$_POST['room'];
                $room->type=$_POST['type'];
                $room->bldg=$_POST['bldg'];
                if($room->create()){
                echo "show_buildings_rooms.php?q=".$_POST['bldg'];
                }else
                {
                echo "y.php";

                }
                exit();
                   
            }elseif ($_POST['module']==5) {
                $rooms = new Rooms($db);
                $rooms->id=$_POST['id'];
                $rooms ->remove();
                echo "show_buildings_rooms.php?q=".$_POST['bldg'];
                exit();
            }elseif ($_POST['module']==6) {
                $rooms = new Rooms($db);
                $rooms->id=$_POST['id'];
                $rooms->room=$_POST['room'];
                $rooms->type=$_POST['type'];
                $rooms->bldg=$_POST['bldg'];
                $rooms ->update();
                echo "show_buildings_rooms.php?q=".$_POST['bldg'];
                exit();
            }elseif ($_POST['module']==7) {
                $prog = new Programs($db);
                $prog->short=$_POST['short'];
                $prog->program=$_POST['program'];
                $prog->specialization=$_POST['specialization'];
                $prog->create();
                echo "show_programs.php";
                exit();
                   
            }elseif ($_POST['module']==8) {
                $prog = new Programs($db);
                $prog->short=$_POST['short'];
                $prog->id=$_POST['id'];
                $prog->program=$_POST['program'];
                $prog->specialization=$_POST['specialization'];
                $prog ->update();
                echo "show_programs.php";
                exit();
            }elseif ($_POST['module']==9) {
                $prog = new Programs($db);
                $prog->id=$_POST['id'];
                $prog ->remove();
                echo "show_programs.php";
                exit();
            }elseif ($_POST['module']==10) {
                $course = new Subjects($db);
                $course->code=$_POST['code'];
                $course->title=$_POST['title'];
                $course->units=$_POST['units'];
                $course->remarks=$_POST['remarks'];
                $course->type=$_POST['type'];
                $course->program=$_POST['program'];
                $course->create();
                echo "show_programs_courses.php?q=".$_POST['program'];
                exit();
            }elseif ($_POST['module']==11) {
                $course = new Subjects($db);
                $course->id=$_POST['id'];
                $course ->remove();
                echo "show_programs_courses.php?q=".$_POST['program'];
                exit();
            }elseif ($_POST['module']==12) {
                $course = new Subjects($db);
                $course->code=$_POST['code'];
                $course->title=$_POST['title'];
                $course->units=$_POST['units'];
                $course->remarks=$_POST['remarks'];
                $course->type=$_POST['type'];
                $course->program=$_POST['program'];
                $course->id=$_POST['id'];
                $course->update();
                echo "show_programs_courses.php?q=".$_POST['program'];
                exit();
            }elseif ($_POST['module']==13) {
                $faculty = new Faculty($db);
                $faculty->idno=$_POST['idno'];
                $faculty->ext=$_POST['ext'];
                $faculty->fname=$_POST['fname'];
                $faculty->mname=$_POST['mname'];
                $faculty->lname=$_POST['lname'];
                $faculty->status=$_POST['status'];
                $faculty->progname=$_POST['progname'];
                $faculty->create();
                echo "show_faculty.php";
                exit();
            }elseif ($_POST['module']==14) {
                $faculty = new Faculty($db);
                $faculty->id=$_POST['id'];
                $faculty ->remove();
                echo "show_faculty.php";
                exit();
            }elseif ($_POST['module']==15) {
                $faculty = new Faculty($db);
                $faculty->id=$_POST['id'];
                $faculty->idno=$_POST['idno'];
                $faculty->ext=$_POST['ext'];
                $faculty->fname=$_POST['fname'];
                $faculty->mname=$_POST['mname'];
                $faculty->lname=$_POST['lname'];
                $faculty->status=$_POST['status'];
                $faculty->progname=$_POST['progname'];
                $faculty->update();
                echo "show_faculty.php";
                exit();
            }elseif ($_POST['module']==16) {
                $opt = new Options($db);
                $opt->value=$_POST['value'];
                $opt ->updatestart();
                echo "show_dashboard.php";
                exit();
            }elseif ($_POST['module']==17) {
                $task = new Tvtasks($db);
                
                $task ->remove(md5($_POST['id']));
                exit();
            }elseif ($_POST['module']==18) {
                if (isset($_POST['checkboxvar'])) {

                    $proin = new Tvtasks($db);

                    $checkboxvar = $_POST['checkboxvar'];
                    foreach ($checkboxvar as $hobys=>$value) {
                           
                            $proin ->task = $_POST['task'];
                            $proin ->deadline = $_POST['deadline'];
                            $proin ->inchargeid = $value;
                            $proin ->create();
                        }
                }
                echo "main.php";
            }elseif ($_POST['module']==19) {
                $upd = new Incharge($db);
                $upd ->username = $_POST['username'];
                $upd ->email = $_POST['email'];
                $upd ->name = $_POST['name'];
                $upd ->position = $_POST['position'];
                $upd ->idno = $_POST['idno'];
                $upd ->facebooklink = $_POST['facebooklink'];
                $upd ->googlelink = $_POST['googlelink'];
                $upd ->twitterlink = $_POST['twitterlink'];
                $upd ->id = $_POST['id'];
                $upd ->updateall();
                echo "showuserprofile.php?masterid=".$_POST['id'];
                exit();
            }elseif ($_POST['module']==20) {
                $si = new stayinndata($db);

                $si->title = $_POST['title'];
                $si->address = $_POST['address'];
                $si->type = $_POST['type'];
                $si->contact= $_POST['contact'];
                $si->price= $_POST['price'];
                $si->id= $_POST['id'];

                    if ($si->update()) {
                        echo "showstayinn.php";
                        exit();
                    }else {
                        echo $si->update();
                    }
            }elseif ($_POST['module']==21) {
                $proin = new stayinndata($db);
                $proin ->remove($_POST['id']);

                echo "showstayinn.php";
                exit();
            }elseif ($_POST['module']==22) {
                $si = new stayinndata($db);

                $si->title = $_POST['title'];
                $si->address = $_POST['address'];
                $si->type = $_POST['type'];
                $si->contact= $_POST['contact'];
                $si->price= $_POST['price'];
                $si->id= $_POST['id'];

                    if ($si->update()) {
                        echo "dashboard.php";
                        exit();
                    }else {
                        echo $si->update();
                    }
            }elseif ($_POST['module']==23) {
                $proin = new stayinndata($db);
                $proin ->remove($_POST['id']);

                echo "dashboard.php";
                exit();
            }elseif ($_POST['module']==24) {
                $proin = new stayinndata($db);
                $proin ->approve($_POST['id']);

                echo "dashboard.php";
                exit();
            }
    }
                
                

    if (isset($_GET['module'])) {
        if ($_GET['module']==1) {
            session_destroy();
            echo "<script>window.location = 'login.php';</script>";
            exit();
        }
    }
    
?>
