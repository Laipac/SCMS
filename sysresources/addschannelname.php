<?php

/* 
 * script that adds sales channel to database
 */
    require '../dbConfig.php';
    
    $channelname=$_POST["channelname"];
    $sql1 = $conn->prepare('SELECT channelname FROM saleschannel WHERE channelname = ?');
    $sql1->bind_param('s',$channelname);
    if($sql1->execute()){
         $sql1->store_result();
         if($sql1->num_rows()>0){
            echo 'exists';
         }
         else{
               $sql= $conn->prepare('INSERT INTO saleschannel (channelname) VALUES (?)');
                $sql->bind_param('s',$channelname);
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