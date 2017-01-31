<?php

/* 
 * script that adds platform admin to database
 */
    require '../dbConfig.php';
    
    $platformadmin=$_POST["platformadmin"];
    $platformid=$_POST['platformid'];
    
    $sql1 = $conn->prepare('SELECT platformadmin FROM platformadmin WHERE platformadmin=? AND serviceplatform = ?');
    $sql1->bind_param('si',$platformadmin,$platformid);
    if($sql1->execute()){
          $sql1->store_result();
         if($sql1->num_rows()>0){
            echo 'exists';
         }
         else{
             $sql= $conn->prepare('INSERT INTO platformadmin (platformadmin,serviceplatform) VALUES (?,?)');
            $sql->bind_param('si',$platformadmin,$platformid);
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