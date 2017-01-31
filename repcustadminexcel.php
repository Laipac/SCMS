<?php
/* 
 * export to excel module
 */
    require 'dbConfig.php';
    require 'public_html/Classes/PHPExcel/IOFactory.php';

    $customer = $_POST['customer1'];
    $servicebillto = $_POST['servicebillto1'];
    $platform = $_POST['platform1'];
    $platformadmin = $_POST['platformadmin1'];
    $saleschannel = $_POST['saleschannel1'];
    $productmodel = $_POST['productmodel1'];
    $hasbeenserviceto = $_POST['hasbeenserviceto1'];
    $hasbeenservicefrom = $_POST['hasbeenservicefrom1'];
    $notinserviceto = $_POST['notinserviceto1'];
    $notinservicefrom = $_POST['notinservicefrom1'];
    $tobeexpiredfrom = $_POST['tobeexpiredfrom1'];
    $tobeexpiredto = $_POST['tobeexpiredto1'];
    
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
        
        $objPHPExcel = new PHPExcel();
       
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="adminreport.xlsx"');
        header('Cache-Control: max-age=0');

        $objPHPExcel->setActiveSheetIndex(0); 
        $rowCount = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, 'Plan');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, 'Rate');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, 'Billing Cycle');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, 'Start Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, 'Ending Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, 'Product Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, 'IMEI');
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, 'SIM');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, 'Tel. Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, 'Locator Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, 'Locator ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, 'Activation Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, 'Activation Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, 'Deactivation Date');
        $rowCount++;
        
        
        while(($row = mysqli_fetch_row($result))){
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row[0]);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row[1]);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row[2]);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row[3]);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row[4]);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row[5]);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row[6]);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row[7]);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row[8]);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount,$row[9]);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $row[10]);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $row[11]);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $row[12]);
            $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $row[13]);
            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $row[14]);
       
            $rowCount++;
       
        }
     

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        //$objWriter->save('export/FileName.xlsx');
        //$objWriter->save('some_excel_file.xlsx');
        ob_end_clean();
       $objWriter->save('php://output');
        
        
    }
    
    mysqli_close($conn);
?>