<?php

/* 
 * updates sim assigned to product model
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST['productmodel'];
    if(empty($_POST['simnumber'])){
        
    }
    else{
        $simnumber=$_POST['simnumber'];
    }
    $imei=$_POST['imei'];
    $idimei=$_POST['idimei'];
   // echo count($simnumber);
    
    $imeicheck = 0;
    $hit='';
    $bFlag=0;
    while($imeicheck<count($imei)){
        $sql16= $conn->prepare('SELECT imei FROM productmodelimei WHERE imei=? AND productmodelimei != ?');
        $sql16->bind_param('ii',$imei[$imeicheck],$idimei[$imeicheck]);
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
        echo 'success';
    }
    mysqli_close($conn);
?>