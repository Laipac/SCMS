<?php
/* 
 * This module edits customer details
 */
    require 'dbConfig.php';
    
    $frstInv=$_POST["frstInv"];
    $cmpnyName=$_POST["cmpnyName"];
    $divName=$_POST["divName"];
    $indivName=$_POST["indivName"];
    $country=$_POST["country"];
    $city=$_POST["city"];
    $address=$_POST["address"];
    $platform=$_POST["platform"];
    $cntactName=$_POST["cntactName"];
    $cntactPhone=$_POST["cntactPhone"];
    $cntactEmail=$_POST["cntactEmail"];
    $serviceBillTo=$_POST["serviceBillTo"];
    $customercode=$_POST['customercode'];
    $customerid = $_POST['customerid'];
    $sql1 = $conn->prepare('SELECT customercode,cmpnyName FROM customers WHERE customercode=? AND cmpnyName = ? AND custId != ?');
    $sql1->bind_param('isi',$customercode,$cmpnyName,$customerid);
    if($sql1->execute()){
        $sql1->store_result();
        if($sql1->num_rows()>0){
             echo 'exists';
        }
        else{
            $sql= $conn->prepare('UPDATE customers SET frstInv=?,divName=?,indivName=?,country=?,city=?,address=?,platform=?,cntactName=?,cntactPhone=?,cntactEmail=?,serviceBillTo=?,customercode=?,cmpnyName=? WHERE custId=? ');
            $sql->bind_param('ssssssssssiisi',$frstInv,$divName,$indivName,$country,$city,$address,$platform,$cntactName,$cntactPhone,$cntactEmail,$serviceBillTo,$customercode,$cmpnyName,$customerid);
            
            if($sql->execute()){
                 echo 'success'; 
                
            }
            else{
               die('There was an error running the query [' . $conn->error . ']');
            }
        }
    }
    else{
        echo 'failed';
    }
      
    
    mysqli_close($conn);
?>