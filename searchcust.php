<?php

/* 
 * searches customer based on customer  number
 */
    require 'dbConfig.php';
    
    $custNum=$_POST["searchval"];
   //$custNum="LP123123";
    $sql= $conn->prepare('SELECT frstInv,cmpnyName,divName,indivName,country,city,address,platform,cntactName,cntactPhone,cntactEmail,serviceBillTo,customercode,custId FROM customers WHERE cmpnyName = ?');
    $sql->bind_param('s',$custNum);
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        echo 'failed';
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
       $results = array(
           'frstInv' => ($row[0]),
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
           'customercode' => ($row[12]),
           'customerid' =>($row[13])
       );
       
        echo json_encode($results);
      
    }
    else
    {
        echo 'failed';
    }
    mysqli_close($conn);
?>