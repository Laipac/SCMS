<?php

/* 
 * script to update sales channel
 */
    require '../dbConfig.php';
    
    $channelname=$_POST["platformname"];
    $channelid=$_POST["platformid"];
    
    $sql1 = $conn->prepare('SELECT channelname FROM saleschannel WHERE channelname = ? AND channelid != ?');
    $sql1->bind_param('si',$channelname,$channelid);
    if($sql1->execute()){
        $sql1->store_result();
        if($sql1->num_rows()>0){
              echo 'exists';
        }
        else{
             $sql= $conn->prepare('UPDATE saleschannel SET channelname=? WHERE channelid=?');
              $sql->bind_param('si',$channelname,$channelid);  
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