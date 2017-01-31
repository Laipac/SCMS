<?php
/* 
 * checks if product model is linked to service plan
 */
    require 'dbConfig.php';
    
    $serviceplan=$_POST['serviceplan'];
    $productmodel=$_POST['productmodel'];
    $x=0;
    $error=1;
    while($x<count($productmodel)){
        $sql= $conn->prepare('SELECT planid FROM serviceplan WHERE productmodel=? AND plantype=?');
        $sql->bind_param('is',$productmodel[$x],$serviceplan);
        $sql->execute();
        if(!$result = $sql->get_result()){
            die('There was an error running the query [' . $conn->error . ']');
        }
        else if(($row = mysqli_fetch_row($result)) > 0){       
        }
        else{
            $error=0;
            break;
        }
        $x++;
    }
    if($error){
        echo 'success';
    }
    else{
        echo 'Product model not linked to service plan. Kindly contact administrator.';
    }
   
    mysqli_close($conn);
?>