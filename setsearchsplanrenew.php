<?php

/* 
 * retrieve product models based on customer and invoice type
 */
    require 'dbConfig.php';
    $customer=$_POST['customer'];
    $invType = $_POST['invType'];
    
    $sql1 = $conn->prepare('SELECT DISTINCT productmodel.serviceplan,serviceplan.plantype FROM productmodel INNER JOIN invoices ON productmodel.invNum=invoices.invNum INNER JOIN customers ON customers.frstInv=invoices.frstInv INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel INNER JOIN serviceplan ON serviceplan.productmodel=productmodel.serviceplan WHERE customers.frstInv=? AND invoices.status=?');
    $sql1->bind_param('ss',$customer,$invType);
    $sql1->execute();
    $sql1->bind_result($productmodelid,$productmodelnames);
    echo '<option value="Blank"><--Select--></option>';
    while($sql1->fetch()){
    
        echo '<option value="'.$productmodelid.'">'.$productmodelnames.'</option>';

    }
   
    mysqli_close($conn);
?>