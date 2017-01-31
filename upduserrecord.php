<?php

/* 
 * update user details
 */
    require 'dbConfig.php';
    $usertype = $_POST['usertype'];
    $userfname=$_POST["userfname"];
    $userlname=$_POST["userlname"];
    $username=$_POST["username"];
    $userpass=$_POST["userpass"];
    $useremail=$_POST['useremail'];
    $usercompany=$_POST['usercompany'];
    $userphone = $_POST['userphone'];
    $usermobile = $_POST['usermobile'];
    $usercountry = $_POST['usercountry'];
    $userprovince = $_POST['userprovince'];
    $usercity = $_POST['usercity'];
    $userstreet = $_POST['userstreet'];
    $userzip = $_POST['userzip'];
    
    $hashToStoreInDb = password_hash($userpass, PASSWORD_DEFAULT);
    
    $sql= $conn->prepare('UPDATE members SET pw=?,userfname=?,userlname=?,phone=?,mobilephone=?,email=?,country=?,province=?,city=?,street=?,zip=?,usertype=?,company=? WHERE username = ?');
    $sql->bind_param('ssssssssssisss',$hashToStoreInDb,$userfname,$userlname,$userphone,$usermobile,$useremail,$usercountry,$userprovince,$usercity,$userstreet,$userzip,$usertype,$usercompany,$username);
    
    if($sql->execute()){
         echo 'success'; 
    }
    else{
       echo $conn->error();
    }
    mysqli_close($conn);
?>