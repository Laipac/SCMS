<?php

/* 
 * update sim numbers based on product model
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST['productmodel'];
    $simnumbers=$_POST["simtoadd"];
    //$invNum=$_POST['invNum'];
    $errors=array();
    $i=0;
    $x=0;
    $y=0;
    while($i<count($simnumbers)){
        
        
        if(strpos($simnumbers[$i],'sim')===0){
            $simnumbers[$i]=str_replace('sim','',$simnumbers[$i]);
            
            $sql2 = $conn->prepare('SELECT simnumber FROM productmodelsim WHERE simnumber=?');
            $sql2->bind_param('i',$simnumbers[$i]);
            if($sql2->execute()){
                $sql2->store_result();
                if($sql2->num_rows()>0){
                    $errors[$x]=$simnumbers[$i].' is already assigned to another product model.';
                    $x++;
                }
                else{
                    $sql = $conn->prepare('SELECT simnumber,activationstatus FROM sim WHERE simnumber=?');
                    $sql->bind_param('i',$simnumbers[$i]);

                    if($sql->execute()){
                        $sql->bind_result($sim,$status);
                        $sql->store_result();
                        if($sql->num_rows()>0){

                            $sql->fetch();
                            if($status==='Inactive'){
                                $errors[$x]=$simnumbers[$i]." is Inactive.";
                                $x++;
                            }
                            else{

                                $sql1= $conn->prepare('INSERT INTO productmodelsim (productmodelinv,simnumber) VALUES (?,?)');
                                $sql1->bind_param('ii',$productmodel,$simnumbers[$i]);
                                if($sql1->execute()){
                                    $errors[$x]="SIM ".$simnumbers[$i]." added.";
                                    $y=1;
                                    $x++;
                                }
                                else{
                                    $errors[$x]="Error running query insert sim to product model.";
                                    $x++;
                                }
                            }
                        }
                        else{
                             $errors[$x]=$simnumbers[$i]." is not in inventory.";
                             $x++;
                        }
                    }
                    else{
                       $errors[$x]="Error running query.";
                       $x++;
                    }
                }
            }
            else{
                 $errors[$x]='Error running query productmodelsim';
                 $x++;
            }
        }
        
        
        
        $i++;
    }
    
   
    $simtoremove=explode(",",$_POST['simtoremove']);
    
    $i=0;
    
    while($i < (count($simtoremove)-1)){
        $sql3= $conn->prepare('DELETE FROM productmodelsim WHERE productmodelsimid=?');
        $sql3->bind_param('i',$simtoremove[$i]);
        if($sql3->execute()){
            $errors[$x]="SIM removed.";
            
            $x++;
        }
        else{
            $errors[$x]="Error running query delete sim to product model.";
            $x++;
        }
        
        $i++;
    }
     echo json_encode($errors);
    mysqli_close($conn);
    
   // echo count($simnumbers);
    
?>