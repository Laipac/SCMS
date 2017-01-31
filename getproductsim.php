<?php

/* 
 * gets locator id and locator name based on product model
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST["productmodel"];
    
   
    $sql1 = $conn->prepare('SELECT simnumber FROM productmodelsim WHERE productmodelinv=?');
    $sql1->bind_param('i',$productmodel);
    $sql1->execute();
    $sql1->bind_result($simnumber);
    $i=1;
    while($sql1->fetch()){
       
        echo '<label for="sim'.$i.'">SIM'.$i.':</label>';
        echo '<input type="text" value="'.$simnumber.'" class="noedit" readonly="readonly" id="sim'.$i.'"></input>';
      
        echo '<label for="locatorid'.$i.'">Locator ID'.$i.':</label>';
        echo '<input type="text" value="" id="locatorid'.$i.'"></input>';
        
        echo '<label for="locatorname'.$i.'">Locator User Name '.$i.':</label>';
        echo '<input type="text" value="" id="locatorname'.$i.'"></input>';
        
        
        $i++;
    }
   
    $i--;
    echo '<input type="hidden" value="'.$i.'" id="simcount"></input>';
    
    mysqli_close($conn);
    
    
   
?>