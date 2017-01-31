<!--
This is the main menu after login
-->
<?php 

session_start();

include "dbConfig.php";
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Menu - SIM CARD Management System</title>
<meta name="description" content=""/>
<meta name="keywords" content=""/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="html5reset.css" media="all"/>
<link rel="stylesheet" href="col.css" media="all"/>
<link rel="stylesheet" href="2cols.css" media="all"/>
<link rel="stylesheet" href="3cols.css" media="all"/>
<link rel="stylesheet" href="4cols.css" media="all"/>
<link rel="stylesheet" href="5cols.css" media="all"/>
<link rel="stylesheet" href="6cols.css" media="all"/>
<link rel="stylesheet" href="7cols.css" media="all"/>
<link rel="stylesheet" href="8cols.css" media="all"/>
<link rel="stylesheet" href="9cols.css" media="all"/>
<link rel="stylesheet" href="10cols.css" media="all"/>
<link rel="stylesheet" href="11cols.css" media="all"/>
<link rel="stylesheet" href="12cols.css" media="all"/>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<style type="text/css">
    input[type=button].btnmain{
        
       
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
         background: url('images/sim.png') 5px no-repeat ;
         cursor:pointer;
         border: none;
         background-position: left center;
       background-color:#34495E;
       color:white;
         
    }
    input[type=button].btndisabled{
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        background: url('images/disabled.png') 5px no-repeat ;
        
        border: none;
        background-position: left center;
        background-color:#EBEBE4;
        color:rgb(84, 84, 84);
         
    }
    input[type=button].btndisabled:hover{
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        background: url('images/disabled.png') 5px no-repeat ;
         
        border: none;
        background-position: left center;
        background-color:#EBEBE4;
        color:rgb(84, 84, 84);  
    }
    input[type=button].btnsys{
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
         background: url('images/sys.png') 5px no-repeat ;
         cursor:pointer;
         border: none;
         background-position: left center;
       background-color:#34495E;
       color:white;
         
    }
    input[type=button].btnexit{
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        
         cursor:pointer;
         border: none;
         
       background-color:#34495E;
       color:white;
         
    }
    input[type="button"]:hover{
        background-color: grey;
        transition: all 0.5s ease;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        color:#34495E;

    }
</style>
<script type="text/javascript">
function btnexit(){

   $.ajax({
        url: "sessionend.php",
        type: "POST",
        success: 
            function(){
                location.href='login.php';
           }
       });
}         
       
    
</script>
</head>
<body>
<?php 
include("sessioncheck.php"); 

?>

   
    <div class="section group">
        
	<div class="col span_2_of_2">
            <div style="text-align:center;clear:both;margin-top:5%;">
                
                <?php
             //   $_SESSION['username']= 'user1';
                    $sql1 = $conn->prepare('SELECT usertype FROM members WHERE username=?');
                    $sql1->bind_param('s',$_SESSION['username']);
                    if($sql1->execute()){
                        $sql1->bind_result($usertype);
                        $sql1->fetch();
                        
                        if($usertype==="Company Admin" || $usertype==="Group Admin" || $usertype==="User" || $usertype==="Customer"){
                            ?>
                                 <input type="button" value="Main Menu"  onclick="location.href='menu.php';" class="btnmain" ></input>
                            <?php
                            
                        }
                        else{
                            ?>
                                 <input type="button" value="Main Menu"  onclick="location.href='menu.php';" class="btndisabled" disabled="disabled"></input>
                            <?php
                           
                        }
                   ?>
               
            </div>
        </div>
      
    </div>
    <div class="section group">
        
        <div class="col span_2_of_2">
            <div style="text-align:center;clear:both;margin-top:5%;">
                <?php
                     if($usertype==="Company Admin" || $usertype==="Group Admin" || $usertype==="User" || $usertype==="Customer"){
                ?>
                    <input type="button" value="Resources" onclick="location.href='sysmenu.php';" class="btnsys"></input>
                 <?php
                     }
                     else{
                ?>
                    <input type="button" value="Resources" onclick="location.href='sysmenu.php';" class="btndisabled" disabled="disabled"></input>
                 <?php
                     }
                ?>
            </div>
        </div>
       
    </div>
    <div class="section group">
        
        <div class="col span_2_of_2">
            <div style="text-align:center;clear:both;margin-top:5%;">
                 <?php
                     if($usertype==="Company Admin" || $usertype==="Group Admin" || $usertype==="User" || $usertype==="Customer"){
                ?>
                    <input type="button" value="Operator"  onclick="location.href='finduser.php';" class="btnsys"></input>
                <?php
                     }
                     else{
                ?>
                    <input type="button" value="Operator"  onclick="location.href='finduser.php';" class="btndisabled" disabled="disabled"></input>
                <?php
                     }
                ?>
            </div>
        </div>
       
    </div>
    <?php
                    }
                    else{
                       
                    }
      ?>
    <div class="section group">
        <div class="col span_2_of_2">
            <div style="text-align:center;clear:both;margin-top:5%;">
            <input type="button" value="Exit" onclick="btnexit();" class="btnexit"></input>
            </div>
        </div>
    </div>
</body>
</html>
