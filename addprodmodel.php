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

<title>Add Product - SIM CARD Management System</title>
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
            
            function addproduct(btnValue){
                if ($('#prodModel').val()===""){
                     alert("Kindly enter product model.");
                }
                else if ($('#qty').val()===""){
                    alert("Kindly enter quantity.");
                }
                else if ($('#qtysim').val()===""){
                    alert("Kindly enter quantity of SIM.");
                }
                 else if ($('#serviceplan').val()===""){
                    alert("Kindly enter service plan.");
                }
                else if ($('#billcycle').val()===""){
                    alert("Kindly enter billing cycle.");
                }
                 else if ($('#cntractStart').val()===""){
                    alert("Kindly enter contract start date.");
                }
                  else if ($('#cntractRenew').val()===""){
                    alert("Kindly enter contract renewal date.");
                }
                else if ($('#cntractEnd').val()===""){
                    alert("Kindly enter contract end date.");
                }
                else{
                    if(btnValue.value==='Add'){
                               
                                           
                       $.ajax({
                         url: "addprodrecord.php",
                         type: "POST",
                         data: {
                            
                             
                             invNum:$('#invNum').val(),
                             prodModel:$('#prodModel').val(),
                             qty:$('#qty').val(),
                             qtysim:$('#qtysim').val(),
                             serviceplan:$('#serviceplan').val(),
                             billcycle:$('#billcycle').val(),
                             cntractStart:$('#cntractStart').val(),
                             cntractRenew:$('#cntractRenew').val(),
                             cntractEnd:$('#cntractEnd').val(),
                             notes:$('#notes').val(),
                             invType:'PROD'
                         },
                         success: 
                             function(result){
                                if(result === "successsuccess"){
                                     $('#statuslabel').text("Product added");
                                 }
                                 else
                                 {
                                     $('#statuslabel').text("Error adding product.");
                                 }
                                
                             }
                        });
                    }
                    else if(btnValue.value==='Reset'){
                       
                        $('#prodModel').val("");
                        $('#qty').val("");
                        $('#qtysim').val("");
                        $('#serviceplan').val("");
                        $('#billcycle').val("");
                        $('#cntractStart').val("");
                        $('#cntractRenew').val("");
                        $('#cntractEnd').val("");
                        $('#notes').val("");
                    }
                    
               
                   
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
                                             <a class="icon icon-phone" href="invcmgmtsim.php">Add</a>
                                        </li>
                                         <li class="icon icon-arrow-left">
                                             <a class="icon icon-phone" href="editinvoicesim.php">Edit</a>
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
                                            <!--
                                            <nav class="codrops-demos">
                                                    <a href="index.html">Demo 1: Overlapping levels</a>
                                                    <a href="index2.html">Demo 2: Covering levels</a>
                                                    <a class="current-demo" href="index3.html">Demo 3: Overlapping levels with back links</a>
                                            </nav>-->
                                            <p> 
                                                <label for="invNum">Customer:<input type="text" name="invNum" id="invNum" value="<?php echo $_GET["invNum"]; ?>" readonly/>
                                                </label>                                              
                                             </p>
                                       <p> <label for="prodModel">Product Model:  <input type="text" name="prodModel" id="prodModel" value="" /></label></p>
                                       <p>  <label for="qty">Quantity:  <input type="text" name="qty" id="qty" value="" /></label></p>
                                      
                                       <p> <label for="qtysim">Quantity of SIM: <input type="text" name="qtysim" id="qtysim" value=""/></label></p>
                                       <p> <label for="serviceplan">Service Plan:<input type="text" name="serviceplan" id="serviceplan" value=""/></label></p>
                                       <p> <label for="billcycle">Laipac Billing Cycle:<input type="text" name="billcycle" id="billcycle" value=""/></label></p>
                                      
                                     
                                    </div>
                                <div class="block block-35 clearfix">
                                    <p> <label for="cntractStart">Initial Contract Start Date:<input type="text" name="cntractStart" id="cntractStart" value="" /></label></p>
                                    <p> <label for="cntractRenew">Contract Renewal Date:<input type="text" name="cntractRenew" id="cntractRenew" value="" /></label></p>
                                     <p> <label for="cntractEnd">Contract Ending Date:<input type="text" name="cntractEnd" id="cntractEnd" value="" /></label></p>
                                    <p> <label for="notes">Notes:<textarea name="notes" id="notes" rows="5"></textarea></label></p>
                                     
                                </div>
                                <div class="block block-30 clearfix">
                                    <p><input type="button" value="Add" onclick="addproduct(this);"></input></p>
                                     <p><input type="button" value="Reset" onclick="addproduct(this);"></input></p>                                
                                    <p><input type="button" value="Exit" onclick="location.href='addinvoice.php?invoice='+$('#invNum').val();"></input></p>
                                  
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
