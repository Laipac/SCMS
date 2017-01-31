<?php

/* 
 * update sim details
 */
    require 'dbConfig.php';
    
    $simnumber=$_POST["simnumber"];
    $simgroup=$_POST["simgroup"];
    $beforedate=$_POST["beforedate"];
    $telnumber=$_POST["telnumber"];
    $activationdate=$_POST["activationdate"];
    $activationstatus=$_POST["activationstatus"];
    $inventorystatus=$_POST["inventorystatus"];
    $deactivationdate=$_POST["deactivationdate"];
    $storagelocation=$_POST["storagelocation"];
    $imei=$_POST["imei"];
    $productmodel=$_POST["productmodel"];
    
    $sql= $conn->prepare('UPDATE sim SET beforedate=STR_TO_DATE(?,"%m/%d/%Y"),telnumber=?,activationdate=STR_TO_DATE(?,"%m/%d/%Y"),activationstatus=?,inventorystatus=?,deactivationdate=STR_TO_DATE(?,"%m/%d/%Y"),storagelocation=?,imei=?,prodmodelid=? WHERE simnumber=? AND simgroup=?');
    
    $sql->bind_param('sisssssiiii',$beforedate,$telnumber,$activationdate,$activationstatus,$inventorystatus,$deactivationdate,$storagelocation,$imei,$productmodel,$simnumber,$simgroup);  
    if($sql->execute()){
        echo 'success';
      //  die('There was an error running the query [' . $conn->error . ']');
    }
    else{
        echo 'failed';
    }
    mysqli_close($conn);
?>