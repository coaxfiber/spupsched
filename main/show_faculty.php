                <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Graduate School Faculty </h4>
                                    <p class="category">Graduate school staff and faculty</p>
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
                                            include_once '../objects/faculty.php';
                                            include_once '../objects/programs.php';
                                            $database = new Database();
                                            $db = $database->getConnection();
                                            $bldg= new Faculty($db);
                                            if (isset($_GET['search'])) {
                                                $stmt = $bldg->readsearch($_GET['search']);
                                            }else
                                            $stmt = $bldg->read();

                                ?>
                                
                                <div class="card-content table-responsive">
                                <div id="bldgdiv"  style="height: 400px; overflow-y: scroll;">
                                        <form class="navbar-form navbar-left" role="search" style="margin: 0; width: 500px" id="searchform">
                                            <div class="form-group  is-empty" style="float: left;width: 250px">
                                                <input type="text" class="form-control" placeholder="Search" id="search" 
                                                <?php 
                                                if (isset($_GET['search'])) {
                                                    echo "value='".$_GET['search']."'";
                                                }
                                                ?>  style="width: 250px">
                                                <span class="material-input"></span>
                                            </div>
                                            <button type="submit" class="btn btn-white btn-round btn-just-icon" style="background-color: #ededed;float: left">
                                                <i class="material-icons">search</i>
                                                <div class="ripple-container"></div>
                                            </button>
                                          </form>
                                    <table class="table" onload="bot();">
                                        <thead class="text-primary" style="color: #32122e">
                                            <td>ID Number</td>
                                            <td>Honorific</td>
                                            <td>First name</td>
                                            <td>Middle name</td>
                                            <td>Last name</td>
                                            <td>status</td>
                                            <td>Program</td>
                                            <td class="text-a" width="200">-Action-</td>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                extract($row);
                                            ?>
                                            <tr  class="hov">
                                                <td><a href="javascript:void(0);" id="val1s<?php echo $id; ?>"><?php echo $idno; ?></a>
                                                    <div class="form-group label-floating" style="margin-top: 0" id="input1div<?php echo $id;?>">
                                                        <input type="text" class="form-control" name="upbldg" id="input1x<?php echo $id;?>" value="<?php echo $idno; ?>">
                                                    </div>
                                                </td>

                                                <td><a href="javascript:void(0);" id="val2s<?php echo $id; ?>"><?php echo $ext; ?></a>
                                                   <div class="form-group label-floating" style="margin-top: 0" id="input2div<?php echo $id;?>">
                                                        <SELECT  type="text" class="form-control" id="input2x<?php echo $id;?>">
                                                            <option value="<?php echo $ext; ?>"><?php echo $ext; ?></option>

                                                            <option value="MR.">MR.</option>
                                                            <option value="MRS.">MRS.</option>
                                                            <option value="MS.">MS.</option>
                                                            <option value="DR.">DR.</option>
                                                            <option value="Atty.">Atty.</option>
                                                        </SELECT>
                                                    </div>
                                                </td>


                                                <td><a href="javascript:void(0);" id="val3s<?php echo $id; ?>"><?php echo $fname; ?></a>
                                                    <div class="form-group label-floating" style="margin-top: 0" id="input3div<?php echo $id;?>">
                                                        <input type="text" class="form-control" name="upbldg" id="input3x<?php echo $id;?>" value="<?php echo $fname; ?>">
                                                    </div>
                                                </td>

                                                <td><a href="javascript:void(0);" id="val4s<?php echo $id; ?>"><?php echo $mname; ?></a>
                                                    <div class="form-group label-floating" style="margin-top: 0" id="input4div<?php echo $id;?>">
                                                        <input type="text" class="form-control" name="upbldg" id="input4x<?php echo $id;?>" value="<?php echo $mname; ?>">
                                                    </div>
                                                </td>

                                                <td><a href="javascript:void(0);" id="val5s<?php echo $id; ?>"><?php echo $lname; ?></a>
                                                    <div class="form-group label-floating" style="margin-top: 0" id="input5div<?php echo $id;?>">
                                                        <input type="text" class="form-control" name="upbldg" id="input5x<?php echo $id;?>" value="<?php echo $lname; ?>">
                                                    </div>
                                                </td>


                                                <td><a href="javascript:void(0);" id="val6s<?php echo $id; ?>"><?php echo $status; ?></a>
                                                   <div class="form-group label-floating" style="margin-top: 0" id="input6div<?php echo $id;?>">
                                                        <SELECT  type="text" class="form-control" id="input6x<?php echo $id;?>">
                                                            <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </SELECT>
                                                    </div>
                                                </td>
                                                <td><a href="javascript:void(0);" id="val7s<?php echo $id; ?>"><?php echo $progname; ?></a>
                                                   <div class="form-group label-floating" style="margin-top: 0" id="input7div<?php echo $id;?>">
                                                        <SELECT  type="text" class="form-control" id="input7x<?php echo $id;?>">
                                                            <option value="<?php echo $progname; ?>"><?php echo $progname; ?></option>
                                                            <?php
                                                            $prog= new Programs($db);
                                                            $stmt2 = $prog->reads();
                                                            while ($row2 = $stmt2->fetch()){
                                                              echo "<option value='".$row2['short']."'>".$row2['short']."</option>";
                                                            }
                                                            ?>
                                                        </SELECT>
                                                    </div>
                                                </td>

                                                <td class="text-a" >
                                                    <div class="bldgaction">
                                                        <a href="javascript:void(0);" data-toggle="modal"  data-target="#date<?php echo $id; ?>"  data-backdrop="static" data-keyboard="false"><i class="material-icons">print</i></a> | 
                                                        <a href="javascript:void(0);" onclick="upshow<?php echo $id; ?>()" ><i class="material-icons">edit</i>&nbsp;</a> | 
                                                        <a href="javascript:void(0);" onclick="deletebldg(<?php echo $id; ?>,14)"><i class="material-icons">delete</i></a>

                                                        <div id="date<?php echo $id; ?>" class="modal fade" role="dialog" style="text-align: left;">
                                                          <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <div class="modal-content" style="padding: 20px 20px 0 20px">
                                                             <form method="POST" action="faculty_print.php"  target="_blank">
                                                              <div class="modal-body" style="padding-top:0">
                                                               <h3>Generate Letter to:</h3>
                                                                <input class="form-control" style="margin-top:0;" readonly="readonly" type="text" name="name" value="<?php echo $ext; ?> <?php echo $fname; ?> <?php echo $mname; ?> <?php echo $lname; ?>">
                                                                <input type="hidden" name="fname" value="<?php echo $fname; ?>">
                                                                <input type="hidden" name="ext" value="<?php echo $ext; ?>">
                                                                <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" style="width: 50%">
                                                                <hr>
                                                               <button type="button" class="btn btn-danger"  data-dismiss="modal">Cancel</button>
                                                               <button type="submit" class="btn btn-success"  >Proceed</button>

                                                              </div>  
                                                              </form>    
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div id="bldgupdate<?php echo $id; ?>" style="display: none">
                                                        <a href="javascript:void(0);" onclick="updatek(<?php echo $id; ?>,'input1x<?php echo $id;?>','input2x<?php echo $id;?>','input3x<?php echo $id;?>','input4x<?php echo $id;?>','input5x<?php echo $id;?>','input6x<?php echo $id;?>','input7x<?php echo $id;?>',15)" ><i class="material-icons">edit</i>&nbsp;Save&nbsp;</a>&nbsp;|&nbsp;
                                                        <a href="javascript:void(0);" onclick="cancel<?php echo $id; ?>()" ><i class="material-icons">cancel</i>&nbsp;Cancel&nbsp;</a> 
                                                    </div>
                                                    <script type="text/javascript">
                                                        $('#input6div<?php echo $id; ?>').hide();
                                                        $('#input5div<?php echo $id; ?>').hide();
                                                        $('#input4div<?php echo $id; ?>').hide();
                                                        $('#input3div<?php echo $id; ?>').hide();
                                                        $('#input2div<?php echo $id; ?>').hide();
                                                        $('#input1div<?php echo $id; ?>').hide();
                                                        $('#input7div<?php echo $id; ?>').hide();
                                                        function upshow<?php echo $id; ?>(){
                                                           document.getElementById("bldgupdate<?php echo $id; ?>").setAttribute("style", "display:inline");
                                                                $('.bldgaction').hide();$('#up<?php echo $id; ?>').hide();
                                                                $('#input6div<?php echo $id; ?>').show();
                                                                $('#input5div<?php echo $id; ?>').show();
                                                                $('#input4div<?php echo $id; ?>').show();
                                                                $('#input3div<?php echo $id; ?>').show();
                                                                $('#input2div<?php echo $id; ?>').show();
                                                                $('#input1div<?php echo $id; ?>').show();
                                                                $('#input7div<?php echo $id; ?>').show();
                                                            $('#val1s<?php echo $id; ?>').hide();
                                                            $('#val2s<?php echo $id; ?>').hide();
                                                            $('#val3s<?php echo $id; ?>').hide();
                                                            $('#val4s<?php echo $id; ?>').hide();
                                                            $('#val5s<?php echo $id; ?>').hide();
                                                            $('#val6s<?php echo $id; ?>').hide();
                                                            $('#val7s<?php echo $id; ?>').hide();
                                                        }
                                                         function cancel<?php echo $id; ?>(){
                                                           document.getElementById("bldgupdate<?php echo $id; ?>").setAttribute("style", "display:none");
                                                           $('.bldgaction').show();
                                                                $('#input6div<?php echo $id; ?>').hide();
                                                                $('#input5div<?php echo $id; ?>').hide();
                                                                $('#input4div<?php echo $id; ?>').hide();
                                                                $('#input3div<?php echo $id; ?>').hide();
                                                                $('#input2div<?php echo $id; ?>').hide();
                                                                $('#input1div<?php echo $id; ?>').hide();
                                                                $('#input7div<?php echo $id; ?>').hide();
                                                            $('#val1s<?php echo $id; ?>').show();
                                                            $('#val2s<?php echo $id; ?>').show();
                                                            $('#val3s<?php echo $id; ?>').show();
                                                            $('#val4s<?php echo $id; ?>').show();
                                                            $('#val5s<?php echo $id; ?>').show();
                                                            $('#val6s<?php echo $id; ?>').show();
                                                            $('#val7s<?php echo $id; ?>').show();
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
                                                        <label class="control-label">ID Number</label>
                                                        <input type="text" class="form-control" name="idno">
                                                        <input type="hidden" name="module" value="13">
                                                    </div></td>

                                                    
                                                      <td>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                        <SELECT  type="text" class="form-control" name="ext">
                                                            <option value="">-Honorific-</option>
                                                            <option value="MR.">MR.</option>
                                                            <option value="MRS.">MRS.</option>
                                                            <option value="MS.">MS.</option>
                                                            <option value="DR.">DR.</option>
                                                            <option value="Atty.">Atty.</option>
                                                        </SELECT>
                                                    </div></td>

                                                    <td>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                        <label class="control-label">First name</label>
                                                        <input type="text" class="form-control" name="fname" required="required">
                                                    </div></td>

                                                    <td>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                        <label class="control-label">Middle name</label>
                                                        <input type="text" class="form-control" name="mname">
                                                    </div></td>

                                                      <td>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                        <label class="control-label">Last name</label>
                                                        <input type="text" class="form-control" name="lname" required="required">
                                                    </div></td>

                                                      <td>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                        <SELECT  type="text" class="form-control" name="status">
                                                            <option value="">-Status-</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </SELECT>
                                                    </div></td>
                                                    <td>
                                                        <div class="form-group label-floating" style="margin-top: 0">
                                                        <SELECT  type="text" class="form-control" name="progname">
                                                            <option value="">-Program-</option>
                                                            <?php
                                                            $prog2= new Programs($db);
                                                            $stmt3 = $prog2->reads();
                                                            while ($row3 = $stmt3->fetch()){
                                                              echo "<option value='".$row3['short']."'>".$row3['short']."</option>";
                                                            }
                                                            ?>
                                                        </SELECT>
                                                    </div></td>

                                                    <td class="text-a" >
                                                    <button class="btn btn-primary btn-round" type="submit" style="margin-top: 0"><i class="material-icons">add</i> Add</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">


                        function deletebldg(id2,module2){
                          var txt;
                          var r = confirm("Are you sure you want to remove this Faculty Member? ");
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

                         $("#searchform").submit(function(e) {
                            var str = document.getElementById('search').value;
                              $('#maincontent').load("show_faculty.php?search="+str);
                            e.preventDefault(); // avoid to execute the actual submit of the form.
                        });

                        function updatek(id,val1,val2,val3,val4,val5,val6,val7,module2){
                              var txt;
                              var value1 = document.getElementById(val1).value;
                              var value2 = document.getElementById(val2).value;
                              var value3 = document.getElementById(val3).value;
                              var value4 = document.getElementById(val4).value;
                              var value5 = document.getElementById(val5).value;
                              var value6 = document.getElementById(val6).value;
                              var value7 = document.getElementById(val7).value;
                              //alert(value);
                              var r = confirm('Are you sure you want to update the The faculty member?');
                              if (r == true) {
                                         $.post('submit.php', { id:id, idno:value1,ext:value2,fname:value3,mname:value4,lname:value5,status:value6, progname:value7,module:module2
                                                                })
                                  .done(function( data ) {
                                   y = data.replace(/(^\s+|\s+$)/g, "")
                                   //alert(data);
                                   $('#maincontent').load(y);
                                 });
                                         
                              }
                          }
                    </script>