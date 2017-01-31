<?php

/* 
 * gets count of all product models based on invoice.
 */
    require 'dbConfig.php';
    $invNum=$_POST['invNum'];
    
    $sql= $conn->prepare('SELECT COUNT(invNum) FROM productmodel WHERE invNum=?');
    $sql->bind_param('i',$invNum);
    $sql->execute();
    $sql->fetch();
    $sql->bind_result($productcount);
   
    echo $productcount;
   
    mysqli_close($conn);
?>