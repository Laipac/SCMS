<?php

/* 
 * get sim, locator name and id, and imei details. read only.
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST["productmodel"];
    
   
    $sql1 = $conn->prepare('SELECT productmodelsim.simnumber,sim.locatorid,sim.locatorname,sim.imei FROM productmodelsim INNER JOIN sim ON productmodelsim.simnumber=sim.simnumber WHERE productmodelsim.productmodelinv=?');
    $sql1->bind_param('i',$productmodel);
    $sql1->execute();
    $sql1->bind_result($simnumber,$locatorid,$locatorname,$imei);
    $i=1;
    while($sql1->fetch()){
       
        echo '<label for="sim'.$i.'">SIM'.$i.':</label>';
        echo '<input type="text" value="'.$simnumber.'" id="sim'.$i.'" readonly class="noedit"></input>';
      
        echo '<label for="locatorid'.$i.'">Locator ID'.$i.':</label>';
        echo '<input type="text" value="'.$locatorid.'" id="locatorid'.$i.'" readonly class="noedit"></input>';
        
        echo '<label for="locatorname'.$i.'">Locator User Name '.$i.':</label>';
        echo '<input type="text" value="'.$locatorname.'" id="locatorname'.$i.'" readonly class="noedit"></input>';
        
        echo '<label for="imei'.$i.'">IMEI '.$i.':</label>';
        echo '<input type="text" value="'.$imei.'" id="imei'.$i.'" readonly class="noedit"></input>';
        
        echo '<hr></hr>';
        $i++;
    }
   
    $i--;
    echo '<input type="hidden" value="'.$i.'" id="simcount"></input>';
    
    mysqli_close($conn);
    
    
   
?>