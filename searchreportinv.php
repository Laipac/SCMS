<?php

/* 
 * displays invoice, plan rate,plan type, billing cyle, start date, end date, renewal, imei, sim details based on search criterias
 */
    require 'dbConfig.php';

    $customer = $_POST['customer'];
    $invtype = $_POST['invtype'];
    $invstatus = $_POST['invstatus'];
    
    
    if($customer==='Blank'){
        $customer= null;
    }
    if($invtype==='Blank'){
        $invtype = null;
    }
    if($invstatus==='Blank'){
        $invstatus = null;
    }
    
    //left join takes everything if nothing matches, inner join only takes row that matches.
    //$sql= $conn->prepare('SELECT invoices.invNum,serviceplan.plantype,serviceplan.planrate,productmodel.billingcycle,productmodel.startDate,productmodel.endingDate,productmodelmaster.productmodelname,productmodelimei.imei,productmodelsim.simnumber,sim.telnumber,sim.locatorname,sim.locatorid,sim.activationstatus,sim.activationdate,sim.deactivationdate FROM customers LEFT JOIN invoices ON customers.frstInv=invoices.frstInv LEFT JOIN productmodel ON productmodel.invNum=invoices.invNum LEFT JOIN productmodelimei ON productmodel.prodmodelid=productmodelimei.productmodelinv LEFT JOIN productmodelsim ON productmodelsim.productmodelinv=productmodel.prodmodelid LEFT JOIN sim ON sim.simnumber=productmodelsim.simnumber LEFT JOIN customercode ON customercode.customercodeid=customers.customercode LEFT JOIN serviceplatform ON customers.platform=serviceplatform.platformid LEFT JOIN servicebillto ON serviceplatform.platformid=servicebillto.serviceplatform LEFT JOIN saleschannel ON invoices.salesChannel=saleschannel.channelid LEFT JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel LEFT JOIN serviceplan ON serviceplan.planid=productmodel.serviceplan WHERE (? IS NULL OR (customers.frstInv = ?) OR (CONCAT(customercode.customercode,customers.frstInv)=?)) AND (? IS NULL OR (servicebillto.servicebilltoid = ?)) AND (? IS NULL OR (serviceplatform.platformid = ?)) AND (? IS NULL OR (platformadmin.platformadminid = ?)) AND (? IS NULL OR (saleschannel.channelid = ?)) AND (? IS NULL OR (productmodel.productmodel = ?)) AND (? IS NULL OR (productmodel.startDate >= ?)) AND (? IS NULL OR (productmodel.startDate <= ?)) AND (? IS NULL OR (productmodel.renewalDate >= ?)) AND (? IS NULL OR (productmodel.renewalDate <= ?)) AND (? IS NULL OR (productmodel.endingDate >= ?)) AND (? IS NULL OR (productmodel.endingDate <= ?))');
    //$sql->bind_param('sssiiiiiiiiiissssssssssss',$customer,$customer,$customer,$servicebillto,$servicebillto,$platform,$platform,$platformadmin,$platformadmin,$saleschannel,$saleschannel,$productmodel,$productmodel,$hasbeenservicefrom,$hasbeenservicefrom,$hasbeenserviceto,$hasbeenserviceto,$tobeexpiredfrom,$tobeexpiredfrom,$tobeexpiredto,$tobeexpiredto,$notinservicefrom,$notinservicefrom,$notinserviceto,$notinserviceto);
    
    $sql= $conn->prepare('SELECT customercode.customername,invoices.invNum,invoices.frstInv,invoices.invType,invoices.status,saleschannel.channelname,invoices.customerPO FROM customercode INNER JOIN customers ON customers.customercode=customercode.customercodeid INNER JOIN invoices ON invoices.frstInv=customers.frstInv INNER JOIN saleschannel ON saleschannel.channelid=invoices.salesChannel WHERE (? IS NULL OR (customercode.customercodeid = ?)) AND (? IS NULL OR (invoices.invType = ?)) AND (? IS NULL OR (invoices.status = ?))');
    $sql->bind_param('iissss',$customer,$customer,$invtype,$invtype,$invstatus,$invstatus);
    
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        
        die('There was an error running the query [' . $conn->error . ']');
        echo '<p style="color:red;">Error running query.</p>';
    }
    else{
        echo '<div class="tablelayout">';
        echo '<div class="tableheading">';
        echo '<div class="tablecell1">Customer</div>';
        echo '<div class="tablecell1">Invoice Number</div>';
        echo '<div class="tablecell1">First Invoice</div>';
        echo '<div class="tablecell1">Invoice Type</div>';
        echo '<div class="tablecell1">Invoice Status</div>';
        echo '<div class="tablecell1">Sales Channel</div>';
        echo '<div class="tablecell1">Customer PO</div>';
        echo '</div>';
        $x=0;
        while(($row = mysqli_fetch_row($result))){
        echo '<div class="tablerow">';
        echo '<div class="tablecell1">';
       
        echo '<span id="spancustomer'.($x+1).'">';
        echo ($row[0]);
        echo '</span>';
        
        echo '</div>';
        echo '<div class="tablecell1">';
       
        echo '<span id="spaninvnum'.($x+1).'">';
        echo ($row[1]);
        echo '</span>';
      
        echo '</div>';
        echo '<div class="tablecell1">';
        
        echo '<span id="spanfrstinv'.($x+1).'">';
        echo ($row[2]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
        
        echo '<span id="spaninvtype'.($x+1).'">';
        echo ($row[3]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
       
        echo '<span id="spaninvstatus'.($x+1).'">';
        echo ($row[4]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
      
        echo '<span id="spansaleschannel'.($x+1).'">';
        echo ($row[5]);
        echo '</span>';
       
        echo '</div>';
        echo '<div class="tablecell1">';
       
        echo '<span id="spancustomerpo'.($x+1).'">';
        echo ($row[6]);
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