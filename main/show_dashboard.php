<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
    include_once '../config/database.php';
    include_once '../objects/options.php';
    include_once '../objects/programs.php';
    $database = new Database();
    $db = $database->getConnection();
    $arr= new Options($db);
    $stmt = $arr->readschoolyear();
    $row = $stmt->fetch();
    $year = $row['value'];
    $stmt = $arr->readsemester();
    $row = $stmt->fetch();
    $term = $row['value'];
    $stmt = $arr->readstart();
    $row = $stmt->fetch();
    $start = date("F j, Y", strtotime($row['value']));

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-6">

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        
        <h4 class="modal-title">Class Starts</h4>
            <div class="form-group label-floating" style="width: 50%">
                <input id="startdate" type="date" class="form-control" value="<?php echo date('Y-m-d',strtotime($row['value'])); ?>" max="<?php echo date('Y-m-d'); ?>">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updatestart('startdate',16)" >Save</button><br><br>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
    function updatestart(id2,module2){
        var txt = document.getElementById(id2).value;
            $.post("submit.php", { value:txt,  module:module2
                })
                .done(function( data ) {
                    alert(data);
                 y = data.replace(/(^\s+|\s+$)/g, "")
                 $('#maincontent').load(y);
               });
            
          }
</script>
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">event</i>
                </div>
                <div class="card-content">
                    <p class="category">Active Year/Semester</p>
                    <h4 class="title"><?php
                        echo $year." - ".$term;
                      ?>
                    </h4>
                </div>
                <div class="card-footer">
                    <div class="stats" >
                        <i class="material-icons text-danger">warning</i>
                        <a href="javascript:void(0)"  onclick="changeclass(5);
                                    document.getElementById('toptitle').innerHTML = 'Settings';
                                    $('#maincontent').load('show_settings.php');">Change the Active School Year and Semester</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">date_range</i>
                </div>
                <div class="card-content">
                    <p class="category">Class Starts</p>
                    <h4 class="title"><?php
                        echo $start;
                      ?></h4>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">date_range</i> <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Change the date</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-nav-tabs">
                <div class="card-header" data-background-color="purple">
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <span class="nav-tabs-title">Filter by:</span>
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="active">
                                    <div class="form-group label-floating" style="margin-top: 3px">
                                                    <SELECT  type="text" name="type" class="form-control" style="color:white;background-color:#ab47bc;">
                                                        <option value="all">-All-</option>
                                                        <?php
                                                             $bldg= new Programs($db);
                                                            $stmt = $bldg->read();
                                                             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                            extract($row);
                                                        ?>
                                                        <option value="<?php echo $short; ?>"><?php echo $short; ?> - <?php echo $program; ?> (<?php echo $specialization; ?>)</option>       
                                                        <?php } ?>
                                                    </SELECT>
                                                </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div id="tablesched"></div>
                </div>
                <script type="text/javascript">
                    $('#tablesched').html('<center><img src=\'../assets/load.gif\' style=\'width:100px;\'></center>').load('show_scheduling.php');
                </script>
            </div>
        </div>
    </div>
</div>