<?php

/* 
 * This module retrieves product model details based on invoice number
 */
    require 'dbConfig.php';
    
   
   //$custNum="LP123123";
    $invNum=$_POST["invNum"];
    $invType=$_POST['invType'];
    if($invType==='SIM'){
        $sql= $conn->prepare('SELECT productmodel.quantityofsim,productmodel.serviceplan,productmodel.notes,productmodel.prodmodelid,productmodel.productmodel FROM productmodel WHERE productmodel.invNum= ?');
    }
    else if($invType==='Service Renew'){
        $sql= $conn->prepare('SELECT productmodel.quantity,productmodel.quantityofsim,productmodel.notes,productmodel.serviceplan,productmodel.billingcycle,productmodel.startDate,productmodel.renewalDate,productmodel.endingDate,productmodel.prodmodelid,productmodel.productmodel FROM productmodel WHERE productmodel.invNum= ?');
        
    }
    else {
        $sql= $conn->prepare('SELECT productmodel.quantity,productmodel.quantityofsim,productmodel.notes,productmodel.serviceplan,productmodel.billingcycle,productmodel.startDate,productmodel.renewalDate,productmodel.endingDate,productmodel.prodmodelid,productmodel.productmodel FROM productmodel WHERE productmodel.invNum= ?');
    }   
    $sql->bind_param('i',$invNum);
    $sql->execute(); 
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else{
        while(($row = mysqli_fetch_row($result))){
            if($invType==='SIM'){
                  $results[] = array(
                'quantityofsim' => ($row[0]),
               'serviceplan' => ($row[1]),
               'notes' => ($row[2]),
               'prodid' => ($row[3]),
               'productmodel' => ($row[4])       
              );
            }
            else{
                  $results[] =array(
               'quantity' => ($row[0]),
                'quantityofsim' => ($row[1]),
                'notes' =>($row[2]),
               'serviceplan' => ($row[3]),
               'billingcycle' => ($row[4]),
                'startDate' => ($row[5]),
               'renewalDate' => ($row[6]),
               'endingDate' => ($row[7]),
               'prodid' => ($row[8]),
               'productmodel' => ($row[9])    

              );
            }
            
        }
        echo json_encode($results);
    }
   
    mysqli_close($conn);
?>