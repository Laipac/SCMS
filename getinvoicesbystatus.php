<?php

/* 
 * get invoices based on status and customer number
 */
    require 'dbConfig.php';
    $cust=$_POST["frstInv"];
    $invType = $_POST['invType'];
    $status=$_POST['status'];
    
    $sql= $conn->prepare('SELECT invNum FROM invoices WHERE frstInv=? AND invType=? AND status=?');
    $sql->bind_param('sss',$cust,$invType,$status);
    $sql->execute();
    $sql->bind_result($invNum);
    echo '<option value="Blank"><--Select--></option>';
    while($sql->fetch()){
        echo '<option value="'.$invNum.'">'.$invNum.'</option>';
        
    }
   
    mysqli_close($conn);
?>