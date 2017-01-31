<?php

/* 
 * gets sim numbers and imei
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
    
   
    $sql1 = $conn->prepare('SELECT simnumber FROM productmodelsim WHERE productmodelinv=?');
    $sql1->bind_param('i',$productmodel);
    $sql1->execute();
    $sql1->bind_result($simnumber);
    $i=1;
    while($sql1->fetch()){
       
        echo '<label for="sim'.$i.'">SIM'.$i.':</label>';
        echo '<input type="text" value="'.$simnumber.'" class="noedit" readonly="readonly" id="sim'.$i.'"></input>';
      
        echo '<label for="imei'.$i.'">IMEI'.$i.':</label>';
        echo '<input type="text" value="" id="imei'.$i.'"></input>';
        
       
        
        $i++;
    }
   $y=$i;
    $i--;
    echo '<input type="hidden" value="'.$i.'" id="simcount"></input>';
  
    
    while($i<$count){
       // echo '<p>';
          echo '<label for="imei'.($i+1).'">IMEI'.($i+1).':</label>';
        echo '<input type="text" value="" id="imei'.($i+1).'"></input>';
        
       // echo '</p>';
        $i++;
        
    }
    mysqli_close($conn);
    
    echo '<input type="hidden" value="'.$i.'" id="imeicount"></input>';
   
?>