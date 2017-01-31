<?php

/* 
 * retrieves product model based on sim number
 */
    require 'dbConfig.php';
    
    $searchval=$_POST["searchval"];
   //$custNum="LP123123";
    $sql= $conn->prepare('SELECT simnumber FROM sim WHERE simnumber = ?');
    $sql->bind_param('i',$searchval);
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
      $simnumber = $row[0];
     
      $sql1 = $conn->prepare('SELECT productmodelinv FROM productmodelimei WHERE imei=?');
      $sql1->bind_param('i',$imei);
      $sql1->execute();
      if(!$result1 = $sql1->get_result()){
         die('There was an error running the query [' . $conn->error . ']'); 
      }
      else if(($row1 = mysqli_fetch_row($result1)) > 0){
          $productmodel=$row1[0];
           echo $productmodel;
      }
      else{
           $sql2 = $conn->prepare('SELECT productmodelinv FROM productmodelsim WHERE simnumber=?');
           $sql2->bind_param('i',$simnumber);
           $sql2->execute();
           if(!$result2= $sql2->get_result()){
                die('There was an error running the query [' . $conn->error . ']'); 
           }
           else if(($row2 = mysqli_fetch_row($result2)) > 0){
                $productmodel=$row2[0];
                 echo $productmodel;
           }
           else{
               echo 'failed';
           }
      }
    }
    else
    {
        echo 'failed';
    }
   
    mysqli_close($conn);
?>