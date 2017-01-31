<?php include "../dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Search Service Plan - SIM CARD Management System</title>
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

        function editserviceplan(planid){
                
              $('input[type=text][name=txtplantype'+planid+']').show();
              $('#spanplantype'+planid).hide();
              $('input[type=text][name=txtplanrate'+planid+']').show();
              $('#spanplanrate'+planid).hide();
              $('input[type=text][name=txtplancurrency'+planid+']').show();
              $('#spanplancurrency'+planid).hide();
              $('select[name=txtproductmodel'+planid+']').show();
              $('#spanproductmodel'+planid).hide();
              $('select[name=txtsimcardtype'+planid+']').show();
              $('#spansimcardtype'+planid).hide();
              
              if($('#selectedplan').val()>0){
                  $('input[type=text][name=txtplantype'+ $('#selectedplan').val()+']').hide();
                  $('#spanplantype'+$('#selectedplan').val()).show();
                  $('input[type=text][name=txtplanrate'+ $('#selectedplan').val()+']').hide();
                  $('#spanplanrate'+$('#selectedplan').val()).show();
                  $('input[type=text][name=txtplancurrency'+ $('#selectedplan').val()+']').hide();
                  $('#spanplancurrency'+$('#selectedplan').val()).show();
                  $('select[name=txtproductmodel'+ $('#selectedplan').val()+']').hide();
                  $('#spanproductmodel'+$('#selectedplan').val()).show();
                  $('select[name=txtsimcardtype'+ $('#selectedplan').val()+']').hide();
                  $('#spansimcardtype'+$('#selectedplan').val()).show();
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
            $('select[name=txtproductmodel'+ $('#selectedplan').val()+']').hide();
            $('#spanproductmodel'+$('#selectedplan').val()).show();
            $('select[name=txtsimcardtype'+ $('#selectedplan').val()+']').hide();
            $('#spansimcardtype'+$('#selectedplan').val()).show();
           
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
                  productmodel:$('select[name=txtproductmodel'+ $('#selectedplan').val()+']').val(),
                  simcardtype:$('select[name=txtsimcardtype'+ $('#selectedplan').val()+']').val(),
                  
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
                                                    
                          $('select[name=txtproductmodel'+ $('#selectedplan').val()+']').val($('select[name=txtproductmodel'+ $('#selectedplan').val()+']').val());
                          $('#spanproductmodel'+($('#selectedplan').val())).text($('select[name=txtproductmodel'+ $('#selectedplan').val()+'] option:selected').text());
                          $('select[name=txtproductmodel'+ $('#selectedplan').val()+']').hide();
                          $('#spanproductmodel'+$('#selectedplan').val()).show();
                          
                          $('select[name=txtsimcardtype'+ $('#selectedplan').val()+']').val($('select[name=txtsimcardtype'+ $('#selectedplan').val()+']').val());
                          $('#spansimcardtype'+($('#selectedplan').val())).text($('select[name=txtsimcardtype'+ $('#selectedplan').val()+'] option:selected').text());
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
function searchvalue(){
    
    var i = 0;
    if($('#searchstring').val()===""){
        alert("Search string is empty.");
    }
    else{
        while(i < $('#searchcount').val()){
            $('#tablerow'+(i+1)).css('background-color',"");
           if(($('#spanplantype'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           /*
           else if(($('#spanplanrate'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           else if(($('#spanplancurrency'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           else if(($('#spanproductmodel'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }
           else if(($('#spansimcardtype'+(i+1)).text().toUpperCase()).indexOf($('#searchstring').val().toUpperCase()) > -1 ){
              $('#tablerow'+(i+1)).css('background-color',"#6699FF");
           }*/
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
                        <h2 class="icon icon-world">Service plan</h2>
                        <ul>
                            <li class="" style="background-color:aqua;">
                                <a class="icon icon-display" href="searchserviceplan.php">Search</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="" >
                                <a class="icon icon-display" href="addserviceplan.php">Create</a>
                            </li>
                        </ul>
                         <ul>
                            <li class="" >
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
                                     <p> <label for="searchstring">Search:<input type="text" name="searchstring" id="searchstring" value="" /></label></p>
                                    <p><input type="button" value="Search" onclick="searchvalue();" class="btnsearch"></input></p>
                                    <div class="tablelayout" style="font-size:50%;">
                                        <div class="tableheading">
                                         
                                            <div class="tablecell"><p>Type</p></div>
                                            <div class="tablecell"><p>Rate/month</p></div>
                                            <div class="tablecell"><p>Currency</p></div>
                                            <div class="tablecell"><p>Product Model</p></div>
                                            <div class="tablecell"><p>Sim Type</p></div>
                                           
                                        </div>
                                            <?php
                                             $stmt= $conn->prepare('SELECT productmodelid,productmodelname FROM productmodelmaster');
                                             $stmt->execute();
                                             $stmt->bind_result($productid,$productname);
                                             while($stmt->fetch())
                                             {
                                                $productarray[$productid]=$productname;
                                             }
                                           
                                              $stmt1= $conn->prepare('SELECT simid,simtype FROM simcardmaster');
                                                $stmt1->execute();
                                                $stmt1->bind_result($simcardid,$simcardtype);
                                            while($stmt1->fetch())
                                            {
                                               $simarray[$simcardid]=$simcardtype;
                                            }
                                            
                                            $sql= $conn->prepare('SELECT serviceplan.planid,serviceplan.plantype,serviceplan.planrate,serviceplan.plancurrency,productmodelmaster.productmodelname,simcardmaster.simtype,serviceplan.productmodel,serviceplan.simcardtype FROM serviceplan INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=serviceplan.productmodel INNER JOIN simcardmaster ON simcardmaster.simid=serviceplan.simcardtype');
                                            $sql->execute();
                                            $sql->bind_result($planid,$plantype,$planrate,$plancurrency,$productmodel,$simcardtype,$productmodelid,$simid);
                                            $i=1;
                                            while($sql->fetch())
                                            {?>
                                              <div class="tablerow" id="tablerow<?php echo $i; ?>">
                                                
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spanplantype<?php echo $i; ?>"><?php echo $plantype; ?></span>
                                                       </p>
                                                  </div>
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spanplanrate<?php echo $i; ?>"><?php echo $planrate; ?></span>
                                                          
                                                      </p>
                                                  </div>
                                                  <div class="tablecell">
                                                      <p>
                                                          <span id="spanplancurrency<?php echo $i; ?>"><?php echo $plancurrency; ?></span>
                                                       </p>
                                                  </div>
                                                   <div class="tablecell">
                                                      <p>
                                                          <span id="spanproductmodel<?php echo $i; ?>"><?php echo $productmodel; ?></span>
                                                         
                                                      </p>
                                                  </div>
                                                   <div class="tablecell">
                                                      <p>
                                                          <span id="spansimcardtype<?php echo $i; ?>"><?php echo $simcardtype; ?></span>
                                                         
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
