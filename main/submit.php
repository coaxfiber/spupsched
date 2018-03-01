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
    include_once('../objects/schedule.php');
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
                $opt = new Options($db);
                $opt->value=$_POST['year'];
                $opt ->updateyear();
                $opt->value=$_POST['term'];
                $opt ->updateterm();
                $opt->value=$_POST['vp'];
                $opt ->updatevp();
                $opt->value=$_POST['dean'];
                $opt ->updatedean();
                echo "show_settings.php";
                exit();
            }elseif ($_POST['module']==18) {
                $sched = new Scheduling($db);
                $sched->year=$_POST['year'];
                $sched->term=$_POST['term'];
                $sched->programid=$_POST['programid'];

                if (isset($_POST['check'])) {
                    $coding = $_POST['check'];
                    $coding2 = $_POST['allcheck'];
                    foreach ($coding2 as $hobys2=>$value2) {
                        $x = 0;
                        foreach ($coding as $hobys=>$value) {
                            if ($value2==$value) {
                                $x=1;
                                break;
                            }
                        }
                        if ($x == 0) {
                            $sched->code = $value2;
                            $sched->removeall();
                        }
                    }

                    $coding3 = $_POST['check'];
                       foreach ($coding3 as $hobys3=>$value3) {
                                $course = new Subjects($db);
                                $stmt=$course->getcode($value3);
                                $row = $stmt->fetch();
                                $sched->code = $row[1];
                                $sched->title = $row[2];
                                $sched->units = $row[3];
                                $stmt = $sched->getcode();
                                if ($stmt->rowCount() > 0) {
                                }else
                                {
                                 $sched->create(); 
                                }  
                            }
                            
                    # code...
                }else
                {
                            $sched->removealls();
                }

                echo "show_scheduling.php?q=".$_POST['stat'];
                exit();
            }elseif ($_POST['module']==19) {
                $sched = new Scheduling($db);


                if ($_POST['sched']==0) {
                   $sched->sched = $_POST['sched2'];
                }else{
                    $arr= new Options($db);
                    $stmt = $arr->readstart();
                    $row = $stmt->fetch();
                    

                    $x=0;
                    $y=0;

                    $string = date("M j", strtotime($row[2]));
                    $month = date("M", strtotime($row[2]));
                    $x++;
                    while ($y<6) {
                        if (date("w", strtotime($row[2].' +'.$x.' day'))==0 || date("w", strtotime($row[2].' +'.$x.' day'))==6) {
                            if ($month == date("M", strtotime($row[2].' +'.$x.' day'))) {
                                $string = $string .", ". date("j", strtotime($row[2].' +'.$x.' day'));
                            }else{
                                $string = $string .", ". date("M j", strtotime($row[2].' +'.$x.' day'));
                                $month = date("M", strtotime($row[2].' +'.$x.' day'));
                            }
                            $y++;
                            //echo $x . "<br>";
                        }
                        $x++;
                    }
                    $first = $string;

                    $x=$x+6;
                    $y=0;
                    if (date("M j", strtotime($row[2].' +'.$x.' day'))) {
                        # code...
                    }
                    $string = date("M j", strtotime($row[2].' +'.$x.' day'));
                    $month = date("M", strtotime($row[2].' +'.$x.' day'));
                    $x++;
                    while ($y<6) {
                        if (date("w", strtotime($row[2].' +'.$x.' day'))==0 || date("w", strtotime($row[2].' +'.$x.' day'))==6) {
                            if ($month == date("M", strtotime($row[2].' +'.$x.' day'))) {
                                $string = $string .", ". date("j", strtotime($row[2].' +'.$x.' day'));
                            }else{
                                $string = $string .", ". date("M j", strtotime($row[2].' +'.$x.' day'));
                                $month = date("M", strtotime($row[2].' +'.$x.' day'));
                            }
                            $y++;
                            //echo $x . "<br>";
                        }
                        $x++;
                    }
                    
                    $second = $string;
                    $y=0;
                    if (date("M j", strtotime($row[2].' +'.$x.' day'))) {
                        # code...
                    }
                    $string = date("M j", strtotime($row[2].' +'.$x.' day'));
                    $month = date("M", strtotime($row[2].' +'.$x.' day'));
                    $x++;
                    while ($y<6) {
                        if (date("w", strtotime($row[2].' +'.$x.' day'))==0 || date("w", strtotime($row[2].' +'.$x.' day'))==6) {
                            if ($month == date("M", strtotime($row[2].' +'.$x.' day'))) {
                                $string = $string .", ". date("j", strtotime($row[2].' +'.$x.' day'));
                            }else{
                                $string = $string .", ". date("M j", strtotime($row[2].' +'.$x.' day'));
                                $month = date("M", strtotime($row[2].' +'.$x.' day'));
                            }
                            $y++;
                            //echo $x . "<br>";
                        }
                        $x++;
                    }
                    
                    $third = $string;

                    if ($_POST['sched']==1) {
                        $sched ->sched = $first;
                    }
                    if ($_POST['sched']==2) {
                        $sched ->sched = $second;
                    }
                    if ($_POST['sched']==3) {
                        $sched ->sched = $third;
                    }
                }

                $test = 0 ;
                $sched ->professor = $_POST['prof'];
                if ($_POST['prof']!='') {
                $stmt = $sched ->check($sched ->sched,$_POST['term'],$_POST['year'],$_POST['prof'],$_POST['id']);
                $test = $stmt->rowCount();
                }
                
                if ($test > 0) {
                   $sched ->sched = "TBA";
                   echo "zzz";
                }
                //$sched ->sched 

                $sched ->time = $_POST['time'];
                $sched ->room = $_POST['room'];
                $sched ->id = $_POST['id'];
                $sched ->updatesched();
                echo "show_scheduling.php?q=".$_POST['stat'];
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
