<?php

/* 
 * retrieve service bill to details based on platform
 */
    require '../dbConfig.php';
    
    
    $platformid=$_POST['platformid'];
       
    $sql= $conn->prepare('SELECT servicebillto FROM servicebillto WHERE serviceplatform=?');
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