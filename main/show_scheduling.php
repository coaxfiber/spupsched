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
                              include_once '../objects/buildings.php';
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
                                          <a href="javascript:void(0);"  data-toggle="modal" data-target="#as<?php echo $id; ?>"  data-backdrop="static" data-keyboard="false"><i class="material-icons">edit</i> Assign Schedule&nbsp;</a>

                                          <div id="as<?php echo $id; ?>" class="modal fade" role="dialog"  style="z-index: 1400;">
                                            <script type="text/javascript">
                                              $("#updatesched<?php echo $id; ?>").submit(function(e) {
                                                var url = "submit.php"; // the script where you handle the form input.
                                                $.ajax({
                                                       type: "POST",
                                                       url: url,
                                                       data: $("#updatesched<?php echo $id; ?>").serialize(), // serializes the form's elements.
                                                       success: function(data)
                                                       {   
                                                          y = data.replace(/(^\s+|\s+$)/g, "");
                                                          if (y.indexOf("zzz")>=0) {alert('The Professor has a conflicted schedule and will be assigned as TBA');y=y.replace('zzz', '');}
                                                          
                                                $( ".modal-backdrop" ).remove();
                                                          $('#tablesched').html('<center><img src=\'../assets/load.gif\' style=\'width:100px;\'></center>').load(y);
                                                       }
                                                     });
                                                e.preventDefault(); // avoid to execute the actual submit of the form.}
                                                
                                            });
                                            </script>
                                            <form method="POST" id="updatesched<?php echo $id; ?>">
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
                                                      <th style="text-align: right">Schedule Order: &nbsp;&nbsp;&nbsp;</th>
                                                      <th>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                          <input type="hidden" name="term" value="<?php echo $term;  ?>">
                                                          <input type="hidden" name="year" value="<?php echo $year;  ?>">
                                                          <input type="hidden" name="module" value="19">
                                                          <input type="hidden" name="id" value="<?php echo $id;  ?>">
                                                          <input type="hidden" name="stat" value="<?php echo $_GET['q'] ?>">
                                                        <SELECT id="select" type="text" name="sched" class="form-control" style="margin-top:0;">
                                                        <option value="0">-Custom-</option>
                                                        <option value="1">First</option>
                                                        <option value="2">Second</option>
                                                        <option value="3">Third</option>
                                                    </SELECT>
                                                  </div>
                                                      </th>
                                                    </tr>

                                                    <tr>
                                                      <th style="text-align: right">
                                                        Subject schedule: &nbsp;&nbsp;&nbsp;
                                                      </th>
                                                      <th>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                          <input type="text" class="form-control" name="sched2" value="<?php echo $sched;  ?>">
                                                      </div>
                                                      </th>
                                                    </tr>
                                                    <tr>
                                                      <th style="text-align: right">
                                                        Time: &nbsp;&nbsp;&nbsp;
                                                      </th>
                                                      <th>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                          <input type="text" class="form-control" name="time" value="<?php echo $time;  ?>">
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
                                                          <input type="text" class="form-control" id="roomvalue<?php echo $id; ?>" name="room" value="<?php echo $room;  ?>">
                                                          </div></td>
                                                          <td>
                                                            <button  type="button"  data-toggle="modal" data-target="#room<?php echo $id; ?>"  data-backdrop="static" data-keyboard="false"><i class="material-icons">create_new_folder</i></button>
                                                          </td>
                                                          </tr>
                                                        </table>
                                                        <script type="text/javascript">
                                                          function clse<?php echo $id;$id2=$id; ?>(){
                                                            $('#room<?php echo $id; ?>').modal('hide');
                                                          }
                                                        </script>
                                                        <div id="room<?php echo $id; ?>" class="modal fade" role="dialog" style="z-index: 1600;">
                                                          <div class="modal-dialog" style="border:1px solid black;width: 90%">
                                                            <!-- Modal content-->
                                                            <div class="modal-content" style="padding: 20px 20px 0 20px">
                                                              <div class="modal-body" style="padding-top:0">

                                                                      <div id="roomsel<?php echo $id; ?>"></div>
                                                                          <script type="text/javascript">
                                                                            $('#roomsel<?php echo $id; ?>').html("<center>Loading...</center>").load('include_room.php?q=0&g=<?php echo $id; ?>');
                                                                              $('#select<?php echo $id; ?>').on('change', function() {
                                                                                $('#roomsel<?php echo $id; ?>').html("<center>Loading...</center>").load('include_room.php?q='+ this.value+'&g=<?php echo $id; ?>' );
                                                                              })
                                                                          </script>
                                                                <?php
                                                                   $bldg10= new Buildings($db);
                                                                    $stmt10 = $bldg10->read();?>
                                                                    <div class="form-group label-floating" style="margin-top: 0;" >
                                                                      <SELECT  type="text" class="form-control" id="select<?php echo $id; ?>">
                                                                          <option value="0">-All-</option>
                                                                          <?php
                                                                              while ($row10 = $stmt10->fetch()){
                                                                              echo "<option value='".$row10[0]."'>".$row10[1]."</option>";
                                                                          }
                                                                          ?>
                                                                          </SELECT>
                                                                      </div>
                                                               <button style="float: right" type="button" class="btn btn-danger custom-close<?php echo $id2; ?>" onclick="clse<?php echo $id2; ?>()">Cancel</button>

                                                               <br><br><br>
                                                              </div>      
                                                            </div>
                                                          </div>
                                                        </div>
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
                                                          <input type="text" class="form-control" readonly="readonly" id="prof<?php echo $id; ?>" value="<?php echo $professor;  ?>" name="prof">
                                                          </div></td>
                                                          <td>
                                                            <button type="button" data-toggle="modal" data-target="#profmod<?php echo $id; ?>"  data-backdrop="static" data-keyboard="false"><i class="material-icons">perm_contact_calendar</i></button>
                                                          </td>
                                                          </tr>
                                                        </table>
                                                        
                                                        <script type="text/javascript">
                                                          function clse2<?php echo $id; ?>(){
                                                            $('#profmod<?php echo $id; ?>').modal('hide');
                                                          }
                                                        </script>
                                                        <div id="profmod<?php echo $id; ?>" class="modal fade" role="dialog" style="z-index: 1600;">
                                                          <div class="modal-dialog" style="border:1px solid black;width: 90%">
                                                            <!-- Modal content-->
                                                            <div class="modal-content" style="padding: 20px 20px 0 20px">
                                                              <div class="modal-body" style="padding-top:0">

                                                                      <div id="profsel<?php echo $id; ?>"></div>
                                                                          <script type="text/javascript">
                                                                            $('#profsel<?php echo $id; ?>').html("<center>Loading...</center>").load('include_prof.php?q=0&g=<?php echo $id; ?>');
                                                                              $('#select2<?php echo $id; ?>').on('change', function() {
                                                                                $('#profsel<?php echo $id; ?>').html("<center>Loading...</center>").load('include_prof.php?q='+ this.value+'&g=<?php echo $id; ?>' );
                                                                              })
                                                                          </script>
                                                                <?php
                                                                   $bldg12= new Programs($db);
                                                                    $stmt12 = $bldg12->reads();?>
                                                                    <div class="form-group label-floating" style="margin-top: 0;" >
                                                                      <SELECT  type="text" class="form-control" id="select2<?php echo $id; ?>">
                                                                          <option value="0">-Select Faculty Member-</option>
                                                                          <?php
                                                                              while ($row12 = $stmt12->fetch()){
                                                                              echo "<option value='".$row12[0]."'>".$row12[0]."</option>";
                                                                          }
                                                                          ?>
                                                                          </SELECT>
                                                                      </div>
                                                               <button style="float: right" type="button" class="btn btn-danger custom-close<?php echo $id2; ?>" onclick="clse2<?php echo $id2; ?>()">Cancel</button>

                                                               <br><br><br>
                                                              </div>      
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </th>
                                                    </tr>

                                                    <tr>
                                                      <th style="text-align: right">
                                                        Merge with: &nbsp;&nbsp;&nbsp;
                                                      </th>
                                                      <th>
                                                        <table width="100%">
                                                          <tr>
                                                            <td width="50%"><div class="form-group label-floating" style="margin-top: 0;">
                                                          <input type="text" class="form-control" name="upbldg" value="" placeholder="Course Code">
                                                          </div></td>
                                                          <td>
                                                            <button>seek</button>
                                                          </td>
                                                          </tr>
                                                        </table>
                                                        
                                                      </th>
                                                    </tr>
                                                  </table>
                                                  <center>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success" >Save</button><br><br>
                                                  </center>
                                                </div>
                                              </div>

                                            </div>
                                            </form>
                                          </div><!--heare-->
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