<?php

/* 
 * set resource authorizations based on usergroup
 */
    require 'dbConfig.php';
    $userRole = $_POST['usertype'];
    $platformsearch = $_POST['platformsearch'];
    $platformcreate = $_POST['platformcreate'];
    $platformedit = $_POST['platformedit'];
    $channelsearch = $_POST['channelsearch'];
    $channelcreate = $_POST['channelcreate'];
    $channeledit = $_POST['channeledit'];
    $productsearch = $_POST['productsearch'];
    $productcreate = $_POST['productcreate'];
    $productedit = $_POST['productedit'];
    $simsearch = $_POST['simsearch'];
    $simcreate = $_POST['simcreate'];
    $simedit = $_POST['simedit'];
    $plansearch = $_POST['plansearch'];
    $plancreate = $_POST['plancreate'];
    $planedit = $_POST['planedit'];
    $billtosearch = $_POST['billtosearch'];
    $billtocreate = $_POST['billtocreate'];
    $billtoedit = $_POST['billtoedit'];
    $platformadminsearch = $_POST['platformadminsearch'];
    $platformadmincreate = $_POST['platformadmincreate'];
    $platformadminedit = $_POST['platformadminedit'];
    $companycodesearch = $_POST['companycodesearch'];
    $companycodecreate = $_POST['companycodecreate'];
    $companycodeedit = $_POST['companycodeedit'];
    
    if($companycodesearch==='true'){
        $companycodesearch=1;
    }
    else{
        $companycodesearch=0;
    }
    if($companycodecreate==='true'){
        $companycodecreate=1;
    }
    else{
        $companycodecreate=0;
    }
    if($companycodeedit==='true'){
        $companycodeedit=1;
    }
    else{
        $companycodeedit=0;
    }
    
    
    
    if($platformadminsearch==='true'){
        $platformadminsearch=1;
    }
    else{
        $platformadminsearch=0;
    }
    if($platformadmincreate==='true'){
        $platformadmincreate=1;
    }
    else{
        $platformadmincreate=0;
    }
    if($platformadminedit==='true'){
        $platformadminedit=1;
    }
    else{
        $platformadminedit=0;
    }
    
    
    if($billtosearch==='true'){
        $billtosearch=1;
    }
    else{
        $billtosearch=0;
    }
    if($billtocreate==='true'){
        $billtocreate=1;
    }
    else{
        $billtocreate=0;
    }
    if($billtoedit==='true'){
        $billtoedit=1;
    }
    else{
        $billtoedit=0;
    }
    
    if($platformsearch==='true'){
        $platformsearch=1;
    }
    else{
        $platformsearch=0;
    }
    if($platformcreate==='true'){
        $platformcreate=1;
    }
    else{
        $platformcreate=0;
    }
    if($platformedit==='true'){
        $platformedit=1;
    }
    else{
        $platformedit=0;
    }
    
    
    if($channelsearch==='true'){
        $channelsearch=1;
    }
    else{
        $channelsearch=0;
    }
    if($channelcreate==='true'){
        $channelcreate=1;
    }
    else{
        $channelcreate=0;
    }
    if($channeledit==='true'){
        $channeledit=1;
    }
    else{
        $channeledit=0;
    }
    
    if($productsearch==='true'){
        $productsearch=1;
    }
    else{
        $productsearch=0;
    }
    if($productcreate==='true'){
        $productcreate=1;
    }
    else{
        $productcreate=0;
    }
    if($productedit==='true'){
        $productedit=1;
    }
    else{
        $productedit=0;
    }
    
    if($simsearch==='true'){
        $simsearch=1;
    }
    else{
        $simsearch=0;
    }
    if($simcreate==='true'){
        $simcreate=1;
    }
    else{
        $simcreate=0;
    }
    if($simedit==='true'){
        $simedit=1;
    }
    else{
        $simedit=0;
    }
    
     if($plansearch==='true'){
        $plansearch=1;
    }
    else{
        $plansearch=0;
    }
    if($plancreate==='true'){
        $plancreate=1;
    }
    else{
        $plancreate=0;
    }
    if($planedit==='true'){
        $planedit=1;
    }
    else{
        $planedit=0;
    }
    
    $sql= $conn->prepare('UPDATE resourceauth SET searchauth=?,createauth=?,editauth=? WHERE usertype=? AND resourcetype="Service Platform"');
    $sql->bind_param('iiii',$platformsearch,$platformcreate,$platformedit,$userRole);
    if($sql->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
    $sql1= $conn->prepare('UPDATE resourceauth SET searchauth=?,createauth=?,editauth=? WHERE usertype=? AND resourcetype="Sales Channel"');
    $sql1->bind_param('iiii',$channelsearch,$channelcreate,$channeledit,$userRole);
    if($sql1->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
    $sql2= $conn->prepare('UPDATE resourceauth SET searchauth=?,createauth=?,editauth=? WHERE usertype=? AND resourcetype="Product Model"');
    $sql2->bind_param('iiii',$productsearch,$productcreate,$productedit,$userRole);
    if($sql2->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
    $sql3= $conn->prepare('UPDATE resourceauth SET searchauth=?,createauth=?,editauth=? WHERE usertype=? AND resourcetype="Sim Card"');
    $sql3->bind_param('iiii',$simsearch,$simcreate,$simedit,$userRole);
    if($sql3->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
    $sql4= $conn->prepare('UPDATE resourceauth SET searchauth=?,createauth=?,editauth=? WHERE usertype=? AND resourcetype="Service Plan"');
    $sql4->bind_param('iiii',$plansearch,$plancreate,$planedit,$userRole);
    if($sql4->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
    
    $sql5= $conn->prepare('UPDATE resourceauth SET searchauth=?,createauth=?,editauth=? WHERE usertype=? AND resourcetype="Service Bill To"');
    $sql5->bind_param('iiii',$billtosearch,$billtocreate,$billtoedit,$userRole);
    if($sql5->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
    
    $sql6= $conn->prepare('UPDATE resourceauth SET searchauth=?,createauth=?,editauth=? WHERE usertype=? AND resourcetype="Platform Admin"');
    $sql6->bind_param('iiii',$platformadminsearch,$platformadmincreate,$platformadminedit,$userRole);
    if($sql6->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
    
    
    $sql7= $conn->prepare('UPDATE resourceauth SET searchauth=?,createauth=?,editauth=? WHERE usertype=? AND resourcetype="Company Code"');
    $sql7->bind_param('iiii',$companycodesearch,$companycodecreate,$companycodeedit,$userRole);
    if($sql7->execute()){
        echo 'success';
    }
    else{
        echo 'failed';
    }
    mysqli_close($conn);
?>