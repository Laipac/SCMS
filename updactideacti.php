<?php

/* 
 * this module is for activation and deactivation of sim
 */
    require 'dbConfig.php';
    
    $simnumber=$_POST["simnumber"];
    $simgroup=$_POST["simgroup"];
    $simaction=$_POST["simaction"];
    $telnumber=$_POST["telnumber"];
    $activationdate=$_POST["activationdate"];
    
    if($simaction==='Activate'){
         $sql= $conn->prepare('UPDATE sim SET telnumber=?,activationdate=STR_TO_DATE(?,"%m/%d/%Y"),activationstatus="Active" WHERE simnumber=? AND simgroup=?');
    }
    else{
         $sql= $conn->prepare('UPDATE sim SET telnumber=?,deactivationdate=STR_TO_DATE(?,"%m/%d/%Y"),activationstatus="Inactive" WHERE simnumber=? AND simgroup=?');
    }    
   
    $sql->bind_param('isii',$telnumber,$activationdate,$simnumber,$simgroup);  
    if($sql->execute()){
        echo 'success';
      //  die('There was an error running the query [' . $conn->error . ']');
    }
    else{
        echo 'failed';
    }
    mysqli_close($conn);
?>