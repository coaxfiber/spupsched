                <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Buildings </h4>
                                    <p class="category">Select a building to show it's Rooms</p>
                                </div>
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
                                            include_once '../objects/buildings.php';
                                            include_once '../objects/rooms.php';
                                            
                                            $database = new Database();
                                            $db = $database->getConnection();
                                            $bldg= new Buildings($db);
                                            $stmt = $bldg->read();

                                ?>
                                
                                <div class="card-content table-responsive">
                                <div id="bldgdiv"  style="height: 400px; overflow-y: scroll;">
                                    <table class="table" onload="bot();">
                                        <thead class="text-primary" style="color: #32122e">
                                            <td >Buildings</td>
                                            <td class="text-a" >-Action-</td>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                extract($row);
                                            ?>
                                            <tr class="hov">
                                                <td><a href="javascript:void(0);" id="up<?php echo $id; ?>"><?php echo $bldg; ?></a>
                                                    <div class="form-group label-floating" style="margin-top: 0" id="inputup<?php echo $id;?>">
                                                        <input type="text" class="form-control" name="upbldg" id="input2up<?php echo $id;?>" value="<?php echo $bldg; ?>">
                                                        <input type="hidden" name="module" value="1">
                                                    </div>
                                                </td>
                                                <td class="text-a" >
                                                    <div class="bldgaction">
                                                        <a href="javascript:void(0);" onclick="changeroom(<?php echo $id; ?>,'<?php echo $bldg; ?>')"><i class="material-icons">domain</i> Select&nbsp;</a> | 
                                                        <a href="javascript:void(0);" onclick="upshow<?php echo $id; ?>()" ><i class="material-icons">edit</i> Update&nbsp;</a> | 
                                                        <a href="javascript:void(0);" onclick="deletebldg(<?php echo $id; ?>,2)"><i class="material-icons">delete</i> Remove</a>
                                                    </div>
                                                    <div id="bldgupdate<?php echo $id; ?>" style="display: none">
                                                        <a href="javascript:void(0);" onclick="updatek(<?php echo $id; ?>,'input2up<?php echo $id;?>',3)" ><i class="material-icons">edit</i>&nbsp;Save&nbsp;</a>&nbsp;|&nbsp;
                                                        <a href="javascript:void(0);" onclick="cancel<?php echo $id; ?>()" ><i class="material-icons">cancel</i>&nbsp;Cancel&nbsp;</a> 
                                                    </div>
                                                    <script type="text/javascript">
                                                        $('#inputup<?php echo $id; ?>').hide();
                                                        function upshow<?php echo $id; ?>(){
                                                           document.getElementById("bldgupdate<?php echo $id; ?>").setAttribute("style", "display:inline");
                                                           $('.bldgaction').hide();$('#up<?php echo $id; ?>').hide();
                                                          $('#inputup<?php echo $id; ?>').show();
                                                        }
                                                         function cancel<?php echo $id; ?>(){
                                                           document.getElementById("bldgupdate<?php echo $id; ?>").setAttribute("style", "display:none");
                                                           $('.bldgaction').show();
                                                           $('#up<?php echo $id; ?>').show();
                                                            $('#inputup<?php echo $id; ?>').hide();
                                                        }
                                                    </script>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                    <form method="POST"  id="addbldg">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                        <label class="control-label">Enter Building here</label>
                                                        <input type="text" class="form-control" name="bldg" required="required">
                                                        <input type="hidden" name="module" value="1">
                                                    </div></td>
                                                    <td class="text-a" >
                                                    <button class="btn btn-primary btn-round" type="submit" style="margin-top: 0"><i class="material-icons">add</i> Add Building</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title" id="roomtitle">All Rooms</h4>
                                    <p class="category">Rooms Availale for Graduate School to use.</p>
                                </div>
                                <div id="rooms"></div>
                            </div>
                            
                        </div>
                    </div>
                    <script type="text/javascript">
                        $('#rooms').load('show_buildings_rooms.php?q=0');

                        function changeroom(var2,var1){
                            document.getElementById('roomtitle').innerHTML = 'Rooms for <b>'+var1+'</b>';
                            $('#rooms').load('show_buildings_rooms.php?q='+var2);
                        }

                        function deletebldg(id2,module2){
                          var txt;
                          var r = confirm("Are you sure you want to remove this Building? Note: all rooms in this building will be removed.");
                          if (r == true) {
                                     $.post("submit.php", { id:id2,  module:module2
                                                            })
                              .done(function( data ) {
                               y = data.replace(/(^\s+|\s+$)/g, "")
                               $('#maincontent').load(y);
                             });
                                     
                          }
                          
                        }
                         $("#addbldg").submit(function(e) {
                            var url = "submit.php"; // the script where you handle the form input.
                            $.ajax({
                                   type: "POST",
                                   url: url,
                                   data: $("#addbldg").serialize(), // serializes the form's elements.
                                   success: function(data)
                                   {  
                                      y = data.replace(/(^\s+|\s+$)/g, "")
                                      $('#maincontent').load(y);
                                   }
                                 });
                            e.preventDefault(); // avoid to execute the actual submit of the form.
                        });
                        function updatek(id,bldg,module2){
                              var txt;
                              var value = document.getElementById(bldg).value;
                              //alert(value);
                              var r = confirm('Are you sure you want to update the building?');
                              if (r == true) {
                                         $.post('submit.php', { id:id, bldg:value, module:module2
                                                                })
                                  .done(function( data ) {
                                   y = data.replace(/(^\s+|\s+$)/g, "")
                                   //alert(data);
                                   $('#maincontent').load(y);
                                 });
                                         
                              }
                          }
                    </script>