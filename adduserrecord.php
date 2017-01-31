<?php
/* 
 * add user details to database
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
    $sql1 = $conn->prepare('SELECT username FROM members WHERE username = ?');
    $sql1->bind_param('s',$username);
    if($sql1->execute()){
        $sql1->store_result();
        if($sql1->num_rows()>0){
             echo 'exists';
        }
        else{
            
            $sql= $conn->prepare('INSERT INTO members (username,pw,userfname,userlname,phone,mobilephone,email,country,province,city,street,zip,usertype,company) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $sql->bind_param('sssssssssssiss',$username,$hashToStoreInDb,$userfname,$userlname,$userphone,$usermobile,$useremail,$usercountry,$userprovince,$usercity,$userstreet,$userzip,$usertype,$usercompany);

            if($sql->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
        }
    }
    else{
         echo $conn->error();
    }
    
    mysqli_close($conn);
?>