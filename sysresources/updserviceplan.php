<?php

/* 
 * script to update service plans
 */
    require '../dbConfig.php';
    
    $planid=$_POST["planid"];
    $plantype=$_POST["plantype"];
    $planrate=$_POST["planrate"];
    $simcardtype = $_POST['simcardtype'];
    $plancurrency=$_POST["plancurrency"];
  
  
    
    $sql1 = $conn->prepare('SELECT plantype FROM serviceplan WHERE plantype = ? AND simcardtype=?');
    $sql1->bind_param('si',$plantype,$planid);
    if($sql1->execute()){
        $sql1->store_result();
         if($sql1->num_rows()>0){
            echo 'exists';
         }
         else{
            $sql= $conn->prepare('UPDATE serviceplan SET plantype=?,planrate=?,plancurrency=?,simcardtype=? WHERE planid=?');
            $sql->bind_param('sssii',$plantype,$planrate,$plancurrency,$simcardtype,$planid);  
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