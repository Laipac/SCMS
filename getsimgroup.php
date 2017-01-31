<?php

/* 
 * get sim group details
 */
    require 'dbConfig.php';
    
    $simtype=$_POST["simtype"];
    
    $sql= $conn->prepare('SELECT simcardmaster.simprovider,simcardmaster.simrate,simcardmaster.simcurrency,simcardmaster.simbilling,serviceplan.plantype,simcardmaster.simnoteplan,simcardmaster.simsize,simcardmaster.simonline FROM simcardmaster INNER JOIN serviceplan ON serviceplan.planid=simcardmaster.simplan WHERE simid = ?');
    $sql->bind_param('i',$simtype);
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
       
        $results = array(
        'simprovider' => ($row[0]),
        'simrate' => ($row[1]),
        'simcurrency' => ($row[2]),
        'simbilling' => ($row[3]),
        'simplan' => ($row[4]),
        'simnoteplan' => ($row[5]),
        'simsize' => ($row[6]),
        'simonline' => ($row[7])
       );
        echo json_encode($results);
    }
    else
    {
        echo 'failed';
    }
    mysqli_close($conn);
?>