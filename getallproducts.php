<?php

/* 
 * gets all product models based on customer
 */
    require 'dbConfig.php';
    $invType=$_POST['invType'];
    $customer=$_POST['customer'];
    if($invType==='Product, SIM and Service' || $invType==='SIM'){
         $sql= $conn->prepare('SELECT productmodelid,productmodelname FROM productmodelmaster WHERE productmodelname != "Null"');
    
    }
    else if($invType==='Service Renew'){
        $invNum=$_POST['invNum'];
        $sql = $conn->prepare('SELECT productmodel.prodmodelid,productmodelmaster.productmodelname FROM productmodel INNER JOIN invoices ON productmodel.invNum=invoices.invNum INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel WHERE invoices.invType=? AND productmodel.invNum=?');
        $sql->bind_param('si',$invType,$invNum);
    }
    else{
        $sql= $conn->prepare('SELECT DISTINCT productmodelmaster.productmodelid,productmodelmaster.productmodelname FROM productmodel INNER JOIN invoices ON productmodel.invNum=invoices.invNum INNER JOIN customers ON customers.frstInv=invoices.frstInv INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel WHERE customers.frstInv=? AND invoices.invType=?');        
        $sql->bind_param('ss',$customer,$invType);
         
    }
    $sql->execute();
    $sql->bind_result($productmodelid,$productmodelname);
    echo '<option value="Blank"><--Select--></option>';
    while($sql->fetch()){
        if($invType==='Service Renew'){
            echo '<option value="'.$productmodelid.'">'.$productmodelid.'-'.$productmodelname.'</option>';
        }
        else{
            echo '<option value="'.$productmodelid.'">'.$productmodelname.'</option>';
        }  
    }
    
        
   
    mysqli_close($conn);
?>