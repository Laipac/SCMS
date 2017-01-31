<?php
/* 
 * script to update company code
 */
    require '../dbConfig.php';
    
    $platformname=$_POST["platformname"];
    $platformid=$_POST["platformid"];
    $customercode=$_POST['customercode'];
    $sql1 = $conn->prepare('SELECT customercode FROM customercode WHERE (customercode = ? OR customername = ?) AND customercodeid != ?');
    $sql1->bind_param('ssi',$customercode,$platformname,$platformid);
    if($sql1->execute()){
        $sql1->store_result();
        if($sql1->num_rows()>0){
            echo 'exists';
        }
        else{
            $sql= $conn->prepare('UPDATE customercode SET customername=?,customercode=? WHERE customercodeid=?');
            $sql->bind_param('ssi',$platformname,$customercode,$platformid);  
            if($sql->execute()){
                echo 'success';
              //  die('There was an error running the query [' . $conn->error . ']');
            }
            else{
                echo 'failed';
            }
        }
    }
    else{
        echo 'failed';
    }
    
    mysqli_close($conn);
?>