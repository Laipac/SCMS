<?php

/* 
 * retrieve platform admins based on platform
 */
    require '../dbConfig.php';
    
    
    $platformid=$_POST['platformid'];
       
    $sql= $conn->prepare('SELECT platformadmin FROM platformadmin WHERE serviceplatform=?');
    $sql->bind_param('i',$platformid);
    if($sql->execute()){
       $sql->bind_result($servicebillto);
       $sql->fetch();
       echo $servicebillto;
    }
    else{
        echo 'failed';
    }
    mysqli_close($conn);
?>