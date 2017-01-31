<!--
This module is for searching sim card types.
-->


<?php include "../dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Search SIM type - SIM CARD Management System</title>
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
             resource:'Sim Card',
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
        function editsim(simid){
                
              $('input[type=text][name=txtsimtype'+simid+']').show();
              $('#spansimtype'+simid).hide();
              $('input[type=text][name=txtsimprovider'+simid+']').show();
              $('#spansimprovider'+simid).hide();
              $('input[type=text][name=txtsimrate'+simid+']').show();
              $('#spansimrate'+simid).hide();
              $('input[type=text][name=txtsimcurrency'+simid+']').show();
              $('#spansimcurrency'+simid).hide();
              $('input[type=text][name=txtsimbilling'+simid+']').show();
              $('#spansimbilling'+simid).hide();
              $('input[type=text][name=txtsimplan'+simid+']').show();
              $('#spansimplan'+simid).hide();
              $('input[type=text][name=txtsimnoteplan'+simid+']').show();
              $('#spansimnoteplan'+simid).hide();
              $('select[name=txtsimsize'+simid+']').show();
              $('#spansimsize'+simid).hide();
              $('select[name=txtsimonline'+simid+']').show();
              $('#spansimonline'+simid).hide();
              
              if($('#selectedsim').val()>0){
                  $('input[type=text][name=txtsimtype'+ $('#selectedsim').val()+']').hide();
                  $('#spansimtype'+$('#selectedsim').val()).show();
                  $('input[type=text][name=txtsimprovider'+ $('#selectedsim').val()+']').hide();
                  $('#spansimprovider'+$('#selectedsim').val()).show();
                  $('input[type=text][name=txtsimrate'+ $('#selectedsim').val()+']').hide();
                  $('#spansimrate'+$('#selectedsim').val()).show();
                  $('input[type=text][name=txtsimcurrency'+ $('#selectedsim').val()+']').hide();
                  $('#spansimcurrency'+$('#selectedsim').val()).show();
                  $('input[type=text][name=txtsimbilling'+ $('#selectedsim').val()+']').hide();
                  $('#spansimbilling'+$('#selectedsim').val()).show();
                  $('input[type=text][name=txtsimplan'+ $('#selectedsim').val()+']').hide();
                  $('#spansimplan'+$('#selectedsim').val()).show();
                  $('input[type=text][name=txtsimnoteplan'+ $('#selectedsim').val()+']').hide();
                  $('#spansimnoteplan'+$('#selectedsim').val()).show();
                  $('select[name=txtsimsize'+ $('#selectedsim').val()+']').hide();
                  $('#spansimsize'+$('#selectedsim').val()).show();
                  $('select[name=txtsimonline'+ $('#selectedsim').val()+']').hide();
                  $('#spansimonline'+$('#selectedsim').val()).show();
              }
              $('#selectedsim').val(simid);
            
              $('#updatevalue').removeAttr('disabled');
              $('#cancelbutton').removeAttr('disabled');
              $('#notelabel').text("Note: Updating SIM type will update SIM type details of all records.");
              $('#statuslabel').text("");
         }
        function cancelsim(){
            $('input[type=radio][name=simname]').removeAttr("checked");
            $('#statuslabel').text("");
            $('#notelabel').text("");
            $('input[type=text][name=txtsimtype'+ $('#selectedsim').val()+']').hide();
            $('#spansimtype'+$('#selectedsim').val()).show();
            $('input[type=text][name=txtsimprovider'+ $('#selectedsim').val()+']').hide();
            $('#spansimprovider'+$('#selectedsim').val()).show();
            $('input[type=text][name=txtsimrate'+ $('#selectedsim').val()+']').hide();
            $('#spansimrate'+$('#selectedsim').val()).show();
            $('input[type=text][name=txtsimcurrency'+ $('#selectedsim').val()+']').hide();
            $('#spansimcurrency'+$('#selectedsim').val()).show();
            $('input[type=text][name=txtsimbilling'+ $('#selectedsim').val()+']').hide();
            $('#spansimbilling'+$('#selectedsim').val()).show();
            $('input[type=text][name=txtsimplan'+ $('#selectedsim').val()+']').hide();
            $('#spansimplan'+$('#selectedsim').val()).show();
            $('input[type=text][name=txtsimnoteplan'+ $('#selectedsim').val()+']').hide();
            $('#spansimnoteplan'+$('#selectedsim').val()).show();
            $('select[name=txtsimsize'+ $('#selectedsim').val()+']').hide();
            $('#spansimsize'+$('#selectedsim').val()).show();
            $('select[name=txtsimonline'+ $('#selectedsim').val()+']').hide();
            $('#spansimonline'+$('#selectedsim').val()).show();
            $('#selectedsim').val("-1");
              $('#updatevalue').attr('disabled','disabled');
              $('#cancelbutton').attr('disabled','disabled');
        }
        function updatesim(){
            
            $('#updatevalue').attr('disabled','disabled');
            $('#cancelbutton').attr('disabled','disabled');
            
            $.ajax({
              url: "updsimcardtype.php",
              type: "POST",
              data: {
                  simtype:$('input[type=text][name=txtsimtype'+ $('#selectedsim').val()+']').val(),
                  simprovider:$('input[type=text][name=txtsimprovider'+ $('#selectedsim').val()+']').val(),
                  simrate:$('input[type=text][name=txtsimrate'+ $('#selectedsim').val()+']').val(),
                  simcurrency:$('input[type=text][name=txtsimcurrency'+ $('#selectedsim').val()+']').val(),
                  simbilling:$('input[type=text][name=txtsimbilling'+ $('#selectedsim').val()+']').val(),
                  simplan:$('input[type=text][name=txtsimplan'+ $('#selectedsim').val()+']').val(),
                  simnoteplan:$('input[type=text][name=txtsimnoteplan'+ $('#selectedsim').val()+']').val(),
                  simsize:$('select[name=txtsimsize'+ $('#selectedsim').val()+']').val(),
                  simonline:$('select[name=txtsimonline'+ $('#selectedsim').val()+']').val(),
                  simid:$('#selectedsim').val()
              },
              success: 
                  function(result){

                      if(result === "success"){
                           $('#statuslabel').show();
                          $('#statuslabel').text("Sim card type updated");
                          $('input[type=text][name=txtsimtype'+ $('#selectedsim').val()+']').val($('input[type=text][name=txtsimtype'+ $('#selectedsim').val()+']').val());
                          $('#spansimtype'+($('#selectedsim').val())).text($('input[type=text][name=txtsimtype'+ $('#selectedsim').val()+']').val());
                          $('input[type=text][name=txtsimtype'+ $('#selectedsim').val()+']').hide();
                          $('#spansimtype'+$('#selectedsim').val()).show();
                          
                          $('input[type=text][name=txtsimprovider'+ $('#selectedsim').val()+']').val($('input[type=text][name=txtsimprovider'+ $('#selectedsim').val()+']').val());
                          $('#spansimprovider'+($('#selectedsim').val())).text($('input[type=text][name=txtsimprovider'+ $('#selectedsim').val()+']').val());
                          $('input[type=text][name=txtsimprovider'+ $('#selectedsim').val()+']').hide();
                          $('#spansimprovider'+$('#selectedsim').val()).show();
                          
                          $('input[type=text][name=txtsimrate'+ $('#selectedsim').val()+']').val($('input[type=text][name=txtsimrate'+ $('#selectedsim').val()+']').val());
                          $('#spansimrate'+($('#selectedsim').val())).text($('input[type=text][name=txtsimrate'+ $('#selectedsim').val()+']').val());
                          $('input[type=text][name=txtsimrate'+ $('#selectedsim').val()+']').hide();
                          $('#spansimrate'+$('#selectedsim').val()).show();
                          
                          $('input[type=text][name=txtsimcurrency'+ $('#selectedsim').val()+']').val($('input[type=text][name=txtsimcurrency'+ $('#selectedsim').val()+']').val());
                          $('#spansimcurrency'+($('#selectedsim').val())).text($('input[type=text][name=txtsimcurrency'+ $('#selectedsim').val()+']').val());
                          $('input[type=text][name=txtsimcurrency'+ $('#selectedsim').val()+']').hide();
                          $('#spansimcurrency'+$('#selectedsim').val()).show(); 
                          
                          $('input[type=text][name=txtsimbilling'+ $('#selectedsim').val()+']').val($('input[type=text][name=txtsimbilling'+ $('#selectedsim').val()+']').val());
                          $('#spansimbilling'+($('#selectedsim').val())).text($('input[type=text][name=txtsimbilling'+ $('#selectedsim').val()+']').val());
                          $('input[type=text][name=txtsimbilling'+ $('#selectedsim').val()+']').hide();
                          $('#spansimbilling'+$('#selectedsim').val()).show();
                          
                          $('input[type=text][name=txtsimplan'+ $('#selectedsim').val()+']').val($('input[type=text][name=txtsimplan'+ $('#selectedsim').val()+']').val());
                          $('#spansimplan'+($('#selectedsim').val())).text($('input[type=text][name=txtsimplan'+ $('#selectedsim').val()+']').val());
                          $('input[type=text][name=txtsimplan'+ $('#selectedsim').val()+']').hide();
                          $('#spansimplan'+$('#selectedsim').val()).show();
                          
                          $('input[type=text][name=txtsimnoteplan'+ $('#selectedsim').val()+']').val($('input[type=text][name=txtsimnoteplan'+ $('#selectedsim').val()+']').val());
                          $('#spansimnoteplan'+($('#selectedsim').val())).text($('input[type=text][name=txtsimnoteplan'+ $('#selectedsim').val()+']').val());
                          $('input[type=text][name=txtsimnoteplan'+ $('#selectedsim').val()+']').hide();
                          $('#spansimnoteplan'+$('#selectedsim').val()).show();
                          
                          $('select[name=txtsimsize'+ $('#selectedsim').val()+']').val($('select[name=txtsimsize'+ $('#selectedsim').val()+']').val());
                          $('#spansimsize'+($('#selectedsim').val())).text($('select[name=txtsimsize'+ $('#selectedsim').val()+']').val());
                          $('select[name=txtsimsize'+ $('#selectedsim').val()+']').hide();
                          $('#spansimsize'+$('#selectedsim').val()).show();
                          
                          $('select[name=txtsimonline'+ $('#selectedsim').val()+']').val($('select[name=txtsimonline'+ $('#selectedsim').val()+']').val());
                          $('#spansimonline'+($('#selectedsim').val())).text($('select[name=txtsimonline'+ $('#selectedsim').val()+']').val());
                          $('select[name=txtsimonline'+ $('#selectedsim').val()+']').hide();
                          $('#spansimonline'+$('#selectedsim').val()).show();
                          $('#statuslabel').fadeOut(4000);
                          
                      }
                      else if(result === "exists"){
                        $('#statuslabel').show();
                        $('#statuslabel').text("SIM card type exists");
                        $('#statuslabel').fadeOut(4000);
                      }
                      else
                      {
                          $('#statuslabel').text("Error updating SIM card type.");
                      }
                       $('#notelabel').text("");
                       $('input[type=radio][name=simname]').removeAttr("checked");
                       $('#selectedsim').val("-1");
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
           if(($('#spansimtype'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           else if(($('#spansimprovider'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           else if(($('#spansimrate'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           else if(($('#spansimcurrency'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           else if(($('#spansimbilling'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           /*
           else if(($('#spansimplan'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }*/
           else if(($('#spansimnoteplan'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           else if(($('#spansimsize'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           else if(($('#spansimonline'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
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
                        <h2 class="icon icon-world">SIM Card Type</h2>
                        <ul>
                            <li class="" style="background-color:aqua;">
                                <a class="icon icon-display" href="searchsimcardtype.php">Search</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="">
                                <a class="icon icon-display" href="addsimcardtype.php">Create</a>
                            </li>
                        </ul>
                         <ul>
                            <li class="" >
                                <a class="icon icon-display" href="editsimcardtype.php">Edit</a>
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
                                   <p> <label for="searchstring">Search:<input type="text" name="searchstring" id="searchstring" value="" /></label></p>
                                    <p><input type="button" value="Search" onclick="searchvalue();" class="btnsearch"></input></p>
                                    <div class="tablelayout" style="font-size:50%;">
                                        <div class="tableheading">
                                            <div class="tablecell"><p>Type</p></div>
                                            <div class="tablecell"><p>Provider</p></div>
                                            <div class="tablecell"><p>Rate</p></div>
                                            <div class="tablecell"><p>Currency</p></div>
                                            <div class="tablecell"><p>Min. months</p></div>
                                           
                                            <div class="tablecell"><p>Plan Note</p></div>
                                            <div class="tablecell"><p>Size</p></div>
                                            <div class="tablecell"><p>On-line</p></div>
                                        </div>
                                            <?php
                                            $sql= $conn->prepare('SELECT simcardmaster.simid,simcardmaster.simtype,simcardmaster.simprovider,simcardmaster.simrate,simcardmaster.simcurrency,simcardmaster.simbilling,serviceplan.plantype,simcardmaster.simnoteplan,simcardmaster.simsize,simonline FROM simcardmaster INNER JOIN serviceplan ON simcardmaster.simplan=serviceplan.planid');
                                            $sql->execute();
                                            $sql->bind_result($simid,$simtype,$simprovider,$simrate,$simcurrency,$simbilling,$simplan,$simnoteplan,$simsize,$simonline);
                                            $i=1;
                                            while($sql->fetch())
                                            {?>
                                              <div class="tablerow" id="tablerow<?php echo $i; ?>">
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spansimtype<?php echo $i; ?>"><?php echo $simtype; ?></span>
                                                      </p>
                                                  </div>
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spansimprovider<?php echo $i; ?>"><?php echo $simprovider; ?></span>
                                                      </p>
                                                  </div>
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spansimrate<?php echo $i; ?>"><?php echo $simrate; ?></span>
                                                      </p>
                                                  </div>
                                                   <div class="tablecell">
                                                      <p>
                                                          <span id="spansimcurrency<?php echo $i; ?>"><?php echo $simcurrency; ?></span>
                                                      </p>
                                                  </div>
                                                   <div class="tablecell">
                                                      <p>
                                                          <span id="spansimbilling<?php echo $i; ?>"><?php echo $simbilling; ?></span>
                                                      </p>
                                                  </div>
                                                  
                                                   <div class="tablecell">
                                                      <p>
                                                          <span id="spansimnoteplan<?php echo $i; ?>"><?php echo $simnoteplan; ?></span>
                                                      </p>
                                                  </div>
                                                   <div class="tablecell">
                                                      <p>
                                                          <span id="spansimsize<?php echo $i; ?>"><?php echo $simsize; ?></span>
                                                      </p>
                                                  </div>
                                                   <div class="tablecell">
                                                      <p>
                                                          <span id="spansimonline<?php echo $i; ?>"><?php echo $simonline; ?></span>
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
                                   <p><input type="button" value="Exit" onclick="location.href='../sysmenu.php';" class="btnback"></input></p>
                                </div>
                            
                    </div><!-- /scroller-inner -->
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
