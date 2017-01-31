<?php
/* 
 * script adds invoices to database
 */
    require 'dbConfig.php';
    
    $invNum=$_POST["invNum"];
    $frstInv=$_POST["frstInv"];
    $salesChannel=$_POST["salesChannel"];
    $customerPO=$_POST["customerPO"];
    $status=$_POST["status"];
    $invType=$_POST["invType"];
    $sql10 = $conn->prepare('SELECT invNum FROM invoices WHERE invNum = ?');
    $sql10->bind_param('i',$invNum);
    if($sql10->execute()){
          $sql10->store_result();
         if($sql10->num_rows()>0){
            echo 'exists';
         }
         else{
                $sql= $conn->prepare('INSERT INTO invoices (invNum,frstInv,salesChannel,customerPO,status,invType) VALUES (?,?,?,?,?,?)');
                $sql->bind_param('isssss',$invNum,$frstInv,$salesChannel,$customerPO,$status,$invType);
                if($sql->execute()){
                    echo 'success';
                }
                else{
                    echo 'failed';
                }
         }
    }
    else{
        echo 'failed';
    }
    mysqli_close($conn);
?>