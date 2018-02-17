<?php
                                ini_set('display_errors', 1);
                                    ini_set('display_startup_errors', 1);
                                    error_reporting(E_ALL);
                                            include_once '../config/database.php';
                                            include_once '../objects/faculty.php';
                                            
                                            $database = new Database();
                                            $db = $database->getConnection();
                                            $room11= new Faculty($db);
                                            $stmt11 = $room11->readprog($_GET['q']);
                                ?>
                                <script type="text/javascript">
                                    function gor<?php echo $_GET['g']; ?>(sel){
                                        document.getElementById('prof<?php echo $_GET['g']; ?>').value = sel;
                                        clse2<?php echo $_GET['g']; ?>();
                                    }
                                </script>
                                <div style="height: 180px;overflow-y: scroll;">
                                    <center>
                                    <table width="100%">
                                    <?php
                                         while ($row11 = $stmt11->fetch()){
                                    ?>
                                    <tr class="hov">
                                        <th width="50%" ><?php echo $row11[2]; ?> <?php echo $row11[3]; ?> <?php echo $row11[4]; ?> <?php echo $row11[5]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: right;"><a href="javascript:void(0);" onclick="gor<?php echo $_GET['g']; ?>('<?php echo $row11[2]; ?> <?php echo $row11[3]; ?> <?php echo $row11[4]; ?> <?php echo $row11[5]; ?>')"><i class="material-icons">domain</i>&nbsp;Select&nbsp;</a></th>
                                    </tr>
                                    <?php } ?>
                                    </table>
                                    </center>
                                </div>