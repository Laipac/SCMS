<?php
/* 
 * script that actually inserts customer to database
 */
    require 'dbConfig.php';
    $customercode = $_POST['customercode'];
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
    
    //$frstInv = "LP".$frstInv;
    //checks if customer is existing
    $sql1 = $conn->prepare('SELECT customercode,cmpnyName FROM customers WHERE customercode=? AND cmpnyName = ?');
    $sql1->bind_param('is',$customercode,$cmpnyName);
    if($sql1->execute()){
        $sql1->store_result();
        if($sql1->num_rows()>0){
            echo 'exists';
        }
        else{
            $sql= $conn->prepare('INSERT INTO customers (frstInv,cmpnyName,divName,indivName,country,city,address,platform,cntactName,cntactPhone,cntactEmail,serviceBillTo,customercode) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $sql->bind_param('sssssssissssi',$frstInv,$cmpnyName,$divName,$indivName,$country,$city,$address,$platform,$cntactName,$cntactPhone,$cntactEmail,$serviceBillTo,$customercode);
           
            if($sql->execute()){
                 echo 'success';
               // die('There was an error running the query [' . $conn->error . ']');
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