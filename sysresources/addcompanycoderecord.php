<?php

/* 
 * script that adds company code to database
 */
    require '../dbConfig.php';
    
    $platformname=$_POST["platformname"];
    $companyname=$_POST['companyname'];
    $sql1 = $conn->prepare('SELECT customercode FROM customercode WHERE customercode = ? AND customername = ?');
    $sql1->bind_param('ss',$platformname,$companyname);
    if($sql1->execute()){
         $sql1->store_result();
          if($sql1->num_rows()>0){
              echo 'exists';
          }
          else{
            $sql= $conn->prepare('INSERT INTO customercode (customercode,customername) VALUES (?,?)');
            $sql->bind_param('ss',$platformname,$companyname);
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