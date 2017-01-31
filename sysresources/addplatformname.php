<?php

/* 
 * script that adds platform to database
 */
    require '../dbConfig.php';
    
    $platformname=$_POST["platformname"];
    
    
    
    $sql1 = $conn->prepare('SELECT platformname FROM serviceplatform WHERE platformname = ?');
    $sql1->bind_param('s',$platformname);
    if($sql1->execute()){
         $sql1->store_result();
          if($sql1->num_rows()>0){
              echo 'exists';
          }
          else {
               $sql= $conn->prepare('INSERT INTO serviceplatform (platformname) VALUES (?)');
                $sql->bind_param('s',$platformname);
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