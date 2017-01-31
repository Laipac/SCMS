<?php

/* 
 * get user authorization
 */
    require 'dbConfig.php';
    
   // $userRole=$_POST["userrole"];
    
    //$userRole=1;
    
    $sql= $conn->prepare('SELECT searchauth,createauth,editauth FROM userauth WHERE usertype = 3');
   
    $sql->execute();
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
        
        $results = array(
           'usersearch' => ($row[0]),
           'usercreate' => ($row[1]),
           'useredit' => ($row[2])
        );  
    }
    else
    {
        echo 'failed';
    }
    $sql1= $conn->prepare('SELECT searchauth,createauth,editauth FROM userauth WHERE usertype = 4');
   
    $sql1->execute();
    if(!$result1 = $sql1->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row1 = mysqli_fetch_row($result1)) > 0){
        
        $results['customersearch'] = $row1[0];
        $results['customercreate']=$row1[1];
        $results['customeredit']=$row1[2];
        
    }
    else
    {
        echo 'failed';
    }
    
    echo json_encode($results);
   // print_r($results);
    mysqli_close($conn);
?>