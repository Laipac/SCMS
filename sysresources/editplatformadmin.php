<!--
This module is for modifying platform admin.
-->

<?php include "../dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Edit Platform Admin - SIM CARD Management System</title>
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
<script type="text/javascript">
jQuery(document).ready(function() {
    $.ajax({
         url: "../checkresourceauth.php",
         type: "POST",
         data: {
             resource:'Platform Admin',
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
function editsim(simid){                
    $('input[type=text][name=platformadmin'+simid+']').show();
    $('#spanadmin'+simid).hide();
   
    $('select[name=platformname'+simid+']').show();
    $('#spanplatformname'+simid).hide();
   

    if($('#selectedsim').val()>0){
        $('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').hide();
        $('#spanadmin'+$('#selectedsim').val()).show();
        $('select[name=platformname'+ $('#selectedsim').val()+']').hide();
        $('#spanplatformname'+$('#selectedsim').val()).show();
        
    }
    $('#selectedsim').val(simid);

    $('#updatevalue').removeAttr('disabled');
    $('#cancelbutton').removeAttr('disabled');
    $('#notelabel').text("Note: Updating SIM type will update SIM type details of all records.");
    $('#statuslabel').text("");
    
   
}
function cancelsim(){
    
    $('input[type=radio][name=platformadminid]').removeAttr("checked");
    $('#statuslabel').text("");
    $('#notelabel').text("");
    
   
    $('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').hide();
    $('#spanadmin'+$('#selectedsim').val()).show();
    
    $('select[name=platformname'+ $('#selectedsim').val()+']').hide();
    $('#spanplatformname'+$('#selectedsim').val()).show();
    
    $('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').val($('#spanadmin'+($('#selectedsim').val())).text());
    $('select[name=platformname'+ $('#selectedsim').val()+'] option:contains('+ $('#spanplatformname'+$('#selectedsim').val()).text() +')').attr('selected',true);
                              
    
    
    
    $('#selectedsim').val("-1");
    $('#updatevalue').attr('disabled','disabled');
    $('#cancelbutton').attr('disabled','disabled');
}  

function updateplatformadmin(){
   
    $('#updatevalue').attr('disabled','disabled');
    $('#cancelbutton').attr('disabled','disabled');
    if($('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').val() === ''){
        alert("Enter platform administrator.");
    }
    else{
         $.ajax({
               url: "updplatformadmin.php",
               type: "POST",
               data: {
                   platformname: $('select[name=platformname'+ $('#selectedsim').val()+']').val(),
                   platformadmin:$('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').val(),
                   platformid:$('#selectedsim').val()
               },
               success: 
                   function(result){

                       if(result === "success"){
                          $('#statuslabel').show();
                          $('#statuslabel').text("Platform admin modified.");
                          $('#statuslabel').fadeOut(4000);
                          $('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').val($('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').val());
                          $('#spanadmin'+($('#selectedsim').val())).text($('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').val());
                          $('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').hide();
                          $('#spanadmin'+$('#selectedsim').val()).show();
                          
                          $('select[name=platformname'+ $('#selectedsim').val()+']').val($('select[name=platformname'+ $('#selectedsim').val()+']').val());
                          $('#spanplatformname'+($('#selectedsim').val())).text($('select[name=platformname'+ $('#selectedsim').val()+'] option:selected').text());
                          $('select[name=platformname'+ $('#selectedsim').val()+']').hide();
                          $('#spanplatformname'+$('#selectedsim').val()).show();
                          
                       }
                       else if(result=== "exists"){
                            $('#statuslabel').show();
                            $('#statuslabel').text("Platform admin already exists.");
                            $('#statuslabel').fadeOut(4000);
                            $('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').val($('#spanadmin'+($('#selectedsim').val())).text());
                            $('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').hide();
                            $('#spanadmin'+$('#selectedsim').val()).show();
                            
                            $('select[name=platformname'+ $('#selectedsim').val()+'] option:contains('+ $('#spanplatformname'+$('#selectedsim').val()).text() +')').attr('selected',true);
                            $('select[name=platformname'+ $('#selectedsim').val()+']').hide();
                            $('#spanplatformname'+$('#selectedsim').val()).show();
                            
                       }
                       else
                       {
                           $('#statuslabel').show();
                         $('#statuslabel').text("Error updating platform admin.");
                          $('#statuslabel').fadeOut(4000);
                           $('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').val($('#spanadmin'+($('#selectedsim').val())).text());
                            $('input[type=text][name=platformadmin'+ $('#selectedsim').val()+']').hide();
                            $('#spanadmin'+$('#selectedsim').val()).show();
                            
                            $('select[name=platformname'+ $('#selectedsim').val()+'] option:contains('+ $('#spanplatformname'+$('#selectedsim').val()).text() +')').attr('selected',true);
                            $('select[name=platformname'+ $('#selectedsim').val()+']').hide();
                            $('#spanplatformname'+$('#selectedsim').val()).show();
                       }
                       $('input[type=radio][name=platformadminid]').removeAttr("checked");
                        $('#selectedsim').val("-1");
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
                        <h2 class="icon icon-world">Platform Admin</h2>
                        <ul>
                            <li class="">
                                <a class="icon icon-display" href="searchplatformadmin.php">Search</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="">
                                <a class="icon icon-display" href="addplatformadmin.php">Create</a>
                            </li>
                        </ul>
                         <ul>
                            <li class="" style="background-color:aqua">
                                <a class="icon icon-display" href="editplatformadmin.php">Edit</a>
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
                                     <p><label id="notelabel" style='color:red;font-weight: bold;'></label></p>
                                    <div class="tablelayout">
                                        <div class="tableheading">
                                            <div class="tablecell"><p></p></div>
                                            <div class="tablecell"><p>Administrator</p></div>
                                            <div class="tablecell"><p>Platform</p></div>
                                            
                                        </div>
                                        
                                        <?php
                                            $sql1= $conn->prepare('SELECT platformid,platformname FROM serviceplatform');
                                            $sql1->execute();
                                            $sql1->bind_result($serviceplatformid,$serviceplatformname);
                                            
                                            while($sql1->fetch())
                                            {
                                                $arrserviceplatform[$serviceplatformid]=$serviceplatformname;
                                            }
                                            $sql= $conn->prepare('SELECT platformadmin.platformadminid,platformadmin.platformadmin,serviceplatform.platformname,serviceplatform.platformid FROM platformadmin INNER JOIN serviceplatform ON serviceplatform.platformid=platformadmin.serviceplatform');
                                            $sql->execute();
                                            $sql->bind_result($platformadminid,$platformadmin,$platformname,$platformid);
                                            while($sql->fetch())
                                            {?>
                                        <div class="tablerow">
                                             <div class="tablecell">
                                                <p><input type="radio" id="platformadminid" name="platformadminid" value="<?php echo $platformadminid; ?>" onclick="editsim(this.value)"/></p>
                                             </div>
                                             <div class="tablecell">
                                                <p>
                                                    <span id="spanadmin<?php echo $platformadminid; ?>"><?php echo $platformadmin ?></span>
                                                    <input type="text" name="platformadmin<?php echo $platformadminid; ?>" value="<?php echo $platformadmin; ?>" style="display:none;"/>
                                                </p>
                                             </div>   
                                            <div class="tablecell">
                                                <p>
                                                    <span id="spanplatformname<?php echo $platformadminid; ?>"><?php echo $platformname; ?></span>

                                                    <select name="platformname<?php echo $platformadminid; ?>" style="display:none;">
                                                        <?php
                                                            $i=0;
                                                            reset($arrserviceplatform);
                                                             while($i < count($arrserviceplatform))
                                                             {?>

                                                                <option value="<?php echo key($arrserviceplatform); ?>"<?php if(key($arrserviceplatform)===$platformid){?> selected="selected" <?php } ?>> <?php echo $arrserviceplatform[key($arrserviceplatform)];?></option>
                                                            <?php
                                                                $i++;
                                                                next($arrserviceplatform);
                                                             }
                                                        ?>
                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                        
                                           <?php

                                            }
                                            mysqli_close($conn);
                                            ?>
                                        
                                    </div>
                                    
                                         
                                </div>
                        <div class="block block-30">
                            
                                   
                                      <p><input type="button" value="Save" id="updatevalue" onclick="updateplatformadmin()" class="btnedit"></input></p>     
                                      <p><input type="button" value="Cancel" id="cancelbutton" onclick="cancelsim()" disabled="disabled" class="btncancel"></input></p>
                                    <p><input type="button" value="Exit" onclick="location.href='../sysmenu.php';" class="btnback"></input></p>
                            <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                        </div>
                </div>
                 
            </div><!-- /scroller -->
        </div>
        <input type="hidden" id="selectedsim" value="0"/>
    </div>	
     <script type="text/javascript" src="../js/classie.js"></script>
    <script type="text/javascript" src="../js/mlpushmenu.js"></script>
    <script type="text/javascript">
            // new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
              mainMenu = new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {type : 'overlap'});
              mainMenu._openMenu();
    </script>
</body>
</html>
