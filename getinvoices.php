<?php

/* 
 * get all invoices based on invoice type and customer
 */
    require 'dbConfig.php';
    $cust=$_POST["frstInv"];
    $invType = $_POST['invType'];
    
    $sql= $conn->prepare('SELECT invNum FROM invoices WHERE frstInv=? AND invType=?');
    $sql->bind_param('ss',$cust,$invType);
    $sql->execute();
    $sql->bind_result($invNum);
    echo '<option value="Blank"><--Select--></option>';
    while($sql->fetch()){
        echo '<option value="'.$invNum.'">'.$invNum.'</option>';
        
    }
   
    mysqli_close($conn);
?>