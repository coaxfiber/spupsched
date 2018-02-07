<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include_once('../config/database.php');
    include_once('../objects/buildings.php');
    include_once('../objects/rooms.php');
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
                $task = new Milestones($db);
                $task ->remove($_POST['value']);
                echo "projects.php?q=".$_POST['projid']."&g=".md5($_POST['projid'])."";
                exit();
            }elseif ($_POST['module']==8) {
                    
                $proin = new Proin($db);
                $proin ->removeall($_POST['projid']);

                $pro = new Projects($db);
                $pro ->remove($_POST['projid']);

                $tasks = new Milestones($db);
                $tasks ->removeall($_POST['projid']);
                echo "main.php";
                exit();
            }elseif ($_POST['module']==9) {
                $proin = new Proin($db);
                $proin ->remove($_POST['q'],$_POST['g']);
                echo "main.php";
                exit();
            }elseif ($_POST['module']==10) {
            
            $proj = new Tasks($db);

            $proj->title = $_POST['title'];
            $proj->date_start = $_POST['startdate'];
            $proj->date_end = $_POST['enddate'];
            $proj->projectid= $_POST['projid'];
            $proj->milestoneid= $_POST['milesid'];

                if ($proj->create()) {
                    echo "projects.php?q=".$_POST['projid']."&g=".md5($_POST['projid'])."";
                    exit();
                }else {
                    
                }
            }elseif ($_POST['module']==11) {
            $proj = new Tasks($db);

                $proj->id = $_POST['id'];
                $proj->title = $_POST['title'];
                $proj->date_start = $_POST['startdate'];
                $proj->date_end = $_POST['enddate'];

                if (isset($_POST['status'])) {
                    $proj->status=1;
                }else
                {
                    $proj->status=0;
                }

                if ($proj->update()) {
                    echo "projects.php?q=".$_POST['projid']."&g=".md5($_POST['projid'])."";
                    exit();
                }else {
                    
                }
            }elseif ($_POST['module']==12) {
                $task = new Tasks($db);
                $task ->remove($_POST['value']);
                echo "projects.php?q=".$_POST['projid']."&g=".md5($_POST['projid'])."";
                exit();
            }elseif ($_POST['module']==13) {
                $log = new Incharge($db);

                $log->username = $_SESSION['code'];
                $log->password = md5(md5($_POST['cpassword']));
                $stmt2 = $log->read();
                $num = $stmt2->rowCount();
                $row2 = $stmt2->fetch();
                if ($num>0&&$_POST['rpassword']==$_POST['npassword']) {
                extract($row2);
                $log ->cpw(md5(md5($_POST['npassword'])),$_SESSION['id']);
                echo "Password Changed!";
                }else{
                echo "Change password failed! either new password and repeat password din not match or old password is incorrect.";
                }
                
                exit();
            }elseif ($_POST['module']==14) {
                $upd = new Incharge($db);
                $upd ->username = $_POST['username'];
                $upd ->email = $_POST['email'];
                $upd ->name = $_POST['name'];
                $upd ->facebooklink = $_POST['facebooklink'];
                $upd ->googlelink = $_POST['googlelink'];
                $upd ->twitterlink = $_POST['twitterlink'];
                $upd ->id = $_SESSION['id'];
                $upd ->update();
                echo "user.php";
                exit();
            }elseif ($_POST['module']==15) {
                $task = new Tvtasks($db);
                $task->id=$_POST['id'];
                $task->status=$_POST['ck'];
                $task ->updatestat();
                exit();
            }elseif ($_POST['module']==16) {
                $task = new Tvtasks($db);
                $task->id=$_POST['id'];
                $task->task=$_POST['task'];
                $task->deadline=$_POST['deadline'];
                $task ->updaterec();
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