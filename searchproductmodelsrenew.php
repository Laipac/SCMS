<?php

/* 
 * retrieves product model and invoice details based product model details and customer number
 */
    require 'dbConfig.php';

    $customer = $_POST['frstInv'];
    $serviceplan = $_POST['serviceplan'];
    $productmodel = $_POST['productmodel'];
    $billingcycle = $_POST['billingcycle'];
    $cntractRenewFrom = $_POST['cntractRenewFrom'];
    $cntractRenewTo = $_POST['cntractRenewTo'];
    $cntractEndingFrom = $_POST['cntractEndingFrom'];
    $cntractEndingTo = $_POST['cntractEndingTo'];
    
    
    
    if($customer==='Blank'){
        $customer = null;
    }
    if($serviceplan==='Blank'){
       $serviceplan = null;
    }
    if($productmodel==='Blank'){
        $productmodel = null;
    }
    
    
    if(empty($billingcycle)){
       $billingcycle = null;
    }
    
    if(empty($cntractRenewFrom)){
      $cntractRenewFrom= null; 
    }
    
    if(empty($cntractRenewTo)){
      $cntractRenewTo = null; 
    }
    
    if(empty( $cntractEndingFrom )){
        $cntractEndingFrom = null; 
    }
    
    if(empty( $cntractEndingTo)){
       $cntractEndingTo = null; 
    }
   
   
    echo $billingcycle;
    $sql= $conn->prepare('SELECT DISTINCT productmodel.prodmodelid,productmodelmaster.productmodelname,productmodel.invNum FROM customers LEFT JOIN invoices ON customers.frstInv=invoices.frstInv LEFT JOIN productmodel ON productmodel.invNum=invoices.invNum LEFT JOIN productmodelmaster ON productmodel.productmodel=productmodelmaster.productmodelid WHERE (? IS NULL OR (customers.frstInv = ?))  AND (? IS NULL OR (productmodel.productmodel = ?)) AND (? IS NULL OR (productmodel.serviceplan = ?)) AND (? IS NULL OR (productmodel.billingcycle = ?)) AND (? IS NULL OR (productmodel.renewalDate >= STR_TO_DATE(?,"%m/%d/%Y"))) AND (? IS NULL OR (productmodel.renewalDate <= STR_TO_DATE(?,"%m/%d/%Y"))) AND (? IS NULL OR (productmodel.endingDate >= STR_TO_DATE(?,"%m/%d/%Y"))) AND (? IS NULL OR (productmodel.endingDate <= STR_TO_DATE(?,"%m/%d/%Y"))) AND invoices.status="Service Assigned"');
    $sql->bind_param('ssiiiissssssssss',$customer,$customer,$productmodel,$productmodel,$serviceplan,$serviceplan,$billingcycle,$billingcycle,$cntractRenewFrom,$cntractRenewFrom,$cntractRenewTo,$cntractRenewTo,$cntractEndingFrom,$cntractEndingFrom,$cntractEndingTo,$cntractEndingTo);
    
  
    if($sql->execute()){
         $sql->bind_result($productmodelnumbers,$productmodelnames,$invoicenumber);
        echo '<option value="Blank"><--Select--></option>';
        $x=0;
        while($sql->fetch()){
             echo '<option value="'.$productmodelnumbers.'">'.$invoicenumber." - ".$productmodelnames.'</option>';
             $x++;
             
        }
        if($x<1){
            echo 'none';
        }
    }
    else{
        echo 'failed';
    }
    
   
    mysqli_close($conn);
?>