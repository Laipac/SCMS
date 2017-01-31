<?php

/* 
 * get all product models
 */
    require 'dbConfig.php';
   
    $sql = $conn->prepare('SELECT productmodelid,productmodelname FROM productmodelmaster WHERE productmodelname != "Null"');
    $sql->execute();
    $sql->bind_result($productmodelid,$productmodelname);
    while($sql->fetch()){
        echo '<option value="'.$productmodelid.'">'.$productmodelname.'</option>';  
    }
   
    mysqli_close($conn);
?>