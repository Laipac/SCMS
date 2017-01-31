<?php
/* 
 * checks user authorizations
 */

session_start();
require 'dbConfig.php';

$username = $_SESSION['username'];

//$resource='Service Platform';
//$activity ='searchauth';
$activity = $_POST['activity'];


  

$sql10 = $conn->prepare('SELECT roles.roleid FROM members INNER JOIN roles ON members.usertype=roles.rolename WHERE members.username = ?');
$sql10->bind_param('s',$username);

if($sql10->execute()){
    $sql10->store_result();
    $sql10->bind_result($usertype);
    $sql10->fetch();
    $sql = $conn->prepare('SELECT '.$activity.' FROM userauth WHERE usertype=?');
  
    $sql->bind_param('i',$usertype);
    
    if($sql->execute()){
        $sql->bind_result($userauth);
        $sql->fetch();
        echo $userauth;
    }
    else{
        echo 'failed';
    }

  
  
}
else{
    echo 'failed';
}

    mysqli_close($conn);
?>