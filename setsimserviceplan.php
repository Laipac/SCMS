<?php

/* 
 * retrieve sim numbers based on service plan
 */
    require 'dbConfig.php';
    $serviceplan = $_POST['serviceplan'];
    $simnumber = $_POST['simnumber'];
    $sql16 = $conn->prepare('SELECT DISTINCT sim.simnumber FROM sim INNER JOIN simcardmaster ON sim.simgroup = simcardmaster.simid INNER JOIN serviceplan ON serviceplan.simcardtype = simcardmaster.simid LEFT JOIN productmodelsim ON productmodelsim.simnumber = sim.simnumber WHERE (productmodelsim.simnumber IS NULL OR productmodelsim.simnumber=?) AND serviceplan.planid = ?');
    $sql16->bind_param('ii',$simnumber,$serviceplan);
    $sql16->execute();
    $sql16->bind_result($simnumber);
    echo '<option value="Blank"><--Select--></option>';
    while($sql16->fetch()){
    
         echo '<option value="'.$simnumber.'">'.$simnumber.'</option>';
    }
     
   
    mysqli_close($conn);
?>