<?php

/* 
 * This module retrieves sim numbers linked to product model
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST["productmodel"];
    
   //$custNum="LP123123";
    $sql= $conn->prepare('SELECT productmodelsimid,simnumber FROM productmodelsim WHERE productmodelinv = ?');
    $sql->bind_param('i',$productmodel);
    $sql->execute();
    $sql->bind_result($productmodelsimid,$simnumber);
    $txtprodmodelid='';
    while($sql->fetch()){
        echo '<option value="'.$productmodelsimid.'">'.$simnumber.'</option>';
       
    }
    mysqli_close($conn);
?>