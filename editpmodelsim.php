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

<title>Maintain Product Model - SIM CARD Management System</title>
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
            function getproductmodel(){
                if($('#productmodel option:selected').val()==="SELECTPRODMODEL"){
                  
                    $('#qtyofsim').val("");
                    $('#serviceplan').val("");
                    $('notes').val("");
                }
                else{
                    $.ajax({
                        url: "retrieveProd.php",
                        type: "POST",
                        data: {productmodel:$('#productmodel option:selected').val(),
                            invType:'SIM'
                        },
                        success: 
                            function(result){
                              
                                if(result==="failed"){
                                    $('#statuslabel').text("Error retrieving invoice details.");                                  
                                }
                                else{
                                   var arrResult = JSON.parse(result);                               
                                   
                                    $('#qtyofsim').val(arrResult['quantityofsim']);
                                    $('#serviceplan').val(arrResult['serviceplan']);
                                     
                                       $('#notes').val(arrResult['notes']); 
                                     $('#statuslabel').text("");
                                }
                            }
                    });
                }
            }
              
            function updateProd(btnValue){
               
                if ($('#qtyofsim').val()===""){
                    alert("Kindly enter quantity of SIM.");
                }
                 else if ($('#serviceplan').val()===""){
                    alert("Kindly enter service plan.");
                }
                else{
                    if(btnValue.value==='Save'){                             
                            $.ajax({
                              url: "updprodrecord.php",
                              type: "POST",
                              data: {
                                  productmodel:$('#productmodel option:selected').val(),
                                  qtyofsim:$('#qtyofsim').val(),
                                  serviceplan:$('#serviceplan').val(),
                                  notes:$('#notes').val(),
                                  invType:'SIM'
                              },
                              success: 
                                  function(result){
                                        alert(result);
                                      if(result === "successsuccess"){
                                          $('#statuslabel').text("Product modified");
                                      }
                                      else
                                      {
                                          $('#statuslabel').text("Error modifying product.");
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
                                         location.href='addprodmodel.php?invNum='+$('#invNum').val();
                                     }
                                     else
                                     {
                                         $('#statuslabel').text("Save invoice first.");
                                     }

                                }
                            });
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
                                                <label for="searchcust">Invoice:<input type="text" name="searchcust" id="searchcust" value="<?php echo $_GET["invoice"]; ?>" readonly/>
                                                </label>                                              
                                             </p>
                                       <p>  
                                           <label for="productmodel">Product Model:
                                               <select name="productmodel" id="productmodel" onchange="getproductmodel()">
                                                    <option value="SELECTPRODMODEL"><--Select Product--></option>
                                                   <?php
                                                     require 'dbConfig.php';
                                                     $invNum=$_GET["invoice"];
                                                      $sql= $conn->prepare('SELECT productmodel,prodmodelid FROM productmodel WHERE invNum = ?');
                                                      $sql->bind_param('i',$invNum);
                                                      $sql->execute();
                                                      $sql->bind_result($productmodel,$productmodelid);
                                                      while($sql->fetch())
                                                      {?>
                                                   <option value="<?php echo $productmodelid; ?>"><?php echo $productmodel;   ?></option>
                                                   <?php
                                                    
                                                      }
                                                      mysqli_close($conn);
                                                   ?>
                                               </select>
                                               
                                           </label>
                                       </p>         
                                       <p> <label for="qtyofsim">Quantity of SIM: <input type="text" name="qtyofsim" id="qtyofsim" value=""/></label></p>
                                       <p> <label for="serviceplan">Service Plan:<input type="text" name="serviceplan" id="serviceplan" value=""/></label></p>
                                   
                                    </div>
                                <div class="block block-35 clearfix">
                                     <p> <label for="notes">Notes:<textarea name="notes" id="notes" rows="5"></textarea></label></p>
                                     <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                </div>
                                <div class="block block-30 clearfix">                                 
                                    <p><input type="button" value="Save" onclick="updateProd(this);"></input></p>                                    
                                    <p><input type="button" value="Exit" onclick="location.href='invcmgmtsim.php';"></input></p>
                                    <p><input type="button" value="Save and Submit" onclick=""></input></p>
                                   
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
