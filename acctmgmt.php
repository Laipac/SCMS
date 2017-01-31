<!--
This module is for account management which is for creating customers.
-->

<?php include "dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Account Management - SIM CARD Management System</title>
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
<script type="text/javascript">
 //code for checking authorization if user is permitted to use module.
jQuery(document).ready(function() {
    $.ajax({
         url: "checkfuncauth.php",
         type: "POST",
         data: {
             
             activity:'accountcreate'
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
                
 });
 
 //function that adds customer to database
function addcust(btnValue){
                
        if($('#customercode').val()==='Blank'){
            alert("Kindly select customer code.");
        }
        else if ($('#frstInv').val()===""){
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
        else if ($('#platform').val()==="Blank"){
            alert("Kindly select platform.");
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
        else if ($('#serviceBillTo').val()==="Blank"){
            alert("Kindly enter service bill to.");
        }
        else{
          $.ajax({
                url: "addcustomer.php",
                type: "POST",
                data: {
                    customercode:$('#customercode').val(),
                    frstInv:$('#frstInv').val(),
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
                success: 
                    function(result){
                        if(result==='success'){
                            $('#statuslabel').show();
                            $('#statuslabel').text("Customer Created.");
                            $('#statuslabel').fadeOut(3000);
                        }
                        else if(result==='exists'){
                            $('#statuslabel').show();
                            $('#statuslabel').text("Customer already exists.");
                            $('#statuslabel').fadeOut(3000);
                        }
                        else{
                            alert(result);
                            $('#statuslabel').show();
                            $('#statuslabel').text("Error creating customer.");
                            $('#statuslabel').fadeOut(3000);
                        }
                    } 
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
           $('#platform').val("Blank");
           $('#cntactName').val("");
           $('#cntactPhone').val("");
           $('#cntactEmail').val("");
           $('#serviceBillTo').val("");
           $('#customercode').val('Blank');
           $.ajax({
                url: "getallplatforms.php",
                type: "POST",
                success: 
                    function(result){
                        $('#platform').empty();
                        $('#platform').append(result);
                    }
           });
       }
    }
//function that gets all bill to based on platform selected.
function setbillto(){
    $.ajax({
        url: "getallbillto.php",
        type: "POST",
        data: {
            platform:$('#platform').val()
        },
        success: 
            function(result){
                $('#serviceBillTo').empty();
                $('#serviceBillTo').append(result);
            }
   });
}
</script>

</head>
<body>
    <div class="headercolor"></div> 
    <div class="container">
        <div class="mp-pusher" id="mp-pusher">
          
                <nav id="mp-menu" class="mp-menu">
                    <div class="mp-level">
                        <h2 class="icon icon-world">Account Management</h2>
                       
                                   
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-phone" href="searchcustomer.php">Search</a>
                            </li>
                             <li class="icon icon-arrow-left">
                                <a class="icon icon-phone" href="acctmgmt.php"  style="background-color:aqua;">Add</a>
                            </li>
                             <li class="icon icon-arrow-left">
                                <a class="icon icon-phone" href="editcustomer.php">Edit</a>
                            </li>
                             <li class="icon icon-arrow-left">
                                <a class="icon icon-phone" href="menu.php">Exit</a>
                            </li>
                        </ul>
                       
                    </div>
                </nav>
            <div class="scroller"><!-- this is for emulating position fixed of the nav -->
                    <div class="scroller-inner" id="pagecontent">
                          
                         
                                <div class="block block-30 clearfix">
                                    <p><a href="#" id="trigger" class="menu-trigger" style="display:none;">Menu</a></p>
                                        <p> <label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                    <p> <label for="customercode">Customer Code: </label>
                                        <select name="customercode" id="customercode" >
                                             <option value="Blank"><--Select--></option>
                                            <?php 
                                                $sql= $conn->prepare('SELECT customercodeid,customercode,customername FROM customercode');
                                                $sql->execute();
                                                $sql->bind_result($customerid,$customercode,$customername);
                                            while($sql->fetch()){
                                            ?>
                                                 <option value="<?php echo $customerid; ?>"><?php echo $customercode.' - '.$customername; ?></option>  
                                            <?php
                                            }
                                            ?>
                                        </select>   
                                    </p>
                                    <p>  <label for="frstInv">First Laipac Invoice#:  <input type="text" name="frstInv" id="frstInv" value=""/></label></p>
                                    <p> <label for="cmpnyName">Company's Name:  <input type="text" name="cmpnyName" id="cmpnyName" value=""/></label></p>
                                    <p> <label for="divName">Division's Name:  <input type="text" name="divName" id="divName" value=""/></label></p>
                                    <p> <label for="indivName">Individual's Name:<input type="text" name="indivName" id="indivName" value=""/></label></p>
                                    <p> <label for="country">Country:<input type="text" name="country" id="country" value=""/></label></p>
                                    
                                </div>
                                <div class="block block-30 clearfix">
                                    <p> <label for="city">City:<input type="text" name="city" id="city" value=""/></label></p>  
                                     <p> <label for="address">Address:<input type="text" name="address" id="address" value=""/></label></p>
                                      <p> <label for="platform">Platform:</label>
                                          
                                          <select name="platform" id="platform" onchange="setbillto()">
                                             <option value="Blank"><--Select--></option>
                                            <?php 
                                                $sql1= $conn->prepare('SELECT platformid,platformname FROM serviceplatform');
                                                $sql1->execute();
                                                $sql1->bind_result($platformid,$platformname);
                                            while($sql1->fetch()){
                                            ?>
                                                 <option value="<?php echo $platformid; ?>"><?php echo $platformname; ?></option>  
                                            <?php
                                            }
                                            ?>
                                        </select>   
                                      
                                      
                                      </p>
                                      
                                      
                                       <p> <label for="cntactName">Contact Name:<input type="text" name="cntactName" id="cntactName" value=""/></label></p>
                                       <p> <label for="cntactPhone">Contact Tel. No.:<input type="text" name="cntactPhone" id="cntactPhone" value=""/></label></p>
                                       <p> <label for="cntactEmail">Contact Email:<input type="text" name="cntactEmail" id="cntactEmail" value=""/></label></p>
                                        <p><label for="serviceBillTo">Service Bill to:</label>
                                            
                                            <select name="serviceBillTo" id="serviceBillTo">
                                                
                                            </select>
                                        </p>
                                        
                                </div>
                                <div class="block block-20 clearfix">
                                    <p><input type="button" value="Save" onclick="addcust(this)"></input></p>
                                     <p><input type="button" value="Exit" onclick="location.href='menu.php';"></input></p>
                                      <p><input type="button" value="Save and Continue" onclick="addcust(this)"></input></p>
                                    
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
</body>
</html>
