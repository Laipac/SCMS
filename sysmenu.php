<!--
This module is for system management menu. Menu for resources
-->

<?php 


include "dbConfig.php";
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>System Management - SIM CARD Management System</title>
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
<style type="text/css">
    input[type=button].btnback{
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/back.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnplatform{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/platform.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnplatform{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/platform.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
     input[type=button].btnservice{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/pserv.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnauth{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/auth.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnsearch{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/search.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
     input[type=button].btnadmin{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/admin.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    
    input[type=button].btnsim{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/simsys.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
     input[type=button].btncompany{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/company.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnbill{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/bill.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnpmodel{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/pmodel.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnchannel{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/channel.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
     input[type=button].btncreate{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/create.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnedit{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/edit.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
     input[type="button"]:hover{
        background-color: grey;
        transition: all 0.5s ease;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        color:#34495E;
         border:none;
          cursor:pointer;

    }
</style>
</head>
<body>
     
    <div class="headercolor"></div> 
    <div class="section group">	
        <div class="col span_1_of_4">
            Resources
        </div>
        <div class="col span_1_of_4">
             
        </div>
      
       
    </div>
    <div class="section group">
       
	<div class="col span_1_of_4">                    
            <input type="button" value="Service Platform" onclick="location.href='sysresources/searchplatform.php';" class="btnplatform"></input>
           
        </div>
        <div class="col span_1_of_4"> 
            <input type="button" value="Service Bill To" onclick="location.href='sysresources/searchservicebillto.php';" class="btnbill"></input>
        </div>
	
         <div class="col span_1_of_4">
              <input type="button" value="Back" onclick="location.href='main.php';" class="btnback"></input>  
        </div>
       
        
    </div>
   
    <div class="section group">
        
	<div class="col span_1_of_4">
            <input type="button" value="Sales Channel" onclick="location.href='sysresources/searchschannel.php';" class="btnchannel"></input>
        </div>
        <div class="col span_1_of_4">
           <input type="button" value="Platform Admin" onclick="location.href='sysresources/searchplatformadmin.php';" class="btnadmin"></input> 
        </div>
	
    </div>
    
    <div class="section group">
        
	<div class="col span_1_of_4">          
            <input type="button" value="Product Model" onclick="location.href='sysresources/searchprodmodel.php';" class="btnpmodel"></input>
        </div>
        <div class="col span_1_of_4">
            <input type="button" value="Company Code" onclick="location.href='sysresources/searchcompanycode.php';" class="btncompany"></input>
        </div>
	
    </div>
    <div class="section group">
        
	<div class="col span_1_of_4">      
            <input type="button" value="SIM Card" onclick="location.href='sysresources/searchsimcardtype.php';" class="btnsim"></input>
        </div>
        <div class="col span_1_of_4">
            <input type="button" value="Service Plan" onclick="location.href='sysresources/searchserviceplan.php';" class="btnservice"></input>   
        </div>
	
    </div>
   
      <div class="section group">
          <div class="col span_1_of_4">
                
          </div>
	<div class="col span_1_of_4">
             
        </div>
	
    </div>
</body>
</html>
