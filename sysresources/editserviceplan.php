<!--
This module is for modifying service plans
-->

<?php include "../dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Edit Service Plan - SIM CARD Management System</title>
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
             resource:'Service Plan',
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
        function editserviceplan(planid){
                
              $('input[type=text][name=txtplantype'+planid+']').show();
              $('#spanplantype'+planid).hide();
              $('input[type=text][name=txtplanrate'+planid+']').show();
              $('#spanplanrate'+planid).hide();
              $('input[type=text][name=txtplancurrency'+planid+']').show();
              $('#spanplancurrency'+planid).hide();
              
              $('#spansimcardtype'+planid).hide();
              $('select[name=txtsimcardtype'+planid+']').show();
              
              if($('#selectedplan').val()>0){
                  $('input[type=text][name=txtplantype'+ $('#selectedplan').val()+']').hide();
                  $('#spanplantype'+$('#selectedplan').val()).show();
                  $('input[type=text][name=txtplanrate'+ $('#selectedplan').val()+']').hide();
                  $('#spanplanrate'+$('#selectedplan').val()).show();
                  $('input[type=text][name=txtplancurrency'+ $('#selectedplan').val()+']').hide();
                  $('#spanplancurrency'+$('#selectedplan').val()).show();
                  
                  $('#spansimcardtype'+$('#selectedplan').val()).hide();
                  $('select[name=txtsimcardtype'+$('#selectedplan').val()+']').show();
               
                  
              }
              $('#selectedplan').val(planid);
            
              $('#updatevalue').removeAttr('disabled');
              $('#cancelbutton').removeAttr('disabled');
              $('#notelabel').text("Note: Updating service plan will update service plan of all records.");
              $('#statuslabel').text("");
         }
        function cancelserviceplan(){
            $('input[type=radio][name=planname]').removeAttr("checked");
            $('#statuslabel').text("");
            $('#notelabel').text("");
            $('input[type=text][name=txtplantype'+ $('#selectedplan').val()+']').hide();
            $('#spanplantype'+$('#selectedplan').val()).show();
            $('input[type=text][name=txtplanrate'+ $('#selectedplan').val()+']').hide();
            $('#spanplanrate'+$('#selectedplan').val()).show();
            $('input[type=text][name=txtplancurrency'+ $('#selectedplan').val()+']').hide();
            $('#spanplancurrency'+$('#selectedplan').val()).show();
          
            $('#spansimcardtype'+$('#selectedplan').val()).show();
             $('select[name=txtsimcardtype'+$('#selectedplan').val()+']').hide();
           
            $('#selectedplan').val("-1");
            $('#updatevalue').attr('disabled','disabled');
            $('#cancelbutton').attr('disabled','disabled');
        }
        function updateserviceplan(){
            
            $('#updatevalue').attr('disabled','disabled');
            $('#cancelbutton').attr('disabled','disabled');
           
            $.ajax({
              url: "updserviceplan.php",
              type: "POST",
              data: {
                  plantype:$('input[type=text][name=txtplantype'+ $('#selectedplan').val()+']').val(),
                  planrate:$('input[type=text][name=txtplanrate'+ $('#selectedplan').val()+']').val(),
                  plancurrency:$('input[type=text][name=txtplancurrency'+ $('#selectedplan').val()+']').val(),
                  simcardtype:$('select[name=txtsimcardtype'+$('#selectedplan').val()+']').val(),
           
                 
                  
                  planid:$('#selectedplan').val()
                  
              },
              success: 
                  function(result){

                      if(result === "success"){
                          $('#statuslabel').show();
                          $('#statuslabel').text("Service plan updated");
                         
                          $('input[type=text][name=txtplantype'+ $('#selectedplan').val()+']').val($('input[type=text][name=txtplantype'+ $('#selectedplan').val()+']').val());
                          $('#spanplantype'+($('#selectedplan').val())).text($('input[type=text][name=txtplantype'+ $('#selectedplan').val()+']').val());
                          $('input[type=text][name=txtplantype'+ $('#selectedplan').val()+']').hide();
                          $('#spanplantype'+$('#selectedplan').val()).show();
                          
                          $('input[type=text][name=txtplanrate'+ $('#selectedplan').val()+']').val($('input[type=text][name=txtplanrate'+ $('#selectedplan').val()+']').val());
                          $('#spanplanrate'+($('#selectedplan').val())).text($('input[type=text][name=txtplanrate'+ $('#selectedplan').val()+']').val());
                          $('input[type=text][name=txtplanrate'+ $('#selectedplan').val()+']').hide();
                          $('#spanplanrate'+$('#selectedplan').val()).show();
                          
                          $('input[type=text][name=txtplancurrency'+ $('#selectedplan').val()+']').val($('input[type=text][name=txtplancurrency'+ $('#selectedplan').val()+']').val());
                          $('#spanplancurrency'+($('#selectedplan').val())).text($('input[type=text][name=txtplancurrency'+ $('#selectedplan').val()+']').val());
                          $('input[type=text][name=txtplancurrency'+ $('#selectedplan').val()+']').hide();
                          $('#spanplancurrency'+$('#selectedplan').val()).show();
                                                    
                          $('select[name=txtsimcardtype'+ $('#selectedplan').val()+']').val($('select[name=txtsimcardtype'+ $('#selectedplan').val()+']').val());
                          $('#spansimcardtype'+($('#selectedplan').val())).text($('select[name=txtsimcardtype'+ $('#selectedplan').val()+'] :selected').text());
                          $('select[name=txtsimcardtype'+ $('#selectedplan').val()+']').hide();
                          $('#spansimcardtype'+$('#selectedplan').val()).show();                         
                          
                      
                          $('#statuslabel').fadeOut(4000);
                          
                      }
                      else if(result==="exists"){
                        $('#statuslabel').show();
                        $('#statuslabel').text("Service plan exists.");
                        $('#statuslabel').fadeOut(4000);
                      }
                      else
                      {
                          $('#statuslabel').show();
                          $('#statuslabel').text("Error updating SIM card type.");
                          $('#statuslabel').fadeOut(4000);
                      }
                       $('#notelabel').text("");
                       $('input[type=radio][name=planname]').removeAttr("checked");
                       $('#selectedplan').val("-1");
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
                        <h2 class="icon icon-world">Service plan</h2>
                        <ul>
                            <li class="">
                                <a class="icon icon-display" href="searchserviceplan.php">Search</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="">
                                <a class="icon icon-display" href="addserviceplan.php">Create</a>
                            </li>
                        </ul>
                         <ul>
                            <li class="" style="background-color:aqua;">
                                <a class="icon icon-display" href="editserviceplan.php">Edit</a>
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
                          
                                <div class="block block-80 clearfix">
                                    <p><a href="#" id="trigger" class="menu-trigger" style="display:none;">Menu</a></p>
                                     <p><label id="notelabel" style='color:red;font-weight: bold;'></label></p>
                                    <div class="tablelayout" style="font-size:50%;">
                                        <div class="tableheading">
                                            <div class="tablecell"><p></p></div>
                                            <div class="tablecell"><p>Type</p></div>
                                            <div class="tablecell"><p>Rate/month</p></div>
                                            <div class="tablecell"><p>Currency</p></div>
                                            <div class="tablecell"><p>Sim Card Type</p></div>
                                            
                                           
                                        </div>
                                            <?php
                                             $simcardtypes=array();
                                            $sql60= $conn->prepare('SELECT simid,simtype FROM simcardmaster');
                                            $sql60->execute();
                                            $sql60->bind_result($simid,$simtype);
                                            $x=0;
                                            while($sql60->fetch()){
                                              $simcardtypes[$x][0]=$simid;
                                              $simcardtypes[$x][1]=$simtype;
                                              $x++;
                                                }
                                           
                                           
                                            
                                            $sql= $conn->prepare('SELECT serviceplan.planid,serviceplan.plantype,serviceplan.planrate,serviceplan.plancurrency,simcardmaster.simtype,simcardmaster.simid FROM serviceplan INNER JOIN simcardmaster ON simcardmaster.simid=serviceplan.simcardtype');
                                            $sql->execute();
                                            $sql->bind_result($planid,$plantype,$planrate,$plancurrency,$simcardtype,$simid);
                                            while($sql->fetch())
                                            {?>
                                              <div class="tablerow">
                                                  <div class="tablecell">
                                                      <p><input type="radio" id="planname" name="planname" value="<?php echo $planid; ?>" onclick="editserviceplan(this.value)"/></p>
                                                  </div>
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spanplantype<?php echo $planid; ?>"><?php echo $plantype; ?></span>
                                                          <input type="text" name="txtplantype<?php echo $planid; ?>" value="<?php echo $plantype; ?>" style="display:none;"/>
                                                      </p>
                                                  </div>
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spanplanrate<?php echo $planid; ?>"><?php echo $planrate; ?></span>
                                                          <input type="text" name="txtplanrate<?php echo $planid; ?>" value="<?php echo $planrate; ?>" style="display:none;"/>
                                                      </p>
                                                  </div>
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spanplancurrency<?php echo $planid; ?>"><?php echo $plancurrency; ?></span>
                                                          <input type="text" name="txtplancurrency<?php echo $planid; ?>" value="<?php echo $plancurrency; ?>" style="display:none;"/>
                                                      </p>
                                                  </div>
                                                   <div class="tablecell">
                                                      <p>
                                                          <span id="spansimcardtype<?php echo $planid; ?>"><?php echo $simcardtype; ?></span>
                                                          
                                                          <select name="txtsimcardtype<?php echo $planid; ?>" style="display:none;">
                                                               <?php 
                                                                  $y=0;
                                                                  $bFlag=1;
                                                                    while($y<count($simcardtypes)){
                                                                         if($simcardtypes[$y][0]===$simid){ ?>
                                                                              <option value="<?php echo $simcardtypes[$y][0]; ?>"  selected="selected"><?php echo $simcardtypes[$y][1]; ?></option>
                                                                 <?php        
                                                                            $bFlag=0;
                                                                         }
                                                                         else{ ?>
                                                                             <option value="<?php echo $simcardtypes[$y][0]; ?>"><?php echo $simcardtypes[$y][1]; ?></option>  
                                                                  <?php  }
                                                                   
                                                             
                                                                         
                                                                  
                                                                        $y++;
                                                                    }
                                                                   
                                                                ?>
                                                          </select>
                                                      </p>
                                                  </div>
                                                 
                                                
                                              </div>
                                            <?php

                                            }
                                            //mysqli_close($conn);
                                            ?>
                                        
                                    </div>
                                     
                                     
                                </div>
                                <div class="block block-80 clearfix">
                                         <p><input type="button" value="Exit" onclick="location.href='../sysmenu.php';" class="btnback"></input></p>
                                         
                                    <p><input type="button" value="Save" id="updatevalue" onclick="updateserviceplan()" disabled="disabled" class="btnedit"></input></p>
                                    <p><input type="button" value="Cancel" id="cancelbutton" onclick="cancelserviceplan()" disabled="disabled" class="btncancel"></input></p>
                                    <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                </div>
                           
                    </div><!-- /scroller-inner -->
            </div><!-- /scroller -->
        </div>
          <input type="hidden" id="selectedplan" value="0"/>
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
