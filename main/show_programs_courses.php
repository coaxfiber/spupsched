<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        include_once '../config/database.php';
        include_once '../objects/subjects.php';
        
        $database = new Database();
        $db = $database->getConnection();
        $room= new Subjects($db);
        $stmt = $room->read($_GET['q']);

?>


    <div class="card-content table-responsive">
        <div   style="height: 400px; overflow-y: scroll;">
        <table class="table">
            <thead class="text-primary" style="color: #32122e">
                <td >Code</td>
                <td >Title</td>
                <td width="40"  >Units</td>
                <td >Remarks</td>
                <td >Type</td>
                <td class="text-a" width="183" >-Action-</td>
            </thead>
            <tbody>
                <?php
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                ?>
                <tr>
                    <td><a href="javascript:void(0);" id="vals<?php echo $id; ?>"><?php echo $code; ?></a>
                        <div class="form-group label-floating" style="margin-top: 0" id="inputdiv<?php echo $id;?>">
                            <input type="text" class="form-control" name="upbldg" id="inputx<?php echo $id;?>" value="<?php echo $code; ?>">
                        </div></td>
                        <td><a href="javascript:void(0);" id="val2s<?php echo $id; ?>"><?php echo $title; ?></a>
                        <div class="form-group label-floating" style="margin-top: 0" id="input2div<?php echo $id;?>">
                            <Textarea type="text" class="form-control" name="upbldg" id="input2x<?php echo $id;?>"><?php echo $title; ?></Textarea>
                        </div></td>
                    <td><a href="javascript:void(0);" id="val3s<?php echo $id; ?>"><?php echo $units; ?></a>
                        <div class="form-group label-floating" style="margin-top: 0" id="input3div<?php echo $id;?>">
                            <input type="number" class="form-control" name="upbldg" id="input3x<?php echo $id;?>" value="<?php echo $units; ?>">
                        </div></td>
                        <td><a href="javascript:void(0);" id="val4s<?php echo $id; ?>"><?php echo $remarks; ?></a>
                        <div class="form-group label-floating" style="margin-top: 0" id="input4div<?php echo $id;?>">
                            <input type="text" class="form-control" name="upbldg" id="input4x<?php echo $id;?>" value="<?php echo $remarks; ?>">
                        </div></td>
                    <td><a href="javascript:void(0);" id="val5s<?php echo $id; ?>"><?php echo $type; ?></a>
                        <div class="form-group label-floating" style="margin-top: 0" id="input5div<?php echo $id;?>">
                        <SELECT  type="text" class="form-control" id="input5x<?php echo $id;?>">
                            <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                            <?php 
                                include_once 'type_courses.php';
                             ?>
                        </SELECT>
                    </div></td>
                    <td class="text-a" >
                        <div class="bldgaction2">
                            <a href="javascript:void(0);" onclick="roomshow<?php echo $id; ?>()" ><i class="material-icons">edit</i> Update&nbsp;</a> | 
                            <a href="javascript:void(0);" onclick="deleteroom(<?php echo $id; ?>,11,<?php echo $_GET['q'];?>)"><i class="material-icons">delete</i> Remove</a>
                        </div>
                        <div id="roomupdate<?php echo $id; ?>" style="display: none">
                            <a href="javascript:void(0);" onclick="updateroom(<?php echo $id; ?>,'inputx<?php echo $id;?>','input2x<?php echo $id;?>','input3x<?php echo $id;?>','input4x<?php echo $id;?>','input5x<?php echo $id;?>',12,<?php echo $_GET['q'];?>)" ><i class="material-icons">edit</i>&nbsp;Save&nbsp;</a>&nbsp;|&nbsp;
                            <a href="javascript:void(0);" onclick="cancelroom<?php echo $id; ?>()" ><i class="material-icons">cancel</i>&nbsp;Cancel&nbsp;</a> 
                        </div>
                        <script type="text/javascript">
                            $('#inputdiv<?php echo $id; ?>').hide();
                            $('#input2div<?php echo $id; ?>').hide();
                            $('#input3div<?php echo $id; ?>').hide();
                            $('#input4div<?php echo $id; ?>').hide();
                            $('#input5div<?php echo $id; ?>').hide();
                            function roomshow<?php echo $id; ?>(){
                               document.getElementById("roomupdate<?php echo $id; ?>").setAttribute("style", "display:inline");
                               $('.bldgaction2').hide();
                              $('#inputdiv<?php echo $id; ?>').show();
                              $('#input2div<?php echo $id; ?>').show();
                              $('#input3div<?php echo $id; ?>').show();
                              $('#input4div<?php echo $id; ?>').show();
                              $('#input5div<?php echo $id; ?>').show();

                                $('#vals<?php echo $id; ?>').hide();
                                $('#val2s<?php echo $id; ?>').hide();
                                $('#val3s<?php echo $id; ?>').hide();
                                $('#val4s<?php echo $id; ?>').hide();
                                $('#val5s<?php echo $id; ?>').hide();

                            }
                             function cancelroom<?php echo $id; ?>(){
                               document.getElementById("roomupdate<?php echo $id; ?>").setAttribute("style", "display:none");
                               $('.bldgaction2').show();

                                $('#inputdiv<?php echo $id; ?>').hide();
                                $('#input2div<?php echo $id; ?>').hide();
                                $('#input3div<?php echo $id; ?>').hide();
                                $('#input4div<?php echo $id; ?>').hide();
                                $('#input5div<?php echo $id; ?>').hide();
                                $('#vals<?php echo $id; ?>').show();
                                $('#val2s<?php echo $id; ?>').show();
                                $('#val3s<?php echo $id; ?>').show();
                                $('#val4s<?php echo $id; ?>').show();
                                $('#val5s<?php echo $id; ?>').show();
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
                                                    <label class="control-label">Code</label>
                                                    <input type="text" class="form-control"  name="code" required="required">
                                                    <input type="hidden" name="module" value="10">
                                                    <input type="hidden" name="program" value="<?php echo $_GET['q'];?>">
                                                </div></td>
                                                <td>
                                                    <div class="form-group label-floating" style="margin-top: 0">
                                                    <label class="control-label">Title</label>
                                                    <Textarea type="text" class="form-control" name="title" required="required"></Textarea>
                                                </div></td>
                                                <td  width="40"  >
                                                    <div class="form-group label-floating" style="margin-top: 0">
                                                    <label class="control-label">Units</label>
                                                    <input type="number" class="form-control" name="units" required="required">
                                                </div></td>
                                                <td>
                                                    <div class="form-group label-floating" style="margin-top: 0">
                                                    <label class="control-label">Remarks</label>
                                                    <input type="text" class="form-control" name="remarks">
                                                </div></td>
                                                <td>
                                                    <div class="form-group label-floating" style="margin-top: 0">
                                                    <label class="control-label">-Select Type-</label>
                                                    <SELECT  type="text" name="type" class="form-control" required="required"> 
                                                      <option value=""></option>      
                                                      <?php 
                                                          include('type_courses.php');
                                                       ?>
                                                    </SELECT>
                                                </div></td>
                                                <td class="text-a" >
                                                <button  type="submit" class="btn btn-primary btn-round"  style="margin-top: 0"><i class="material-icons">add</i> Add Course</button></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                    <script type="text/javascript">
                                        
                                        $("#addroom").submit(function(e) {
                                            var url = "submit.php"; // the script where you handle the form input.
                                            $.ajax({
                                                   type: "POST",
                                                   url: url,
                                                   data: $("#addroom").serialize(), // serializes the form's elements.
                                                   success: function(data)
                                                   {   
                                                    alert(data);
                                                      y = data.replace(/(^\s+|\s+$)/g, "")
                                                      $('#rooms').load(y);
                                                   }
                                                 });
                                            e.preventDefault(); // avoid to execute the actual submit of the form.}
                                            
                                        });

                                        function deleteroom(id2,module2,bldg){
                                          var txt;
                                          var r = confirm("Are you sure you want to remove this Course?");
                                          if (r == true) {
                                                     $.post("submit.php", { id:id2,  module:module2, program:bldg
                                                                            })
                                              .done(function( data ) {
                                               y = data.replace(/(^\s+|\s+$)/g, "")
                                               $('#rooms').load(y);
                                             });
                                                     
                                          }
                                          
                                        }
                                        function updateroom(id,code,title,units,remarks,type,mod,program){
                                          var txt;
                                          var value1 = document.getElementById(code).value;
                                          var value2 = document.getElementById(title).value;
                                          var value3 = document.getElementById(units).value;
                                          var value4 = document.getElementById(remarks).value;
                                          var value5 = document.getElementById(type).value;
                                          //alert(value);
                                          var r = confirm('Are you sure you want to update the Course?');
                                          if (r == true) {
                                                     $.post('submit.php', { id,code:value1,title:value2,units:value3,remarks:value4,type:value5,module:mod,program:program
                                                                            })
                                              .done(function( data ) {
                                                alert(data);
                                               y = data.replace(/(^\s+|\s+$)/g, "")
                                               $('#rooms').load(y);
                                             });
                                                     
                                          }
                                      }
                                    </script>
    </div>