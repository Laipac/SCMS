<?php

/* 
 * get usergroup function authorizations
 */
    require 'dbConfig.php';
    
    $userRole=$_POST["usertype"];
    
    //$userRole=1;
    
    $sql= $conn->prepare('SELECT accountsearch,accountcreate,accountedit,invoicefull,invoicesimfull,invoicesimcheck,invoiceproductfull,invoiceproductcheck,invoiceservicefull,invoiceservicecheck,invoicerenewfull,invoicerenewcheck,simfull,siminventory,simactivation,simdeactivation,simedit,servicemgmt,repindividual,repadmin,repplatform FROM functionauth WHERE usertype = ?');
    $sql->bind_param('i',$userRole);
    $sql->execute();
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
        
        $results = array(
           'accountsearch' => ($row[0]),
           'accountcreate' => ($row[1]),
           'accountedit' => ($row[2]),
           'invoicefull' => ($row[3]),
           'invoicesimfull' => ($row[4]),
            'invoicesimcheck' => ($row[5]),
            'invoiceproductfull' => ($row[6]),
            'invoiceproductcheck' => ($row[7]),
            'invoiceservicefull' => ($row[8]),
            'invoiceservicecheck' => ($row[9]),
            'invoicerenewfull' => ($row[10]),
            'invoicerenewcheck' => ($row[11]),
            'simfull' => ($row[12]),
            'siminventory' => ($row[13]),
            'simactivation' => ($row[14]),
            'simdeactivation' => ($row[15]),
            'simedit' => ($row[16]),
            'servicemgmt' => ($row[17]),
            'repindividual' => ($row[18]),
            'repadmin' => ($row[19]),
            'repplatform' => ($row[20])
        );  
    }
    else
    {
        echo 'failed';
    }
    
    echo json_encode($results);
   // print_r($results);
    mysqli_close($conn);
?>