<?php

/* 
 * search user based on user name. retrieves user details for display
 */
    require 'dbConfig.php';
    
    $username=$_POST["username"];
   //$custNum="LP123123";
    $sql= $conn->prepare('SELECT userfname,userlname,phone,mobilephone,city,email,country,province,street,zip,usertype,company FROM members WHERE  username= ?');
    $sql->bind_param('s',$username);
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
       $results = array(
           'userfname' => ($row[0]),
            'userlname' => ($row[1]),
           'phone' => ($row[2]),
           'mobilephone' => ($row[3]),
            'city' => ($row[4]),
            'email' => ($row[5]),
           'country' => ($row[6]),
           'province' => ($row[7]),
           'street' => ($row[8]),
           'zip' => ($row[9]),
           'usertype' => ($row[10]),
           'company' => ($row[11])
       );
       
        echo json_encode($results);
      
    }
    else
    {
        echo 'failed';
    }
    mysqli_close($conn);
?>