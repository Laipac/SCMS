<!--
This module is for adding user to system.
-->
<?php include "dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Add Role - SIM CARD Management System</title>
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
             
             activity:'createauth'
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
            
            function addrole(){
                if($('#rolename').val()===""){
                     alert("Kindly enter role name.");
                }
              
                else{
                  $.ajax({
                        url: "addrolerecord.php",
                        type: "POST",
                        data: {
                            rolename:$('#rolename').val()
                        },
                        success: 
                            function(result){
                               
                                if(result==='successsuccesssuccesssuccesssuccesssuccesssuccesssuccesssuccesssuccesssuccess'){
                                    $('#statuslabel').show();
                                    $('#statuslabel').text("Role Created.");
                                     $('#statuslabel').fadeOut(4000);
                                   
                                }
                                else if(result==='exists'){
                                    $('#statuslabel').show();
                                    $('#statuslabel').text("Role already exists.");
                                     $('#statuslabel').fadeOut(4000);
                                }
                                else{
                                  $('#statuslabel').show();
                                  $('#statuslabel').text(result);
                                 
                                   // $('#statuslabel').text("Error creating user.");
                                     $('#statuslabel').fadeOut(4000);  
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
                        <h2 class="icon icon-world">Operator</h2>
                        <ul>
                            <li class="" >
                                <a class="icon icon-display" href="finduser.php">Search</a>
                            </li>
                        </ul>
                         <ul>
                            <li class="" style="background-color:aqua;">
                                <a class="icon icon-display" href="addrole.php">Create Role</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="">
                                <a class="icon icon-display" href="adduser.php">Create</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="" >
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
                                                <input type="button" value="Add Role" onclick="addrole()"/> 
                                                <input type="button" value="Exit" onclick="location.href='sysmenu.php';"></input>
                                               
                                             </p>
                                        
                                        <div class="tabs" >
                                            <ul class="tab-links">
                                                <li class="active"><a href="#tab1">Role</a></li>
                                                <li><a href="#tab2">Available Roles</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div id="tab1" class="tab active">
                                                     <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                                  
                                                    <p>
                                                        <label for="rolename">Role Name:</label>
                                                        <input type="text" name="rolename" id="rolename" value=""></input>
                                                    </p>
                                                    
                                                    
                                                   
                                                </div>
                                                <div id="tab2" class="tab">
                                                    
                                                    <div class="tablelayout">
                                                        <div class="tableheading">
                                                            <div class="tablecell"><p>Role</p></div>
                                                           
                                                        </div>

                                                            <?php

                                                            $sql= $conn->prepare('SELECT rolename FROM roles');
                                                            $sql->execute();
                                                            $sql->bind_result($rolename);
                                                            $i=1;
                                                            while($sql->fetch())
                                                            {?>
                                                              <div class="tablerow" id="tablerow<?php echo $i; ?>">
                                                                  <div class="tablecell">
                                                                      <p>
                                                                          <span id="spanuser<?php echo $i; ?>"><?php echo $rolename; ?></span>
                                                                      </p>
                                                                  </div>
                                                                
                                                              </div>
                                                            <?php
                                                                 $i++;
                                                            }
                                                            mysqli_close($conn);
                                                            ?>
                                                         <input type="hidden" value="<?php echo $i-1; ?>" id="rolecount"></input>
                                                    </div>
                                                    
                                                    
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
