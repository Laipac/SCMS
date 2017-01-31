<?php

/* 
 * set function authorization based on user group
 */
    require 'dbConfig.php';
    
    $userRole = $_POST['usertype'];
    $accountsearch = $_POST['accountsearch'];
    $accountcreate = $_POST['accountcreate'];
    $accountedit = $_POST['accountedit'];
    $invoicefull = $_POST['invoicefull'];
    $invoicesimfull = $_POST['invoicesimfull'];
    $invoicesimcheck = $_POST['invoicesimcheck'];
    $invoiceproductfull = $_POST['invoiceproductfull'];
    $invoiceproductcheck = $_POST['invoiceproductcheck'];
    $invoiceservicefull = $_POST['invoiceservicefull'];
    $invoiceservicecheck = $_POST['invoiceservicecheck'];
    $invoicerenewfull = $_POST['invoicerenewfull'];
    $invoicerenewcheck = $_POST['invoicerenewcheck'];
    $simfull = $_POST['simfull'];
    $siminventory = $_POST['siminventory'];
    $simactivation = $_POST['simactivation'];
    $simdeactivation = $_POST['simdeactivation'];
    $simedit = $_POST['simedit'];
    $servicemgmt = $_POST['servicemgmt'];
    $repindividual = $_POST['repindividual'];
    $repadmin = $_POST['repadmin'];
    $repplatform = $_POST['repplatform'];
    
    
    if($repindividual==='true'){
        $repindividual=1;
    }
    else{
        $repindividual=0;
    }
    if($repadmin==='true'){
        $repadmin=1;
    }
    else{
       $repadmin=0;
    }
    if($repplatform==='true'){
        $repplatform=1;
    }
    else{
       $repplatform=0;
    }
    
    
    if($accountsearch==='true'){
        $accountsearch=1;
    }
    else{
        $accountsearch=0;
    }
    if($accountcreate==='true'){
        $accountcreate=1;
    }
    else{
        $accountcreate=0;
    }
    if($accountedit==='true'){
        $accountedit=1;
    }
    else{
        $accountedit=0;
    }
    
    
    if($invoicefull==='true'){
        $invoicefull=1;
    }
    else{
        $invoicefull=0;
    }
    if($invoicesimfull==='true'){
        $invoicesimfull=1;
    }
    else{
        $invoicesimfull=0;
    }
    if($invoicesimcheck==='true'){
        $invoicesimcheck=1;
    }
    else{
        $invoicesimcheck=0;
    }
    if($invoiceproductfull==='true'){
       $invoiceproductfull=1;
    }
    else{
        $invoiceproductfull=0;
    }
    if($invoiceproductcheck==='true'){
       $invoiceproductcheck=1;
    }
    else{
        $invoiceproductcheck=0;
    }
    if($invoiceservicefull==='true'){
        $invoiceservicefull=1;
    }
    else{
        $invoiceservicefull=0;
    }
    if($invoiceservicecheck==='true'){
        $invoiceservicecheck=1;
    }
    else{
        $invoiceservicecheck=0;
    }
    if($invoicerenewfull==='true'){
        $invoicerenewfull=1;
    }
    else{
        $invoicerenewfull=0;
    }
    if($invoicerenewcheck==='true'){
        $invoicerenewcheck=1;
    }
    else{
        $invoicerenewcheck=0;
    }
    if($simfull==='true'){
        $simfull=1;
    }
    else{
        $simfull=0;
    }
    if($siminventory==='true'){
        $siminventory=1;
    }
    else{
        $siminventory=0;
    }
    if($simactivation==='true'){
        $simactivation=1;
    }
    else{
        $simactivation=0;
    }
    if($simdeactivation==='true'){
        $simdeactivation=1;
    }
    else{
        $simdeactivation=0;
    }
    if($simedit==='true'){
        $simedit=1;
    }
    else{
        $simedit=0;
    }
    if($servicemgmt==='true'){
        $servicemgmt=1;
    }
    else{
        $servicemgmt=0;
    }
    
    
    $sql= $conn->prepare('UPDATE functionauth SET accountsearch=?,accountcreate=?,accountedit=?,invoicefull=?,invoicesimfull=?,invoicesimcheck=?,invoiceproductfull=?,invoiceproductcheck=?,invoiceservicefull=?,invoiceservicecheck=?,invoicerenewfull=?,invoicerenewcheck=?,simfull=?,siminventory=?,simactivation=?,simdeactivation=?,simedit=?,servicemgmt=?,repindividual=?,repadmin=?,repplatform=? WHERE usertype=?');
    $sql->bind_param('iiiiiiiiiiiiiiiiiiiiii',$accountsearch,$accountcreate,$accountedit,$invoicefull,$invoicesimfull,$invoicesimcheck,$invoiceproductfull,$invoiceproductcheck,$invoiceservicefull,$invoiceservicecheck,$invoicerenewfull,$invoicerenewcheck,$simfull,$siminventory,$simactivation,$simdeactivation,$simedit,$servicemgmt,$repindividual,$repadmin,$repplatform,$userRole);
    if($sql->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
   
   
    mysqli_close($conn);
?>