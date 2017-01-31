<?php

/* 
 * script to update sim card types
 */
    require '../dbConfig.php';
    
    $simid=$_POST["simid"];
    $simprovider=$_POST["simprovider"];
    $simrate=$_POST["simrate"];
    $simtype=$_POST["simtype"];
    $simcurrency=$_POST["simcurrency"];
    $simbilling=$_POST["simbilling"];
    //$simplan=$_POST["simplan"];
    $simnoteplan=$_POST["simnoteplan"];
    $simsize=$_POST["simsize"];
    $simonline=$_POST["simonline"];
    $sql1 = $conn->prepare('SELECT simtype FROM simcardmaster WHERE simtype = ? AND simid != ?');
    $sql1->bind_param('si',$simtype,$simid);
    if($sql1->execute()){
         $sql1->store_result();
         if($sql1->num_rows()>0){
            echo 'exists';
         }
         else{
            //    $sql= $conn->prepare('UPDATE simcardmaster SET simtype=?,simprovider=?,simrate=?,simcurrency=?,simbilling=?,simplan=?,simnoteplan=?,simsize=?,simonline=? WHERE simid=?');
            //    $sql->bind_param('ssssiisssi',$simtype,$simprovider,$simrate,$simcurrency,$simbilling,$simplan,$simnoteplan,$simsize,$simonline,$simid);  
                
                $sql= $conn->prepare('UPDATE simcardmaster SET simtype=?,simprovider=?,simrate=?,simcurrency=?,simbilling=?,simnoteplan=?,simsize=?,simonline=? WHERE simid=?');
                $sql->bind_param('ssssisssi',$simtype,$simprovider,$simrate,$simcurrency,$simbilling,$simnoteplan,$simsize,$simonline,$simid);  
              
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