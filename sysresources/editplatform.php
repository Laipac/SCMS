<!--
This module is for modifying platforms
-->
<?php include "../dbConfig.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Edit Platform - SIM CARD Management System</title>
<meta name="description" content=""/>
<meta name="keywords" content=""/>
<link href="../style.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../html5reset.css" media="all"/>
<link rel="stylesheet" href="../col.css" media="all"/>
<link rel="stylesheet" href="../2cols.css" media="all"/>
<link rel="stylesheet" href="../3cols.css" media="all"/>
<link rel="stylesheet" href="../4cols.css" media="all"/>
<link rel="stylesheet" href="../5cols.css" media="all"/>
<link rel="stylesheet" href="../6cols.css" media="all"/>
<link rel="stylesheet" href="../7cols.css" media="all"/>
<link rel="stylesheet" href="../8cols.css" media="all"/>
<link rel="stylesheet" href="../9cols.css" media="all"/>
<link rel="stylesheet" href="../10cols.css" media="all"/>
<link rel="stylesheet" href="../11cols.css" media="all"/>
<link rel="stylesheet" href="../12cols.css" media="all"/>
<link rel="stylesheet" type="text/css" href="../css/normalize.css" />
<link rel="stylesheet" type="text/css" href="../css/demo.css" />
<link rel="stylesheet" type="text/css" href="../css/icons.css" />
<link rel="stylesheet" type="text/css" href="../css/component.css" />
<script type="text/javascript" src="../js/modernizr.custom.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
    $.ajax({
         url: "../checkresourceauth.php",
         type: "POST",
         data: {
             resource:'Service Platform',
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

        function editplatform(platformid){
                
              $('input[type=text][name='+platformid+']').show();
              
              $('#spanvalue'+platformid).hide();
              
              if($('#selectedplatform').val()>0){
                  $('input[type=text][name='+ $('#selectedplatform').val()+']').hide();
                  $('#spanvalue'+$('#selectedplatform').val()).show();
              }
              $('#selectedplatform').val(platformid);
            
              $('#updatevalue').removeAttr('disabled');
              $('#cancelbutton').removeAttr('disabled');
              $('#notelabel').text("Note: Updating platform name will update platform name of all records.");
              $('#statuslabel').text("");
         }
        function cancelplatform(){
            $('input[type=radio][name=platformname]').removeAttr("checked");
            $('#statuslabel').text("");
            $('#notelabel').text("");
            $('input[type=text][name='+ $('#selectedplatform').val()+']').hide();
            $('#spanvalue'+$('#selectedplatform').val()).show(); 
             $('#selectedplatform').val("-1");
        }
        function updateplatform(){
            
            $('#updatevalue').attr('disabled','disabled');
            $('#cancelbutton').attr('disabled','disabled');
            
            $.ajax({
              url: "updplatform.php",
              type: "POST",
              data: {
                  platformname:$('input[type=text][name='+ $('#selectedplatform').val()+']').val(),
                  platformid:$('#selectedplatform').val()
              },
              success: 
                  function(result){

                      if(result === "success"){
                          $('#statuslabel').show();
                          $('#statuslabel').text("Platform updated");
                          $('#statuslabel').fadeOut(4000);
                          $('input[type=text][name='+ $('#selectedplatform').val()+']').val($('input[type=text][name='+ $('#selectedplatform').val()+']').val());
                        
                          $('#spanvalue'+($('#selectedplatform').val())).text($('input[type=text][name='+ $('#selectedplatform').val()+']').val());
                          $('input[type=text][name='+ $('#selectedplatform').val()+']').hide();
                          $('#spanvalue'+$('#selectedplatform').val()).show(); 
                      }
                      else if(result === "exists"){
                          $('#statuslabel').show();
                          $('#statuslabel').text("Error updating platform. Platform already exists.");
                          $('#statuslabel').fadeOut(4000);
                          $('input[type=text][name='+ $('#selectedplatform').val()+']').val($('#spanvalue'+($('#selectedplatform').val())).text());
                          $('input[type=text][name='+ $('#selectedplatform').val()+']').hide();
                          $('#spanvalue'+$('#selectedplatform').val()).show(); 
                      }
                      else
                      {
                          $('#statuslabel').show();
                          $('#statuslabel').text("Error updating platform.");
                          $('#statuslabel').fadeOut(4000);
                          $('input[type=text][name='+ $('#selectedplatform').val()+']').val($('#spanvalue'+($('#selectedplatform').val())).text());
                          $('input[type=text][name='+ $('#selectedplatform').val()+']').hide();
                          $('#spanvalue'+$('#selectedplatform').val()).show(); 
                      }
                       $('#notelabel').text("");
                       $('input[type=radio][name=platformname]').removeAttr("checked");
                        $('#selectedplatform').val("-1");
                  }
             });
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
                        <h2 class="icon icon-world">Service Platform</h2>
                        <ul>
                            <li class="">
                                <a class="icon icon-display" href="searchplatform.php">Search</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="">
                                <a class="icon icon-display" href="addplatform.php">Create</a>
                            </li>
                        </ul>
                         <ul>
                            <li class="" style="background-color:aqua;">
                                <a class="icon icon-display" href="editplatform.php">Edit</a>
                            </li>
                        </ul>
                         <ul>
                            <li class="">
                                <a class="icon icon-display" href="../sysmenu.php">Exit</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            <div class="scroller"><!-- this is for emulating position fixed of the nav -->
                    <div class="scroller-inner" id="pagecontent">
                           
                                <div class="block block-45 clearfix">
                                    <p><a href="#" id="trigger" class="menu-trigger" style="display:none;">Menu</a></p>
                                     <p><label id="notelabel" style='color:red;font-weight: bold;'></label></p>
                                    <div class="tablelayout">
                                        <div class="tableheading">
                                            <div class="tablecell"><p></p></div>
                                            <div class="tablecell"><p>Name</p></div>
                                        </div>
                                        
                                            <?php

                                            $sql= $conn->prepare('SELECT platformid,platformname FROM serviceplatform');
                                            $sql->execute();
                                            $sql->bind_result($platformid,$platformname);
                                            while($sql->fetch())
                                            {?>
                                              <div class="tablerow">
                                                  <div class="tablecell">
                                                      <p><input type="radio" id="platformname" name="platformname" value="<?php echo $platformid; ?>" onclick="editplatform(this.value)"/></p>
                                                  </div>
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spanvalue<?php echo $platformid; ?>"><?php echo $platformname; ?></span>
                                                          <input type="text" id="platformtext" name="<?php echo $platformid; ?>" value="<?php echo $platformname; ?>" style="display:none;"/>
                                                      </p>
                                                  </div>
                                              </div>
                                            <?php

                                            }
                                            mysqli_close($conn);
                                            ?>
                                        
                                    </div>
                                    
                                     
                                </div>
                                <div class="block block-30 clearfix">
                                    <p><input type="button" value="Exit" onclick="location.href='../sysmenu.php';" class="btnback"></input></p>
                                         
                                    <p><input type="button" value="Save" id="updatevalue" onclick="updateplatform()" disabled="disabled" class="btnedit"></input></p>
                                    <p><input type="button" value="Cancel" id="cancelbutton" onclick="cancelplatform()" disabled="disabled" class="btncancel"></input></p>
                                    <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                </div>
                           
                    </div><!-- /scroller-inner -->
            </div><!-- /scroller -->
        </div>
          <input type="hidden" id="selectedplatform" value="0"/>
    </div>	
    <script type="text/javascript" src="../js/classie.js"></script>
    <script type="text/javascript" src="../js/mlpushmenu.js"></script>
    <script type="text/javascript">
       //     new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
        mainMenu = new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {type : 'overlap'});
              mainMenu._openMenu();
    </script>
  
</body>
</html>
