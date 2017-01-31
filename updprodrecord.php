<?php

/* 
 * This module is for updating product models based on invoice
 */
    require 'dbConfig.php';
    $productmodel=$_POST["prodModel"];
    $invNum=$_POST['invNum'];
    
    $invType=$_POST["invType"];
    $notes=$_POST["notes"];
   
    
    if($invType==="SIM"){
         $productmodelid=$_POST["productmodelid"];
    $qtyofsim=$_POST["qtysim"];
    $serviceplan=$_POST["serviceplan"];
        $sql= $conn->prepare('UPDATE productmodel SET productmodel=?,serviceplan=?,quantityofsim=?,notes=? WHERE prodmodelid=?');
        $sql->bind_param('iiisi',$productmodel,$serviceplan,$qtyofsim,$notes,$productmodelid);
       if($sql->execute()){
            echo 'success';
        }
        else{
            echo 'failed';
          
        }
     
    }
   
    else if($invType==='Service Renew'){
        $billcycle=$_POST['newbillcycle'];
        $serviceplan=$_POST['newserviceplan'];
        $imei=$_POST['imei'];
        $sim=$_POST['simnumber'];
        
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
        $prodModel=$_POST['productmodel'];//product model master
        $originalproducts=$_POST['originalproducts'];//original product models in the invoice. This will be used to check if new product model needs to be created.
        
        //get unique product models base on product model master id. Need this to know how many product models to create
        $arrUnique = array_unique($prodModel);
        $arrproductmodels = array();
        $arrnewproducts = array();
        $arrexistingpmodels = array();
        $arrexistingprod = array();
        $d=0;
        $e=0;
        
        //2d array existing pmodels to create mapping product model master id and product model id.
        $sql13 = $conn->prepare('SELECT prodmodelid,productmodel FROM productmodel WHERE invNum=?');
        $sql13->bind_param('i',$invNum);
        if($sql13->execute()){
            $sql13->bind_result($existingproductmodelid,$existingproductmodel);
            $u=0;
            while($sql13->fetch()){
                $arrexistingpmodels[$u][0]=$existingproductmodelid;
                $arrexistingpmodels[$u][1]=$existingproductmodel;//needed 2 capture twice to be able to use in_array
                $arrexistingprod[$u]=$existingproductmodel;
                $u++;
            }
        }
        else{
            echo 'failed sql13';
        }
        //gets new product models for renewal based on product model master id
        while($d<count($sim)){
            if(in_array($prodModel[$d],$arrexistingprod)){
                
            }
            else{
                $arrnewproducts[$e]=$prodModel[$d];
            }
            
            $d++;
        }
        //gets unique new product models only. index does not change
        $arrnew123=array_unique($arrnewproducts);
        $arrnew=array_values($arrnew123); //changes index to start from 0.
        
        $w=0;
        //initialize 2d array to 0. [2] is for sim and imei count.
        while($w<count($arrnew)){
        
            $arrproductmodels[$w][2]=0;
            
            $w++;
        }
        
        $y=0;
        while($y<count($sim)){
            $w=0;
            while($w<count($arrnew)){
                if($prodModel[$y]===$arrnew[$w]){
                     $arrproductmodels[$w][2]++;
                }
                $w++;
            }
            $y++;
        }
        
        
        
        $z=0;
        //2d array to capture new product model id created. This creates product model master to new product model id mapping.
        
        
        while($z<count($arrnew)){
            $arrproductmodels[$z][0] = $arrnew[$z];
            $sql2= $conn->prepare('INSERT INTO productmodel (invNum,productModel,quantity,quantityofsim,serviceplan,billingcycle,startDate,renewalDate,endingDate,notes) VALUES (?,?,?,?,?,?,STR_TO_DATE(?,"%m/%d/%Y"),STR_TO_DATE(?,"%m/%d/%Y"),STR_TO_DATE(?,"%m/%d/%Y"),?)');
            $sql2->bind_param('iiiiisssss',$invNum,$arrnew[$z],$arrproductmodels[$z][2],$arrproductmodels[$z][2],$serviceplan,$billcycle,$cntractStart,$cntractRenew,$cntractEnd,$notes);
            if($sql2->execute()){
                    echo 'success';
                  //  die('There was an error running the query [' . $conn->error . ']');
            }
            else{
                    //echo 'failed';
                echo $conn->error;
            }
            $newprod = $sql2->insert_id;
            $arrproductmodels[$z][1] = $newprod;
            
            $z++;
        }
        $x=0;
        while($x<count($imei)){
            $v=0;
            $bFlag=1;
            //for new product models, update using new product model just created.
            while($v<count($arrnew)){
                if($prodModel[$x]===$arrnew[$v]){
                   $sql14=$conn->prepare('UPDATE productmodel SET serviceplan=?,billingcycle=?,renewalDate=STR_TO_DATE(?,"%m/%d/%Y"),endingDate=STR_TO_DATE(?,"%m/%d/%Y") WHERE prodmodelid=?');
                   $sql14->bind_param('isssi',$serviceplan,$billcycle,$cntractRenew,$cntractEnd,$arrproductmodels[$v][1]); //2d array from insert product model statement
                   if($sql14->execute()){
                           echo 'success';
                   }
                   else{
                       //echo 'failed';
                       echo $conn->error;
                   }
                    
                    
                    $sql5=$conn->prepare('UPDATE sim SET oldproductmodel=? WHERE simnumber=?');
                    $sql5->bind_param('ii',$productmodel[$x],$sim[$x]);
                    if($sql5->execute()){
                            echo 'success';
                            
                            //update product model record old, deduct qty qtyofsim
                    }
                    else{
                        //echo 'failed';
                        echo $conn->error;
                    }
                    $sql3=$conn->prepare('UPDATE productmodelsim SET productmodelinv=? WHERE simnumber=?');
                    $sql3->bind_param('ii',$arrproductmodels[$v][1],$sim[$x]); //2d array from insert product model statement
                    if($sql3->execute()){
                            echo 'success';
                    }
                    else{
                        //echo 'failed';
                        echo $conn->error;
                    }
                    $sql4=$conn->prepare('UPDATE productmodelimei SET productmodelinv=? WHERE imei=?');
                    $sql4->bind_param('ii',$arrproductmodels[$v][1],$imei[$x]); //2d array from insert product model statement
                    if($sql4->execute()){
                            echo 'success';
                    }
                    else{
                        //echo 'failed';
                        echo $conn->error;
                    }
                    $sql30=$conn->prepare('UPDATE sim SET locatorid=NULL,locatorname=NULL WHERE simnumber=?');
                    $sql30->bind_param('i',$sim[$x]); //2d array from insert product model statement
                    if($sql30->execute()){
                            echo 'success';
                    }
                    else{
                        //echo 'failed';
                        echo $conn->error;
                    }
                   
                    
                    
                    $bFlag=0;
                    break;
                }
                
                $v++;
            }
            //if product model is not new.
           
            if($bFlag){
                //loop to compare update product model id based on existing product models assigned to invoice.
                $t=0;
                
                while($t<count($arrexistingprod)){
                    
                    $sql15=$conn->prepare('UPDATE productmodel SET serviceplan=?,billingcycle=?,renewalDate=STR_TO_DATE(?,"%m/%d/%Y"),endingDate=STR_TO_DATE(?,"%m/%d/%Y") WHERE prodmodelid=?');
                    $sql15->bind_param('isssi',$serviceplan,$billcycle,$cntractRenew,$cntractEnd,$arrexistingpmodels[$t][0]); //2d array from insert product model statement
                    if($sql15->execute()){
                            echo 'success';
                    }
                    else{
                        //echo 'failed';
                        echo $conn->error;
                    }
                    
                    
                    
                    $sql6= $conn->prepare('SELECT productmodelinv FROM productmodelsim WHERE simnumber=? AND productmodelinv=?');
                    $sql6->bind_param('ii',$sim[$x],$arrexistingpmodels[$t][0]);
                    if($sql6->execute()){
                        $sql6->store_result();
                        if($sql6->num_rows()>0){
                           
                            break;
                        }
                        else{
                           
                            if($prodModel[$x]==$arrexistingpmodels[$t][1]){
                              
                                $sql7=$conn->prepare('UPDATE sim SET oldproductmodel=? WHERE simnumber=?');
                                $sql7->bind_param('ii',$productmodel[$x],$sim[$x]);
                                if($sql7->execute()){
                                        echo 'success';
                                }
                                else{
                                    //echo 'failed';
                                    echo $conn->error;
                                }
                                $sql8=$conn->prepare('UPDATE productmodelsim SET productmodelinv=? WHERE simnumber=?');
                                $sql8->bind_param('ii',$arrexistingpmodels[$t][0],$sim[$x]);
                                if($sql8->execute()){
                                        echo 'success';
                                }
                                else{
                                    //echo 'failed';
                                    echo $conn->error;
                                }
                                $sql9=$conn->prepare('UPDATE productmodelimei SET productmodelinv=? WHERE imei=?');
                                $sql9->bind_param('ii',$arrexistingpmodels[$t][0],$imei[$x]);
                                if($sql9->execute()){
                                        echo 'success';
                                }
                                else{
                                    //echo 'failed';
                                    echo $conn->error;
                                }
                                $sql31=$conn->prepare('UPDATE sim SET locatorid=NULL,locatorname=NULL WHERE simnumber=?');
                                $sql31->bind_param('i',$sim[$x]); //2d array from insert product model statement
                                if($sql31->execute()){
                                        echo 'success';
                                }
                                else{
                                    //echo 'failed';
                                    echo $conn->error;
                                }
                               
                                break;
                            }

                        }

                    }
                    else{
                        echo 'here?';
                    }
                    $t++;
                }
            }
            
            $x++;
        }
        //check deleted sims, reinstate to old product model.
        $simtoremove=$_POST['simtoremove'];
        if($simtoremove===""){
            
        }
        else{
            $simremove=rtrim($simtoremove,',');
            $arrsimremove=explode(",",$simremove);
             $b=0;
            while($b<count($arrsimremove)){
                $sql10 = $conn->prepare('SELECT oldproductmodel,imei FROM sim WHERE simnumber=?');
                $sql10->bind_param('i',$arrsimremove[$b]);

                if($sql10->execute()){
                    $sql10->store_result();
                    $sql10->bind_result($oldproductmodel,$imei);
                    if($sql10->fetch()){
                        $sql11=$conn->prepare('UPDATE productmodelsim SET productmodelinv=? WHERE simnumber=?');
                        $sql11->bind_param('ii',$oldproductmodel,$arrsimremove[$b]);
                        if($sql11->execute()){
                                echo 'success';
                        }
                        else{
                           // echo 'failed';
                            echo $conn->error;
                        }
                        $sql12=$conn->prepare('UPDATE productmodelimei SET productmodelinv=? WHERE imei=?');
                        $sql12->bind_param('ii',$oldproductmodel,$imei);
                        if($sql12->execute()){
                                echo 'success';
                        }
                        else{
                           // echo 'failed';
                            echo $conn->error;
                        }
                    }
                    else{
                        echo 'failed22';
                    }
                }
                else{
                    echo 'failed23';
                }

                $b++;
            }
        }
    }
     else{
          $productmodelid=$_POST["productmodelid"];
    $qtyofsim=$_POST["qtysim"];
    $serviceplan=$_POST["serviceplan"];
        $qty=$_POST["qty"];
        $billingcycle=$_POST["billcycle"];
        $startDate=$_POST["cntractStart"];
        $endingDate=$_POST["cntractEnd"];
        $renewalDate=$_POST["cntractRenew"];
        $sql= $conn->prepare('UPDATE productmodel SET productmodel=?,quantity=?,quantityofsim=?,notes=?,serviceplan=?,billingcycle=?,startDate=STR_TO_DATE(?,"%m/%d/%Y"),endingDate=STR_TO_DATE(?,"%m/%d/%Y"),renewalDate=STR_TO_DATE(?,"%m/%d/%Y") WHERE prodmodelid=?');
        $sql->bind_param('iiisissssi',$productmodel,$qty,$qtyofsim,$notes,$serviceplan,$billingcycle,$startDate,$endingDate,$renewalDate,$productmodelid);
       if($sql->execute()){
            echo 'success';
        }
        else{
            echo 'failed';
          
        }
       
    }
    mysqli_close($conn);
?>