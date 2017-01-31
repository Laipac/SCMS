<?php
/* 
 * add sim to product model
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST['productmodel'];
    if(empty($_POST['simnumber'])){
        
    }
    else{
        $simnumber=$_POST['simnumber'];
    }
    
    $imei=$_POST['imei'];
    $invnum=$_POST['invNum'];
    
   // echo count($simnumber);
    $imeicheck = 0;
    $hit='';
    $bFlag=0;
    while($imeicheck<count($imei)){
        $sql16= $conn->prepare('SELECT imei FROM productmodelimei WHERE imei=?');
        $sql16->bind_param('i',$imei[$imeicheck]);
        if($sql16->execute()){
            $sql16->store_result();
            if($sql16->num_rows()>0){
                $hit=$hit.$imei[$imeicheck]." already assigned to a product model.";
               $bFlag++;
            }
            else{
                
            }
        }
        else{
            echo 'failed';
            break;
        }
        $imeicheck++;
    }
    if($bFlag>0){
        echo "No IMEI assigned. ".$hit;
    }
    else{
    
                $x=0;

                while($x<count($simnumber)){
                    $sql= $conn->prepare('UPDATE sim SET imei=? WHERE simnumber=?');
                    $sql->bind_param('ii',$imei[$x],$simnumber[$x]);
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
                    $sql1= $conn->prepare('INSERT INTO productmodelimei (productmodelinv,imei) VALUES(?,?)');
                    $sql1->bind_param('ii',$productmodel,$imei[$y]);
                    if($sql1->execute()){

                    }
                    else{
                        echo 'failed';
                        break;
                    }
                    $y++;
                }
        $sql30 = $conn->prepare('SELECT productmodel.prodmodelid FROM productmodel LEFT JOIN productmodelimei ON productmodel.prodmodelid=productmodelimei.productmodelinv WHERE productmodelimei.productmodelinv IS NULL AND productmodel.prodmodelid != ? AND productmodel.invNum = ?');
        $sql30->bind_param('ii',$productmodel,$invnum);
        if($sql30->execute()){
            $sql30->store_result();
            if($sql30->num_rows()>0){
                echo 'success';
            }
            else{
                echo $sql30->num_rows();
                $sql3= $conn->prepare('UPDATE invoices SET status="Product Assigned", productassigned=NOW() WHERE invNum=?');
                $sql3->bind_param('i',$invnum);
                if($sql3->execute()){
                     echo 'success';
                }
                else{
                    echo 'failed';

                }
            }
        }
    }
    
   
    
    mysqli_close($conn);
?>