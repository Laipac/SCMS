<?php

/* 
 * get imei and sim details based on invoice
 */
    require 'dbConfig.php';
    
   
   //$custNum="LP123123";
    $invNum=$_POST["invNum"];
  
   
    $sql= $conn->prepare('SELECT productmodel.prodmodelid,productmodelmaster.productmodelname,productmodel.productmodel,sim.locatorid,sim.imei,sim.simnumber,sim.activationstatus,simcardmaster.simprovider,serviceplan.plantype,productmodel.billingcycle,productmodel.renewalDate,productmodel.endingDate,sim.locatorname FROM invoices INNER JOIN productmodel ON invoices.invNum=productmodel.invNum INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel LEFT JOIN serviceplan ON productmodel.serviceplan=serviceplan.planid INNER JOIN productmodelsim ON productmodelinv=productmodel.prodmodelid INNER JOIN sim ON productmodelsim.simnumber=sim.simnumber INNER JOIN simcardmaster ON sim.simgroup=simcardmaster.simid WHERE invoices.invNum=?');
    $sql->bind_param('i',$invNum);
    $sql->execute(); 
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else{
        $x=0;
        $productmodeloriginal='';
        while(($row = mysqli_fetch_row($result))){
           
            echo '<div class="tablerow" id=productmodelrow'.($x+1).'>';
            echo '<div id="tabletoadd'.($x+1).'" class="tablecellsim"><p><input type="checkbox" id="productmodelcheckbox'.($x+1).'" value="'.($x+1).'"> </input></p></div>';
            echo '<div class="tablecellsim" id="tablerowprodmodel'.($x+1).'">';
            echo '<p>'.$row[1].'</p>';
            echo '</div>';
             echo '<input type="hidden" id="selectedproductmodelname'.($x+1).'" value="'.$row[1].'"></input>';
            echo '<input type="hidden" id="selectedprodmodelnumber'.($x+1).'" value="'.$row[2].'"></input>';
            echo '<input type="hidden" id="productmodelnumber'.($x+1).'" value="'.$row[0].'"></input>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$row[3].'</p>';
            echo '</div>';
            echo '<div id="tablerowimei'.($x+1).'" class="tablecellsim">';
            echo '<p>'.$row[4].'</p>';   
            echo '</div>';
            echo '<div id="tablerowsimnumber'.($x+1).'" class="tablecellsim">';
            echo '<p>'.$row[5].'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$row[6].'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$row[7].'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$row[8].'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$row[9].'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$row[10].'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$row[11].'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$row[12].'</p>';
            echo '</div>';
            
            
            echo '</div>';
            $productmodeloriginal = $productmodeloriginal.$row[2].',';
            
            $x++;
        }
      
    }
    echo  '<input type="hidden" id="itemcounter" value="'.($x+1).'" />';
    echo '<input type="hidden" id="productreneworiginal" value="'.$productmodeloriginal.'" />';
    mysqli_close($conn);
?>