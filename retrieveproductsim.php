<?php

/* 
 * This module retrieves sim number and imei
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
    
    
    
    $sql1 = $conn->prepare('SELECT productmodelsim.simnumber,sim.imei,productmodelimei.productmodelimei FROM productmodelsim INNER JOIN sim ON sim.simnumber=productmodelsim.simnumber INNER JOIN productmodelimei ON productmodelimei.imei=sim.imei WHERE productmodelsim.productmodelinv=?');
    $sql1->bind_param('i',$productmodel);
    $sql1->execute();
    $sql1->bind_result($simnumber,$imei,$imeisim);
    $i=1;
    while($sql1->fetch()){
        
        echo '<label for="sim'.$i.'">SIM'.$i.':</label>';
        echo '<input type="text" value="'.$simnumber.'" class="noedit" readonly="readonly" id="sim'.$i.'"></input>';
      
        echo '<label for="imei'.$i.'">IMEI'.$i.':</label>';
        echo '<input type="text" value="'.$imei.'" id="imei'.$i.'"></input>';
        echo '<input type="hidden" value="'.$imeisim.'" id="idimei'.$i.'"></input>';
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