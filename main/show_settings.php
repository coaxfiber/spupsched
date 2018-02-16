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
     $stmt = $arr->readdean();
    $row = $stmt->fetch();
    $dean = $row['value'];
     $stmt = $arr->readvp();
    $row = $stmt->fetch();
    $vp = $row['value'];

?>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Setting</h4>
      </div>
      <div class="modal-body">
        <table width="100%">
            <tr>
                <td>Active School Year</td>
                <td>
                    <div class="form-group label-floating" style="margin-top: 0">
                        <select  class="form-control" id="year">
                            <?php 
                               echo '<option value="'.$year.'">'.$year."</option>";

                                $now = date("Y");
                                for($x = $now;$x > 2016;$x--)
                                {
                                    $y=$x+1;
                               echo '<option value="'.$x.' - '.$y.'">'.$x.' - '.$y."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Active Semester</td>
                <td>
                    <div class="form-group label-floating" style="margin-top: 0">
                        <select  class="form-control" id="term">
                            <?php 
                               echo '<option value="'.$term.'">'.$term."</option>";
                            ?>
                            <option value="Third Semester">Third Semester</option>
                            <option value="Second Semester">Second Semester</option>
                            <option value="First Semester">First Semester</option>
                            <option value="Transition Term">Transition Term</option>
                            <option value="Summer">Summer</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Dean</td>
                <td>
                    <div class="form-group label-floating" style="margin-top: 0">
                       <input type="text"   class="form-control" value="<?php echo $dean; ?>" id="dean">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Vice President</td>
                <td>
                    <div class="form-group label-floating" style="margin-top: 0">
                       <input type="text" id="vp" class="form-control" value="<?php echo $vp; ?>">
                    </div>
                </td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateall()" >Save</button><br><br>
      </div>
    </div>

  </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header text-center" data-background-color="purple">
                    <h4 class="title">Settings</h3>
                        <p class="category">The settings determines some output of all reports and its content.</p>
                </div>
                <div class="card-content">
                    <div class="table-responsive table-upgrade">
                        <table class="table">
                            
                            <tbody>
                                <tr>
                                    <td>Active School Year and Semester</td>
                                    <td class="text-center">
                                        <?php
                                            echo $year." - ".$term;
                                          ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Graduate School Dean</td>
                                    <td class="text-center">

                                        <?php
                                            echo $dean;
                                          ?></td>
                                </tr>
                                <tr>
                                    <td>Vice President</td>
                                    <td class="text-center">

                                        <?php
                                            echo $vp;
                                          ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-round btn-fill btn-info"  data-toggle="modal" data-target="#myModal">Update</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function updateall(){
        var txt1 = document.getElementById('year').value;
        var txt2 = document.getElementById('term').value;
        var txt3 = document.getElementById('dean').value;
        var txt4 = document.getElementById('vp').value;
            $.post("submit.php", { year:txt1,term:txt2,dean:txt3, vp:txt4, module:17
                })
                .done(function( data ) {
                 y = data.replace(/(^\s+|\s+$)/g, "")
                 $('#maincontent').load(y);
               });
            
          }
</script>