<?php

/* 
 * set user authorizations based on user group
 */
    require 'dbConfig.php';
    
    $usersearch = $_POST['usersearch'];
    $usercreate = $_POST['usercreate'];
    $useredit = $_POST['useredit'];
    $customersearch = $_POST['customersearch'];
    $customercreate = $_POST['customercreate'];
    $customeredit = $_POST['customeredit'];
    
    
    if($usersearch==='true'){
        $usersearch=1;
    }
    else{
        $usersearch=0;
    }
    if($usercreate==='true'){
        $usercreate=1;
    }
    else{
        $usercreate=0;
    }
    if($useredit==='true'){
        $useredit=1;
    }
    else{
        $useredit=0;
    }
    
    
    if($customersearch==='true'){
        $customersearch=1;
    }
    else{
        $customersearch=0;
    }
    if($customercreate==='true'){
        $customercreate=1;
    }
    else{
        $customercreate=0;
    }
    if($customeredit==='true'){
        $customeredit=1;
    }
    else{
        $customeredit=0;
    }
    
    
    $sql= $conn->prepare('UPDATE userauth SET searchauth=?,createauth=?,editauth=? WHERE usertype=3');
    $sql->bind_param('iii',$usersearch,$usercreate,$useredit);
    if($sql->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
    $sql1= $conn->prepare('UPDATE userauth SET searchauth=?,createauth=?,editauth=? WHERE usertype=4');
    $sql1->bind_param('iii',$customersearch,$customercreate,$customeredit);
    if($sql1->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
   
    mysqli_close($conn);
?>