<!--
This module is for modifying user details
-->
<?php include "dbConfig.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>User Maintenance - SIM CARD Management System</title>
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
         url: "checkuserauth.php",
         type: "POST",
         data: {
             
             activity:'editauth'
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
            url: "upduserrecord.php",
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
                        $('#statuslabel').text("User modified.");
                         $('#statuslabel').fadeOut(4000);

                    }
                    else{
                        alert(result);
                      $('#statuslabel').show();
                        $('#statuslabel').text("Error modifying user.");
                         $('#statuslabel').fadeOut(4000);  
                    }
                }

        });
    }
}
function searchCust(){
   if ($('#searchcust').val()===""){
        alert("Kindly enter user name.");
   }
   else{
        $.ajax({
           url: "searchuser.php",
           type: "POST",
           data: {username:$('#searchcust').val()
           },
           success: 
               function(result){

                   if(result==="failed"){
                       $('#statuslabel').text("Customer does not exist.");
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
                   else{
                      var arrResult = JSON.parse(result);
                      $('#userfname').val(arrResult['userfname']);
                       $('#userlname').val(arrResult['userlname']);
                       $('#userphone').val(arrResult['phone']);
                       $('#usermobile').val(arrResult['mobilephone']);
                       $('#usercountry').val(arrResult['country']);
                       $('#usercity').val(arrResult['city']);
                       $('#userstreet').val(arrResult['street']);
                       $('#userprovince').val(arrResult['province']);
                       $('#userzip').val(arrResult['zip']);
                       $('#usertype').val(arrResult['usertype']);
                       $('#useremail').val(arrResult['email']);
                       $('#username').val($('#searchcust').val());
                       $('#usercompany').val(arrResult['company']);
                        $('#statuslabel').text("");
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
                                <li class="" style="background-color:aqua;">
                                    <a class="icon icon-display" href="edituser.php">Edit</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="" >
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
                        <div class="scroller-inner" id="pagecontent">
                        
                                <div class="block block-80 clearfix">
                                        <p><a href="#" id="trigger" class="menu-trigger" style="display:none;">Menu</a></p>
                                             <p style="float:right;">
                                                <input type="button" value="Modify User" onclick="adduser()"/> 
                                                <input type="button" value="Exit" onclick="location.href='main.php';"></input>
                                                <input type="button" value="Reset" onclick="resetfields()"/>
                                             </p>
                                       
                                        
                                        <div class="tabs">
                                            <ul class="tab-links">
                                                <li class="active"><a href="#tab1">User Details</a></li>
                                             
                                            </ul>
                                            <div class="tab-content">
                                                <div id="tab1" class="tab active">
                                                     <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                                      <p> 
                                                        <label for="searchcust">Input User Name:</label>

                                                        <input type="text" name="searchcust" id="searchcust" value=""/>
                                                        <input type="button" value=""  onclick="searchCust()" style="width:40px;height:40px;background: url('search.png');background-position:center;background-repeat: no-repeat;"></input>
                                                    </p>
                                                    <p style="font-size:medium">* - required</p>
                                                     <p> <label for="usertype">*User Type:</label>
                                                         <select name="usertype" id="usertype">
                                                             <option value="Blank"><--Select--></option>
                                                             <option value="Company Admin">Company Admin</option>
                                                             <option value="Group Admin">Group Admin</option>
                                                             <option value="User">User</option>
                                                              <option value="Customer">Customer</option>
                                                         </select>   
                                                    </p>
                                                    <p>
                                                        <label for="username">*User Name:</label>
                                                        <input type="text" name="username" id="username" value=""></input>
                                                    </p>
                                                    <p>
                                                        <label for="userpass">*Password:</label>
                                                        <input type="password" name="userpass" id="userpass" value=""></input>
                                                    </p>
                                                    <p>
                                                         <label for="userfname">*First Name: </label>
                                                         <input type="text" name="userfname" id="userfname" value=""></input>
                                                    </p>
                                                    <p>
                                                          <label for="userlname">*Last Name:</label>
                                                          <input type="text" name="userlname" id="userlname" value=""></input>
                                                    </p>
                                                    <p>
                                                          <label for="useremail">*Email:</label>
                                                          <input type="text" name="useremail" id="useremail" value=""></input>
                                                    </p>
                                                    <p>
                                                          <label for="usercompany">*Company:</label>
                                                          <input type="text" name="usercompany" id="usercompany" value=""></input>
                                                    </p>
                                                    <p>
                                                          <label for="userphone">Phone:</label>
                                                          <input type="text" name="userphone" id="userphone" value=""></input>
                                                    </p>
                                                    <p>
                                                          <label for="usermobile">Mobile Phone:</label>
                                                          <input type="text" name="usermobile" id="usermobile" value=""></input>
                                                    </p>
                                                    <p>
                                                          <label for="usercountry">Country:</label>
                                                          <input type="text" name="usercountry" id="usercountry" value=""></input>
                                                    </p>
                                                    <p>
                                                          <label for="userprovince">Province:</label>
                                                          <input type="text" name="userprovince" id="userprovince" value=""></input>
                                                    </p>
                                                    <p>
                                                          <label for="usercity">City:</label>
                                                          <input type="text" name="usercity" id="usercity" value=""></input>
                                                    </p>
                                                    <p>
                                                          <label for="userstreet">Street & No:</label>
                                                          <input type="text" name="userstreet" id="userstreet" value=""></input>
                                                    </p>
                                                    <p>
                                                          <label for="userzip">Zip/Post code:</label>
                                                          <input type="text" name="userzip" id="userzip" value=""></input>
                                                    </p>
                                                    
                                                    
                                                   
                                                </div>
                        
                                            </div>
                                        </div>                                                                     
                               
                        </div>
                </div><!-- /scroller-inner -->
            </div><!-- /scroller -->
        </div>
    </div>
  </body>
    <script type="text/javascript" src="js/classie.js"></script>
    <script type="text/javascript" src="js/mlpushmenu.js"></script>
    <script type="text/javascript">
              // new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
            mainMenu = new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {type : 'overlap'});
            mainMenu._openMenu();
    </script>
   
   

</html>
