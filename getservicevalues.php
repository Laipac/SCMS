<?php

/* 
 * get product model details
 */
    require 'dbConfig.php';
    
   $productmodel=$_POST['productmodel'];
    
    $sql= $conn->prepare('SELECT productmodel.serviceplan,productmodel.billingcycle,productmodel.renewalDate,productmodel.endingDate FROM productmodel WHERE productmodel.prodmodelid= ?');
       
    $sql->bind_param('i',$productmodel);
    $sql->execute(); 
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else{
        while(($row = mysqli_fetch_row($result))){
          
            $results =array(
        
         'serviceplan' => ($row[0]),
         'billingcycle' => ($row[1]),
         
         'renewalDate' => ($row[2]),
         'endingDate' => ($row[3])
        

              );
        }
        echo json_encode($results);
    }
   
    mysqli_close($conn);
?>