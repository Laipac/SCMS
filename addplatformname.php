<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    require '../dbConfig.php';
    
    $platformname=$_POST["platformname"];
       
    $sql= $conn->prepare('INSERT INTO serviceplatform (platformname) VALUES (?)');
    $sql->bind_param('s',$platformname);
    if($sql->execute()){
        echo 'success';
    
    }
    else{
        echo 'failed';
    }
    mysqli_close($conn);
?>