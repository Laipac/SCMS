<?php

/* 
 * gets all linked customer details and invoice details based on product model
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST["productmodel"];
   //$custNum="LP123123";
    $sql= $conn->prepare('SELECT invoices.invType,customers.cmpnyName,customers.divName,customers.indivName,customers.country,customers.city,customers.address,customers.platform,customers.cntactName,customers.cntactPhone,customers.cntactEmail,customers.serviceBillTo,invoices.invNum,customers.frstInv FROM productmodel INNER JOIN invoices on productmodel.invNum=invoices.invNum INNER JOIN customers ON customers.frstInv=invoices.frstInv WHERE productmodel.prodmodelid = ?');
    $sql->bind_param('i',$productmodel);
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
          $results = array(
           'invType' => ($row[0]),
           'cmpnyName' => ($row[1]),
           'divName' => ($row[2]),
           'indivName' => ($row[3]),
           'country' => ($row[4]),
           'city' => ($row[5]),
           'address' => ($row[6]),
           'platform' => ($row[7]),
           'cntactName' => ($row[8]),
           'cntactPhone' => ($row[9]),
           'cntactEmail' => ($row[10]),
           'serviceBillTo' => ($row[11]),
            'invNum' => ($row[12]),
            'frstInv' => ($row[13])
        );
        echo json_encode($results);
    
    }
    else
    {
        echo 'failed';
    }
   
    mysqli_close($conn);
?>