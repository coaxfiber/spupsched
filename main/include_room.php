<?php
                                ini_set('display_errors', 1);
                                    ini_set('display_startup_errors', 1);
                                    error_reporting(E_ALL);
                                            include_once '../config/database.php';
                                            include_once '../objects/rooms.php';
                                            
                                            $database = new Database();
                                            $db = $database->getConnection();
                                            $room11= new Rooms($db);
                                            $stmt11 = $room11->read($_GET['q']);
                                ?>
                                <script type="text/javascript">
                                    function gor3<?php echo $_GET['g']; ?>(sel){
                                        document.getElementById('roomvalue<?php echo $_GET['g']; ?>').value = sel;
                                        clse<?php echo $_GET['g']; ?>();
                                    }
                                </script>
                                <div style="height: 180px;overflow-y: scroll;">
                                    <center>
                                    <table width="60%">
                                    <?php
                                         while ($row11 = $stmt11->fetch()){
                                    ?>
                                    <tr class="hov">
                                        <th width="50%" ><?php echo $row11[1]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th style="text-align: right;"><a href="javascript:void(0);" onclick="gor3<?php echo $_GET['g']; ?>('<?php echo $row11[1]; ?>')"><i class="material-icons">domain</i>&nbsp;Select&nbsp;</a></th>
                                    </tr>
                                    <?php } ?>
                                    </table>
                                    </center>
                                </div>