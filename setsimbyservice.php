<?php

/* 
 * retrieve sim numbers based on service plan
 */
    require 'dbConfig.php';
    $serviceplan = $_POST['serviceplan'];
    $sql16 = $conn->prepare('SELECT sim.simnumber FROM sim LEFT JOIN productmodelsim ON productmodelsim.simnumber=sim.simnumber LEFT JOIN simcardmaster ON simcardmaster.simid=sim.simgroup LEFT JOIN serviceplan ON simcardmaster.simplan=serviceplan.planid WHERE productmodelsim.simnumber IS NULL AND serviceplan.planid=?');
    $sql16->bind_param('i',$serviceplan);
    $sql16->execute();
    $sql16->bind_result($simnumber);
    echo '<option value="Blank"><--Select--></option>';
    while($sql16->fetch()){
    
         echo '<option value="'.$simnumber.'">'.$simnumber.'</option>';
    }
     
   
    mysqli_close($conn);
?>