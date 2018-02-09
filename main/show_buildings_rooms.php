<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        include_once '../config/database.php';
        include_once '../objects/rooms.php';
        
        $database = new Database();
        $db = $database->getConnection();
        $room= new Rooms($db);
        $stmt = $room->read($_GET['q']);

?>


    <div class="card-content table-responsive">
        <div   style="height: 400px; overflow-y: scroll;">
        <table class="table">
            <thead class="text-primary" style="color: #32122e">
                <td >Rooms</td>
                <td >Type</td>
                <td class="text-a" >-Action-</td>
            </thead>
            <tbody>
                <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                ?>
                <tr>
                    <td><a href="javascript:void(0);" id="roomvals<?php echo $id; ?>"><?php echo $room; ?></a>
                        <div class="form-group label-floating" style="margin-top: 0" id="roomdiv<?php echo $id;?>">
                            <input type="text" class="form-control" name="upbldg" id="roominput<?php echo $id;?>" value="<?php echo $room; ?>">
                        </div></td>
                    <td><a href="javascript:void(0);" id="room2vals<?php echo $id; ?>"><?php echo $type; ?></a>
                        <div class="form-group label-floating" style="margin-top: 0" id="room2div<?php echo $id;?>">
                        <SELECT  type="text" class="form-control" id="roomtype<?php echo $id;?>">
                            <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                            <?php 
                            if ($type=="Lecture") {
                               echo "<option value='Laboratory'>Laboratory</option>";
                            }else {
                                echo "<option value='Lecture'>Lecture</option>";
                            }
                             ?>
                        </SELECT>
                    </div></td>
                    <td class="text-a" >
                        <div class="bldgaction2">
                            <a href="javascript:void(0);" onclick="roomshow<?php echo $id; ?>()" ><i class="material-icons">edit</i> Update&nbsp;</a> | 
                            <a href="javascript:void(0);" onclick="deleteroom(<?php echo $id; ?>,5,<?php echo $_GET['q'];?>)"><i class="material-icons">delete</i> Remove</a>
                        </div>
                        <div id="roomupdate<?php echo $id; ?>" style="display: none">
                            <a href="javascript:void(0);" onclick="updateroom(<?php echo $id; ?>,'roominput<?php echo $id;?>',6,'roomtype<?php echo $id;?>',<?php echo $_GET['q'];?>)" ><i class="material-icons">edit</i>&nbsp;Save&nbsp;</a>&nbsp;|&nbsp;
                            <a href="javascript:void(0);" onclick="cancelroom<?php echo $id; ?>()" ><i class="material-icons">cancel</i>&nbsp;Cancel&nbsp;</a> 
                        </div>
                        <script type="text/javascript">
                            $('#roomdiv<?php echo $id; ?>').hide();
                            $('#room2div<?php echo $id; ?>').hide();
                            function roomshow<?php echo $id; ?>(){
                               document.getElementById("roomupdate<?php echo $id; ?>").setAttribute("style", "display:inline");
                               $('.bldgaction2').hide();
                                $('#roomdiv<?php echo $id; ?>').show();
                                $('#room2div<?php echo $id; ?>').show();
                                $('#roomvals<?php echo $id; ?>').hide();
                                $('#room2vals<?php echo $id; ?>').hide();

                            }
                             function cancelroom<?php echo $id; ?>(){
                               document.getElementById("roomupdate<?php echo $id; ?>").setAttribute("style", "display:none");
                               $('.bldgaction2').show();
                                $('#roomdiv<?php echo $id; ?>').hide();
                                $('#room2div<?php echo $id; ?>').hide();
                                $('#roomvals<?php echo $id; ?>').show();
                                $('#room2vals<?php echo $id; ?>').show();
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
                                    <form method="POST"  id="addroom">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                <td>
                                                    <div class="form-group label-floating" style="margin-top: 0">
                                                    <label class="control-label">Enter Room here</label>
                                                    <input type="text" class="form-control" <?php if($_GET['q']==0) echo "disabled='disabled'";?> name="room" required="required">
                                                    <input type="hidden" name="module" value="4">
                                                    <input type="hidden" name="get" value="<?php echo $_GET['q'];?>" id="get">
                                                    <input type="hidden" name="bldg" value="<?php echo $_GET['q'];?>">
                                                </div></td>
                                                <td>
                                                    <div class="form-group label-floating" style="margin-top: 0">
                                                    <label class="control-label">-Select Type-</label>
                                                    <SELECT  type="text" name="type" class="form-control" <?php if($_GET['q']==0) echo "disabled='disabled'";?> required="required">
                                                        <option value=""></option>
                                                        <option value="Laboratory">Laboratory</option>
                                                        <option value="Lecture">Lecture</option>
                                                    </SELECT>
                                                </div></td>
                                                <td class="text-a" >
                                                <button  type="submit" class="btn btn-primary btn-round"  style="margin-top: 0"><i class="material-icons">add</i> Add Room</button></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                    <script type="text/javascript">
                                        
                                        $("#addroom").submit(function(e) {
                                            if (document.getElementById('get').value == 0) {
                                                alert('Please select a building to add rooms.');
                                            }else{
                                            var url = "submit.php"; // the script where you handle the form input.
                                            $.ajax({
                                                   type: "POST",
                                                   url: url,
                                                   data: $("#addroom").serialize(), // serializes the form's elements.
                                                   success: function(data)
                                                   {   
                                                      y = data.replace(/(^\s+|\s+$)/g, "")
                                                      $('#rooms').load(y);
                                                   }
                                                 });}
                                            e.preventDefault(); // avoid to execute the actual submit of the form.}
                                            
                                        });

                                        function deleteroom(id2,module2,bldg){
                                          var txt;
                                          var r = confirm("Are you sure you want to remove this Room?");
                                          if (r == true) {
                                                     $.post("submit.php", { id:id2,  module:module2, bldg:bldg
                                                                            })
                                              .done(function( data ) {
                                               y = data.replace(/(^\s+|\s+$)/g, "")
                                               $('#rooms').load(y);
                                             });
                                                     
                                          }
                                          
                                        }
                                        function updateroom(id,rm,module2,ty,bldg){
                                          var txt;
                                          var value = document.getElementById(rm).value;
                                          var value2 = document.getElementById(ty).value;
                                          //alert(value);
                                          var r = confirm('Are you sure you want to update the building?');
                                          if (r == true) {
                                                     $.post('submit.php', { id:id, bldg:bldg, module:module2, type:value2 , room:value
                                                                            })
                                              .done(function( data ) {
                                               y = data.replace(/(^\s+|\s+$)/g, "")
                                               $('#rooms').load(y);
                                             });
                                                     
                                          }
                                      }
                                    </script>
    </div>