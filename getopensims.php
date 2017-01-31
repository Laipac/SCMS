<?php

/* 
 * get all available sims from sim inventory. Sims not assigned to any product model.
 */
    require 'dbConfig.php';
    $sql16 = $conn->prepare('SELECT sim.simnumber FROM sim LEFT JOIN productmodelsim ON productmodelsim.simnumber=sim.simnumber WHERE productmodelsim.simnumber IS NULL');
                                                                
    $sql16->execute();
    $sql16->bind_result($simnumber);
    echo '<option value="Blank"><--Select--></option>';
    while($sql16->fetch()){
        echo '<option value="'.$simnumber.'">'.$simnumber.'</option>';
    }
     
   
    mysqli_close($conn);
?>