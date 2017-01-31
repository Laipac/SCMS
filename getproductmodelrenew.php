<?php

/* 
 * similar as getproductmodel script but difference is checking for existing assigned sim numbers
 */
    require 'dbConfig.php';
   $productmodel=$_POST["productmodel"];
   $simnumbers=$_POST["simnumbers"];
    // $productmodel=22;
    $sql= $conn->prepare('SELECT sim.locatorid,sim.imei,sim.simnumber,sim.activationstatus,simcardmaster.simprovider,serviceplan.plantype,productmodel.billingcycle,productmodel.renewalDate,productmodel.endingDate,sim.locatorname,productmodelmaster.productmodelname,productmodel.productmodel FROM productmodel INNER JOIN serviceplan ON productmodel.serviceplan=serviceplan.planid INNER JOIN productmodelsim ON productmodel.prodmodelid=productmodelsim.productmodelinv INNER JOIN sim ON productmodelsim.simnumber=sim.simnumber INNER JOIN simcardmaster ON sim.simgroup=simcardmaster.simid INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel WHERE productmodel.prodmodelid=?');
    $sql->bind_param('i',$productmodel);
    $sql->execute();
    $sql->bind_result($locatorid,$imei,$simnumber,$activationstatus,$provider,$plantype,$billingcycle,$renewalDate,$endingDate,$locatorname,$products,$productmodelnumber);
   
    echo '<div id="tablesims" class="tablelayout">';
    echo '<div class="tableheading">';
    echo '<div class="tablecellsim"><p>Item</p></div>';
    echo '<div class="tablecellsim"><p>Locator ID</p></div>';
    echo '<div class="tablecellsim"><p>IMEI</p></div>';
    echo '<div class="tablecellsim"><p>SIM Number</p></div>';
    echo '<div class="tablecellsim"><p>Activation Status</p></div>';
    echo '<div class="tablecellsim"><p>Provider</p></div>';
    echo '<div class="tablecellsim"><p>Service Plan</p></div>';
    echo '<div class="tablecellsim"><p>Billing Cycle</p></div>';
    echo '<div class="tablecellsim"><p>Renewal Date</p></div>';
    echo '<div class="tablecellsim"><p>End Date</p></div>';
    echo '<div class="tablecellsim"><p>Locator Name</p></div>';
    echo '</div>';
    $i=1;
    $x=1;
    while($sql->fetch()){
        if(in_array($simnumber,$simnumbers)){
            
        }
        else{
            echo '<div class="tablerow" id="tableproductrow'.$i.'">';
            echo '<div class="tablecellsim" id="tablerowproductmodel'.$i.'">';
         //   echo '<p><input type="checkbox" id="productmodelname" name="productmodelname" value="'.$i.'" onclick="setrenewal(this.value)" /></p>';
            echo '<p><input type="checkbox" id="productmodelname'.$i.'" name="productmodelname" value="'.$i.'" /></p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$locatorid.'</p>';
            echo '</div>';
            echo '<div id="tablecellimei'.$i.'" class="tablecellsim">';
            echo '<p>'.$imei.'</p>';   
            echo '</div>';
            echo '<div id="tablecellsimnumber'.$i.'" class="tablecellsim">';
            echo '<p>'.$simnumber.'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$activationstatus.'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$provider.'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$plantype.'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$billingcycle.'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$renewalDate.'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$endingDate.'</p>';
            echo '</div>';
            echo '<div class="tablecellsim">';
            echo '<p>'.$locatorname.'</p>';
            echo '</div>';

            echo '<input type="hidden" id="selectedpmodelname'.$i.'" value='.$products.' />';
            echo '<input type="hidden" id="selectedpmodelnum'.$i.'" value='.$productmodelnumber.' />';
            echo '</div>';
            $x++;
        }
        
       
        
       
        $i=$i+1;
    }
    
    echo '</div>';
    
   
    echo '<input type="hidden" id="totaldevices" value='.($x-1).' />';
    
    
    
 /*   echo '<p>';
    echo '<label id="lblproductmodel" class="lblclass"></label>';
    echo '<label id="lblimei" class="lblclass"></label>';
    echo '<label id="lblsimnumber" class="lblclass"></label>';
    echo '</p>';

    echo '<p id="pararenewserviceplan" >';
    echo '<label for="serviceplannew">Service Plan:</label>';
    echo '<select name="serviceplannew" id="serviceplannew">';
    $sql1= $conn->prepare('SELECT DISTINCT serviceplan.plantype,serviceplan.planid FROM serviceplan INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=serviceplan.productmodel WHERE serviceplan.productmodel=?');
   
    $sql1->bind_param('i',$productmodelnumber);
    $sql1->execute();
    $sql1->bind_result($plantype,$planid);
    while($sql1->fetch()){
        echo '<option value="'.$planid.'">'.$plantype.'</option>';
    }
    echo '</select>';
    echo '</p>';
    echo '<p id="pararenewserviceplanbilling" >';
    echo '<label for="serviceplanbilling">Billing Cycle:</label>';
    echo '<input type="text" id="serviceplanbilling" value="" />';
    echo '</p>';
    echo '<p id="pararenewserviceplanrenewdate" >';
    echo '<label for="serviceplanrenewdate">Renewal Date:</label>';
    echo '<input type="text" id="serviceplanrenewdate" value="" />';
    echo '</p>';
    echo '<p id="pararenewserviceplanenddate" >';
    echo '<label for="serviceplanenddate">Ending Date:</label>';
    echo '<input type="text" id="serviceplanenddate" value="" />';
    echo '</p>';
*/
   
     echo '<input type="button" id="selecteddevices" value="Add" onclick="setdates();" />';
    //echo '<p id="pararenewalbuttons" style="display:none;">';
    //echo '<input type="button" id="btnid" value="Add" onclick="addinvoicerenewal();" />';
    //echo '<input type="button" value="Back" onclick="backinvoicerenewal();" />';
    //echo '</p>';
    echo '<p id="parastatuses">';
    echo '<label id="statuslabelrenew" style="color:lightgreen;font-weight: bold;"></label>';
    echo '</p>';
    mysqli_close($conn);
?> 