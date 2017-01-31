<?php

/* 
 * script to update platform admin
 */
    require '../dbConfig.php';
    
    $platformadmin=$_POST["platformadmin"];
    $platformid=$_POST['platformid'];
    $platformname=$_POST['platformname'];
    
    
    $sql1 = $conn->prepare('SELECT platformadmin FROM platformadmin WHERE (platformadmin = ? AND serviceplatform = ?) AND platformadminid != ?');
    $sql1->bind_param('sii',$platformadmin,$platformname,$platformid);
    if($sql1->execute()){
         $sql1->store_result();
         if($sql1->num_rows()>0){
            echo 'exists';
         }
         else{
             $sql= $conn->prepare('UPDATE platformadmin SET platformadmin=?,serviceplatform=? WHERE platformadminid=?');
            $sql->bind_param('sii',$platformadmin,$platformname,$platformid);
            if($sql->execute()){
                echo 'success';

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