<?php
/* 
 * checks if sim is already assigned to an imei
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST['productmodel'];
    $simnumber=$_POST['simnumber'];
    $imei=$_POST['imei'];
    $assigned=array();
    $x=0;
    $y=0;
    $error=0;
    while($x<count($simnumber)){
        $sql= $conn->prepare('SELECT simnumber FROM productmodelsim WHERE simnumber=? AND productmodelinv<>?');
        $sql->bind_param('ii',$simnumber[$x],$productmodel);
        $sql->execute();
        if(!$result = $sql->get_result()){
            die('There was an error running the query [' . $conn->error . ']');
        }
        else if(($row = mysqli_fetch_row($result)) > 0){

            $assigned[$y] ='SIM '.$simnumber[$x].' is already assigned to another product model.';
            $y++;
            $error=1;
           
        }
        $x++;
    }
    $z=0;
    while($z<count($imei)){
        $sql1= $conn->prepare('SELECT imei FROM productmodelimei WHERE imei=? AND productmodelinv<>?');
        $sql1->bind_param('ii',$imei[$z],$productmodel);
        $sql1->execute();
        if(!$result1 = $sql1->get_result()){
            die('There was an error running the query [' . $conn->error . ']');
        }
        else if(($row1 = mysqli_fetch_row($result1)) > 0){

            $assigned[$y] ='IMEI '.$imei[$z].' is already assigned to another product model.';
            $z++;
            $error=1;
        }
        $z++;
    }
    if($error){
        echo json_encode($assigned);
    }
    else{
         echo 'success';
    }
    mysqli_close($conn);
?>