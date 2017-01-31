<?php

/* 
 * This module retrieves invoice details based on invoice number and invoice type
 */
    require 'dbConfig.php';
    
    $invNum=$_POST["invNum"];
    $invType=$_POST["invType"];
   //$custNum="LP123123";
    $sql= $conn->prepare('SELECT salesChannel,customerPO,status,submitDate FROM invoices WHERE invNum = ? AND invType = ?');
    $sql->bind_param('is',$invNum,$invType);
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
        
        $results = array(
           'salesChannel' => ($row[0]),
           'customerPO' => ($row[1]),
           'status' => ($row[2]),
           'submitDate' => ($row[3])
           
        );
        echo json_encode($results);
      
    }
    else
    {
        echo 'failed';
    }
    mysqli_close($conn);
?>