          <style type="text/css">
                      .text-a{
                          text-align: right;
                      }
                  </style>
                  <?php
                    ini_set('display_errors', 1);
                      ini_set('display_startup_errors', 1);
                      error_reporting(E_ALL);
                              include_once '../config/database.php';
                              include_once '../objects/schedule.php';
                              include_once '../objects/options.php';
                              include_once '../objects/programs.php';
                              $database = new Database();
                              $db = $database->getConnection();
                              $schedude= new Scheduling($db);

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


                              $schedude->term = $term;
                              $schedude->year = $year;

                              $prog= new Programs($db);
                              if ($_GET['q']!=0) {
                               $progstmt = $prog->readone($_GET['q']);
                              }else
                              $progstmt = $prog->read();    
                 while ($row2 = $progstmt->fetch()){
                 ?>
                  
                  <div class="card-content table-responsive">
                  <div id="bldgdiv">
                    <table style="width: 100%">
                      <tr>
                        <td>
                          <h3><?php echo $row2[1]; ?> - <?php echo $row2[2]; ?><?php if ($row2[3]=='') {
                      # code...
                    }else{echo " (".$row2[3].")";} ?></h3>
                        </td>
                        <td>
                            <div style="text-align: right;float: right;margin-top: 17px">
                              <a href="javascript:void(0);" onclick="pdfprint()"  data-toggle="modal" data-target="#of<?php echo $row2[0]; ?>"><i class="material-icons">print</i>&nbsp;Offered Courses&nbsp;</a>

                            <!-- Modal -->
                            <div id="of<?php echo $row2[0]; ?>" class="modal fade" role="dialog">
                              <div class="modal-dialog" style="width: 70%">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" style="text-align: left">Courses Offered for <b><?php echo $row2[1]; ?> - <?php echo $row2[2]; ?><?php if ($row2[3]=='') {
                                  }else{echo " (".$row2[3].")";} ?></b></h4>
                                  </div>
                                  <div class="modal-body">
                                    <div id="cf<?php echo $row2[0]; ?>" style="text-align: left;"></div>
                                    <script type="text/javascript">
                                      $('#cf<?php echo $row2[0]; ?>').load('include_prog.php?q=<?php echo $row2[0]; ?>&g=<?php echo $row2[1]; ?>&stat=<?php echo $_GET["q"] ?>');
                                    </script>
                                  </div>
                                </div>

                              </div>
                            </div>
                              </div>  
                        </td>
                      </tr>
                    </table>
                    
                      <table class="table" onload="bot();">
                          <thead class="text-primary" style="color: #32122e">
                              <th ><b>Code</b></th>
                              <th ><b>Course Title</b></th>
                              <th ><b>Units</b></th>
                              <th ><b>Schedule</b></th>
                              <th ><b>Time</b></th>
                              <th ><b>Room</b></th>
                              <th ><b>Professor</b></th>
                              <th class="text-a" ><b>-Action-</b></th>
                          </thead>
                          <tbody>
                              <?php
                              $schedude->programid = $row2[0];
                              $stmt = $schedude->read();
                                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                  extract($row);
                              ?>
                              <tr  class="hov">
                                  <td><?php echo $code; ?>
                                  </td>
                                  <td><?php echo $title; ?>
                                  </td>
                                  <td><?php echo $units; ?>
                                  </td>
                                  <td><?php echo $sched; ?>
                                  </td>
                                  <td><?php echo $time; ?>
                                  </td>
                                  <td><?php echo $room; ?>
                                  </td>
                                  <td><?php echo $professor; ?>
                                  </td>
                                  <td class="text-a">
                                      <div class="bldgaction"> 
                                          <a href="javascript:void(0);"  data-toggle="modal" data-target="#as<?php echo $id; ?>"><i class="material-icons">edit</i> Assign Schedule&nbsp;</a>

                                          <div id="as<?php echo $id; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title" style="text-align: left"><b><?php echo $row2[1]; ?> <?php if ($row2[3]=='') {
                                                }else{echo " (".$row2[3].")";} ?></b></h4>
                                                </div>
                                                <div class="modal-body">
                                                  <table style="width: 100%">
                                                    <tr>
                                                      <th style="text-align: right">Code: &nbsp;&nbsp;&nbsp;</th>
                                                      <th><?php echo $code; ?></th>
                                                    </tr>
                                                    <tr>
                                                      <th style="text-align: right">Course Title: &nbsp;&nbsp;&nbsp;</th>
                                                      <th><?php echo $title; ?></th>
                                                    </tr>
                                                    <tr>
                                                      <th style="text-align: right">Units: &nbsp;&nbsp;&nbsp;</th>
                                                      <th><?php echo $units;  ?></th>
                                                    </tr>
                                                    <tr>
                                                      <th style="text-align: right">Subject schedule: &nbsp;&nbsp;&nbsp;</th>
                                                      <th>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                        <SELECT id="select" type="text" name="type" class="form-control" style="margin-top:0;">
                                                        <?php 
                                                        if ($sched == '') {
                                                         echo '<option value="0">-Unassigned-</option>';
                                                        }else
                                                        if ($sched == 1){
                                                          echo '<option value="1">First</option>';
                                                        }else
                                                        if ($sched ==2 ){
                                                          echo '<option value="2">Second</option>';
                                                        }else
                                                        if ($sched ==3 ){
                                                          echo '<option value="3">Third</option>';
                                                        }
                                                        
                                                        echo $units;  ?>
                                                        
                                                        <option value="1">First</option>
                                                        <option value="2">Second</option>
                                                        <option value="3">Third</option>
                                                    </SELECT>
                                                  </div>
                                                      </th>
                                                    </tr>
                                                    <tr>
                                                      <th style="text-align: right">
                                                        Time: &nbsp;&nbsp;&nbsp;
                                                      </th>
                                                      <th>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                          <input type="text" class="form-control" name="upbldg" value="<?php echo $time;  ?>">
                                                      </div>
                                                      </th>
                                                    </tr>
                                                    <tr>
                                                      <th style="text-align: right">
                                                        Room: &nbsp;&nbsp;&nbsp;
                                                      </th>
                                                      <th>
                                                        <table width="100%">
                                                          <tr>
                                                            <td width="50%"><div class="form-group label-floating" style="margin-top: 0;">
                                                          <input type="text" class="form-control" name="upbldg" value="<?php echo $room;  ?>">
                                                          </div></td>
                                                          <td>
                                                            <button>seek</button>
                                                          </td>
                                                          </tr>
                                                        </table>
                                                        
                                                      </th>
                                                    </tr>
                                                    <tr>
                                                      <th style="text-align: right">
                                                        Professor: &nbsp;&nbsp;&nbsp;
                                                      </th>
                                                      <th>
                                                        <table width="100%">
                                                          <tr>
                                                            <td width="50%"><div class="form-group label-floating" style="margin-top: 0;">
                                                          <input type="text" class="form-control" name="upbldg" value="<?php echo $professor;  ?>">
                                                          </div></td>
                                                          <td>
                                                            <button>seek</button>
                                                          </td>
                                                          </tr>
                                                        </table>
                                                        
                                                      </th>
                                                    </tr>
                                                  </table>
                                                </div>
                                              </div>

                                            </div>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                              <?php
                                  }
                              ?>
                          </tbody>
                      </table>
                  </div>
                  </div>
                  <?php } ?>
                   <!-- Trigger the modal with a button -->

              </div>
      <script type="text/javascript">
          $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
        
          function pdfprint(){
            if (document.getElementById('print1').value!='none' && document.getElementById('print1').value!='0') {
              var url = "curriculum.php?q="+document.getElementById('print1').value+"&g="+document.getElementById('print2').value;
                  var win = window.open(url);
                  win.focus();
            }
            else{
              alert('No selected Program!')
            }
          }
         
      </script>