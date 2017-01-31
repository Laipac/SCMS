<?php

/* 
 * get sim details based on sim number and simgroup
 */
    require 'dbConfig.php';
    
    $simnumber=$_POST["simnumber"];
    $simgroup=$_POST["simgroup"];
    
    if($simgroup===""){
        $sql= $conn->prepare('SELECT sim.telnumber,sim.beforedate,sim.activationstatus,sim.activationdate,sim.inventorystatus,sim.storagelocation,sim.imei,sim.locatorid,sim.locatorname,productmodelmaster.productmodelname,simcardmaster.simtype FROM sim INNER JOIN simcardmaster ON simcardmaster.simid=sim.simgroup INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=sim.prodmodelid WHERE sim.simnumber = ?');
        $sql->bind_param('i',$simnumber);
    }
    else{
       $sql= $conn->prepare('SELECT sim.telnumber,sim.beforedate,sim.activationstatus,sim.activationdate,sim.inventorystatus,sim.storagelocation,sim.imei,sim.prodmodelid FROM sim WHERE simnumber = ? AND simgroup = ?');
     $sql->bind_param('ii',$simnumber,$simgroup);
    }
    
    $sql->execute();
    
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
        
        $results = array(
        'telnumber' => ($row[0]),
        'beforedate' => ($row[1]),
        'activationstatus' => ($row[2]),
        'activationdate' => ($row[3]),
        'inventorystatus' => ($row[4]),
        'storagelocation' => ($row[5]),
        'imei' => ($row[6]),
        'locatorid' => ($row[7]),
        'locatorname' => ($row[8]),
        'productmodel' => ($row[9]),
        'simtype' => ($row[10])
       );
        echo json_encode($results);
    }
    else
    {
        echo 'failed';
    }
    mysqli_close($conn);
?>