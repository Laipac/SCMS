<?php

/* 
 * This module is for updating product models
 */
    require 'dbConfig.php';
    $productmodel=$_POST["productmodel"];
    $cntractRenew=$_POST['cntractRenew'];
    $cntractEnd=$_POST["cntractEnd"];
    $notes=$_POST["notes"];
    $billcycle=$_POST["billcycle"];
    $serviceplan=$_POST['serviceplan'];
    
    
    $sql= $conn->prepare('UPDATE productmodel SET billingcycle=?,serviceplan=?,renewalDate=STR_TO_DATE(?,"%m/%d/%Y"),endingDate=STR_TO_DATE(?,"%m/%d/%Y"),notes=? WHERE prodmodelid=?');
    $sql->bind_param('sisssi',$billcycle,$serviceplan,$cntractRenew,$cntractEnd,$notes,$productmodel);
    if($sql->execute()){
        echo 'success';
    }
    else{
        echo 'failed';

    }
     
    mysqli_close($conn);
?>