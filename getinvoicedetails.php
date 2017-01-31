<?php

/* 
 * get invoice details
 */
    require 'dbConfig.php';
    
    $invNum=$_POST["invNum"];
   
    $sql= $conn->prepare('SELECT salesChannel,customerPO,status,submitDate,invType FROM invoices WHERE invNum = ?');
    $sql->bind_param('i',$invNum);
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
        
        $results = array(
           'salesChannel' => ($row[0]),
           'customerPO' => ($row[1]),
           'status' => ($row[2]),
           'submitDate' => ($row[3]),
            'invType' => ($row[4])
           
        );
        echo json_encode($results);
      
    }
    else
    {
        echo 'failed';
    }
    mysqli_close($conn);
?>