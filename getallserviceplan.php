<?php

/* 
 * get all available service plans
 */
    require 'dbConfig.php';
   
    $sql= $conn->prepare('SELECT planid,plantype FROM serviceplan');
   
    $sql->execute();
    $sql->bind_result($planid,$plantype);
   
    while($sql->fetch()){
        echo '<option value="'.$planid.'">'.$plantype.'</option>';
        
    }
   
    mysqli_close($conn);
?>