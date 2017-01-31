<?php
/* 
 * Adds product model to invoices.
 */
    require 'dbConfig.php';
 
     $invNum=$_POST['invNum'];
     $invType=$_POST['invType'];
     $prodModel=$_POST['prodModel'];
     
     $notes=$_POST['notes'];
     if($invType==='SIM'){
         $qtysim=$_POST['qtysim'];
     $serviceplan=$_POST['serviceplan'];
        $sql= $conn->prepare('INSERT INTO productmodel (invNum,productModel,quantityofsim,serviceplan,notes) VALUES (?,?,?,?,?)');
        $sql->bind_param('iiiis',$invNum,$prodModel,$qtysim,$serviceplan,$notes);
          if($sql->execute()){
        echo 'success';
      //  die('There was an error running the query [' . $conn->error . ']');
        }
        else{
            echo 'failed';
        }
       
     }
     else if($invType==='Product, SIM and Service'){
         $qtysim=$_POST['qtysim'];
     $serviceplan=$_POST['serviceplan'];
        $qty=$_POST['qty'];
        $billcycle=$_POST['billcycle'];
        $cntractStart=$_POST['cntractStart'];
        $cntractRenew=$_POST['cntractRenew'];
        $cntractEnd=$_POST['cntractEnd'];
        $sql= $conn->prepare('INSERT INTO productmodel (invNum,productModel,quantity,quantityofsim,serviceplan,billingcycle,startDate,renewalDate,endingDate,notes) VALUES (?,?,?,?,?,?,STR_TO_DATE(?,"%m/%d/%Y"),STR_TO_DATE(?,"%m/%d/%Y"),STR_TO_DATE(?,"%m/%d/%Y"),?)');
        $sql->bind_param('iiiiisssss',$invNum,$prodModel,$qty,$qtysim,$serviceplan,$billcycle,$cntractStart,$cntractRenew,$cntractEnd,$notes);
        if($sql->execute()){
        echo 'success';
      //  die('There was an error running the query [' . $conn->error . ']');
        }
        else{
            echo 'failed';
        }
        
    }
    else if($invType==='Service Renew'){
        $billcycle=$_POST['newbillcycle'];
        $newserviceplan=$_POST['newserviceplan'];
        //arrays
        $imei=$_POST['imei'];
        $sim=$_POST['simnumber'];
        $productmodelnumber = $_POST['prodModel'];
        
        $qty=count($imei);
        $qtysim=count($sim);
        if(empty($_POST['cntractStart'])){
            $cntractStart=null;
        }
        else{
            $cntractStart=$_POST['cntractStart'];
        }
        
        $cntractRenew=$_POST['newrenewaldate'];
        $cntractEnd=$_POST['newenddate'];
        $prodModel=$_POST['productmodel']; //array of product model id from product model master
       
       
        
        //get unique product models base on product model master id. Need this to know how many product models to create
        $arrUnique123 = array_unique($prodModel);
        $arrUnique = array_values($arrUnique123);//changes index to start from 0.
        $arrproductmodels = array();
        
        $w=0;
        while($w<count($arrUnique)){
        
            $arrproductmodels[$w][2]=0;
            
            $w++;
        }
        
        $y=0;
        while($y<count($sim)){
            $w=0;
            while($w<count($arrUnique)){
                if($prodModel[$y]===$arrUnique[$w]){
                     $arrproductmodels[$w][2]++;
                }
                $w++;
            }
            $y++;
        }
        $z=0;
        //2d array to capture new product model id created. This creates product model master to new product model id mapping.
      
        while($z<count($arrUnique)){
            $arrproductmodels[$z][0] = $arrUnique[$z];
           
            $sql2= $conn->prepare('INSERT INTO productmodel (invNum,productmodel,quantity,quantityofsim,serviceplan,billingcycle,startDate,renewalDate,endingDate,notes) VALUES (?,?,?,?,?,?,STR_TO_DATE(?,"%m/%d/%Y"),STR_TO_DATE(?,"%m/%d/%Y"),STR_TO_DATE(?,"%m/%d/%Y"),?)');
            $sql2->bind_param('iiiiisssss',$invNum,$arrUnique[$z],$arrproductmodels[$z][2],$arrproductmodels[$z][2],$newserviceplan,$billcycle,$cntractStart,$cntractRenew,$cntractEnd,$notes);
            if($sql2->execute()){
                    echo 'success';
                  //  die('There was an error running the query [' . $conn->error . ']');
            }
            else{
                    echo $conn->error;
            }
            $newprod = $sql2->insert_id;
            $arrproductmodels[$z][1] = $newprod;
            
            $z++;
        }
        
        
       
        $x=0;
        while($x<count($imei)){
            $sql5=$conn->prepare('UPDATE sim SET oldproductmodel=? WHERE simnumber=?');
            $sql5->bind_param('ii',$productmodelnumber[$x],$sim[$x]);
            if($sql5->execute()){
                    echo 'success';
            }
            else{
                echo $conn->error;
                //echo $conn->error;
            }
            
            $a=0;
            while($a<count($arrUnique)){
                if($prodModel[$x]===$arrproductmodels[$a][0]){
                    $sql3=$conn->prepare('UPDATE productmodelsim SET productmodelinv=? WHERE simnumber=?');
                    $sql3->bind_param('ii',$arrproductmodels[$a][1],$sim[$x]);
                    if($sql3->execute()){
                            echo 'success';
                    }
                    else{
                        echo $conn->error;
                        //echo $conn->error;
                    }
                    $sql4=$conn->prepare('UPDATE productmodelimei SET productmodelinv=? WHERE imei=?');
                    $sql4->bind_param('ii',$arrproductmodels[$a][1],$imei[$x]);
                    if($sql4->execute()){
                            echo 'success';
                    }
                    else{
                        echo $conn->error;
                        //echo $conn->error;
                    }
                    /*
                    $sql10=$conn->prepare('UPDATE sim SET locatorid=NULL,locatorname=NULL WHERE simnumber=?');
                    $sql10->bind_param('i',$sim[$x]);
                    if($sql10->execute()){
                            echo 'success';
                    }
                    else{
                        echo $conn->error;
                        //echo $conn->error;
                    }*/
                    
                    break;
                }
                $a++;
            }
            
            
            $x++;
        }
        
        
        
    }
    
     
   
   
    mysqli_close($conn);
?>