<?php

/* 
 * retrieve service plans
 */
    require 'dbConfig.php';
   // $productmodel=$_POST["productmodel"];
    
    $sql= $conn->prepare('SELECT serviceplan.plantype,serviceplan.planid FROM serviceplan');
    //$sql->bind_param('i',$productmodel);
    $sql->execute();
    $sql->bind_result($plantype,$planid);
    echo '<option value="Blank"><--Select--></option>';
    while($sql->fetch()){
        echo '<option value="'.$planid.'">'.$plantype.'</option>';
        
    }
   
    mysqli_close($conn);
?>