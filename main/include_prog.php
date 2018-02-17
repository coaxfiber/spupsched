<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        include_once '../config/database.php';
        include_once '../objects/subjects.php';
        include_once '../objects/schedule.php';
        include_once '../objects/options.php';
        
        $database = new Database();
        $db = $database->getConnection();
        $room= new Subjects($db);
        $schedule= new Scheduling($db);
                              $arr= new Options($db);
                              $stmt = $arr->readschoolyear();
                              $row = $stmt->fetch();
                              $year = $row['value'];
                              $stmt = $arr->readsemester();
                              $row = $stmt->fetch();
                              $term = $row['value'];
                              $stmt = $arr->readstart();
                              $row = $stmt->fetch();
        $schedule->year = $year;
        $schedule->term = $term;

?>


    <div class="card-content table-responsive">
        <div style="overflow-y: scroll;height: 400px" >
        <form id="filloffered<?php echo $_GET['q']; ?>" method="POST">
        <table class="table">
            <thead class="text-primary" style="color: #32122e">
                <td >Code</td>
                <td >Title</td>
                <td width="40"  >Units</td>
                <td >Type</td>
                <td class="text-a" width="183" >-Action-</td>
            </thead>
            <tbody>
                <?php
                    $stmt = $room->readlist($_GET['q'],$_GET['g']);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);

                ?>
                <tr  class="hov">
                    <td><a href="javascript:void(0);" id="vals<?php echo $id; ?>"><?php echo $code; ?></a>
                        </td>
                        <td><a href="javascript:void(0);" id="val2s<?php echo $id; ?>"><?php echo $title; ?></a>
                        </td>
                    <td><a href="javascript:void(0);" id="val3s<?php echo $id; ?>"><?php echo $units; ?></a>
                      </td>
                    <td><a href="javascript:void(0);" id="val5s<?php echo $id; ?>"><?php echo $type; ?></a>
                        </td>
                    <td class="text-a" >
                        <div class="checkbox" style="float: right;margin-right: 40px">
                            <label style="font-size: 1em">
                              <?php 
                              $schedule->code = $code;
                              $schedule->programid = $_GET['q'];
                              $store =  $schedule->getcode();
                              $stt = $store->rowCount();
                              if ($stt>0) {
                               echo '<input type="checkbox" value="'.$code.'" name="check[]" checked>';
                              }else
                               echo '<input type="checkbox" value="'.$code.'"  name="check[]">';
                             ?>
                            </label>
                            <input type="checkbox" value="<?php echo $code; ?>" name="allcheck[]" style="visibility: hidden;" checked="checked" />
                        </div>
                    </td>
                </tr>
                <?php
                    }
                ?>
                    </tbody>
                </table>
                <br>
                <div style="float: right;">
                                
                            <input type="hidden" name="year" value="<?php echo $year; ?>">
                            <input type="hidden" name="term" value="<?php echo $term; ?>">
                            <input type="hidden" name="module" value="18">
                            <input type="hidden" name="stat" value="<?php echo  $_GET['stat']; ?>">
                            <input type="hidden" name="programid" value="<?php echo  $_GET['q']; ?>">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success" >Save</button><br><br>
                </div>
              </form>
                <br>
                <br>
                <br>
                </div>
                                    <script type="text/javascript">
                                        
                                        $("#filloffered<?php echo $_GET['q']; ?>").submit(function(e) {
                                            var url = "submit.php"; // the script where you handle the form input.
                                            $.ajax({
                                                   type: "POST",
                                                   url: url,
                                                   data: $("#filloffered<?php echo $_GET['q']; ?>").serialize(), // serializes the form's elements.
                                                   success: function(data)
                                                   {   
                                                      y = data.replace(/(^\s+|\s+$)/g, "");
                                                $( ".modal-backdrop" ).remove();
                                               $('#tablesched').html('<center><img src=\'../assets/load.gif\' style=\'width:100px;\'></center>').load(y);
                                                   }
                                                 });
                                            e.preventDefault(); // avoid to execute the actual submit of the form.}
                                            
                                        });
                                    </script>
    </div>