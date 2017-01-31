<?php
/* 
 * export to excel module
 */
    require 'dbConfig.php';
    require '/Classes/PHPExcel/IOFactory.php';

    $customer = $_POST['customer1'];
    $invtype = $_POST['invtype1'];
    $invstatus = $_POST['invstatus1'];
   
    
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
        
        $objPHPExcel = new PHPExcel();
       
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="invoicereport.xlsx"');
        header('Cache-Control: max-age=0');

        $objPHPExcel->setActiveSheetIndex(0); 
        $rowCount = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, 'Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, 'First Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, 'Invoice Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, 'Invoice Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, 'Sales Channel');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, 'Customer PO');
        $rowCount++;
        
        while(($row = mysqli_fetch_row($result))){
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row[0]);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row[1]);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row[2]);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row[3]);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row[4]);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row[5]);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row[6]);
           
       
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