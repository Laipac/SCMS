<?php

/* 
 * gets all service plans
 */
    require 'dbConfig.php';
   
    
    $sql= $conn->prepare('SELECT serviceplan.plantype,serviceplan.planid FROM serviceplan');
    
    $sql->execute();
    $sql->bind_result($plantype,$planid);
   
    while($sql->fetch()){
        echo '<option value="'.$planid.'">'.$plantype.'</option>';
        
    }
   
    mysqli_close($conn);
?>