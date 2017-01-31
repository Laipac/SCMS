<?php

/* 
 * read excel files for sim upload
 */
    include 'Classes/PHPExcel/IOFactory.php';
   
   // $inputFileName = 'uploads/'.$_POST['filename'];
    $uploadtype=$_POST['uploadtype'];
    //$exceltype=$_POST['exceltype'];
     $exceltype='xls';
    $inputFileName = 'uploads/Book1.xls';
    
    if($exceltype==='xls'){
        $exceltype='Excel5';
    }
    else{
        $exceltype='Excel2007';
    }
    
    
    try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($exceltype);
    $objPHPExcel = $objReader->load($inputFileName);
    } catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    }
    
    $sheet = $objPHPExcel->getSheet(0); 
    $highestRow = $sheet->getHighestRow(); 
    $highestColumn = $sheet->getHighestColumn();
    
    
    echo '<div id="simdata" style="display:table;border-collapse: collapse;">';
    echo '<div style="display:table-row;border: 1px solid #000;">';
    echo '<div style="display:table-cell;border: 1px solid #000; font-weight:bold;">SIM</div>';
    if($uploadtype==='IMEI'){
        echo '<div style="display:table-cell;border: 1px solid #000; font-weight:bold;">IMEI</div>';
    }
    
    
    echo '</div>'; 
    //  Loop through each row of the worksheet in turn
    $x=false;
    for ($row = 2; $row <= $highestRow; $row++){ 
        /*  Read a row of data into an array
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                        NULL,
                                        TRUE,
                                        FALSE);
          Insert row data array into your database of choice here*/
        echo '<div style="display:table-row;border: 1px solid #000;">';
        echo '<div id="simdata'.$row.'" style="display:table-cell;border: 1px solid #000;">';
        echo $sheet->getCell('B'.$row)->getValue();
        echo '</div>';
        if($uploadtype==='IMEI'){
            echo '<div id="simimei'.$row.'" style="display:table-cell;border: 1px solid #000;">';
            echo $sheet->getCell('C'.$row)->getValue();
            echo '</div>';
        }
        
        
        if((is_numeric($sheet->getCell('B'.$row)->getValue())===false) || (is_numeric($sheet->getCell('C'.$row)->getValue())===false)){
            echo '<div style="display:table-cell; color:red;border: 1px solid #000;">';
            echo 'SIM or IMEI must be numeric.';
            echo '</div>';
            $x=true;
            
        }
        if(strlen($sheet->getCell('B'.$row)->getValue())>19){
            echo '<div style="display:table-cell; color:red;border: 1px solid #000;">';
            echo 'SIM should be 19 digits only.';
            echo '</div>';
            $x=true;
        }
        if(strlen($sheet->getCell('B'.$row)->getValue())<19){
            echo '<div style="display:table-cell; color:red;border: 1px solid #000;">';
            echo 'SIM should be 19 digits.';
            echo '</div>';
            $x=true;
        }
        if($uploadtype==='IMEI'){
            if(strlen($sheet->getCell('C'.$row)->getValue())>15){
                echo '<div style="display:table-cell; color:red;border: 1px solid #000;">';
                echo 'IMEI should be 15 digits only.';
                echo '</div>';
                $x=true;
            }
            if(strlen($sheet->getCell('C'.$row)->getValue())<15){
                echo '<div style="display:table-cell; color:red;border: 1px solid #000;">';
                echo 'IMEI should be 15 digits.';
                echo '</div>';
                $x=true;
            }
        }     
        echo '</div>';
    }
   echo '</div>';
   echo '<input type="hidden" id="simdatacount" value="'.($highestRow-1).'" />';
   echo '<hr></hr>';
   if($x){
       echo '<input type="hidden" id="simcheck" value="0" />';
   }
   else{
       echo '<input type="hidden" id="simcheck" value="1" />';
   }
    //echo '<p>';
   
   include 'dbConfig.php';
   echo '<label for="simfiletype">SIM Type:</label>';
   echo '<select name="simfiletype" id="simfiletype">';
   echo '<option value="Blank"><--Select--></option>';
                      
    $sql= $conn->prepare('SELECT simid,simtype FROM simcardmaster');
    $sql->execute();
    $sql->bind_result($simid,$simtype);
    while($sql->fetch()){
    echo '<option value="'.$simid.'">'.$simtype.'</option>';  
   }
    echo '</select>'; 
  mysqli_close($conn);
?>