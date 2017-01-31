<?php
/* 
 * add sim to database
 */
    require 'dbConfig.php';
    
    $simgroup=$_POST["simgroup"];
    $simnumber=$_POST["simnumber"];
    $telnumber=$_POST["telnumber"];
    $beforedate=$_POST["beforedate"];
    $activationstatus=$_POST["activationstatus"];
    $activationdate=$_POST["activationdate"];
    $storagelocation=$_POST["storagelocation"];
    $inventorystatus=$_POST["inventorystatus"];
    $imei=$_POST["imei"];
    $prodmodelid=$_POST["prodmodelid"];
    
    
    
    $sql10 = $conn->prepare('SELECT simnumber FROM sim WHERE simnumber = ?');
    $sql10->bind_param('i',$simnumber);
    if($sql10->execute()){
        $sql10->store_result();
        if($sql10->num_rows()>0){
           echo 'exists';
        }
        else{
            $sql= $conn->prepare('INSERT INTO sim (simgroup,simnumber,telnumber,beforedate,activationstatus,activationdate,inventorystatus,storagelocation,imei,prodmodelid) VALUES (?,?,?,STR_TO_DATE(?,"%m/%d/%Y"),?,STR_TO_DATE(?,"%m/%d/%Y"),?,?,?,?)');
            $sql->bind_param('iiisssssii',$simgroup,$simnumber,$telnumber,$beforedate,$activationstatus,$activationdate,$inventorystatus,$storagelocation,$imei,$prodmodelid);

            if($sql->execute()){
                echo 'success';
              //  die('There was an error running the query [' . $conn->error . ']');
            }
            else{
                echo 'failed';
            }
        }
    
    }
    else{
        echo 'failed';
    }
    
    mysqli_close($conn);
?>