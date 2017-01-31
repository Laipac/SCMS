<?php

/* 
 * get all available platforms
 */
    require 'dbConfig.php';
   
    $sql= $conn->prepare('SELECT platformid,platformname FROM serviceplatform');
    $sql->execute();
    $sql->bind_result($platformid,$platformname);
    echo '<option value="Blank"><--Select--></option>';
    while($sql->fetch()){
        echo '<option value="'.$platformid.'">'.$platformname.'</option>';
        
    }
   
    mysqli_close($conn);
?>