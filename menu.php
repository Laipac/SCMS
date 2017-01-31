<!--
This is the menu after hitting main menu after the login page.
-->

<?php include "dbConfig.php";

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $password = $_POST["password"];
	 if ($name == '' || $password == '') {
        $msg = "You must enter all fields";
    } else {
        $sql = "SELECT * FROM members WHERE username = '$name' AND pw = '$password'";
        $query = mysqli_query($conn,$sql);

        if ($query === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysqli_error($conn);
            
            exit;
        }

        if (mysqli_num_rows($query) > 0) {
         
            header('Location: menu.php');
            mysqli_close($conn);
            exit;
        }

        $msg = "Username and password do not match";
    }
}
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

<style type="text/css">
    input[type=button].btnact{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/act.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btninvc{
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/invc.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnmgmt{
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/mgmt.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btninvcsim{
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/invcsim.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnph{
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/ph.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
     input[type=button].btnreports{
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/reports.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnloc{
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/loc.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
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
    input[type=button].btnservice{
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/service.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnrenew{
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('images/renew.png') 5px no-repeat ;
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
    <div class="headercolor">
       
    </div> 
    <div class="section group">	
	<div class="col span_1_of_3">
            <div style="text-align:right;clear:both;">           
                    <input type="button" value="Account Management" onclick="location.href='searchcustomer.php';" class="btnact"></input>
            </div>
        </div>
	<div class="col span_1_of_3">
            <div style="text-align:center;clear:both;">
            <input type="button" value="Invoice Management" onclick="location.href='addinvoice.php';" class="btninvc"></input>
            </div>
	</div>
	<div class="col span_1_of_3">
            <div style="text-align:left;clear:both;">
            <input type="button" value="Invoice & SIM" onclick="location.href='addinvoicesim.php';" class="btninvcsim"></input>
            </div>
        </div>	
    </div>
    
    <div class="section group">	
	<div class="col span_1_of_3">
            <div style="text-align:right;clear:both;">           
                    <input type="button" value="Invoice & Product" class="btnph" onclick="location.href='addinvoiceproduct.php';" ></input>
            </div>
        </div>
	<div class="col span_1_of_3">
            <div style="text-align:center;clear:both;">
            <input type="button" value="Invoice & Service" class="btnloc" onclick="location.href='addinvoiceservice.php';"></input>
            </div>
	</div>
	<div class="col span_1_of_3">
            <div style="text-align:left;clear:both;">
            <input type="button" value="Invoice & Service Renew" class="btnrenew" onclick="location.href='addservicerenew.php';"></input>
            </div>
        </div>	
    </div>
    
    <div class="section group">	
	<div class="col span_1_of_3">
            <div style="text-align:right;clear:both;">           
                    <input type="button" value="Reports" class="btnreports" onclick="location.href='reports.php';"></input>
            </div>
        </div>
	<div class="col span_1_of_3">
            <div style="text-align:center;clear:both;">
            <input type="button" value="SIM Management" onclick="location.href='addsim.php';" class="btnmgmt" ></input>
            </div>
	</div>
	<div class="col span_1_of_3">
            <div style="text-align:left;clear:both;">
            <input type="button" value="Service Management" class="btnservice" onclick="location.href='servicemgmt.php';" ></input>
            </div>
        </div>	
    </div>
    
    <div class="section group">	
	
	<div class="col span_1_of_3">
            <div style="text-align:right;clear:both;">
            <input type="button" value="Back to Main" onclick="location.href='main.php';" class="btnback"></input>
            </div>
	</div>
	<div class="col span_1_of_3">
            <div style="text-align:center;clear:both;">
            
            </div>
        </div>	
        <div class="col span_1_of_3">
            <div style="text-align:left;clear:both;">
            
            </div>
        </div>
    </div>
	
</body>
</html>
