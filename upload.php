<?php
/* 
 * upload script that uploads sim details from an excel file
 */
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$uploadtype=$_POST['fileuploadtype'];
$exceltype=$_POST['fileexceltype'];


if($uploadtype==='IMEI'){
    $uploadtype='1';
}
else{
    $uploadtype='0';
}

if($exceltype==='xls'){
    $exceltype='0';
}
else{
    $exceltype='1';
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    unlink($target_file);
    $uploadOk = 1;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

header('Location: addsim.php?upload='.basename( $_FILES["fileToUpload"]["name"]).$uploadtype.$exceltype); exit;