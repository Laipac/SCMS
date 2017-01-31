<?php

/* 
 * script to update product model
 */
    require '../dbConfig.php';
    
    $productmodelname=$_POST["productmodelname"];
    $productmodelid=$_POST["productmodelid"];
    $sql1 = $conn->prepare('SELECT productmodelname FROM productmodelmaster WHERE productmodelname = ? AND productmodelid != ?');
    $sql1->bind_param('si',$productmodelname,$productmodelid);
    if($sql1->execute()){
        $sql1->store_result();
        if($sql1->num_rows()>0){
            echo 'exists';
        }
        else{
            $sql= $conn->prepare('UPDATE productmodelmaster SET productmodelname=? WHERE productmodelid=?');
            $sql->bind_param('si',$productmodelname,$productmodelid);  
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