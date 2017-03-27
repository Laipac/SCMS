<?php
/* 
 * export to excel module
 */
    require 'dbConfig.php';
    require '/Classes/PHPExcel/IOFactory.php';

     $reporttype = $_POST['reporttype1'];
    
   
    
    if($reporttype==="Available"){
        $sql= $conn->prepare('SELECT simcardmaster.simtype, sim.simnumber, sim.activationstatus, sim.inventorystatus, sim.storagelocation FROM sim INNER JOIN simcardmaster ON simcardmaster.simid=sim.simgroup LEFT JOIN productmodelsim ON productmodelsim.simnumber=sim.simnumber WHERE productmodelsim.simnumber IS NULL');
        
    }                         
    else if($reporttype==="Assigned"){
        $sql= $conn->prepare('SELECT simcardmaster.simtype, sim.simnumber, sim.activationstatus, sim.inventorystatus, sim.storagelocation, sim.imei, sim.locatorid, sim.locatorname FROM sim INNER JOIN simcardmaster ON simcardmaster.simid=sim.simgroup INNER JOIN productmodelsim ON productmodelsim.simnumber=sim.simnumber');
       
    }
    $sql->execute();
   
    if(!$result = $sql->get_result()){
        
        die('There was an error running the query [' . $conn->error . ']');
        echo '<p style="color:red;">Error running query.</p>';
    }
    else{
        
        $objPHPExcel = new PHPExcel();
       
        header('Content-Type: application/vnd.ms-excel');
        if($reporttype==="Assigned"){
            header('Content-Disposition: attachment;filename="assignedsimreport.xlsx"');
        }
        else{
            header('Content-Disposition: attachment;filename="availablesimreport.xlsx"');
        }
        
        header('Cache-Control: max-age=0');

        $objPHPExcel->setActiveSheetIndex(0); 
        $rowCount = 1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'SIM Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, 'SIM Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, 'Activation Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, 'Inventory Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, 'Storage Location');
        if($reporttype==="Assigned"){
           
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, 'IMEI');
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, 'Locator ID');
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, 'Locator Name');
        }
        
       
        $rowCount++;
        
        while(($row = mysqli_fetch_row($result))){
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row[0]);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row[1]);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row[2]);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row[3]);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row[4]);
           
             if($reporttype==="Assigned"){
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row[5]);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row[6]);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $row[7]);
             }
       
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