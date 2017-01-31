<?php
/* 
 * links sim number to product model
 */
    require 'dbConfig.php';
    
    $simnumber=$_POST["simnumber"];
    $productmodel=$_POST['productmodel'];
    $simnumbers=explode("\n",$simnumber);
    $invNum=$_POST['invNum'];
    $errors=array();
    $i=0;
    $x=0;
    $y=0;
    while($i<count($simnumbers)){
        
        $sql2 = $conn->prepare('SELECT simnumber FROM productmodelsim WHERE simnumber=?');
        $sql2->bind_param('i',$simnumbers[$i]);
        if($sql2->execute()){
            $sql2->store_result();
            if($sql2->num_rows()>0){
                $errors[$x]='Error '.$simnumbers[$i].' is already assigned to another product model.';
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
                            $errors[$x]="Error ".$simnumbers[$i]." is Inactive.";
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
                         $errors[$x]="Error ".$simnumbers[$i]." is not in inventory.";
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
        
        $i++;
    }
    
    if($y){
        $sql30 = $conn->prepare('SELECT productmodel.prodmodelid FROM productmodel LEFT JOIN productmodelsim ON productmodel.prodmodelid=productmodelsim.productmodelinv WHERE productmodelsim.productmodelinv IS NULL AND productmodel.prodmodelid!=? AND productmodel.invNum=?');
        $sql30->bind_param('ii',$productmodel,$invNum);
        if($sql30->execute()){
            $sql30->store_result();
            if($sql30->num_rows()>0){
               
            }
            else{
                $sql3= $conn->prepare('UPDATE invoices SET status="SIM Assigned", simassigned=NOW() WHERE invNum=?');
                $sql3->bind_param('i',$invNum);
                if($sql3->execute()){

                }
                else{
                    $errors[$x]="Error running query update invoices.";
                    $x++;
                }
            }
        }
        else{
            echo 'failed';
        }
        
    }
    echo json_encode($errors);
    
    
    mysqli_close($conn);
    
   // echo count($simnumbers);
    
?>