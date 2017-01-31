<?php

/* 
 * script to update platform
 */
    require '../dbConfig.php';
    
    $platformname=$_POST["platformname"];
    $platformid=$_POST["platformid"];
    
    $sql1 = $conn->prepare('SELECT platformname FROM serviceplatform WHERE platformname = ? AND platformid !=?');
    $sql1->bind_param('si',$platformname,$platformid);
    
    if($sql1->execute()){
         $sql1->store_result();
          if($sql1->num_rows()>0){
              echo 'exists';
          }
          else{
               $sql= $conn->prepare('UPDATE serviceplatform SET platformname=? WHERE platformid=?');
                $sql->bind_param('si',$platformname,$platformid);  
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