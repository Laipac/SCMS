<?php
/* 
 * This module gets all bill to details based on service platform.
 */
    require 'dbConfig.php';
    $platform = $_POST['platform'];
    $sql= $conn->prepare('SELECT servicebilltoid,servicebillto FROM servicebillto WHERE serviceplatform = ?');
    $sql->bind_param('i',$platform);
    $sql->execute();
    $sql->bind_result($billtoid,$billto);
    echo '<option value="Blank"><--Select--></option>';
    while($sql->fetch()){
        echo '<option value="'.$billtoid.'">'.$billto.'</option>';
        
    }
   
    mysqli_close($conn);
?>