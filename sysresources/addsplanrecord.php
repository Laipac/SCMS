<?php

/* 
 * script that add service plans
 */
    require '../dbConfig.php';
   
    $plantype=$_POST['plantype'];
    $planrate=$_POST['planrate'];
    $plancurrency=$_POST['plancurrency'];
    $simcardtype = $_POST['simcardtype'];
  
    $sql1 = $conn->prepare('SELECT plantype FROM serviceplan WHERE plantype=? AND simcardtype = ?');
    $sql1->bind_param('si',$plantype,$simcardtype);
    if($sql1->execute()){
        $sql1->store_result();
         if($sql1->num_rows()>0){
            echo 'exists';
         }
         else{
            $sql= $conn->prepare('INSERT INTO serviceplan (plantype,planrate,plancurrency,simcardtype) VALUES (?,?,?,?)');
            $sql->bind_param('sssi',$plantype,$planrate,$plancurrency,$simcardtype);
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