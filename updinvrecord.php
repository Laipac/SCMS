<?php

/* 
 * this module is for updating invoices
 */
    require 'dbConfig.php';
    
    $invNum=$_POST["invNum"];
    $status=$_POST["status"];
    $salesChannel=$_POST["salesChannel"];
    $customerPO=$_POST["customerPO"];
    //$submitDate=$_POST["submitDate"];
     $submitDate="";
    $invType=$_POST["invType"];
    if(!empty($submitDate)){
         $sql= $conn->prepare('UPDATE invoices SET salesChannel=?,customerPO=?,status=?,submitDate = STR_TO_DATE(?,"%m/%d/%Y") WHERE invNum=? AND invType=?');
    }
    else{
         $sql= $conn->prepare('UPDATE invoices SET salesChannel=?,customerPO=?,status=?,submitDate=? WHERE invNum=? AND invType=?');
    }   
    $sql->bind_param('ssssis',$salesChannel,$customerPO,$status,$submitDate,$invNum,$invType);  
    if($sql->execute()){
        echo 'success';
      //  die('There was an error running the query [' . $conn->error . ']');
    }
    else{
        echo 'failed';
    }
    
    mysqli_close($conn);
?>