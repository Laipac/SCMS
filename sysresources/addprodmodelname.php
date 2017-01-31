<?php

/* 
 * script that adds product model to database
 */
    require '../dbConfig.php';
    
    $productmodelname=$_POST["productmodelname"];
    $sql1 = $conn->prepare('SELECT productmodelname FROM productmodelmaster WHERE productmodelname = ?');
    $sql1->bind_param('s',$productmodelname);
    if($sql1->execute()){
        $sql1->store_result();
        if($sql1->num_rows()>0){
            echo 'exists';
        }
        else{
            $sql= $conn->prepare('INSERT INTO productmodelmaster (productmodelname) VALUES (?)');
            $sql->bind_param('s',$productmodelname);
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