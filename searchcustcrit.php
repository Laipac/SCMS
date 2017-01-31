<?php

/* 
 * retrieves customer details based on locator id, invoice number, sim number, imei, platform admin, platform user criteria
 */
    require 'dbConfig.php';

   $customer=$_POST["customer"];
    
    //$customer='123565';
    $platformadmin=$_POST['platformadmin'];
    $platformuser=$_POST['platformuser'];
    $locatorid= $_POST['locatorid'];
   $invoicenumber=$_POST['invoicenumber'];
    $simnumber=$_POST['simnumber'];
    $imeinumber=$_POST['imeinumber'];
   
    
    if(empty($customer)){
       $customer = null;
    }
    
    if(empty($platformadmin)){
       $platformadmin = null; 
    }
    
    if(empty($platformuser)){
       $platformuser = null; 
    }
    
    if(empty($locatorid)){
       $locatorid = null; 
    }
    
    if(empty($invoicenumber)){
       $invoicenumber = null; 
    }
    
    if(empty($simnumber)){
       $simnumber = null; 
    }
    
    if(empty($imeinumber)){
       $imeinumber = null; 
    }
    
    //$sql= $conn->prepare('SELECT customers.frstInv,customers.cmpnyName,customers.divName,customers.indivName,customers.country,customers.city,customers.address,customers.platform,customers.cntactName,customers.cntactPhone,customers.cntactEmail,customers.serviceBillTo,invoices.invNum,productmodel.prodmodelid FROM customers INNER JOIN invoices ON customers.frstInv=invoices.frstInv INNER JOIN productmodel ON productmodel.invNum=invoices.invNum INNER JOIN productmodelimei ON productmodel.prodmodelid=productmodelimei.productmodelinv INNER JOIN productmodelsim ON productmodelsim.productmodelinv=productmodel.prodmodelid INNER JOIN sim ON sim.simnumber=productmodelsim.simnumber WHERE (? IS NULL OR (customers.frstInv = ?)) AND (? IS NULL OR (invoices.platformadmin = ?)) AND (? IS NULL OR (invoices.platformuser = ?)) AND (? IS NULL OR (sim.locatorid = ?)) AND (? IS NULL OR (invoices.invNum = ?)) AND (? IS NULL OR (productmodelsim.simnumber = ?)) AND (? IS NULL OR (productmodelimei.imei = ?))');
   
    //left join takes everything if nothing matches, inner join only takes row that matches.
    $sql= $conn->prepare('SELECT customers.frstInv,customers.cmpnyName,customers.divName,customers.indivName,customers.country,customers.city,customers.address,customers.platform,customers.cntactName,customers.cntactPhone,customers.cntactEmail,customers.serviceBillTo,invoices.invNum,productmodel.prodmodelid FROM customers LEFT JOIN invoices ON customers.frstInv=invoices.frstInv LEFT JOIN productmodel ON productmodel.invNum=invoices.invNum LEFT JOIN productmodelimei ON productmodel.prodmodelid=productmodelimei.productmodelinv LEFT JOIN productmodelsim ON productmodelsim.productmodelinv=productmodel.prodmodelid LEFT JOIN sim ON sim.simnumber=productmodelsim.simnumber WHERE (? IS NULL OR (customers.frstInv = ?)) AND (? IS NULL OR (invoices.platformadmin = ?)) AND (? IS NULL OR (invoices.platformuser = ?)) AND (? IS NULL OR (sim.locatorid = ?)) AND (? IS NULL OR (invoices.invNum = ?)) AND (? IS NULL OR (productmodelsim.simnumber = ?)) AND (? IS NULL OR (productmodelimei.imei = ?))');
    
   
    $sql->bind_param('ssssssiiiiiiii',$customer,$customer,$platformadmin,$platformadmin,$platformuser,$platformuser,$locatorid,$locatorid,$invoicenumber,$invoicenumber,$simnumber,$simnumber,$imeinumber,$imeinumber);
    $sql->execute();
    
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else{ 
        
        while(($row = mysqli_fetch_row($result))){
            
            $results[] = array(
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
                'invoices' => ($row[12]),
                'productmodel' => ($row[13])
            );
        }
        if(empty($results)){
           
           echo 'failed';
        }
        else{
            
             echo json_encode($results);
        }
    }
    
    mysqli_close($conn);
?>