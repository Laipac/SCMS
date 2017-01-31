<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    require 'dbConfig.php';
    
    $productmodel=$_POST["productmodel"];
    $serviceplan = $_POST["serviceplan"];
    
    $arravailablesim = array();
    
    $sql2 = $conn->prepare('SELECT sim.simnumber FROM sim LEFT JOIN productmodelsim ON productmodelsim.simnumber=sim.simnumber LEFT JOIN simcardmaster ON sim.simgroup=simcardmaster.simid LEFT JOIN serviceplan ON serviceplan.simcardtype=simcardmaster.simid WHERE productmodelsim.simnumber IS NULL AND serviceplan.planid=?');
    $sql2->bind_param('i',$serviceplan);
    $sql2->execute();
    $sql2->bind_result($availablesim);
    $x=0;
    while($sql2->fetch()){
        $arravailablesim[$x]=$availablesim;
        $x++;
    }
    
    
    
    $sql1 = $conn->prepare('SELECT productmodelsim.simnumber,sim.locatorid,sim.locatorname,sim.imei FROM productmodelsim INNER JOIN sim ON productmodelsim.simnumber=sim.simnumber WHERE productmodelsim.productmodelinv=?');
    $sql1->bind_param('i',$productmodel);
    $sql1->execute();
    $sql1->bind_result($simnumber,$locatorid,$locatorname,$imei);
    $i=1;
    while($sql1->fetch()){
      
        echo '<label for="sim'.$i.'">SIM'.$i.':</label>';
        
        echo '<select id="sim'.$i.'">';
        echo '<option value="'.$simnumber.'" selected="selected">'.$simnumber.'</option>';
        $a=0;
        while($a<count($arravailablesim)){
            echo '<option value="'.$arravailablesim[$a].'">'.$arravailablesim[$a].'</option>';
            $a++;
        }
        
        echo '</select>';
        
        echo '<input type="hidden" value="'.$simnumber.'" id="simoriginal'.$i.'"></input>';
        
        echo '<label for="imei'.$i.'">IMEI'.$i.':</label>';
        echo '<input type="text" value="'.$imei.'" class="noedit" readonly="readonly" id="imei'.$i.'"></input>';
        
        echo '<label for="locatorid'.$i.'">Locator ID'.$i.':</label>';
        echo '<input type="text" value="'.$locatorid.'" id="locatorid'.$i.'"></input>';
        
        echo '<label for="locatorname'.$i.'">Locator User Name '.$i.':</label>';
        echo '<input type="text" value="'.$locatorname.'" id="locatorname'.$i.'"></input>';
        echo '<hr></hr>';
        
        $i++;
    }
   
    $i--;
    echo '<input type="hidden" value="'.$i.'" id="simcount"></input>';
    
    mysqli_close($conn);
    
    
   
?>