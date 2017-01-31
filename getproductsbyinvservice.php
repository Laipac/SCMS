<?php

/* 
 * get product models that does not have locator id and locator name assigned to product model
 */
    require 'dbConfig.php';
    
  
    $invNum=$_POST['invNum'];
    
    $sql= $conn->prepare('SELECT DISTINCT productmodel.prodmodelid,productmodelmaster.productmodelname FROM productmodel INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel LEFT JOIN productmodelsim ON productmodelsim.productmodelinv=productmodel.prodmodelid LEFT JOIN sim ON sim.simnumber=productmodelsim.simnumber WHERE productmodel.invNum=? AND sim.locatorid IS NULL AND sim.locatorname IS NULL');
    $sql->bind_param('i',$invNum);
    $sql->execute();
    $sql->bind_result($productmodelid,$productmodelname);
    echo '<option value="Blank"><--Select--></option>';
    while($sql->fetch()){
        echo '<option value="'.$productmodelid.'">'.$productmodelid.'-'.$productmodelname.'</option>';
        
    }
   
    mysqli_close($conn);
?>