<!--
This module is for setting authorizations based on user group.
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

<title>Authorizations - SIM CARD Management System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
<style type="text/css">
    input[type=button].btnupdate{
        color:white;
        font-family: futura;
        border-radius: 15px;
        -webkit-border-radius: 15px;
        -moz-border-radius:15px;
        border:none;
         cursor:pointer;
         background: url('images/update.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
     input[type=button].btnclear{
        color:white;
        font-family: futura;
        border-radius: 15px;
        -webkit-border-radius: 15px;
        -moz-border-radius:15px;
        border:none;
         cursor:pointer;
         background: url('images/clear.png') 5px no-repeat ;
         background-color:#34495E;
        background-position: left center;

    }
    input[type=button].btnexit{
        color:#34495E;
        font-family: futura;
        border-radius: 15px;
        -webkit-border-radius: 15px;
        -moz-border-radius:15px;
        border:none;
         cursor:pointer;
         background: url('images/exit.png') 5px no-repeat ;
         background-color:white;
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
            });
            
            function adduser(){
                if($('#usertype').val()==="Blank"){
                     alert("Kindly select user type.");
                }
                else if ($('#username').val()===""){
                     alert("Kindly enter user name.");
                }
                else if ($('#userpass').val()===""){
                    alert("Kindly enter user password.");
                }
                else if($('#userpass').val().length < 6){
                    alert("Password should be at least 6 characters.");
                }
                else if ($('#userfname').val()===""){
                    alert("Kindly enter first name.");
                }
                else if ($('#userlname').val()===""){
                    alert("Kindly enter last name.");
                }
                else if ($('#useremail').val()===""){
                    alert("Kindly enter email address.");
                }
                else if ($('#usercompany').val()===""){
                    alert("Kindly enter company.");
                }
                else{
                  $.ajax({
                        url: "adduserrecord.php",
                        type: "POST",
                        data: {
                            usertype:$('#usertype').val(),
                            username:$('#username').val(),
                            userpass:$('#userpass').val(),
                            userfname:$('#userfname').val(),
                            userlname:$('#userlname').val(),
                            useremail:$('#useremail').val(),
                            usercompany:$('#usercompany').val(),
                            userphone:$('#userphone').val(),
                            usermobile:$('#usermobile').val(),
                            usercountry:$('#usercountry').val(),
                            userprovince:$('#userprovince').val(),
                            usercity:$('#usercity').val(),
                            userstreet:$('#userstreet').val(),
                            userzip:$('#userzip').val()
                        },
                        success: 
                            function(result){
                               
                                if(result==='success'){
                                    $('#statuslabel').show();
                                    $('#statuslabel').text("User Created.");
                                     $('#statuslabel').fadeOut(4000);
                                   
                                }
                                else{
                                  $('#statuslabel').show();
                                    $('#statuslabel').text("Error creating user.");
                                     $('#statuslabel').fadeOut(4000);  
                                }
                            }
                         
                    });
                }
            }
function resetfields(){
      $('#statuslabel').text("");
       $('#userfname').val("");
        $('#userlname').val("");
        $('#userphone').val("");
        $('#usermobile').val("");
        $('#useremail').val("");
        $('#usercountry').val("");
        $('#userprovince').val("");
        $('#usercity').val("");
        $('#userstreet').val("");
        $('#userzip').val("");
        $('#usertype').val("");
        $('#username').val("");
        $('#usertype').val("Blank");
        $('#usercompany').val("");
}
function setauthorizations(){
    
    if($('#usertype').val()==='Blank'){
       $('#serviceplatform1').prop('checked',false);
        $('#serviceplatform2').prop('checked',false);
        $('#serviceplatform3').prop('checked',false);
        $('#saleschannel1').prop('checked',false);
        $('#saleschannel2').prop('checked',false);
        $('#saleschannel3').prop('checked',false);
        $('#productmodel1').prop('checked',false);
        $('#productmodel2').prop('checked',false);
        $('#productmodel3').prop('checked',false);
        $('#simcard1').prop('checked',false);
        $('#simcard2').prop('checked',false);
        $('#simcard3').prop('checked',false);
        $('#serviceplan1').prop('checked',false);
        $('#serviceplan2').prop('checked',false);
        $('#serviceplan3').prop('checked',false);
        $('#servicebillto1').prop('checked',false);
        $('#servicebillto2').prop('checked',false);
        $('#servicebillto3').prop('checked',false);
         $('#platformadmin1').prop('checked',false);
        $('#platformadmin2').prop('checked',false);
        $('#platformadmin3').prop('checked',false);
         $('#companycode1').prop('checked',false);
        $('#companycode2').prop('checked',false);
        $('#companycode3').prop('checked',false);
    }
    else{
        $.ajax({
                url: "getresourceauth.php",
                type: "POST",
                data: {
                    userrole:$('#usertype').val()
                },
                success: 
                    function(result){
                       var arrResults = JSON.parse(result);
                        if(result.indexOf('failed')>-1){
                             $('#statuslabel').show();
                            $('#statuslabel').text("Error retrieving authorizations.");
                             $('#statuslabel').fadeOut(4000);  
                        }
                        else{
                          if(arrResults['platformsearch']){
                              $('#serviceplatform1').prop('checked',true);
                          }
                          else{
                               $('#serviceplatform1').prop('checked',false);
                          }
                          if(arrResults['platformcreate']){
                              $('#serviceplatform2').prop('checked',true);
                          }
                          else{
                               $('#serviceplatform2').prop('checked',false);
                          }
                          if(arrResults['platformedit']){
                              $('#serviceplatform3').prop('checked',true);
                          }
                          else{
                               $('#serviceplatform3').prop('checked',false);
                          }

                          if(arrResults['channelsearch']){
                              $('#saleschannel1').prop('checked',true);
                          }
                          else{
                               $('#saleschannel1').prop('checked',false);
                          }
                          if(arrResults['channelcreate']){
                              $('#saleschannel2').prop('checked',true);
                          }
                          else{
                               $('#saleschannel2').prop('checked',false);
                          }
                          if(arrResults['channeledit']){
                              $('#saleschannel3').prop('checked',true);
                          }
                          else{
                               $('#saleschannel3').prop('checked',false);
                          }

                          if(arrResults['productsearch']){
                              $('#productmodel1').prop('checked',true);
                          }
                          else{
                               $('#productmodel1').prop('checked',false);
                          }
                          if(arrResults['productcreate']){
                              $('#productmodel2').prop('checked',true);
                          }
                          else{
                               $('#productmodel2').prop('checked',false);
                          }
                          if(arrResults['productedit']){
                              $('#productmodel3').prop('checked',true);
                          }
                          else{
                               $('#productmodel3').prop('checked',false);
                          }

                          if(arrResults['simsearch']){
                              $('#simcard1').prop('checked',true);
                          }
                          else{
                               $('#simcard1').prop('checked',false);
                          }
                          if(arrResults['simcreate']){
                              $('#simcard2').prop('checked',true);
                          }
                          else{
                               $('#simcard2').prop('checked',false);
                          }
                          if(arrResults['simedit']){
                              $('#simcard3').prop('checked',true);
                          }
                          else{
                               $('#simcard3').prop('checked',false);
                          }

                           if(arrResults['plansearch']){
                              $('#serviceplan1').prop('checked',true);
                          }
                          else{
                               $('#serviceplan1').prop('checked',false);
                          }
                          if(arrResults['plancreate']){
                              $('#serviceplan2').prop('checked',true);
                          }
                          else{
                               $('#serviceplan2').prop('checked',false);
                          }
                          if(arrResults['planedit']){
                              $('#serviceplan3').prop('checked',true);
                          }
                          else{
                               $('#serviceplan3').prop('checked',false);
                          }
                          
                           if(arrResults['billtosearch']){
                              $('#servicebillto1').prop('checked',true);
                          }
                          else{
                               $('#servicebillto1').prop('checked',false);
                          }
                          if(arrResults['billtocreate']){
                              $('#servicebillto2').prop('checked',true);
                          }
                          else{
                               $('#servicebillto2').prop('checked',false);
                          }
                          if(arrResults['billtoedit']){
                              $('#servicebillto3').prop('checked',true);
                          }
                          else{
                               $('#servicebillto3').prop('checked',false);
                          }
                          
                          
                           if(arrResults['platformadminsearch']){
                              $('#platformadmin1').prop('checked',true);
                          }
                          else{
                               $('#platformadmin1').prop('checked',false);
                          }
                          if(arrResults['platformadmincreate']){
                              $('#platformadmin2').prop('checked',true);
                          }
                          else{
                               $('#platformadmin2').prop('checked',false);
                          }
                          if(arrResults['platformadminedit']){
                              $('#platformadmin3').prop('checked',true);
                          }
                          else{
                               $('#platformadmin3').prop('checked',false);
                          }
                          
                           if(arrResults['companycodesearch']){
                              $('#companycode1').prop('checked',true);
                          }
                          else{
                               $('#companycode1').prop('checked',false);
                          }
                          if(arrResults['companycodecreate']){
                              $('#companycode2').prop('checked',true);
                          }
                          else{
                               $('#companycode2').prop('checked',false);
                          }
                          if(arrResults['companycodeedit']){
                              $('#companycode3').prop('checked',true);
                          }
                          else{
                               $('#companycode3').prop('checked',false);
                          }
                         // alert($('#serviceplan3').is(':checked'));
                        }
                    }            
        });
    }
}
function setuserauth(){
    if($('#usertype1').val()==='Blank'){
       $('#groupadmin1').prop('checked',false);
        $('#groupadmin2').prop('checked',false);
        $('#groupadmin3').prop('checked',false);
        $('#user1').prop('checked',false);
        $('#user2').prop('checked',false);
        $('#user3').prop('checked',false);
        $('#customer1').prop('checked',false);
        $('#customer2').prop('checked',false);
        $('#customer3').prop('checked',false);
        
        $('#groupadmin1').prop('disabled',true);
        $('#groupadmin2').prop('disabled',true);
        $('#groupadmin3').prop('disabled',true);
        $('#user1').prop('disabled',true);
        $('#user2').prop('disabled',true);
        $('#user3').prop('disabled',true);
        $('#customer1').prop('disabled',true);
        $('#customer2').prop('disabled',true);
        $('#customer3').prop('disabled',true);
        
        $('#groupadmindiv').show();
    }
    else if($('#usertype1').val()==='1'){
        $('#groupadmindiv').show();
        $('#groupadmin1').prop('checked',true);
        $('#groupadmin2').prop('checked',true);
        $('#groupadmin3').prop('checked',true);
        $('#user1').prop('checked',true);
        $('#user2').prop('checked',true);
        $('#user3').prop('checked',true);
        $('#customer1').prop('checked',true);
        $('#customer2').prop('checked',true);
        $('#customer3').prop('checked',true);
        
        $('#groupadmin1').prop('disabled',true);
        $('#groupadmin2').prop('disabled',true);
        $('#groupadmin3').prop('disabled',true);
        $('#user1').prop('disabled',true);
        $('#user2').prop('disabled',true);
        $('#user3').prop('disabled',true);
        $('#customer1').prop('disabled',true);
        $('#customer2').prop('disabled',true);
        $('#customer3').prop('disabled',true);
    }
    else{   
        $('#groupadmindiv').hide();
        $('#groupadmin1').prop('disabled',false);
        $('#groupadmin2').prop('disabled',false);
        $('#groupadmin3').prop('disabled',false);
        $('#user1').prop('disabled',false);
        $('#user2').prop('disabled',false);
        $('#user3').prop('disabled',false);
        $('#customer1').prop('disabled',false);
        $('#customer2').prop('disabled',false);
        $('#customer3').prop('disabled',false);
        
        $.ajax({
                url: "getuserauth.php",
                type: "GET",
                success: 
                    function(result){
                       
                       var arrResults = JSON.parse(result);
                        if(result.indexOf('failed')>-1){
                             $('#statuslabel1').show();
                            $('#statuslabel1').text("Error retrieving authorizations.");
                             $('#statuslabel1').fadeOut(4000);  
                        }
                        else{
                          if(arrResults['usersearch']){
                              $('#user1').prop('checked',true);
                          }
                          else{
                               $('#user1').prop('checked',false);
                          }
                          if(arrResults['usercreate']){
                              $('#user2').prop('checked',true);
                          }
                          else{
                               $('#user2').prop('checked',false);
                          }
                          if(arrResults['useredit']){
                              $('#user3').prop('checked',true);
                          }
                          else{
                               $('#user3').prop('checked',false);
                          }

                          if(arrResults['customersearch']){
                              $('#customer1').prop('checked',true);
                          }
                          else{
                               $('#customer1').prop('checked',false);
                          }
                          if(arrResults['customercreate']){
                              $('#customer2').prop('checked',true);
                          }
                          else{
                               $('#customer2').prop('checked',false);
                          }
                          if(arrResults['customeredit']){
                              $('#customer3').prop('checked',true);
                          }
                          else{
                               $('#customer3').prop('checked',false);
                          }

                         // alert($('#serviceplan3').is(':checked'));
                        }
                    }            
        });
    }
}
function updateauthorizations(){
    if($('#usertype').val()==='Blank'){
        alert('Select a user type.');
    }
    else{
        $.ajax({
                url: "setauthresource.php",
                type: "POST",
                data: {
                    usertype:$('#usertype').val(),
                    platformsearch:$('#serviceplatform1').is(':checked'),
                    platformcreate:$('#serviceplatform2').is(':checked'),
                    platformedit:$('#serviceplatform3').is(':checked'),
                    channelsearch:$('#saleschannel1').is(':checked'),
                    channelcreate:$('#saleschannel2').is(':checked'),
                    channeledit:$('#saleschannel3').is(':checked'),
                    productsearch:$('#productmodel1').is(':checked'),
                    productcreate:$('#productmodel2').is(':checked'),
                    productedit:$('#productmodel3').is(':checked'),
                    simsearch:$('#simcard1').is(':checked'),
                    simcreate:$('#simcard2').is(':checked'),
                    simedit:$('#simcard3').is(':checked'),
                    plansearch:$('#serviceplan1').is(':checked'),
                    plancreate:$('#serviceplan2').is(':checked'),
                    planedit:$('#serviceplan3').is(':checked'),
                    billtosearch:$('#servicebillto1').is(':checked'),
                    billtocreate:$('#servicebillto2').is(':checked'),
                    billtoedit:$('#servicebillto3').is(':checked'),
                    platformadminsearch:$('#platformadmin1').is(':checked'),
                    platformadmincreate:$('#platformadmin2').is(':checked'),
                    platformadminedit:$('#platformadmin3').is(':checked'),
                    companycodesearch:$('#companycode1').is(':checked'),
                    companycodecreate:$('#companycode2').is(':checked'),
                    companycodeedit:$('#companycode3').is(':checked')
                },
                success: 
                    function(result){

                        if(result.indexOf('failed')>-1){
                            $('#statuslabel').show();
                            $('#statuslabel').text("Error updating authorization.");
                             $('#statuslabel').fadeOut(4000);

                        }
                        else{
                          $('#statuslabel').show();
                            $('#statuslabel').text("Authorization updated.");
                             $('#statuslabel').fadeOut(4000);  
                        }
                    }

            });
    }
}
function updateuserauth(){
    if($('#usertype1').val()==='Blank'){
        alert('Select a user type.');
    }
    else if($('#usertype1').val()==='2'){
        $.ajax({
                url: "setuserauth.php",
                type: "POST",
                data: {
                    
                    usersearch:$('#user1').is(':checked'),
                    usercreate:$('#user2').is(':checked'),
                    useredit:$('#user3').is(':checked'),
                    customersearch:$('#customer1').is(':checked'),
                    customercreate:$('#customer2').is(':checked'),
                    customeredit:$('#customer3').is(':checked')
                    
                },
                success: 
                    function(result){

                        if(result.indexOf('failed')>-1){
                            $('#statuslabel1').show();
                            $('#statuslabel1').text("Error updating authorization.");
                             $('#statuslabel1').fadeOut(4000);

                        }
                        else{
                          $('#statuslabel1').show();
                            $('#statuslabel1').text("Authorization updated.");
                             $('#statuslabel1').fadeOut(4000);  
                        }
                    }

            });
    
    }
    else{
        
    }
}
function setfunctionauth(){
    if($('#usertype2').val()==='Blank'){
        $('#accountsearch').prop('checked',false);
        $('#accountcreate').prop('checked',false);
        $('#accountedit').prop('checked',false);
        $('#invoicefull').prop('checked',false);
        $('#invoicesimfull').prop('checked',false);
        $('#invoicesimcheck').prop('checked',false);
        $('#invoiceproductfull').prop('checked',false);
        $('#invoiceproductcheck').prop('checked',false);
        $('#invoiceservicefull').prop('checked',false);
        $('#invoiceservicecheck').prop('checked',false);
        $('#invoicerenewfull').prop('checked',false);
        $('#invoicerenewcheck').prop('checked',false);
        $('#simfull').prop('checked',false);
        $('#siminventory').prop('checked',false);
        $('#simactivation').prop('checked',false);
        $('#simdeactivation').prop('checked',false);
        $('#simedit').prop('checked',false);
        $('#servicemgmt').prop('checked',false);
        $('#repindividual').prop('checked',false);
        $('#repadmin').prop('checked',false);
        $('#repplatform').prop('checked',false); 
        
    }
    else{
        $.ajax({
                url: "getfuncauth.php",
                type: "POST",
                data: {
                    usertype:$('#usertype2').val()
                },
                success: 
                    function(result){
                       var arrResults = JSON.parse(result);
                        if(result.indexOf('failed')>-1){
                             $('#statuslabel2').show();
                            $('#statuslabel2').text("Error retrieving authorizations.");
                             $('#statuslabel2').fadeOut(4000);  
                        }
                        else{
                          if(arrResults['accountsearch']){
                              $('#accountsearch').prop('checked',true);
                          }
                          else{
                               $('#accountsearch').prop('checked',false);
                          }
                          if(arrResults['accountcreate']){
                              $('#accountcreate').prop('checked',true);
                          }
                          else{
                               $('#accountcreate').prop('checked',false);
                          }
                          if(arrResults['accountedit']){
                              $('#accountedit').prop('checked',true);
                          }
                          else{
                               $('#accountedit').prop('checked',false);
                          }

                          if(arrResults['invoicefull']){
                              $('#invoicefull').prop('checked',true);
                          }
                          else{
                               $('#invoicefull').prop('checked',false);
                          }
                          if(arrResults['invoicesimfull']){
                              $('#invoicesimfull').prop('checked',true);
                          }
                          else{
                               $('#invoicesimfull').prop('checked',false);
                          }
                          if(arrResults['invoicesimcheck']){
                              $('#invoicesimcheck').prop('checked',true);
                          }
                          else{
                               $('#invoicesimcheck').prop('checked',false);
                          }
                          if(arrResults['invoiceproductfull']){
                              $('#invoiceproductfull').prop('checked',true);
                          }
                          else{
                               $('#invoiceproductfull').prop('checked',false);
                          }
                          if(arrResults['invoiceproductcheck']){
                              $('#invoiceproductcheck').prop('checked',true);
                          }
                          else{
                               $('#invoiceproductcheck').prop('checked',false);
                          }
                          if(arrResults['invoiceservicefull']){
                              $('#invoiceservicefull').prop('checked',true);
                          }
                          else{
                               $('#invoiceservicefull').prop('checked',false);
                          }
                          if(arrResults['invoiceservicecheck']){
                              $('#invoiceservicecheck').prop('checked',true);
                          }
                          else{
                               $('#invoiceservicecheck').prop('checked',false);
                          }
                          if(arrResults['invoicerenewfull']){
                              $('#invoicerenewfull').prop('checked',true);
                          }
                          else{
                               $('#invoicerenewfull').prop('checked',false);
                          }
                          if(arrResults['invoicerenewcheck']){
                              $('#invoicerenewcheck').prop('checked',true);
                          }
                          else{
                               $('#invoicerenewcheck').prop('checked',false);
                          }
                          if(arrResults['simfull']){
                              $('#simfull').prop('checked',true);
                          }
                          else{
                               $('#simfull').prop('checked',false);
                          }
                          if(arrResults['siminventory']){
                              $('#siminventory').prop('checked',true);
                          }
                          else{
                               $('#siminventory').prop('checked',false);
                          }
                          if(arrResults['simactivation']){
                              $('#simactivation').prop('checked',true);
                          }
                          else{
                               $('#simactivation').prop('checked',false);
                          }
                          if(arrResults['simdeactivation']){
                              $('#simdeactivation').prop('checked',true);
                          }
                          else{
                               $('#simdeactivation').prop('checked',false);
                          }
                          if(arrResults['simedit']){
                              $('#simedit').prop('checked',true);
                          }
                          else{
                               $('#simedit').prop('checked',false);
                          }
                          if(arrResults['servicemgmt']){
                              $('#servicemgmt').prop('checked',true);
                          }
                          else{
                               $('#servicemgmt').prop('checked',false);
                          }
                          
                          
                          if(arrResults['repindividual']){
                              $('#repindividual').prop('checked',true);
                          }
                          else{
                               $('#repindividual').prop('checked',false);
                          }
                          if(arrResults['repadmin']){
                              $('#repadmin').prop('checked',true);
                          }
                          else{
                               $('#repadmin').prop('checked',false);
                          }
                          if(arrResults['repplatform']){
                              $('#repplatform').prop('checked',true);
                          }
                          else{
                               $('#repplatform').prop('checked',false);
                          }
                         // alert($('#serviceplan3').is(':checked'));
                        }
                    }            
        });
    
    }
}
function updatefunctionauth(){
    if($('#usertype2').val()==='Blank'){
        alert('Select a user type.');
    }
    else{
        $.ajax({
                url: "setfuncauth.php",
                type: "POST",
                data: {
                    usertype:$('#usertype2').val(),
                    accountsearch:$('#accountsearch').is(':checked'),
                    accountcreate:$('#accountcreate').is(':checked'),
                    accountedit:$('#accountedit').is(':checked'),
                    invoicefull:$('#invoicefull').is(':checked'),
                    invoicesimfull:$('#invoicesimfull').is(':checked'),
                    invoicesimcheck:$('#invoicesimcheck').is(':checked'),
                    invoiceproductfull:$('#invoiceproductfull').is(':checked'),
                    invoiceproductcheck:$('#invoiceproductcheck').is(':checked'),
                    invoiceservicefull:$('#invoiceservicefull').is(':checked'),
                    invoiceservicecheck:$('#invoiceservicecheck').is(':checked'),
                    invoicerenewfull:$('#invoicerenewfull').is(':checked'),
                    invoicerenewcheck:$('#invoicerenewcheck').is(':checked'),
                    simfull:$('#simfull').is(':checked'),
                    siminventory:$('#siminventory').is(':checked'),
                    simactivation:$('#simactivation').is(':checked'),
                    simdeactivation:$('#simdeactivation').is(':checked'),
                    simedit:$('#simedit').is(':checked'),
                    servicemgmt:$('#servicemgmt').is(':checked'),
                    repindividual:$('#repindividual').is(':checked'),
                    repadmin:$('#repadmin').is(':checked'),
                    repplatform:$('#repplatform').is(':checked')
                    
                },
                success: 
                    function(result){

                        if(result.indexOf('failed')>-1){
                            $('#statuslabel2').show();
                            $('#statuslabel2').text("Error updating authorization.");
                             $('#statuslabel2').fadeOut(4000);

                        }
                        else{
                          $('#statuslabel2').show();
                            $('#statuslabel2').text("Authorization updated.");
                             $('#statuslabel2').fadeOut(4000);  
                        }
                    }

            });
    }
}
function clearfunctionauth(){
     $('#accountsearch').prop('checked',false);
        $('#accountcreate').prop('checked',false);
        $('#accountedit').prop('checked',false);
        $('#invoicefull').prop('checked',false);
        $('#invoicesimfull').prop('checked',false);
        $('#invoicesimcheck').prop('checked',false);
        $('#invoiceproductfull').prop('checked',false);
        $('#invoiceproductcheck').prop('checked',false);
        $('#invoiceservicefull').prop('checked',false);
        $('#invoiceservicecheck').prop('checked',false);
        $('#invoicerenewfull').prop('checked',false);
        $('#invoicerenewcheck').prop('checked',false);
        $('#simfull').prop('checked',false);
        $('#siminventory').prop('checked',false);
        $('#simactivation').prop('checked',false);
        $('#simdeactivation').prop('checked',false);
        $('#simedit').prop('checked',false);
        $('#servicemgmt').prop('checked',false); 
}
</script>
    </head>
    <body>
       <div class="headercolor"></div> 
    <div class="container">
        <div class="mp-pusher" id="mp-pusher">         
                <nav id="mp-menu" class="mp-menu">
                    <div class="mp-level">
                        <h2 class="icon icon-world">Operator</h2>
                            <ul>
                                <li class="" >
                                    <a class="icon icon-display" href="finduser.php">Search</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="">
                                    <a class="icon icon-display" href="addrole.php">Create Role</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="" >
                                    <a class="icon icon-display" href="adduser.php">Create</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="">
                                    <a class="icon icon-display" href="edituser.php">Edit</a>
                                </li>
                            </ul>
                            <ul>
                                <li class=""  style="background-color:aqua;">
                                    <a class="icon icon-display" href="authorizations.php">Authorizations</a>
                                </li>
                            </ul>
                             <ul>
                                <li class="">
                                    <a class="icon icon-display" href="main.php">Exit</a>
                                </li>
                            </ul>
                    </div>
                </nav>
            <div class="scroller"><!-- this is for emulating position fixed of the nav -->
                <div class="scroller-inner">
                      
                                <div class="block block-80 clearfix">
                                        <p><a href="#" id="trigger" class="menu-trigger" style="display:none;">Menu</a></p>
                                             <p style="float:right;">
                                                
                                                <input type="button" value="Exit" class="btnexit" onclick="location.href='main.php';"></input>
                                               
                                             </p>
                                        
                                        <div class="tabs">
                                            <ul class="tab-links">
                                                <li class="active"><a href="#tab1">Resource</a></li>
                                                <li><a href="#tab2">User Account</a></li>
                                                <li><a href="#tab3">System Function</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="tab1" class="tab active">
                                                     <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                                    <p style="font-size:medium">* - required</p>
                                                     <p> <label for="usertype">*User Type:</label>
                                                         <select name="usertype" id="usertype" onchange="setauthorizations();">
                                                             <option value="Blank"><--Select--></option>
                                                                <?php 
                                                          $sql= $conn->prepare('SELECT roleid,rolename FROM roles');
                                                          $sql->execute();
                                                          $sql->bind_result($roleid,$rolename);
                                                          
                                                          while($sql->fetch()){
                                                          ?>
                                                               <option value="<?php echo $roleid ?>"><?php echo $rolename ?></option>  
                                                          <?php
                                                          }
                                                          ?>
                                                         </select>   
                                                    </p>
                                                     <p>
                                                        <div class="tablelayout">
                                                             <div class="tableheading">
                                                                <div class="tablecell"><p>Type of Resource</p></div>
                                                                <div class="tablecell"><p>Search</p></div>
                                                                <div class="tablecell"><p>Create</p></div>
                                                                <div class="tablecell"><p>Edit</p></div>
                                                            </div>
                                                              <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Service Platform</p>
                                                                  </div>
                                                                  <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="serviceplatform1" name="serviceplatform" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="serviceplatform2" name="serviceplatform" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="serviceplatform3" name="serviceplatform" value=""></input></p>
                                                                  </div>  
                                                              </div>
                                                             <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Sales Channel</p>
                                                                  </div>
                                                                    <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="saleschannel1" name="saleschannel" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="saleschannel2" name="saleschannel" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="saleschannel3" name="saleschannel" value=""></input></p>
                                                                  </div>     
                                                              </div>
                                                             <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Product Model</p>
                                                                  </div>
                                                                  <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="productmodel1" name="productmodel" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="productmodel2" name="productmodel" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="productmodel3" name="productmodel" value=""></input></p>
                                                                  </div>    
                                                              </div>
                                                             <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>SIM Card</p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="simcard1" name="simcard" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="simcard2" name="simcard" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="simcard3" name="simcard" value=""></input></p>
                                                                  </div>   
                                                              </div>
                                                             <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Service Plan</p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="serviceplan1" name="serviceplan" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="serviceplan2" name="serviceplan" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="serviceplan3" name="serviceplan" value=""></input></p>
                                                                  </div>       
                                                              </div>
                                                             <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Service Bill To</p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="servicebillto1" name="servicebillto" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="servicebillto2" name="servicebillto" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="servicebillto3" name="servicebillto" value=""></input></p>
                                                                  </div>       
                                                              </div>
                                                            <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Platform Admin</p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="platformadmin1" name="platformadmin" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="platformadmin2" name="platformadmin" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="platformadmin3" name="platformadmin" value=""></input></p>
                                                                  </div>       
                                                              </div>
                                                            <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Company Code</p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="companycode1" name="companycode" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="companycode2" name="companycode" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="companycode3" name="companycode" value=""></input></p>
                                                                  </div>       
                                                              </div>
                                                        </div>
                                                    </p>
                                                    <p>
                                                         <input type="button" value="Update" class="btnupdate" onclick="updateauthorizations();"></input>
                                                    </p>
                                                </div>
                                                
                                                <div id="tab2" class="tab">
                                                    <p><label id="statuslabel1" style='color:lightgreen;font-weight: bold;'></label></p>
                                                    <p style="font-size:medium">* - required</p>
                                                     <p> <label for="usertype1">*User Type:</label>
                                                         <select name="usertype1" id="usertype1" onchange="setuserauth();">
                                                             <option value="Blank"><--Select--></option>
                                                                <?php 
                                                          $sql1= $conn->prepare('SELECT roleid,rolename FROM roles WHERE rolename="Company Admin" OR rolename="Group Admin"');
                                                          $sql1->execute();
                                                          $sql1->bind_result($roleid,$rolename);
                                                          
                                                          while($sql1->fetch()){
                                                          ?>
                                                               <option value="<?php echo $roleid ?>"><?php echo $rolename ?></option>  
                                                          <?php
                                                          }
                                                          ?>
                                                         </select>   
                                                    </p>
                                                   <p>
                                                        <div class="tablelayout">
                                                             <div class="tableheading">
                                                                <div class="tablecell"><p>Account Type</p></div>
                                                                <div class="tablecell"><p>Search</p></div>
                                                                <div class="tablecell"><p>Create</p></div>
                                                                <div class="tablecell"><p>Edit</p></div>
                                                            </div>
                                                              <div id="groupadmindiv" class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Group Admin</p>
                                                                  </div>
                                                                  <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="groupadmin1" name="groupadmin" ></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="groupadmin2" name="groupadmin" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="groupadmin3" name="groupadmin" value=""></input></p>
                                                                  </div>  
                                                              </div>
                                                             <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>User</p>
                                                                  </div>
                                                                    <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="user1" name="user" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="user2" name="user" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="user3" name="user" value=""></input></p>
                                                                  </div>     
                                                              </div>
                                                             <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Customer</p>
                                                                  </div>
                                                                  <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="customer1" name="customer" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="customer2" name="customer" value=""></input></p>
                                                                  </div>
                                                                   <div class="tablecell" style="text-align:center;">
                                                                      <p><input type="checkbox" id="customer3" name="customer" value=""></input></p>
                                                                  </div>    
                                                              </div>
                                                             
                                                        </div>
                                                    </p>
                                                    <p>
                                                         <input type="button" value="Update" class="btnupdate" onclick="updateuserauth();"></input>
                                                    </p>
                                                   
                                                </div>
                                                <div id="tab3" class="tab">
                                                         
                                                    <p style="font-size:medium">* - required</p>
                                                     <p> <label for="usertype2">*User Type:</label>
                                                         <select name="usertype2" id="usertype2" onchange="setfunctionauth();">
                                                             <option value="Blank"><--Select--></option>
                                                                <?php 
                                                          $sql2= $conn->prepare('SELECT roleid,rolename FROM roles');
                                                          $sql2->execute();
                                                          $sql2->bind_result($roleid,$rolename);
                                                          
                                                          while($sql2->fetch()){
                                                          ?>
                                                               <option value="<?php echo $roleid ?>"><?php echo $rolename ?></option>  
                                                          <?php
                                                          }
                                                          ?>
                                                         </select>   
                                                    </p>
                                                     <p>
                                                        <div class="tablelayout">
                                                             <div class="tableheading">
                                                                <div class="tablecell" style="width:50%;"><p>Type of Function</p></div>
                                                                <div class="tablecell" style="width:50%;"><p>Authorization</p></div>
                                                               
                                                            </div>
                                                            <div class="tablerow">
                                                                <div class="tablecell">
                                                                    <p>Account Management</p>
                                                                </div>
                                                                <div class="tablecell">
                                                                    <p>
                                                                      <input type="checkbox" id="accountsearch" name="accountmanagement">Search</input>
                                                                    </p>
                                                                    <p>
                                                                        <input type="checkbox" id="accountcreate" name="accountmanagement">Create</input>
                                                                    </p>
                                                                    <p>
                                                                        <input type="checkbox" id="accountedit" name="accountmanagement">Edit</input>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="tablerow">
                                                                <div class="tablecell">
                                                                    <p>Invoice Management</p>
                                                                </div>
                                                                <div class="tablecell">
                                                                      <p><input type="checkbox" id="invoicefull" name="invoicefull">Full Function</input></p>
                                                                </div>
                                                                     
                                                            </div>
                                                            <div class="tablerow">
                                                                <div class="tablecell">
                                                                    <p>Invoice & SIM</p>
                                                                </div>
                                                                <div class="tablecell">
                                                                    <p><input type="checkbox" id="invoicesimfull" name="invoicesim">Full Function</input></p>
                                                                    <p>
                                                                        <input type="checkbox" id="invoicesimcheck" name="invoicesim">Invoice Check</input>
                                                                    </p>
                                                                </div>
                                                                      
                                                            </div>
                                                            <div class="tablerow">
                                                                <div class="tablecell">
                                                                    <p>Invoice & Product</p>
                                                                </div>
                                                                 <div class="tablecell">
                                                                    <p><input type="checkbox" id="invoiceproductfull" name="invoiceproduct">Full Function</input></p>
                                                                    <p><input type="checkbox" id="invoiceproductcheck" name="invoiceproduct">Invoice Check</input></p>
                                                                </div>
                                                                 
                                                            </div>
                                                            <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Invoice & Service</p>
                                                                  </div>
                                                                   <div class="tablecell">
                                                                      <p><input type="checkbox" id="invoiceservicefull" name="invoiceservice">Full Function</input></p>
                                                                      <p><input type="checkbox" id="invoiceservicecheck" name="invoiceservice">Invoice Check</input></p>
                                                                  </div> 
                                                            </div>
                                                            <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Invoice & Service Renew</p>
                                                                  </div>
                                                                   <div class="tablecell">
                                                                      <p><input type="checkbox" id="invoicerenewfull" name="invoicerenew">Full Function</input></p>
                                                                      <p><input type="checkbox" id="invoicerenewcheck" name="invoicerenew">Invoice Check</input></p>
                                                                  </div> 
                                                            </div>
                                                            <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Sim Card Management</p>
                                                                  </div>
                                                                   <div class="tablecell">
                                                                      <p><input type="checkbox" id="simfull" name="simcardmgmt">Full Function</input></p>
                                                                      <p><input type="checkbox" id="siminventory" name="simcardmgmt">Inventory</input></p>
                                                                      <p><input type="checkbox" id="simactivation" name="simcardmgmt">Activation</input></p>
                                                                      <p><input type="checkbox" id="simdeactivation" name="simcardmgmt">Deactivation</input></p>
                                                                      <p><input type="checkbox" id="simedit" name="simcardmgmt">Edit</input></p>
                                                                  </div> 
                                                            </div>
                                                            <div class="tablerow">
                                                                <div class="tablecell">
                                                                    <p>Service Management</p>
                                                                </div>
                                                                <div class="tablecell">
                                                                    <p><input type="checkbox" id="servicemgmt" name="servicemgmt">Full Function</input></p>  
                                                                </div> 
                                                            </div>
                                                             <div class="tablerow">
                                                                  <div class="tablecell">
                                                                      <p>Reports</p>
                                                                  </div>
                                                                   <div class="tablecell">
                                                                      <p><input type="checkbox" id="repindividual" name="reports">Individual</input></p>
                                                                      <p><input type="checkbox" id="repadmin" name="reports">Admin</input></p>
                                                                      <p><input type="checkbox" id="repplatform" name="reports">Platform</input></p>
                                                                     
                                                                  </div> 
                                                            </div>
                                                        </div>
                                                    </p>
                                                    <p>
                                                         <input type="button" value="Update" class="btnupdate" onclick="updatefunctionauth();"></input>
                                                         <input type="button" value="Clear" class="btnclear" onclick="clearfunctionauth();"></input>
                                                    </p>
                                                    <p><label id="statuslabel2" style='color:lightgreen;font-weight: bold;'></label></p>
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
            // new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
            mainMenu = new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {type : 'overlap'});
            mainMenu._openMenu();
    </script>
    <input type="hidden" id="productcount" name="productcount" value="1"></input>
    </body>

</html>
