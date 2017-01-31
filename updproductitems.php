<?php

/* 
 * update product model details, sim, imei and locator id and name
 */
    require 'dbConfig.php';
    $serviceplan=$_POST['serviceplan'];
    $billcycle=$_POST['billcyle'];
    $cntractRenew=$_POST['cntractRenew'];
    $cntractEnd=$_POST['cntractEnd'];
    
    $productmodel=$_POST['productmodel'];
    $simnumber=$_POST['simnumber'];
    $imei=$_POST['imei'];
    $idimei=$_POST['idimei'];
    $idsim=$_POST['idsim'];
    $locatorid=$_POST['locatorid'];
    $locatorname=$_POST['locatorname'];
  
   
    $sql2= $conn->prepare('UPDATE productmodel SET serviceplan=?,billingcycle=?,renewalDate=STR_TO_DATE(?,"%m/%d/%Y"),endingDate=STR_TO_DATE(?,"%m/%d/%Y") WHERE prodmodelid=?');
    $sql2->bind_param('isssi',$serviceplan,$billcycle,$cntractRenew,$cntractEnd,$productmodel);
    if($sql2->execute()){
      
    }
    else{
        echo 'failed';

    }
    $x=0;
    
    while($x<count($simnumber)){
        $sql= $conn->prepare('UPDATE sim SET imei=?,locatorid=?,locatorname=? WHERE simnumber=?');
        $sql->bind_param('iisi',$imei[$x],$locatorid[$x],$locatorname[$x],$simnumber[$x]);
        if($sql->execute()){
             
        }
        else{
            echo 'failed';
            break;
        }
        $x++;
    }
    $y=0;
    while($y<count($imei)){
        $sql1= $conn->prepare('UPDATE productmodelimei SET imei=? WHERE productmodelimei=?');
        $sql1->bind_param('ii',$imei[$y],$idimei[$y]);
        if($sql1->execute()){
           
        }
        else{
            echo 'failed';
            break;
        }
        $y++;
    }
    $z=0;
    while($z<count($simnumber)){
        $sql3= $conn->prepare('UPDATE productmodelsim SET simnumber=? WHERE productmodelsimid=?');
        $sql3->bind_param('ii',$simnumber[$z],$idsim[$z]);
        if($sql3->execute()){
           
        }
        else{
            echo 'failed';
            break;
        }
        $z++;
    }
    echo 'success';
    
    mysqli_close($conn);
?>