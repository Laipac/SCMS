<?php

/* 
 * script that adds sim type to database
 */
    require '../dbConfig.php';
    
    $simtype=$_POST['simtype'];
    $simprovider=$_POST['simprovider'];
    $simrate=$_POST['simrate'];
    $simcurrency=$_POST['simcurrency'];
    $simbilling=$_POST['simbilling'];
    //$simplan=$_POST['simplan'];
    $simnoteplan=$_POST['simnoteplan'];
    $simsize=$_POST['simsize'];
    $simonline=$_POST['simonline'];
    
    $sql1 = $conn->prepare('SELECT simtype FROM simcardmaster WHERE simtype = ?');
    $sql1->bind_param('s',$simtype);
    if($sql1->execute()){
        $sql1->store_result();
         if($sql1->num_rows()>0){
            echo 'exists';
         }
         else{
           // $sql= $conn->prepare('INSERT INTO simcardmaster (simtype,simprovider,simrate,simcurrency,simbilling,simplan,simnoteplan,simsize,simonline) VALUES (?,?,?,?,?,?,?,?,?)');
           //  $sql->bind_param('ssssissss',$simtype,$simprovider,$simrate,$simcurrency,$simbilling,$simplan,$simnoteplan,$simsize,$simonline);
             
             
             $sql= $conn->prepare('INSERT INTO simcardmaster (simtype,simprovider,simrate,simcurrency,simbilling,simnoteplan,simsize,simonline) VALUES (?,?,?,?,?,?,?,?)');
           
             $sql->bind_param('ssssssss',$simtype,$simprovider,$simrate,$simcurrency,$simbilling,$simnoteplan,$simsize,$simonline);
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