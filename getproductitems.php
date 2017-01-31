<?php

/* 
 * get sim, imei and service details based on product model.
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST["productmodel"];
    
    $sql= $conn->prepare('SELECT quantity FROM productmodel WHERE prodmodelid = ?');
    $sql->bind_param('i',$productmodel);
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
       
        $count = $row[0];
        
    }
    else
    {
        echo 'failed';
    }
    $sql1 = $conn->prepare('SELECT productmodelsim.simnumber,sim.imei,productmodelimei.productmodelimei,sim.locatorid,sim.locatorname,productmodelsim.productmodelsimid FROM productmodelsim INNER JOIN sim ON sim.simnumber=productmodelsim.simnumber INNER JOIN productmodelimei ON productmodelimei.imei=sim.imei WHERE productmodelsim.productmodelinv=?');
    $sql1->bind_param('i',$productmodel);
    $sql1->execute();
    $sql1->bind_result($simnumber,$imei,$imeisim,$locatorid,$locatorname,$productmodelsim);
    $i=1;
    while($sql1->fetch()){
        
        echo '<label for="sim'.$i.'">SIM'.$i.':</label>';
        echo '<input type="text" value="'.$simnumber.'" id="sim'.$i.'"></input>';
        echo '<input type="hidden" value="'.$productmodelsim.'" id="idsim'.$i.'"></input>';
        
        echo '<label for="locatorid'.$i.'">Locator ID'.$i.':</label>';
        echo '<input type="text" value="'.$locatorid.'" id="locatorid'.$i.'"></input>';
        
        echo '<label for="locatorname'.$i.'">Locator User Name '.$i.':</label>';
        echo '<input type="text" value="'.$locatorname.'" id="locatorname'.$i.'"></input>';
        
        echo '<label for="imei'.$i.'">IMEI'.$i.':</label>';
        echo '<input type="text" value="'.$imei.'" id="imei'.$i.'"></input>';
        echo '<input type="hidden" value="'.$imeisim.'" id="idimei'.$i.'"></input>';
        echo '<hr></hr>';
        $i++;
    }
    $y=$i;
    $i--;
    echo '<input type="hidden" value="'.$i.'" id="simcount"></input>';
    $imeiqty = $count-$i;
    
    $sql2 = $conn->prepare('SELECT productmodelimei.imei,productmodelimei.productmodelimei FROM productmodelimei LEFT JOIN sim ON sim.imei = productmodelimei.imei WHERE sim.imei IS NULL AND productmodelimei.productmodelinv=?');
    $sql2->bind_param('i',$productmodel);
    $sql2->execute();
    $sql2->bind_result($simimei,$idimei);
    
    while($sql2->fetch()){
       // echo '<p>';
        echo '<label for="imei'.$y.'">IMEI'.$y.':</label>';
        echo '<input type="text" value="'.$simimei.'" id="imei'.$y.'"></input>';
        echo '<input type="hidden" value="'.$idimei.'" id="idimei'.$y.'"></input>';
       // echo '</p>';
        $y++;
        
    }
    
    
    mysqli_close($conn);
    
    
    echo '<input type="hidden" value="'.$count.'" id="imeicount"></input>';
?>