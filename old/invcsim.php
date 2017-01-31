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

<title>Invoice Management - SIM CARD Management System</title>
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
<link rel="stylesheet" type="text/css" href="css/normalize.css" />
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/icons.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript">
            function searchCust(){
                if ($('#searchcust').val()===""){
                     alert("Kindly enter customer number.");
                }
                else{
                   // alert($('#searchcust').val());
                     $.ajax({
                        url: "searchcust.php",
                        type: "POST",
                        data: {custNum:$('#searchcust').val()
                        },
                        success: 
                            function(result){
                              
                                if(result==="failed"){
                                    $('#statuslabel').text("Customer does not exist.");
                                    $('#frstInv').val("");
                                    $('#cmpnyName').val("");
                                    $('#divName').val("");
                                    $('#indivName').val("");
                                    $('#country').val("");
                                    $('#city').val("");
                                    $('#address').val("");
                                    $('#platform').val("");
                                    $('#cntactName').val("");
                                    $('#cntactPhone').val("");
                                    $('#cntactEmail').val("");
                                    $('#serviceBillTo').val("");
                                }
                                else{
                                     //alert('HELLO');
                                   
                                   var arrResult = JSON.parse(result);
                                   var invNum = arrResult['frstInv'].substr(2);
                                    $('#cmpnyName').val(arrResult['cmpnyName']);
                                    $('#frstInv').val(invNum);
                                    $('#divName').val(arrResult['divName']);
                                    $('#indivName').val(arrResult['indivName']);
                                    $('#country').val(arrResult['country']);
                                    $('#city').val(arrResult['city']);
                                    $('#address').val(arrResult['address']);
                                    $('#platform').val(arrResult['platform']);
                                    $('#cntactName').val(arrResult['cntactName']);
                                    $('#cntactPhone').val(arrResult['cntactPhone']);
                                    $('#cntactEmail').val(arrResult['cntactEmail']);
                                    $('#serviceBillTo').val(arrResult['serviceBillTo']);
                                     $('#statuslabel').text("");
                                }
                            }
                    });
                  
                }
            }
            function editcust(btnValue){
                if ($('#frstInv').val()===""){
                     alert("Kindly enter invoice number.");
                }
                else if ($('#cmpnyName').val()===""){
                    alert("Kindly enter company name.");
                }
                else if ($('#divName').val()===""){
                    alert("Kindly enter division name.");
                }
                 else if ($('#indivName').val()===""){
                    alert("Kindly enter individual name.");
                }
                else if ($('#country').val()===""){
                    alert("Kindly enter country.");
                }
                
               else if ($('#city').val()===""){
                    alert("Kindly enter city.");
                }
                else if ($('#address').val()===""){
                    alert("Kindly enter address.");
                }
                else if ($('#platform').val()===""){
                    alert("Kindly enter platform.");
                }
                else if ($('#cntactName').val()===""){
                    alert("Kindly enter contact name.");
                }
                else if ($('#cntactPhone').val()===""){
                    alert("Kindly enter contact phone number.");
                }
                else if ($('#cntactEmail').val()===""){
                    alert("Kindly enter contact email address.");
                }
                else if ($('#serviceBillTo').val()===""){
                    alert("Kindly enter service bill to.");
                }
                else{
                  $.ajax({
                        url: "editcust.php",
                        type: "POST",
                        data: {frstInv:$('#frstInv').val(),
                            cmpnyName:$('#cmpnyName').val(),
                            divName:$('#divName').val(),
                            indivName:$('#indivName').val(),
                            country:$('#country').val(),
                            city:$('#city').val(),
                            address:$('#address').val(),
                            platform:$('#platform').val(),
                            cntactName:$('#cntactName').val(),
                            cntactPhone:$('#cntactPhone').val(),
                            cntactEmail:$('#cntactEmail').val(),
                            serviceBillTo:$('#serviceBillTo').val()
                           
                        },
                        success: $('#statuslabel').text("Customer updated.")  
                    });
                }
                if (btnValue.value === "Save and Continue"){
                   $('#frstInv').val("");
                   $('#cmpnyName').val("");
                   $('#divName').val("");
                   $('#indivName').val("");
                   $('#country').val("");
                   $('#city').val("");
                   $('#address').val("");
                   $('#platform').val("");
                   $('#cntactName').val("");
                   $('#cntactPhone').val("");
                   $('#cntactEmail').val("");
                   $('#serviceBillTo').val("");
                   
                   
               }
            }
        </script>

</head>
<body>
    <div class="headercolor"></div> 
    <div class="container">
        <div class="mp-pusher" id="mp-pusher">
          
                <nav id="mp-menu" class="mp-menu">
                    <div class="mp-level">
                        <h2 class="icon icon-world">Invoice & SIM</h2>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="#">LocationNow (LN)</a>
                                <div class="mp-level">
                                    <h2 class="icon icon-display">LocationNow (LN)</h2>
                                    <a class="mp-back" href="#">back</a>
                                    <ul>
                                        <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Search</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="invcmgmt.php">Add</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                             <a class="icon icon-phone" href="editinv.php">Edit</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="menu.php">Exit</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="#">SIM</a>
                                <div class="mp-level">
                                    <h2 class="icon icon-display">SIM</h2>
                                    <a class="mp-back" href="#">back</a>
                                    <ul>
                                        <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Search</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                             <a class="icon icon-phone" href="invcmgmtsim.php">Add</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="editinvsim.php">Edit</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="menu.php">Exit</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                         <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="#">Service Renew</a>
                                <div class="mp-level">
                                    <h2 class="icon icon-display">Service Renew</h2>
                                    <a class="mp-back" href="#">back</a>
                                    <ul>
                                        <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Search</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Add</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Edit</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Exit</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                         <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="../SCMS/menu.php">Exit</a>
                                <!--<div class="mp-level">
                                    <h2 class="icon icon-display">Exit</h2>
                                    
                                    <a class="mp-back" href="#">back</a>
                                    <ul>
                                        <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Search</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Add</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Edit</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Exit</a>
                                        </li>
                                    </ul>
                                </div>-->
                            </li>
                        </ul>
                    </div>
                </nav>
            <div class="scroller"><!-- this is for emulating position fixed of the nav -->
                    <div class="scroller-inner">
                            <!-- Top Navigation 
                            <div class="codrops-top clearfix">
                                    <a class="codrops-icon codrops-icon-prev" href="http://tympanus.net/Tutorials/CircularNavigation/"><span>Previous Demo</span></a>
                                    <span class="right"><a class="codrops-icon codrops-icon-drop" href="http://tympanus.net/codrops/?p=16252"><span>Back to the Codrops Article</span></a></span>
                            </div>
                            <header class="codrops-header">
                                    <h1>Multi-Level Push Menu <span>Off-screen navigation with multiple levels</span></h1>
                            </header>-->
                            <div class="content clearfix">
                                    <div class="block block-35 clearfix">
                                            <p><a href="#" id="trigger" class="menu-trigger">Menu</a></p>
                                            <!--
                                            <nav class="codrops-demos">
                                                    <a href="index.html">Demo 1: Overlapping levels</a>
                                                    <a href="index2.html">Demo 2: Covering levels</a>
                                                    <a class="current-demo" href="index3.html">Demo 3: Overlapping levels with back links</a>
                                            </nav>-->
                                             <p> <label for="searchcust">Input Customer:<input type="button" value=""  onclick="searchCust()" style="width:40px;height:40px;background: url('search.png');background-position:center;background-repeat: no-repeat;"></input>
                                                     <input type="text" name="searchcust" id="searchcust" value=""/></label>
                                                 
                                             </p>
                                      
                                            <p>  <label for="frstInv">First Laipac Invoice#:  <input type="text" name="frstInv" id="frstInv" value="" readonly/></label></p>
                                       <p> <label for="cmpnyName">Company's Name:  <input type="text" name="cmpnyName" id="cmpnyName" value="" readonly/></label></p>
                                       <p> <label for="divName">Division's Name:  <input type="text" name="divName" id="divName" value="" readonly/></label></p>
                                       <p> <label for="indivName">Individual's Name:<input type="text" name="indivName" id="indivName" value="" readonly/></label></p>
                                       <p> <label for="country">Country:<input type="text" name="country" id="country" value="" readonly/></label></p>
                                      
                                     
                                    </div>
                                <div class="block block-35 clearfix">
                                     <p> <label for="city">City:<input type="text" name="city" id="city" value=""/></label></p>
                                      
                                     <p> <label for="address">Address:<input type="text" name="address" id="address" value=""/></label></p>
                                      <p> <label for="platform">Platform:<input type="text" name="platform" id="platform" value=""/></label></p>
                                       <p> <label for="cntactName">Contact Name:<input type="text" name="cntactName" id="cntactName" value=""/></label></p>
                                       <p> <label for="cntactPhone">Contact Tel. No.:<input type="text" name="cntactPhone" id="cntactPhone" value=""/></label></p>
                                       <p> <label for="cntactEmail">Contact Email:<input type="text" name="cntactEmail" id="cntactEmail" value=""/></label></p>
                                       
                                        
                                </div>
                                <div class="block block-30 clearfix">
                                     <p><label for="serviceBillTo">Service Bill to:<input type="text" name="serviceBillTo" id="serviceBillTo" value=""/></label></p>
                                    <p><input type="button" value="Add SIM" onclick="location.href='addinvoicesim.php?invoice=LP'+$('#frstInv').val();"></input></p>
                                     <p><input type="button" value="Edit SIM" onclick="location.href='editinvoicesim.php?invoice=LP'+$('#frstInv').val();"></input></p>
                                    
                                      <p><input type="button" value="Exit" onclick="location.href='menu.php';"></input></p>
                                      <p> <label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                </div>
                                
                                  <!-- <div class="block block-60">
                                       
                                            <p><strong>Demo 3:</strong> Overlapping levels with back links</p>
                                            <p>This menu will open by pushing the website content to the right. It has multi-level functionality, allowing endless nesting of navigation elements.</p>
                                            <p>The next level can optionally overlap or cover the previous one.</p>
                                    
                                        
                                   </div>-->
                                   <!-- <div class="info">
                                            <p>If you enjoyed this you might also like:</p>
                                            <p><a href="http://goo.gl/JLJ4v5">Responsive Multi-Level Menu</a></p>
                                            <p><a href="http://goo.gl/qjbq9Y">Google Nexus Website Menu</a></p>
                                      
                                    </div>-->
                            </div>
                    </div><!-- /scroller-inner -->
            </div><!-- /scroller -->
        </div>
    </div>	
    <script type="text/javascript" src="js/classie.js"></script>
    <script type="text/javascript" src="js/mlpushmenu.js"></script>
    <script type="text/javascript">
            new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
    </script>
</body>
</html>
