<?php

/* 
 * displays invoice, plan rate,plan type, billing cyle, start date, end date, renewal, imei, sim details based on search criterias
 */
    require 'dbConfig.php';

    $customer = $_POST['customer'];
    $servicebillto = $_POST['servicebillto'];
    $platform = $_POST['platform'];
    $platformadmin = $_POST['platformadmin'];
    $saleschannel = $_POST['saleschannel'];
    $productmodel = $_POST['productmodel'];
    $hasbeenserviceto = $_POST['hasbeenserviceto'];
    $hasbeenservicefrom = $_POST['hasbeenservicefrom'];
    $notinserviceto = $_POST['notinserviceto'];
    $notinservicefrom = $_POST['notinservicefrom'];
    $tobeexpiredfrom = $_POST['tobeexpiredfrom'];
    $tobeexpiredto = $_POST['tobeexpiredto'];
    
    if($servicebillto==='Blank'){
        $servicebillto = null;
    }
    if($platform==='Blank'){
        $platform = null;
    }
    if($platformadmin==='Blank'){
        $platformadmin = null;
    }
    if($saleschannel==='Blank'){
        $saleschannel = null;
    }
    if($productmodel==='Blank'){
        $productmodel = null;
    }
    
    
    if(empty($customer)){
       $customer = null;
    }
    
    if(empty($hasbeenserviceto)){
      $hasbeenserviceto= null; 
    }
    
    if(empty($hasbeenservicefrom)){
       $hasbeenservicefrom = null; 
    }
    
    if(empty( $notinserviceto )){
        $notinserviceto  = null; 
    }
    
    if(empty( $notinservicefrom)){
       $notinservicefrom = null; 
    }
    
    if(empty($tobeexpiredfrom)){
       $tobeexpiredfrom = null; 
    }
    
    if(empty($tobeexpiredto)){
       $tobeexpiredto = null; 
    }
   
    //left join takes everything if nothing matches, inner join only takes row that matches.
    //$sql= $conn->prepare('SELECT invoices.invNum,serviceplan.plantype,serviceplan.planrate,productmodel.billingcycle,productmodel.startDate,productmodel.endingDate,productmodelmaster.productmodelname,productmodelimei.imei,productmodelsim.simnumber,sim.telnumber,sim.locatorname,sim.locatorid,sim.activationstatus,sim.activationdate,sim.deactivationdate FROM customers LEFT JOIN invoices ON customers.frstInv=invoices.frstInv LEFT JOIN productmodel ON productmodel.invNum=invoices.invNum LEFT JOIN productmodelimei ON productmodel.prodmodelid=productmodelimei.productmodelinv LEFT JOIN productmodelsim ON productmodelsim.productmodelinv=productmodel.prodmodelid LEFT JOIN sim ON sim.simnumber=productmodelsim.simnumber LEFT JOIN customercode ON customercode.customercodeid=customers.customercode LEFT JOIN serviceplatform ON customers.platform=serviceplatform.platformid LEFT JOIN servicebillto ON serviceplatform.platformid=servicebillto.serviceplatform LEFT JOIN saleschannel ON invoices.salesChannel=saleschannel.channelid LEFT JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel LEFT JOIN serviceplan ON serviceplan.planid=productmodel.serviceplan WHERE (? IS NULL OR (customers.frstInv = ?) OR (CONCAT(customercode.customercode,customers.frstInv)=?)) AND (? IS NULL OR (servicebillto.servicebilltoid = ?)) AND (? IS NULL OR (serviceplatform.platformid = ?)) AND (? IS NULL OR (platformadmin.platformadminid = ?)) AND (? IS NULL OR (saleschannel.channelid = ?)) AND (? IS NULL OR (productmodel.productmodel = ?)) AND (? IS NULL OR (productmodel.startDate >= ?)) AND (? IS NULL OR (productmodel.startDate <= ?)) AND (? IS NULL OR (productmodel.renewalDate >= ?)) AND (? IS NULL OR (productmodel.renewalDate <= ?)) AND (? IS NULL OR (productmodel.endingDate >= ?)) AND (? IS NULL OR (productmodel.endingDate <= ?))');
    //$sql->bind_param('sssiiiiiiiiiissssssssssss',$customer,$customer,$customer,$servicebillto,$servicebillto,$platform,$platform,$platformadmin,$platformadmin,$saleschannel,$saleschannel,$productmodel,$productmodel,$hasbeenservicefrom,$hasbeenservicefrom,$hasbeenserviceto,$hasbeenserviceto,$tobeexpiredfrom,$tobeexpiredfrom,$tobeexpiredto,$tobeexpiredto,$notinservicefrom,$notinservicefrom,$notinserviceto,$notinserviceto);
    
    $sql= $conn->prepare('SELECT invoices.invNum,serviceplan.plantype,serviceplan.planrate,productmodel.billingcycle,productmodel.startDate,productmodel.endingDate,productmodelmaster.productmodelname,productmodelimei.imei,productmodelsim.simnumber,sim.telnumber,sim.locatorname,sim.locatorid,sim.activationstatus,sim.activationdate,sim.deactivationdate FROM customers LEFT JOIN invoices ON customers.frstInv=invoices.frstInv LEFT JOIN productmodel ON productmodel.invNum=invoices.invNum LEFT JOIN productmodelimei ON productmodel.prodmodelid=productmodelimei.productmodelinv LEFT JOIN productmodelsim ON productmodelsim.productmodelinv=productmodel.prodmodelid LEFT JOIN sim ON sim.simnumber=productmodelsim.simnumber LEFT JOIN customercode ON customercode.customercodeid=customers.customercode LEFT JOIN serviceplatform ON customers.platform=serviceplatform.platformid LEFT JOIN servicebillto ON serviceplatform.platformid=servicebillto.serviceplatform LEFT JOIN saleschannel ON invoices.salesChannel=saleschannel.channelid LEFT JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel LEFT JOIN serviceplan ON serviceplan.planid=productmodel.serviceplan LEFT JOIN platformadmin ON platformadmin.serviceplatform=serviceplatform.platformid WHERE (? IS NULL OR (customers.frstInv = ?) OR (CONCAT(customercode.customercode,customers.frstInv)=?)) AND (? IS NULL OR (servicebillto.servicebilltoid = ?)) AND (? IS NULL OR (serviceplatform.platformid = ?)) AND (? IS NULL OR (platformadmin.platformadminid = ?)) AND (? IS NULL OR (saleschannel.channelid = ?)) AND (? IS NULL OR (productmodel.productmodel = ?)) AND (? IS NULL OR (productmodel.startDate >= STR_TO_DATE(?,"%m/%d/%Y"))) AND (? IS NULL OR (productmodel.startDate <= STR_TO_DATE(?,"%m/%d/%Y"))) AND (? IS NULL OR (productmodel.renewalDate >= STR_TO_DATE(?,"%m/%d/%Y"))) AND (? IS NULL OR (productmodel.renewalDate <= STR_TO_DATE(?,"%m/%d/%Y"))) AND (? IS NULL OR (productmodel.endingDate >= STR_TO_DATE(?,"%m/%d/%Y"))) AND (? IS NULL OR (productmodel.endingDate <= STR_TO_DATE(?,"%m/%d/%Y")))');
    $sql->bind_param('sssiiiiiiiiiissssssssssss',$customer,$customer,$customer,$servicebillto,$servicebillto,$platform,$platform,$platformadmin,$platformadmin,$saleschannel,$saleschannel,$productmodel,$productmodel,$hasbeenservicefrom,$hasbeenservicefrom, $hasbeenserviceto, $hasbeenserviceto,$tobeexpiredfrom,$tobeexpiredfrom,$tobeexpiredto,$tobeexpiredto,$notinservicefrom,$notinservicefrom,$notinserviceto,$notinserviceto);
    
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        
        die('There was an error running the query [' . $conn->error . ']');
        echo '<p style="color:red;">Error running query.</p>';
    }
    else{
        echo '<div class="tablelayout">';
        echo '<div class="tableheading">';
        echo '<div class="tablecell1">Invoice</div>';
        echo '<div class="tablecell1">Plan</div>';
        echo '<div class="tablecell1">Rate</div>';
        echo '<div class="tablecell1">Billing Cycle</div>';
        echo '<div class="tablecell1">Start Date</div>';
        echo '<div class="tablecell1">Ending Date</div>';
        echo '<div class="tablecell1">Product Model</div>';
        echo '<div class="tablecell1">IMEI</div>';
        echo '<div class="tablecell1">SIM</div>';
        echo '<div class="tablecell1">Tel. Number</div>';
        echo '<div class="tablecell1">Locator Name</div>';
        echo '<div class="tablecell1">Locator ID</div>';
        echo '<div class="tablecell1">Activation Status</div>';
        echo '<div class="tablecell1">Activation Date</div>';
        echo '<div class="tablecell1">Deactivation Date</div>';
        echo '</div>';
        $x=0;
        while(($row = mysqli_fetch_row($result))){
        echo '<div class="tablerow">';
        echo '<div class="tablecell1">';
       
        echo '<span id="spaninvnum'.($x+1).'">';
        echo ($row[0]);
        echo '</span>';
        
        echo '</div>';
        echo '<div class="tablecell1">';
       
        echo '<span id="spanplantype'.($x+1).'">';
        echo ($row[1]);
        echo '</span>';
      
        echo '</div>';
        echo '<div class="tablecell1">';
        
        echo '<span id="spanplanrate'.($x+1).'">';
        echo ($row[2]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
        
        echo '<span id="spanbillingcycle'.($x+1).'">';
        echo ($row[3]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
       
        echo '<span id="spanstartdate'.($x+1).'">';
        echo ($row[4]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
      
        echo '<span id="spanendingdate'.($x+1).'">';
        echo ($row[5]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
       
        echo '<span id="spanproductmodel'.($x+1).'">';
        echo ($row[6]);
        echo '</span>';
        
        echo '</div>';
        echo '<div class="tablecell1">';
        
        echo '<span id="spanimei'.($x+1).'">';
        echo ($row[7]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
       
        echo '<span id="spansim'.($x+1).'">';
        echo ($row[8]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
       
        echo '<span id="spantelnumber'.($x+1).'">';
        echo ($row[9]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
        
        echo '<span id="spanlocatorname'.($x+1).'">';
        echo ($row[10]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
        
        echo '<span id="spanlocatorid'.($x+1).'">';
        echo ($row[11]);
        echo '</span>';
      
        echo '</div>';
        echo '<div class="tablecell1">';
       
        echo '<span id="spanactivationstatus'.($x+1).'">';
        echo ($row[12]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
        
        echo '<span id="spanactivationdate'.($x+1).'">';
        echo ($row[13]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
        
        echo '<span id="spandeactivationdate'.($x+1).'">';
        echo ($row[14]);
        echo '</span>';
       
        echo '</div>';
            $x++;
        echo '</div>';
        }
        echo '</div>';
        if($x===0){
           
           echo '<p style="color:red;">No result set.</p>';
        }
       
        echo '<div style="clear:both;"></div>';
    }
    
    mysqli_close($conn);
?>