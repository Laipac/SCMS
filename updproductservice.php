<?php

/* 
 * update service dates and locator id and name
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST['productmodel'];
    $invNum=$_POST['invNum'];
    if(empty($_POST['simnumber'])){
        
    }
    else{
        $simnumber=$_POST['simnumber'];
    }
    if(empty($_POST['locatorid'])){
        
    }
    else{
         $locatorid=$_POST['locatorid'];
    }
    if(empty($_POST['locatorname'])){}
    else{
        $locatorname=$_POST['locatorname'];
    }
    $loccheck = 0;
    $hit='';
    $bFlag=0;
    while($loccheck<count($locatorid)){
        $sql16= $conn->prepare('SELECT locatorid FROM sim WHERE locatorid=? AND simnumber!=?');
        $sql16->bind_param('ii',$locatorid[$loccheck],$simnumber[$loccheck]);
        if($sql16->execute()){
            $sql16->store_result();
            if($sql16->num_rows()>0){
                $hit=$hit."Locator ID ".$locatorid[$loccheck]." already exists.";
               $bFlag++;
            }
            else{
                
            }
        }
        else{
            echo 'failed';
            break;
        }
        $loccheck++;
    }
    $loccheck = 0;
    while($loccheck<count($locatorname)){
        $sql17= $conn->prepare('SELECT locatorname FROM sim WHERE locatorname=? AND simnumber!=?');
        $sql17->bind_param('si',$locatorname[$loccheck],$simnumber[$loccheck]);
        if($sql17->execute()){
            $sql17->store_result();
            if($sql17->num_rows()>0){
                $hit=$hit."Locator name ".$locatorname[$loccheck]." already exists.";
               $bFlag++;
            }
            else{
                
            }
        }
        else{
            echo 'failed';
            break;
        }
        $loccheck++;
    }
    if($bFlag>0){
        echo "No locator id or locator name assigned. ".$hit;
    }
    else{
    
        $x=0;

        while($x<count($simnumber)){
            $sql= $conn->prepare('UPDATE sim SET locatorid=?,locatorname=? WHERE simnumber=?');
            $sql->bind_param('isi',$locatorid[$x],$locatorname[$x],$simnumber[$x]);
            if($sql->execute()){

            }
            else{
                echo 'failed';
                break;
            }
            $x++;
        }
        
        
        
        $billcycle=$_POST['billcycle'];
        $cntractStart=$_POST['cntractStart'];
        $cntractRenew=$_POST['cntractRenew'];
        $cntractEnd=$_POST['cntractEnd'];
        $sql31= $conn->prepare('UPDATE productmodel SET billingcycle=?,startDate=STR_TO_DATE(?,"%m/%d/%Y"),renewalDate=STR_TO_DATE(?,"%m/%d/%Y"),endingDate=STR_TO_DATE(?,"%m/%d/%Y") WHERE prodmodelid=?');
        $sql31->bind_param('ssssi',$billcycle,$cntractStart,$cntractRenew,$cntractEnd,$productmodel);
        if($sql31->execute()){

        }
        else{
            echo 'failed';
         
        }
        
        $sql3= $conn->prepare('UPDATE invoices SET status="Service Assigned", serviceassigned=NOW() WHERE invNum=?');
        $sql3->bind_param('i',$invNum);
        if($sql3->execute()){
             echo 'success';
        }
        else{
            echo 'failed';

        }

   
    }
    mysqli_close($conn);
?>