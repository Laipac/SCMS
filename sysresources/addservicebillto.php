<!--
This module is for adding service bill to
-->

<?php include "../dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Add Service Bill To - SIM CARD Management System</title>
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

<style type="text/css">
    input[type=button].btncreate{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('../images/create.png') 5px no-repeat ;
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
<script type="text/javascript">
$.ajax({
         url: "../checkresourceauth.php",
         type: "POST",
         data: {
             resource:'Service Bill To',
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
            function addplatform(){
                var platformname = $('#servicebillto').val().trim();
                
                if (platformname===""){
                     alert("Kindly enter service bill to.");
                }
                else{   
                   
                    $.ajax({
                      url: "addservicebilltorec.php",
                      type: "POST",
                      data: {
                          servicebillto:platformname,
                          platformid:$('#platform').val()
                      },
                      success: 
                          function(result){
                              
                              if(result === "success"){
                                  $('#statuslabel').show();
                                  $('#statuslabel').text("Service bill to created");
                                  $('#statuslabel').fadeOut(4000);
                              }
                              else if(result === "exists"){
                                  $('#statuslabel').show();
                                  $('#statuslabel').text("Service bill to record exists");
                                  $('#statuslabel').fadeOut(4000);
                              }
                              else
                              {
                                  $('#statuslabel').show();
                                  $('#statuslabel').text("Error creating service bill to.");
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
                        <h2 class="icon icon-world">Service Bill To</h2>
                        <ul>
                            <li class="">
                                <a class="icon icon-display" href="searchservicebillto.php">Search</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="" style="background-color:aqua;">
                                <a class="icon icon-display" href="addservicebillto.php">Create</a>
                            </li>
                        </ul>
                         <ul>
                            <li class="">
                                <a class="icon icon-display" href="editservicebillto.php">Edit</a>
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
                           
                                <div class="block block-35 clearfix">
                                    <p><a href="#" id="trigger" class="menu-trigger" style="display:none;">Menu</a></p>
                                     <p> <label for="platform">Platform:  </label>
                                        <select name="platform" id="platform">
                                          
                                         <?php 
                                         $sql= $conn->prepare('SELECT platformid,platformname FROM serviceplatform');
                                         $sql->execute();
                                         $sql->bind_result($platformid,$platformname);

                                         while($sql->fetch()){
                                         ?>
                                              <option value="<?php echo $platformid; ?>"><?php echo $platformname; ?></option>  
                                         <?php
                                         }

                                         ?>
                                     </select>  
                                   </p>
                                    <p> <label for="servicebillto">Service Bill To:</label>
                                            <input type="text" name="servicebillto" id="servicebillto" value="" />
                                    </p>
                                    <p><input type="button" value="Add" onclick="addplatform();" class="btncreate"></input></p>
                                                                   
                                    <p><input type="button" value="Exit" onclick="location.href='../sysmenu.php';" class="btnback"></input></p>
                                         
                                </div>
                                <div class="block block-30">
                                    <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                </div>
                           
                    </div><!-- /scroller-inner -->
            </div><!-- /scroller -->
        </div>
    </div>	
    <script type="text/javascript" src="../js/classie.js"></script>
    <script type="text/javascript" src="../js/mlpushmenu.js"></script>
    <script type="text/javascript">
          //  new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
           mainMenu = new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {type : 'overlap'});
           mainMenu._openMenu();
    </script>
</body>
</html>
