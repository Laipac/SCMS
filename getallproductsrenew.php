<?php

/* 
 * gets all product models based on customer for service renew invoices
 */
    require 'dbConfig.php';
    $customer=$_POST['customer'];
    $invType = $_POST['invType'];
    
    $sql1 = $conn->prepare('SELECT DISTINCT productmodel.prodmodelid,productmodelmaster.productmodelname,productmodel.invNum FROM productmodel INNER JOIN invoices ON productmodel.invNum=invoices.invNum INNER JOIN customers ON customers.frstInv=invoices.frstInv INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel WHERE customers.frstInv=? AND invoices.status=?');
    $sql1->bind_param('ss',$customer,$invType);
    $sql1->execute();
    $sql1->bind_result($productmodelnumbers,$productmodelnames,$invoicenumber);
    echo '<option value="Blank"><--Select--></option>';
    while($sql1->fetch()){
    
        echo '<option value="'.$productmodelnumbers.'">'.$invoicenumber." - ".$productmodelnames.'</option>';

    }
   
    mysqli_close($conn);
?>