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

<title>Maintain Invoice - SIM CARD Management System</title>
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
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script type="text/javascript">
            function getinvoices(){
                if($('#invNum option:selected').val()==="SELECTINVOICE"){
                    $('#salesChannel').val("");
                    $('#customerPO').val("");
                    $('#status').val("SETSTATUS");
                    $('#submitDate').val("");
                }
                else{
                    $.ajax({
                        url: "retrieveInv.php",
                        type: "POST",
                        data: {invNum:$('#invNum option:selected').val(),
                           invType:$('#invType').val()
                        },
                        success: 
                            function(result){
                              
                                if(result==="failed"){
                                    $('#statuslabel').text("Error retrieving invoice details.");                                  
                                }
                                else{
                                   var arrResult = JSON.parse(result);                               
                                    $('#salesChannel').val(arrResult['salesChannel']);
                                    $('#customerPO').val(arrResult['customerPO']);
                                    $('#status').val(arrResult['status']);
                                    $('#submitDate').val(arrResult['submitDate']);
                                    
                                    if($('#status').val()==="Submitted"){
                                        $('#salesChannel').prop("readonly",true);
                                        $('#customerPO').prop("readonly",true);
                                        $('#status').prop("disabled",true);
                                        $('#submitDate').prop("readonly",true);
                                        $('#statuslabel').text("Invoice already submitted. Cannot modify invoice.");
                                    }
                                    else{
                                         $('#salesChannel').prop("readonly",false);
                                        $('#customerPO').prop("readonly",false);
                                         $('#status').prop("disabled",false);
                                        $('#submitDate').prop("readonly",false);
                                        $('#statuslabel').text("");
                                    }
                                     
                                }
                            }
                    });
                }
            }
             
            function updateInv(btnValue){
                if ($('#salesChannel').val()===""){
                     alert("Kindly enter sales channel.");
                }
                else if ($('#customerPO').val()===""){
                    alert("Kindly enter customer PO.");
                }
                 else if ($('#status').val()==="<--Set Status-->"){
                    alert("Kindly select status.");
                }
                
                else{
                    $bool=1;
                   if ($('#status').val()==="Submitted"){
                     if($('#submitDate').val()===""){
                       alert("Kindly enter date submitted.");
                       $bool=0;
                      }
                      else{
                          $bool=1;
                      }
                   }
                   if($bool>0){
                      
                        if(btnValue.value==='Save'){                             
                            $.ajax({
                              url: "updinvrecord.php",
                              type: "POST",
                              data: {

                                  invNum:$('#invNum option:selected').val(),
                                  salesChannel:$('#salesChannel').val(),
                                  status:$('#status option:selected').val(),
                                  customerPO:$('#customerPO').val(),
                                  submitDate:$('#submitDate').val(),
                                  invType:$('#invType').val()
                              },
                              success: 
                                  function(result){

                                      if(result === "success"){
                                          $('#statuslabel').text("Invoice modified");
                                      }
                                      else
                                      {
                                          $('#statuslabel').text("Error modifying invoice.");
                                      }
                                  }
                             });
                        }
                        else if(btnValue.value==='Edit Product Model'){
                          $.ajax({
                             url: "searchinvoice.php",
                             type: "POST",
                             data: {invNum:$('#invNum').val()                        
                             },
                             success: 
                                 function(result){
                                     if(result==="success"){
                                         $('#statuslabel').text("");
                                         location.href='editprodmodel.php?invNum='+$('#invNum').val();
                                     }
                                     else
                                     {
                                         $('#statuslabel').text("Save invoice first.");
                                     }

                                }
                            });
                        }
                   }
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
                        <h2 class="icon icon-world">Invoice Management</h2>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="#">Product, SIM & Service</a>
                                <div class="mp-level">
                                    <h2 class="icon icon-display">Product, SIM & Service</h2>
                                    <a class="mp-back" href="#">back</a>
                                    <ul>
                                        <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="#">Search</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                            <a class="icon icon-phone" href="acctmgmt.php">Add</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                             <a class="icon icon-phone" href="editcustomer.php">Edit</a>
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
                                <a class="icon icon-display" href="#">SIM</a>
                                <div class="mp-level">
                                    <h2 class="icon icon-display">SIM</h2>
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
                                          
                                            <p> 
                                                <label for="searchcust">Customer:<input type="text" name="searchcust" id="searchcust" value="<?php echo $_GET["invoice"]; ?>" readonly/>
                                                </label>                                              
                                             </p>
                                       <p>  
                                           <label for="invNum">Invoice#:
                                               <select name="invNum" id="invNum" onchange="getinvoices()">
                                                    <option value="SELECTINVOICE"><--Select Invoice--></option>
                                                   <?php
                                                     require 'dbConfig.php';
                                                     $invNum=$_GET["invoice"];
                                                     $invType='Product, SIM and Service';
                                                      $sql= $conn->prepare('SELECT invNum FROM invoices WHERE frstInv = ? AND invType= ?');
                                                      $sql->bind_param('ss',$invNum,$invType);
                                                      $sql->execute();
                                                      $sql->bind_result($invoices);
                                                      while($sql->fetch())
                                                      {?>
                                                   <option value="<?php echo $invoices; ?>"><?php echo $invoices;   ?></option>
                                                   <?php
                                                    
                                                      }
                                                      mysqli_close($conn);
                                                   ?>
                                               </select>
                                               
                                           </label>
                                       </p>
                                       <p> <label for="salesChannel">Sales Channel:  <input type="text" name="salesChannel" id="salesChannel" value="" /></label></p>          
                                       <p> <label for="customerPO">Customer's PO# <input type="text" name="customerPO" id="customerPO" value=""/></label></p>
                                       <p> <label for="invType">Invoice Type:<input type="text" name="invType" id="invType" value="Product, SIM and Service" readonly/></label></p>
                                   
                                    </div>
                                <div class="block block-35 clearfix">
                                    <p> <label for="status">Status:
                                            
                                            <select name="status" id="status">
                                                <option value="SETSTATUS"><--Set Status--></option>
                                                <option value="New">New</option>
                                                <option value="Submitted">Submitted</option>
                                            </select>
                                        </label>
                                    </p>
                                    <p> <label for="submitDate">Submit Date:<input type="text" name="submitDate" id="submitDate" value=""/></label></p>  
                                </div>
                                <div class="block block-30 clearfix">
                                    <p><input type="button" value="Edit Product Model" onclick="location.href='editprodmodel.php?invoice='+$('#invNum option:selected').val();"></input></p>
                                    <p><input type="button" value="Save" onclick="updateInv(this);"></input></p>                                    
                                    <p><input type="button" value="Exit" onclick="location.href='invcmgmt.php';"></input></p>
                                    <p><input type="button" value="Save and Submit" onclick=""></input></p>
                                    <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
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
