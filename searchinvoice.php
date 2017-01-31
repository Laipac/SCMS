<?php

/* 
 * check if invoice number is existing
 */
    require 'dbConfig.php';
    
    $invNum=$_POST["invNum"];
       
    $sql= $conn->prepare('SELECT invNum FROM invoices WHERE invNum = ?');
    $sql->bind_param('i',$invNum);
    $sql->execute();
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
        echo 'success';
    }
    else{
        
        echo 'failed'; 
    }
    mysqli_close($conn);
?>