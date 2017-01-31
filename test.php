

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 include 'Classes/PHPExcel/IOFactory.php';
 
$excel = new PHPExcel();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="your_name.xls"');
header('Cache-Control: max-age=0');  

// Do your stuff here

$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');  

// This line will force the file to download    
$writer->save('php://output');
   
   
?>

