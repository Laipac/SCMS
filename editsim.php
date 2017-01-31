<!--
This module is for modifying SIM inventory details
-->
<?php include "dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>SIM Inventory - SIM CARD Management System</title>
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="css/tabbed.css" media="all"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<link rel="stylesheet" href="/resources/demos/style.css"/>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
     jQuery(document).ready(function() {
                jQuery('.tabs .tab-links a').on('click', function(e)  {
                    var currentAttrValue = jQuery(this).attr('href');
                     
                    // Show/Hide Tabs
                    jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
                   
                    // Change/remove current tab to active
                    jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

                    e.preventDefault();
                   
                });
     
     $.ajax({
         url: "checkfuncauth.php",
         type: "POST",
         data: {
             
             activity:'simfull'
         },
         success: 
            function(result){
             
                 if(result==='1'){
                    
                 }
                 else
                 {      
                  
                   $.ajax({
                        url: "checkfuncauth.php",
                        type: "POST",
                        data: {

                            activity:'simedit'
                        },
                        success: 
                           function(result){

                                if(result==='1'){
                                   
                                }
                                else
                                {      
                                    $('#pagecontent').empty(); 
                                    var para = document.createElement("P");
                                    para.setAttribute("id","authpara");
                                    para.style.fontSize="xx-large";
                                    para.style.transform= "translateY(200%)";
                                    para.style.color="white";
                                    $('#pagecontent').append(para);
                                    $('#authpara').text('You are not authorized to use this module. Contact system administrator for access.');
                                }

                           }
                   });
                   
                   
                 }

            }
    });
     
     
                 $(function() {
                    $("#beforedate").datepicker();
                });
                 $(function() {
                    $("#activationdate").datepicker();
                });
                $(function() {
                    $("#deactivationdate").datepicker();
                });
     });
    function searchsim()
    {
        if($('#simtype').val()==='Blank'){
            alert('Kindly select a SIM Type.');
        }
        else if(isNaN($('#simnumber').val())){
            alert("SIM numbers must be numbers only.");
        }
        else if(($('#simnumber').val().length) < 19){
            alert("SIM number must be 19 digits.");
        }
        else if($('#simnumber').val().length > 19){
            alert("SIM number must be 19 digits.");
        }
        else{
           
             $.ajax({
                    url: "getsimdetails.php",
                    type: "POST",
                    data: {simnumber:$('#simnumber').val(),
                        simgroup:$('#simtype').val()
                    },
                    success: 
                        function(result){

                            if(result==="failed"){
                                $('#statuslabel').text("Error retrieving SIM details. SIM card does not exist.");                                  
                            }
                            else{
                               var arrResult = JSON.parse(result);
                               $('#simnumber1').val($('#simnumber').val());
                                $('#telnumber').val(arrResult['telnumber']);
                                $('#beforedate').val(arrResult['beforedate']);
                                $('#activationstatus').val(arrResult['activationstatus']);
                                $('#activationdate').val(arrResult['activationdate']);
                                $('#inventorystatus').val(arrResult['inventorystatus']);
                                $('#storagelocation').val(arrResult['storagelocation']);
                                $('#imei').val(arrResult['imei']);
                                $('#productmodel').val(arrResult['productmodel']);
                               
                                $('#statuslabel').text("Details on SIM Details tab.");
                            }
                        }
            });
        }
    }
    function getsimgroup(){
        if($('#simtype').val()==="Blank"){
            $('#simprovider').val("");
            $('#simrate').val("");
            $('#simcurrency').val("");
            $('#simbilling').val("");
            $('#simplan').val("");
            $('#simsize').val("");
            $('#simnoteplan').val("");
            $('#simonline').val("");
            $('#statuslabel').text("");
        }
        else{
            $.ajax({
                    url: "getsimgroup.php",
                    type: "POST",
                    data: {simtype:$('#simtype').val()   
                    },
                    success: 
                        function(result){

                            if(result==="failed"){
                                $('#statuslabel').text("Error retrieving invoice details.");                                  
                            }
                            else{
                               var arrResult = JSON.parse(result);                               
                                $('#simprovider').val(arrResult['simprovider']);
                                $('#simrate').val(arrResult['simrate']);
                                $('#simcurrency').val(arrResult['simcurrency']);
                                $('#simbilling').val(arrResult['simbilling']);
                                $('#simplan').val(arrResult['simplan']);
                                $('#simsize').val(arrResult['simsize']);
                                $('#simnoteplan').val(arrResult['simnoteplan']);
                                $('#simonline').val(arrResult['simonline']);
                                $('#statuslabel').text("");
                              
                            }
                        }
            });
        }
       
    }
    function setsim(){
        if($('#telnumber').val()===""){
            alert('Telephone number must not be blank');
        }
        else if($('#activationdate').val()===""){
            alert('Kindly select activation date.');
        }
        else if($('#simnumber1').val()===""){
            alert('SIM number cannot be blank.');
        }
        else if(isNaN($('#simnumber1').val())){
            alert("SIM numbers must be numbers only.");
        }
        else if(($('#simnumber1').val().length) < 19){
            alert("SIM number must be 19 digits.");
        }
        else if($('#simnumber1').val().length > 19){
            alert("SIM number must be 19 digits.");
        }
         else if(isNaN($('#imei').val())){
            alert("IMEI must be numbers only.");
        }
        else if(($('#imei').val().length) < 15){
            alert("IMEI must be 15 digits.");
        }
        else if($('#imei').val().length > 15){
            alert("IMEI must be 15 digits.");
        }
        else{
           
            $.ajax({
                    url: "updsim.php",
                    type: "POST",
                    data: {
                        simnumber:$('#simnumber').val(),
                        simgroup:$('#simtype').val(),
                        telnumber:$('#telnumber').val(),
                        beforedate:$('#beforedate').val(),
                        activationstatus:$('#activationstatus').val(),
                        activationdate:$('#activationdate').val(),
                        inventorystatus:$('#inventorystatus').val(),
                        deactivationdate:$('#deactivationdate').val(),
                        storagelocation:$('#storagelocation').val(),
                        imei:$('#imei').val(),
                        productmodel:$('#productmodel').val()
                    },
                    success: 
                        function(result){

                            if(result==="failed"){
                                $('#statuslabel1').show();
                                $('#statuslabel1').text("Error updating SIM.");
                                $('#statuslabel1').fadeOut(10000);
                            }
                            
                            else{
                               $('#statuslabel1').show();
                                $('#statuslabel1').text("SIM updated.");
                                $('#statuslabel1').fadeOut(10000);
                            }
                        }
            });
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
                        <h2 class="icon icon-world">SIM Card Management</h2>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="addsim.php">Add SIM</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="editsim.php" style="background-color:aqua;">Edit SIM</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="actideactisim.php">Activation & Deactivation</a>
                              
                            </li>
                        </ul>
                        
                         <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="menu.php">Exit</a>
                               
                            </li>
                        </ul>
                    </div>
                </nav>
            <div class="scroller"><!-- this is for emulating position fixed of the nav -->
                    <div class="scroller-inner" id="pagecontent">  
                      
                            <div class="block block-80 clearfix">
                                <p><a href="#" id="trigger" class="menu-trigger" style="display:none;">Menu</a></p>
                             <p style="float:right;">
                                               
                                                <input type="button" value="Exit" onclick="location.href='menu.php';"></input>
                                             </p>
                                
                                <div class="tabs">
                                    <ul class="tab-links">
                                        <li class="active"><a href="#tab1">SIM Type</a></li>
                                        <li><a href="#tab2">SIM Details</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab1" class="tab active">
                                            <p>
                                                <label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label>
                                            </p>
                                            <p>
                                                <label for="simtype">SIM Type:</label>
                                                <select name="simtype" id="simtype" onchange="getsimgroup();" >
                                                   <option value="Blank"><--Select--></option>
                                                  <?php 
                                                  $sql= $conn->prepare('SELECT simid,simtype FROM simcardmaster');
                                                  $sql->execute();
                                                  $sql->bind_result($simid,$simtype);
                                                  while($sql->fetch()){
                                                  ?>
                                                       <option value="<?php echo $simid ?>"><?php echo $simtype ?></option>  
                                                  <?php
                                                  }
                                                  ?>
                                                </select> 
                                            </p>
                                            <p>
                                                <label for="simnumber">SIM number:</label>
                                                <input type="text" name="simnumber" id="simnumber" value=""/>
                                                <input type="button" value=""  onclick="searchsim()" style="width:40px;height:40px;background: url('search.png');background-position:center;background-repeat: no-repeat;"></input>
                                            </p>

                                            <p> 
                                                <label for="simprovider">Provider:</label>
                                                <input type="text" name="simprovider" id="simprovider" value="" class="noedit" readonly="readonly"/>                                               
                                            </p>
                                            
                                            <p> 
                                                <label for="simrate">Rate:</label>
                                                <input type="text" name="simrate" id="simrate" value="" class="noedit" readonly="readonly" />
                                            </p>
                                            <p> 
                                                <label for="simplan">Rate Plan:</label>
                                                <input type="text" name="simplan" id="simplan" value="" class="noedit" readonly="readonly"/>
                                            </p>
                                            <p>  
                                                <label for="simcurrency">Currency:</label>
                                                <input type="text" name="simcurrency" id="simcurrency" value="" class="noedit" readonly="readonly" />
                                            </p>
                                            <p> 
                                                <label for="simbilling">Min Billing Months:</label>
                                                <input type="text" name="simbilling" id="simbilling" value="" class="noedit" readonly="readonly"/>
                                            </p>
                                             <p> 
                                                <label for="simsize">SIM Size:</label>
                                                <input type="text" name="simsize" id="simsize" value="" class="noedit" readonly="readonly"/>
                                            </p>
                                            <p> 
                                                <label for="simonline">On-Line Management:</label>
                                                <input type="text" name="simonline" id="simonline" value="" class="noedit" readonly="readonly"/>
                                            </p>
                                            <p> 
                                                <label for="simnoteplan">Notes:</label>
                                                <textarea name="simnoteplan" id="simnoteplan" rows="4" class="noedit" readonly="readonly"></textarea>
                                            </p>
                                        </div>
                                        <div id="tab2" class="tab">
                                            <p>
                                                <label id="statuslabel1" style='color:lightgreen;font-weight: bold;'></label>
                                            </p>
                                            
                                             <p id="parasimnumber1"> 
                                                <label for="simnumber1">Sim No.:</label>
                                                <input type="text" name="simnumber1" id="simnumber1" value="" class="noedit" readonly="readonly" />
                                            </p>
                                            
                                            <p id="paratelnumber1"> 
                                                <label for="telnumber">MSISDN (Tel No.):</label>
                                                <input type="text" name="telnumber" id="telnumber" value=""/>
                                            </p>
                                            <p id="parabeforedate1"> 
                                                <label for="beforedate">Activation date before:</label>
                                                <input type="text" name="beforedate" id="beforedate" value="" />
                                            </p>
                                            <p id="paraactivationstatus1"> 
                                                <label for="activationstatus">Activation Status: </label>                                         
                                                    <select name="activationstatus" id="activationstatus">
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                        <option value="Suspended">Suspended</option>
                                                        <option value="Terminated">Terminated</option>
                                                    </select>
                                            </p>
                                            <p id="paraactivationdate1"> 
                                                <label id="lblactivationdate" for="activationdate">Activation Date:</label>
                                                <input type="text" name="activationdate" id="activationdate" value=""  />
                                            </p>
                                            <p>
                                                 <label for="deactivationdate">Deactivation Date:</label>
                                                <input type="text" name="deactivationdate" id="deactivationdate" value=""  />
                                            </p>
                                            <p id="parainventorystatus1"> 
                                                <label for="inventorystatus">Inventory Status:</label>                                       
                                                    <select name="inventorystatus" id="inventorystatus">
                                                        <option value="In-stock">In-stock</option>
                                                        <option value="Deployed">Deployed</option>
                                                    </select>    
                                            </p>
                                            <p id="parastoragelocation1"> 
                                                <label for="storagelocation">Storage Location:</label>                                       
                                                <input type="text" name="storagelocation" id="storagelocation" value="" />     
                                            </p>
                                            <p id="paraimei1"> 
                                                <label for="imei">IMEI No.:</label>                                       
                                                <input type="text" name="imei" id="imei" value=""/>   
                                            </p>
                                            <p id="paraproductmodel1"> 
                                                <label for="productmodel">Product Model:</label>                                       
                                                 <select name="productmodel" id="productmodel">
                                                           <option value="Blank"><--Select--></option>
                                                          <?php 
                                                          $sql= $conn->prepare('SELECT productmodelid,productmodelname FROM productmodelmaster');
                                                          $sql->execute();
                                                          $sql->bind_result($productmodelid,$productmodelname);
                                                          
                                                          while($sql->fetch()){
                                                          ?>
                                                               <option value="<?php echo $productmodelid ?>"><?php echo $productmodelname ?></option>  
                                                          <?php
                                                          }
                                                          ?>
                                                </select>    
                                            </p>
                                            <p>
                                                 <input type="button" value="Submit" onclick="setsim();"/>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                    </div><!-- /scroller-inner -->
            </div><!-- /scroller -->
        </div>
    </div>	
    <script type="text/javascript" src="js/classie.js"></script>
    <script type="text/javascript" src="js/mlpushmenu.js"></script>
    <script type="text/javascript">
                                      //  new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
           mainMenu = new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {type : 'overlap'});
           mainMenu._openMenu();
    </script>
    <input type="hidden" id="simcount" name="simcount" value="1"></input>
    
</body>
</html>
