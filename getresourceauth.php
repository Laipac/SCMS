<?php

/* 
 * sets usergroup resource authorization
 */
    require 'dbConfig.php';
    
    $userRole=$_POST["userrole"];
    
    //$userRole=1;
    
    $sql= $conn->prepare('SELECT searchauth,createauth,editauth FROM resourceauth WHERE usertype = ? AND resourcetype="Service Platform"');
    $sql->bind_param('i',$userRole);
    $sql->execute();
    if(!$result = $sql->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row = mysqli_fetch_row($result)) > 0){
        
        $results = array(
           'platformsearch' => ($row[0]),
           'platformcreate' => ($row[1]),
           'platformedit' => ($row[2])
        );  
    }
    else
    {
        echo 'failed';
    }
    $sql1= $conn->prepare('SELECT searchauth,createauth,editauth FROM resourceauth WHERE usertype = ? AND resourcetype="Sales Channel"');
    $sql1->bind_param('i',$userRole);
    $sql1->execute();
    if(!$result1 = $sql1->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row1 = mysqli_fetch_row($result1)) > 0){
        
        $results['channelsearch'] = $row1[0];
        $results['channelcreate']=$row1[1];
        $results['channeledit']=$row1[2];
        
    }
    else
    {
        echo 'failed';
    }
    $sql2= $conn->prepare('SELECT searchauth,createauth,editauth FROM resourceauth WHERE usertype = ? AND resourcetype="Product Model"');
    $sql2->bind_param('i',$userRole);
    $sql2->execute();
    if(!$result2 = $sql2->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row2 = mysqli_fetch_row($result2)) > 0){
        $results['productsearch'] = $row2[0];
        $results['productcreate']=$row2[1];
        $results['productedit']=$row2[2];
       
      
    }
    else
    {
        echo 'failed';
    }
    $sql3= $conn->prepare('SELECT searchauth,createauth,editauth FROM resourceauth WHERE usertype = ? AND resourcetype="Sim Card"');
    $sql3->bind_param('i',$userRole);
    $sql3->execute();
    if(!$result3 = $sql3->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row3 = mysqli_fetch_row($result3)) > 0){
         $results['simsearch'] = $row3[0];
        $results['simcreate']=$row3[1];
        $results['simedit']=$row3[2];
    }
    else
    {
        echo 'failed';
    }
    $sql4= $conn->prepare('SELECT searchauth,createauth,editauth FROM resourceauth WHERE usertype = ? AND resourcetype="Service Plan"');
    $sql4->bind_param('i',$userRole);
    $sql4->execute();
    if(!$result4 = $sql4->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row4 = mysqli_fetch_row($result4)) > 0){
        
      $results['plansearch'] = $row4[0];
        $results['plancreate']=$row4[1];
        $results['planedit']=$row4[2];
     
    }
    else
    {
        echo 'failed';
    }
    $sql5= $conn->prepare('SELECT searchauth,createauth,editauth FROM resourceauth WHERE usertype = ? AND resourcetype="Service Bill To"');
    $sql5->bind_param('i',$userRole);
    $sql5->execute();
    if(!$result5 = $sql5->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row5 = mysqli_fetch_row($result5)) > 0){
        
      $results['billtosearch'] = $row5[0];
        $results['billtocreate']=$row5[1];
        $results['billtoedit']=$row5[2];
     
    }
    else
    {
        echo 'failed';
    }
    
    
    $sql6= $conn->prepare('SELECT searchauth,createauth,editauth FROM resourceauth WHERE usertype = ? AND resourcetype="Platform Admin"');
    $sql6->bind_param('i',$userRole);
    $sql6->execute();
    if(!$result6 = $sql6->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row6 = mysqli_fetch_row($result6)) > 0){
        
      $results['platformadminsearch'] = $row6[0];
        $results['platformadmincreate']=$row6[1];
        $results['platformadminedit']=$row6[2];
     
    }
    else
    {
        echo 'failed';
    }
    
    
    
    $sql7= $conn->prepare('SELECT searchauth,createauth,editauth FROM resourceauth WHERE usertype = ? AND resourcetype="Company Code"');
    $sql7->bind_param('i',$userRole);
    $sql7->execute();
    if(!$result7 = $sql7->get_result()){
        die('There was an error running the query [' . $conn->error . ']');
    }
    else if(($row7 = mysqli_fetch_row($result7)) > 0){
        
      $results['companycodesearch'] = $row7[0];
        $results['companycodecreate']=$row7[1];
        $results['companycodeedit']=$row7[2];
     
    }
    else
    {
        echo 'failed';
    }
    
    
    echo json_encode($results);
   // print_r($results);
    mysqli_close($conn);
?>