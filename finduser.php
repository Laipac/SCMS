<!--
This module is for searching users
-->
<?php include "dbConfig.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Search User - SIM CARD Management System</title>
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

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
    $.ajax({
         url: "checkuserauth.php",
         type: "POST",
         data: {
             
             activity:'searchauth'
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
        function editproductmodel(productmodelid){
                
              $('input[type=text][name='+productmodelid+']').show();
              
              $('#spanvalue'+productmodelid).hide();
              
              if($('#selectedproductmodel').val()>0){
                  $('input[type=text][name='+ $('#selectedproductmodel').val()+']').hide();
                  $('#spanvalue'+$('#selectedproductmodel').val()).show();
              }
              $('#selectedproductmodel').val(productmodelid);
            
              $('#updatevalue').removeAttr('disabled');
              $('#cancelbutton').removeAttr('disabled');
              $('#notelabel').text("Note: Updating product model will update product model of all records.");
              $('#statuslabel').text("");
         }
        function cancelproductmodel(){
            $('input[type=radio][name=productmodelname]').removeAttr("checked");
            $('#statuslabel').text("");
            $('#notelabel').text("");
            $('input[type=text][name='+ $('#selectedproductmodel').val()+']').hide();
            $('#spanvalue'+$('#selectedproductmodel').val()).show();
             $('#selectedproductmodel').val("-1");
        }
        function updateproductmodel(){
            
            $('#updatevalue').attr('disabled','disabled');
            $('#cancelbutton').attr('disabled','disabled');
            
            $.ajax({
              url: "updprodmodel.php",
              type: "POST",
              data: {
                  productmodelname:$('input[type=text][name='+ $('#selectedproductmodel').val()+']').val(),
                  productmodelid:$('#selectedproductmodel').val()
              },
              success: 
                  function(result){

                      if(result === "success"){
                           $('#statuslabel').show();
                          $('#statuslabel').text("Product model updated");
                          $('input[type=text][name='+ $('#selectedproductmodel').val()+']').val($('input[type=text][name='+ $('#selectedproductmodel').val()+']').val());
                        
                          $('#spanvalue'+($('#selectedproductmodel').val())).text($('input[type=text][name='+ $('#selectedproductmodel').val()+']').val());
                          $('input[type=text][name='+ $('#selectedproductmodel').val()+']').hide();
                          $('#spanvalue'+$('#selectedproductmodel').val()).show(); 
                          $('#statuslabel').fadeOut(4000);
                      }
                      else if(result === "exists"){
                          $('#statuslabel').show();
                          $('#statuslabel').text("Product model exists.");
                          $('#statuslabel').fadeOut(4000);
                      }
                      else
                      {
                          $('#statuslabel').show();
                          $('#statuslabel').text("Error updating product model.");
                          $('#statuslabel').fadeOut(4000);
                      }
                       $('#notelabel').text("");
                       $('input[type=radio][name=productmodelname]').removeAttr("checked");
                        $('#selectedproductmodel').val("-1");
                  }
             });
        }
function searchvalue(){
    var i = 0;
    if($('#searchstring').val()===""){
        alert("Search string is empty.");
    }
    else{
      
        while(i < $('#searchcount').val()){
            $('#tablerow'+(i+1)).css('background-color',"");
           if(($('#spanuser'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           else if(($('#spantype'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           i++;
        }
    }
    
   
}
</script>
<style type="text/css">
    input[type=button].btnedit{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('../images/edit.png') 5px no-repeat ;
         background-color:#666666;
        background-position: left center;

    }
     input[type=button].btnsearch{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('../images/search.png') 5px no-repeat ;
         background-color:#666666;
        background-position: left center;

    }
    input[type=button].btncancel{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('../images/cancel.png') 5px no-repeat ;
         background-color:#666666;
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
         background: url('../images/back.png') 5px no-repeat ;
         background-color:#666666;
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
    <div class="headercolor"></div> 
    <div class="container">
        <div class="mp-pusher" id="mp-pusher">         
                <nav id="mp-menu" class="mp-menu">
                    <div class="mp-level">
                        <h2 class="icon icon-world">Operator</h2>
                        <ul>
                            <li class="" style="background-color:aqua;">
                                <a class="icon icon-display" href="finduser.php">Search</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="">
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
                          
                                <div class="block block-40">
                                    <p><a href="#" id="trigger" class="menu-trigger" style="display:none;">Menu</a></p>
                                    <p> <label for="searchstring">Search:<input type="text" name="searchstring" id="searchstring" value=""/></label></p>
                                    <p><input type="button" value="Search" onclick="searchvalue();" class="btnsearch"></input></p>
                                    
                                    <div class="tablelayout">
                                        <div class="tableheading">
                                            <div class="tablecell"><p>Username</p></div>
                                            <div class="tablecell"><p>Type</p></div>
                                        </div>
                                        
                                            <?php

                                            $sql= $conn->prepare('SELECT username,usertype FROM members ORDER BY usertype');
                                            $sql->execute();
                                            $sql->bind_result($username,$usertype);
                                            $i=1;
                                            while($sql->fetch())
                                            {?>
                                              <div class="tablerow" id="tablerow<?php echo $i; ?>">
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spanuser<?php echo $i; ?>"><?php echo $username; ?></span>
                                                      </p>
                                                  </div>
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spantype<?php echo $i; ?>"><?php echo $usertype; ?></span>
                                                      </p>
                                                  </div>
                                              </div>
                                            <?php
                                                 $i++;
                                            }
                                            mysqli_close($conn);
                                            ?>
                                         <input type="hidden" value="<?php echo $i-1; ?>" id="searchcount"></input>
                                    </div>
                                    
                                     
                                </div>
                                <div class="block block-80 clearfix">
                                    <p><input type="button" value="Exit" onclick="location.href='main.php';" class="btnback"></input></p>
                                         
                                  
                                </div>
                         
                    </div><!-- /scroller-inner -->
            </div><!-- /scroller -->
        </div>
          <input type="hidden" id="selectedproductmodel" value="0"/>
    </div>	
    <script type="text/javascript" src="js/classie.js"></script>
    <script type="text/javascript" src="js/mlpushmenu.js"></script>
    <script type="text/javascript">
          // new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
            mainMenu = new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {type : 'overlap'});
            mainMenu._openMenu();
    </script>
  
</body>
</html>
