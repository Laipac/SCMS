<?php
/* 
 * adds service to invoice type service renew
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
        $sql16= $conn->prepare('SELECT locatorid FROM sim WHERE locatorid=?');
        $sql16->bind_param('i',$locatorid[$loccheck]);
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
        $sql17= $conn->prepare('SELECT locatorname FROM sim WHERE locatorname=?');
        $sql17->bind_param('s',$locatorname[$loccheck]);
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
        
        
       
        
        $sql30 = $conn->prepare('SELECT productmodel.prodmodelid FROM productmodel INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel LEFT JOIN productmodelsim ON productmodelsim.productmodelinv=productmodel.prodmodelid LEFT JOIN sim ON sim.simnumber=productmodelsim.simnumber WHERE productmodel.invNum=? AND sim.locatorid IS NULL AND sim.locatorname IS NULL AND productmodel.prodmodelid != ?');
        $sql30->bind_param('ii',$invNum,$productmodel);
        if($sql30->execute()){
            $sql30->store_result();
            if($sql30->num_rows()>0){
                echo 'success';
            }
            else{
                $sql3= $conn->prepare('UPDATE invoices SET status="Service Assigned", serviceassigned=NOW() WHERE invNum=?');
                $sql3->bind_param('i',$invNum);
                if($sql3->execute()){
                     echo 'success';
                }
                else{
                    echo 'failed';

                }
            }
        }
        
    $billingcycle =  $_POST['billcycle'];
    $cntractStart = $_POST['cntractStart'];
    $cntractRenew = $_POST['cntractRenew'];
    $cntractEnd = $_POST['cntractEnd'];
        $sql20= $conn->prepare('UPDATE productmodel SET billingcycle=?,startDate=STR_TO_DATE(?,"%m/%d/%Y"),endingDate=STR_TO_DATE(?,"%m/%d/%Y"),renewalDate=STR_TO_DATE(?,"%m/%d/%Y") WHERE prodmodelid=?');
        $sql20->bind_param('ssssi',$billingcycle, $cntractStart,$cntractEnd,$cntractRenew,$productmodel);
       if($sql20->execute()){
            echo 'success';
        }
        else{
            echo 'failed';
          
        }
   
    }
    mysqli_close($conn);
?>