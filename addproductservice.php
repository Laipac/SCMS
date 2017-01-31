<?php
/* 
 * adds service to sim
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST['productmodel'];
    $invNum=$_POST['invNum'];
    if(empty($_POST['simnumber'])){
        
    }
    else{
        $simnumber=$_POST['simnumber'];
    }
    
    if(empty($_POST['simoriginal'])){
        
    }
    else{
        $simoriginal=$_POST['simoriginal'];
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
            if($simnumber[$x]===$simoriginal[$x]){
                $sql= $conn->prepare('UPDATE sim SET locatorid=?,locatorname=? WHERE simnumber=?');
                $sql->bind_param('isi',$locatorid[$x],$locatorname[$x],$simnumber[$x]);
                if($sql->execute()){

                }
                else{
                     echo $conn->error();
                    break;
                }
            }
            else{
                $sql26= $conn->prepare('SELECT imei FROM sim WHERE simnumber = ?');
                $sql26->bind_param('i',$simoriginal[$x]);
                
                if($sql26->execute()){
                    $sql26->store_result();
                    $sql26->bind_result($imeioriginal);
                    $sql26->fetch();
                   
                }
                else{
                    echo $conn->error();
                    break;
                }
                
                
                //set new product model linked to old product model in IMEI table
                $sql21= $conn->prepare('UPDATE productmodelimei JOIN sim ON sim.imei = productmodelimei.imei SET productmodelimei.productmodelinv = ? WHERE sim.simnumber=?');
                $sql21->bind_param('ii',$productmodel,$simoriginal[$x]);
                if($sql21->execute()){

                }
                else{
                    echo $conn->error();
                    break;
                }
                
                /*set old product model id to sim that was replaced
                $sql22= $conn->prepare('UPDATE productmodelsim JOIN sim ON sim.simnumber = productmodelsim.simnumber SET productmodelsim.productmodelinv = sim.oldproductmodel WHERE sim.simnumber=?');
                $sql22->bind_param('i',$simoriginal[$x]);
                if($sql22->execute()){

                }
                else{
                     echo $conn->error();
                }*/
                
                
                $sql22= $conn->prepare('DELETE FROM productmodelsim WHERE productmodelsim.simnumber=?');
                $sql22->bind_param('i',$simoriginal[$x]);
                if($sql22->execute()){

                }
                else{
                     echo $conn->error();
                }
                
               
                $sql24= $conn->prepare('UPDATE sim SET imei=NULL,locatorid=NULL,locatorname=NULL WHERE simnumber=?');
                $sql24->bind_param('i',$simoriginal[$x]);
                if($sql24->execute()){

                }
                else{
                     echo $conn->error();
                    break;
                }
                
                $sql25= $conn->prepare('UPDATE sim SET locatorid=?,locatorname=?,imei=? WHERE simnumber=?');
                $sql25->bind_param('isii',$locatorid[$x],$locatorname[$x],$imeioriginal,$simnumber[$x]);
                if($sql25->execute()){

                }
                else{
                     echo $conn->error();
                    break;
                }
                $sql23= $conn->prepare('INSERT INTO productmodelsim (productmodelinv,simnumber) VALUES(?,?)');
                $sql23->bind_param('ii',$productmodel,$simnumber[$x]);
                if($sql23->execute()){

                }
                else{
                    echo $conn->error();
                    break;
                }
                
                
                /* 
                $sql24= $conn->prepare('INSERT INTO productmodelimei (productmodelinv,imei) SELECT ?,imei FROM sim WHERE simnumber=?');
                $sql24->bind_param('ii',$productmodel,$simnumber[$x]);
                if($sql24->execute()){

                }
                else{
                    echo $conn->error();
                    break;
                }
                */
                
                
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
   /*     
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
   */
    }
    mysqli_close($conn);
?>