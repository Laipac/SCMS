<?php
/* 
 * add user details to database
 */
    require 'dbConfig.php';
    $rolename = $_POST['rolename'];
    
    
   
    $sql1 = $conn->prepare('SELECT rolename FROM roles WHERE rolename = ?');
    $sql1->bind_param('s',$rolename);
    if($sql1->execute()){
        $sql1->store_result();
        if($sql1->num_rows()>0){
             echo 'exists';
        }
        else{
            
            $sql= $conn->prepare('INSERT INTO roles (rolename) VALUES (?)');
            $sql->bind_param('s',$rolename);

            if($sql->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
            $newid = $sql->insert_id;
            $sql2= $conn->prepare('INSERT INTO functionauth (accountsearch,accountcreate,accountedit,invoicefull,invoicesimfull,invoicesimcheck,invoiceproductfull,invoiceproductcheck,invoiceservicefull,invoiceservicecheck,invoicerenewfull,invoicerenewcheck,simfull,siminventory,simactivation,simdeactivation,simedit,servicemgmt,repindividual,repadmin,repplatform,usertype) VALUES (0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,?)');
            $sql2->bind_param('i',$newid);
            if($sql2->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
            $sql3= $conn->prepare('INSERT INTO userauth (usertype,searchauth,createauth,editauth) VALUES (?,0,0,0)');
            $sql3->bind_param('i',$newid);
            if($sql3->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
            $sql4= $conn->prepare('INSERT INTO resourceauth (resourcetype,searchauth,createauth,editauth,usertype) VALUES ("Service Platform",0,0,0,?)');
            $sql4->bind_param('i',$newid);
            if($sql4->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
            $sql5= $conn->prepare('INSERT INTO resourceauth (resourcetype,searchauth,createauth,editauth,usertype) VALUES ("Sales Channel",0,0,0,?)');
            $sql5->bind_param('i',$newid);
            if($sql5->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
            $sql6= $conn->prepare('INSERT INTO resourceauth (resourcetype,searchauth,createauth,editauth,usertype) VALUES ("Product Model",0,0,0,?)');
            $sql6->bind_param('i',$newid);
            if($sql6->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
            $sql7= $conn->prepare('INSERT INTO resourceauth (resourcetype,searchauth,createauth,editauth,usertype) VALUES ("Sim Card",0,0,0,?)');
            $sql7->bind_param('i',$newid);
            if($sql7->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
            $sql8= $conn->prepare('INSERT INTO resourceauth (resourcetype,searchauth,createauth,editauth,usertype) VALUES ("Service Plan",0,0,0,?)');
            $sql8->bind_param('i',$newid);
            if($sql8->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
            $sql9= $conn->prepare('INSERT INTO resourceauth (resourcetype,searchauth,createauth,editauth,usertype) VALUES ("Service Bill To",0,0,0,?)');
            $sql9->bind_param('i',$newid);
            if($sql9->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
            $sql10= $conn->prepare('INSERT INTO resourceauth (resourcetype,searchauth,createauth,editauth,usertype) VALUES ("Platform Admin",0,0,0,?)');
            $sql10->bind_param('i',$newid);
            if($sql10->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
            $sql11= $conn->prepare('INSERT INTO resourceauth (resourcetype,searchauth,createauth,editauth,usertype) VALUES ("Company Code",0,0,0,?)');
            $sql11->bind_param('i',$newid);
            if($sql11->execute()){
                 echo 'success'; 
            }
            else{
               echo $conn->error();
            }
            
        }
    }
    else{
         echo $conn->error();
    }
    
    mysqli_close($conn);
?>