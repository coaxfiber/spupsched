                <div class="row">
                        <div class="col-md-11">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Programs </h4>
                                    <p class="category">Select a program to show it's Courses</p>
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
                                            include_once '../objects/programs.php';
                                            include_once '../objects/rooms.php';
                                            
                                            $database = new Database();
                                            $db = $database->getConnection();
                                            $bldg= new Programs($db);
                                            $stmt = $bldg->read();

                                ?>
                                
                                <div class="card-content table-responsive">
                                <div id="bldgdiv"  style="height: 300px; overflow-y: scroll;">
                                    <table class="table" onload="bot();">
                                        <thead class="text-primary" style="color: #32122e">
                                            <td >Acronym</td>
                                            <td >Program</td>
                                            <td >Specialization</td>
                                            <td class="text-a" >-Action-</td>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                extract($row);
                                            ?>
                                            <tr>
                                                <td><a href="javascript:void(0);" id="up<?php echo $id; ?>"><?php echo $short; ?></a>
                                                    <div class="form-group label-floating" style="margin-top: 0" id="inputdiv<?php echo $id;?>">
                                                        <input type="text" class="form-control" name="upbldg" id="inputup<?php echo $id;?>" value="<?php echo $short; ?>">
                                                        <input type="hidden" name="module" value="1">
                                                    </div>
                                                </td>
                                                
                                                <td><a href="javascript:void(0);" id="u2p<?php echo $id; ?>"><?php echo $program; ?></a>
                                                    <div class="form-group label-floating" style="margin-top: 0" id="input2div<?php echo $id;?>">
                                                        <input type="text" class="form-control" name="up2bldg" id="input2up<?php echo $id;?>" value="<?php echo $program; ?>">
                                                        <input type="hidden" name="module" value="1">
                                                    </div></td>
                                                    <td><a href="javascript:void(0);" id="u3p<?php echo $id; ?>"><?php echo $specialization; ?></a>
                                                    <div class="form-group label-floating" style="margin-top: 0" id="input3div<?php echo $id;?>">
                                                        <input type="text" class="form-control" name="upbldg" id="input3up<?php echo $id;?>" value="<?php echo $specialization; ?>">
                                                        <input type="hidden" name="module" value="1">
                                                    </div>
                                                </td>
                                                <td class="text-a">
                                                    <div class="bldgaction">
                                                        <a href="javascript:void(0);" onclick="changeroom(<?php echo $id; ?>,'<?php echo $program." (".$specialization.")"; ?>')"><i class="material-icons">domain</i> Select&nbsp;</a> | 
                                                        <a href="javascript:void(0);" onclick="upshow<?php echo $id; ?>()" ><i class="material-icons">edit</i> Update&nbsp;</a> | 
                                                        <a href="javascript:void(0);" onclick="deletebldg(<?php echo $id; ?>,9)"><i class="material-icons">delete</i> Remove</a>
                                                    </div>
                                                    <div id="bldgupdate<?php echo $id; ?>" style="display: none">
                                                        <a href="javascript:void(0);" onclick="updatek(<?php echo $id; ?>,'inputup<?php echo $id;?>','input2up<?php echo $id;?>','input3up<?php echo $id;?>',8)" ><i class="material-icons">edit</i>&nbsp;Save&nbsp;</a>&nbsp;|&nbsp;
                                                        <a href="javascript:void(0);" onclick="cancel<?php echo $id; ?>()" ><i class="material-icons">cancel</i>&nbsp;Cancel&nbsp;</a> 
                                                    </div>
                                                    <script type="text/javascript">
                                                        $('#inputdiv<?php echo $id; ?>').hide();
                                                        $('#input2div<?php echo $id; ?>').hide();
                                                        $('#input3div<?php echo $id; ?>').hide();
                                                        function upshow<?php echo $id; ?>(){
                                                           document.getElementById("bldgupdate<?php echo $id; ?>").setAttribute("style", "display:inline");
                                                           $('.bldgaction').hide();
                                                           $('#up<?php echo $id; ?>').hide();
                                                           $('#u2p<?php echo $id; ?>').hide();
                                                           $('#u3p<?php echo $id; ?>').hide();
                                                        $('#inputdiv<?php echo $id; ?>').show();
                                                        $('#input2div<?php echo $id; ?>').show();
                                                        $('#input3div<?php echo $id; ?>').show();
                                                        }
                                                         function cancel<?php echo $id; ?>(){
                                                           document.getElementById("bldgupdate<?php echo $id; ?>").setAttribute("style", "display:none");
                                                           $('.bldgaction').show();
                                                           $('#up<?php echo $id; ?>').show();
                                                           $('#u2p<?php echo $id; ?>').show();
                                                           $('#u3p<?php echo $id; ?>').show();
                                                        $('#inputdiv<?php echo $id; ?>').hide();
                                                        $('#input2div<?php echo $id; ?>').hide();
                                                        $('#input3div<?php echo $id; ?>').hide();
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
                                                        <label class="control-label">Acronym</label>
                                                        <input type="text" class="form-control" name="short" required="required">
                                                    </div></td>
                                                    <td>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                        <label class="control-label">Program</label>
                                                        <input type="text" class="form-control" name="program" required="required">
                                                        <input type="hidden" name="module" value="7">
                                                    </div></td>
                                                    <td>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                        <label class="control-label">Specialization</label>
                                                        <input type="text" class="form-control" name="specialization" required="required">
                                                        <input type="hidden" name="module" value="7">
                                                    </div></td>

                                                    <td class="text-a" >
                                                    <button class="btn btn-primary btn-round" type="submit" style="margin-top: 0"><i class="material-icons">add</i> Add Program</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title" id="roomtitle">Select a Program</h4>
                                    <p class="category" style="width: 60%;float: left;">Programs that are offered in the Graduate School.</p>
                                    <div style="text-align: right;"><a href="javascript:void(0);" onclick="changeroom(0,'the Institution')" ><i class="material-icons">assignment</i>&nbsp;Go to Institutional Courses&nbsp;</a> | <a href="javascript:void(0);" onclick="print()" ><i class="material-icons">print</i>&nbsp;Print&nbsp;</a>
                                      </div>
                                </div>

                                <div id="rooms">
                                    <div class="card-content table-responsive">
                                       <div   style="height: 100px; overflow-y: scroll;">
                                        <center><b>-NO PPROGRAM SELECTED-</b></center>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <script type="text/javascript">
                        function changeroom(var2,var1){
                            document.getElementById('roomtitle').innerHTML = 'Courses in <b>'+var1+'</b>';
                            $('#rooms').load('show_programs_courses.php?q='+var2);
                        }

                        function deletebldg(id2,module2){
                          var txt;
                          var r = confirm("Are you sure you want to remove this Program? Note: all courses in this program will be removed.");
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

                        function updatek(id,short,program,spe,module2){
                              var txt;
                              var value = document.getElementById(short).value;
                              var value2 = document.getElementById(program).value;
                              var value3 = document.getElementById(spe).value;
                              //alert(value);
                              var r = confirm('Are you sure you want to update the Program?');
                              if (r == true) {
                                         $.post('submit.php', { id:id, short:value, program:value2,specialization:value3, module:module2
                                                                })
                                  .done(function( data ) {
                                   y = data.replace(/(^\s+|\s+$)/g, "")
                                   $('#maincontent').load(y);
                                 });
                                         
                              }
                          }
                    </script>