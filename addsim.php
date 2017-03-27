<!--
This module is for adding sim to inventory.
-->
<?php include "dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>SIM Inventory - SIM CARD Management System</title>
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
         url: "checkfuncauth.php",
         type: "POST",
         data: {
             
             activity:'simfull'
         },
         success: 
            function(result){
             
                 if(result==='1'){
                    
                 }
                 else
                 {      
                  
                   $.ajax({
                        url: "checkfuncauth.php",
                        type: "POST",
                        data: {

                            activity:'siminventory'
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
                   
                   
                 }

            }
    });
 
 
                
                var queryString = window.location.search.substring(1);
                
                if(queryString===''){
                    $(function() {
                        $("#beforedate1").datepicker();
                    });
                     $(function() {
                        $("#activationdate1").datepicker();
                    });
                }
                else{
                    var varArray = queryString.split("="); //eg. index.html?msg=1

                    var param1 = varArray[0];
                    var param2 = varArray[1];

                    var strfiletype=param2.substr(param2.length-2,1);
                    var strexceltype=param2.substr(param2.length-1,1);


                    param2=param2.substr(0,param2.length-2);

                    if(strfiletype==='1'){
                        $('#uploadtype').val('IMEI');
                    }
                    else
                    {
                        $('#uploadtype').val('SIM');
                    }

                    if(strexceltype==='1'){
                       $('#exceltype').val('xlsx'); 
                    }
                    else{
                        $('#exceltype').val('xls');
                    }

                    if(param1==='upload'){
                        jQuery('.tabs #tab3').show().siblings().hide();
                        $('a[href$="#tab3"]').parent('li').addClass('active').siblings().removeClass('active');
                        $('#statuslabel1').text("File uploaded.");
                        $('#fname').val(param2);

                        $.ajax({
                         url: "readexcel.php",
                         type: "POST",
                         data: {

                             filename:param2,
                             uploadtype:$('#uploadtype').val(),
                             exceltype:$('#exceltype').val()

                         },
                         success: 
                             function(result){

                                 if(result.indexOf('Error') === "-1"){
                                    $('#statuslabel1').text(result);
                                 }
                                 else
                                 {
                                    if($('#uploadtype').val() === "IMEI"){
                                         $('#statuslabel1').text("SIM Cards and IMEI read.");    
                                    }
                                    else{
                                         $('#statuslabel1').text("SIM Cards read.");

                                    }
                                   $('#simheader').text("Upload Details:");

                                     $('#readexcel').append(result);
                                 }



                                var parabeforedate = document.createElement("P");
                                parabeforedate.setAttribute("id","parasimbeforedate");
                                var lblbeforedate = "<label for=\"simbeforedate\">Activation date before:</label>";
                                var txtbeforedate = "<input type=\"text\" name=\"simbeforedate\" id=\"simbeforedate\" value=\"\" />";
                                $('#tab3').append(parabeforedate);
                                $('#parasimbeforedate').append(lblbeforedate,txtbeforedate);
                                $(function() {
                                    $("#simbeforedate").datepicker();
                                });
    

                                var parasimactivationstatus = document.createElement("P");
                                parasimactivationstatus.setAttribute("id","parasimactivationstatus");
                                var lblactivationstatus = "<label for=\"simactivationstatus\">Activation Status:</label>";
                                var selactivationstatus = "<select name=\"simactivationstatus\" id=\"simactivationstatus\" ><option value=\"Active\">Active</option><option value=\"Inactive\">Inactive</option><option value=\"Suspended\">Suspended</option><option value=\"Terminated\">Terminated</option></select>";
                                $('#tab3').append(parasimactivationstatus);
                                $('#parasimactivationstatus').append(lblactivationstatus,selactivationstatus);

                                var parasimactivationdate = document.createElement("P");
                                parasimactivationdate.setAttribute("id","parasimactivationdate");
                                var lblsimactivationdate = "<label for=\"simactivationdate\">Activation date:</label>";
                                var txtsimactivationdate = "<input type=\"text\" name=\"simactivationdate\" id=\"simactivationdate\" value=\"\" />";
                                $('#tab3').append(parasimactivationdate);
                                $('#parasimactivationdate').append(lblsimactivationdate,txtsimactivationdate);
                                 $(function() {
                                    $("#simactivationdate").datepicker();
                                });
                                
                                
                                var parasiminventorystatus = document.createElement("P");
                                parasiminventorystatus.setAttribute("id","parasiminventorystatus");
                                var lblinventorystatus = "<label for=\"siminventorystatus\">Inventory Status:</label>";
                                var selinventorystatus = "<select name=\"siminventorystatus\" id=\"siminventorystatus\" ><option value=\"In-stock\">In-stock</option><option value=\"Deployed\">Deployed</option></select>";
                                $('#tab3').append(parasiminventorystatus);
                                $('#parasiminventorystatus').append(lblinventorystatus,selinventorystatus);

                                var parasimstorageloc = document.createElement("P");
                                parasimstorageloc.setAttribute("id","parasimstorageloc");
                                var lblsimstorageloc = "<label for=\"simstorageloc\">Storage location:</label>";
                                var txtsimstorageloc = "<input type=\"text\" name=\"simstorageloc\" id=\"simstorageloc\" value=\"\" />";
                                $('#tab3').append(parasimstorageloc);
                                $('#parasimstorageloc').append(lblsimstorageloc,txtsimstorageloc);

                                $('#tab3').append("<input type=\"button\" name=\"btnSubmit\" id=\"btnSubmit\" value=\"Submit\" onclick=\"filesim();\" /><hr></hr>");


                             }
                        });

                    }
                }
                
                 
      
        
               
     });
    function filesim()
    {
        if($('#simfiletype').val()==='Blank'){
            alert('Kindly select the SIM type.');
        }
        else if($('#simcheck').val()==='0'){
            alert('Error importing SIM. Kindly fix import file and resubmit.');
        }
        else{
            var z=0;
            var imei=0;
            addallfilesims();

            function addallfilesims(){

                 if(z < $('#simdatacount').val()){
                    //alert($('#simdata'+(z+2)).text());
                    if($('#uploadtype').val()==='IMEI'){
                       imei = $('#simimei'+(z+2)).text();
                    }
                    else{
                        imei='';
                    }
                    $.ajax({
                     url: "addsimrecord.php",
                     type: "POST",
                     data: {

                         simgroup:$('#simfiletype').val(),
                         simnumber:$('#simdata'+(z+2)).text(),                     
                         beforedate:$('#simbeforedate').val(),
                         telnumber:'',
                         imei:imei,
                         prodmodelid:'',
                         activationstatus:$('#simactivationstatus').val(),
                         activationdate:$('#simactivationdate').val(),
                         inventorystatus:$('#siminventorystatus').val(),
                         storagelocation:$('#simstorageloc').val()
                     },
                     success: 
                         function(result){
                             
                             if(result === "success"){
                                 $('#statuslabel1').text("SIM cards added");
                                 z++;
                                 addallfilesims();
                             }
                             else
                             {
                                 $('#statuslabel1').text("Error adding sim.");
                             }
                         }
                    });
                }
            }
        }
        
        //haksdhkahsdaskjd
        
        
    }
        
     
    function resetsim(){
        $('#simnumber'+parseInt($('#simcount').val())).val("");
        $('#telnumber'+parseInt($('#simcount').val())).val("");
        $('#beforedate'+parseInt($('#simcount').val())).val("");
        $('#activationdate'+parseInt($('#simcount').val())).val("");
        $('#storagelocation'+parseInt($('#simcount').val())).val("");
        $('#imei'+parseInt($('#simcount').val())).val("");
        $('#productmodel'+parseInt($('#simcount').val())).val("Blank"); 
    }
    function addsim(){
        var simcount= parseInt($('#simcount').val());
        var i=0;
        var bTest=0;
        while(i < simcount){
            if ($('#simtype').val()==="Blank"){
                alert("Kindly select SIM type.");
                bTest=1;
                break;
            }
            else if ($('#simnumber'+(i+1)).val()===""){
                alert("Kindly enter SIM number on SIM "+(i+1)+".");
                bTest=1;
                break;
            }
            else if ($('#telnumber'+(i+1)).val()===""){
                alert("Kindly enter MSISN number on SIM "+(i+1)+".");
                bTest=1;
                break;
            }
            else if ($('#storagelocation'+(i+1)).val()===""){
                alert("Kindly enter storage location on SIM "+(i+1)+".");
                bTest=1;
                break;
            }
            i++;
        }
        if(bTest){
            
        }
        else{
            var x=0;
            addallsims();
            
            function addallsims(){
                
                 if(x < $('#simcount').val()){
                    
                    $.ajax({
                     url: "addsimrecord.php",
                     type: "POST",
                     data: {

                         simgroup:$('#simtype').val(),
                         simnumber:$('#simnumber'+(x+1)).val(),
                         telnumber:$('#telnumber'+(x+1)).val(),
                         beforedate:$('#beforedate'+(x+1)).val(),
                         activationstatus:$('#activationstatus'+(x+1)).val(),
                         activationdate:$('#activationdate'+(x+1)).val(),
                         inventorystatus:$('#inventorystatus'+(x+1)).val(),
                         storagelocation:$('#storagelocation'+(x+1)).val(),
                         imei:$('#imei'+(x+1)).val(),
                         prodmodelid:$('#productmodel'+(x+1)).val()

                     },
                     success: 
                         function(result){

                             if(result === "success"){
                                 $('#statuslabel').show();
                                 $('#statuslabel').text("SIM cards added");
                                 $('#statuslabel').fadeOut(5000);
                                 x++;
                                 addallsims();
                             }
                             else if(result === "exists"){
                                  $('#statuslabel').show();
                                 $('#statuslabel').text("SIM card exists");
                                 $('#statuslabel').fadeOut(5000);
                             }
                             else
                             {  $('#statuslabel').show();
                                 $('#statuslabel').text("Error adding sim.");
                                 $('#statuslabel').fadeOut(5000);
                             }
                         }
                    });
                }
            }
            
        }
        
    }
    function getsimgroup(){
        if($('#simtype').val()==="Blank"){
            
        }
        else{
            $.ajax({
                    url: "getsimgroup.php",
                    type: "POST",
                    data: {simtype:$('#simtype').val()   
                    },
                    success: 
                        function(result){

                            if(result==="failed"){
                                $('#statuslabel').text("Error retrieving invoice details.");                                  
                            }
                            else{
                               var arrResult = JSON.parse(result);                               
                                $('#simprovider').val(arrResult['simprovider']);
                                $('#simrate').val(arrResult['simrate']);
                                $('#simcurrency').val(arrResult['simcurrency']);
                                $('#simbilling').val(arrResult['simbilling']);
                                $('#simplan').val(arrResult['simplan']);
                                $('#simsize').val(arrResult['simsize']);
                                $('#simnoteplan').val(arrResult['simnoteplan']);
                                $('#simonline').val(arrResult['simonline']);
                                $('#statuslabel').text("");
                                if(parseInt($('#simcount').val()) > 1){
                                    var i = parseInt($('#simcount').val());
                                    while(i>0){
                                        $('#parasimnumber'+i).remove();

                                        $('#paratelnumber'+i).remove();
                                        $('#parabeforedate'+i).remove();
                                        $('#paraactivationstatus'+i).remove();
                                        $('#paraactivationdate'+i).remove();
                                        $('#parainventorystatus'+i).remove();
                                        $('#parastoragelocation'+i).remove();
                                        $('#paraimei'+i).remove();
                                        $('#paraproductmodel'+i).remove();
                                          i--;
                                    }
                                    $('#simcount').val("0");
                                    $('hr').remove();
                                    addsims();
                                }
                            }
                        }
            });
        }
       
    }
    function addsims(){
        var parasimnumber = document.createElement("P");
        parasimnumber.setAttribute("id","parasimnumber"+(parseInt($('#simcount').val())+1));
        var lblsimnumber = "<label for=\"simnumber" + (parseInt($('#simcount').val())+1) + "\">SIM No.:</label>";
        var txtsimnumber = "<input type=\"text\" name=\"simnumber"+ (parseInt($('#simcount').val())+1) + "\" id=\"simnumber"+(parseInt($('#simcount').val())+1) +"\" value=\"\" />";
        $('#tab2').append(parasimnumber);
        $('#parasimnumber'+(parseInt($('#simcount').val())+1)).append(lblsimnumber,txtsimnumber);

        var paratelnumber = document.createElement("P");
        paratelnumber.setAttribute("id","paratelnumber"+(parseInt($('#simcount').val())+1));
        var lbltelnumber = "<label for=\"telnumber"+(parseInt($('#simcount').val())+1)+"\">MSISDN (Tel No.):</label>";
        var txttelnumber = "<input type=\"text\" name=\"telnumber"+ (parseInt($('#simcount').val())+1) + "\" id=\"telnumber"+(parseInt($('#simcount').val())+1) +"\" value=\"\" />";
        $('#tab2').append(paratelnumber);
        $('#paratelnumber'+(parseInt($('#simcount').val())+1)).append(lbltelnumber,txttelnumber);

        var parabeforedate = document.createElement("P");
        parabeforedate.setAttribute("id","parabeforedate"+(parseInt($('#simcount').val())+1));
        var lblbeforedate = "<label for=\"beforedate"+(parseInt($('#simcount').val())+1)+"\">Activation date before:</label>";
        var txtbeforedate = "<input type=\"text\" name=\"beforedate"+ (parseInt($('#simcount').val())+1) + "\" id=\"beforedate"+(parseInt($('#simcount').val())+1) +"\" value=\"\" />";
        $('#tab2').append(parabeforedate);
        $('#parabeforedate'+(parseInt($('#simcount').val())+1)).append(lblbeforedate,txtbeforedate);
        $(function() {
            $("#beforedate"+(parseInt($('#simcount').val())+1)).datepicker();
        });
                    
       
        var paraactivationstatus = document.createElement("P");
        paraactivationstatus.setAttribute("id","paraactivationstatus"+(parseInt($('#simcount').val())+1));
        var lblactivationstatus = "<label for=\"activationstatus"+(parseInt($('#simcount').val())+1)+"\">Activation Status:</label>";
        var selactivationstatus = "<select name=\"activationstatus"+ (parseInt($('#simcount').val())+1) + "\" id=\"activationstatus"+(parseInt($('#simcount').val())+1) +"\" ><option value=\"Active\">Active</option><option value=\"Inactive\">Inactive</option><option value=\"Suspended\">Suspended</option><option value=\"Terminated\">Terminated</option></select>";
        $('#tab2').append(paraactivationstatus);
        $('#paraactivationstatus'+(parseInt($('#simcount').val())+1)).append(lblactivationstatus,selactivationstatus);

        var paraactivationdate = document.createElement("P");
        paraactivationdate.setAttribute("id","paraactivationdate"+(parseInt($('#simcount').val())+1));
        var lblactivationdate = "<label for=\"activationdate"+(parseInt($('#simcount').val())+1)+"\">Activation Date:</label>";
        var txtactivationdate = "<input type=\"text\" name=\"activationdate"+ (parseInt($('#simcount').val())+1) + "\" id=\"activationdate"+(parseInt($('#simcount').val())+1) +"\" value=\"\" />";
        $('#tab2').append(paraactivationdate);
        $('#paraactivationdate'+(parseInt($('#simcount').val())+1)).append(lblactivationdate,txtactivationdate);
         $(function() {
            $("#activationdate"+(parseInt($('#simcount').val())+1)).datepicker();
        });

        var parainventorystatus = document.createElement("P");
        parainventorystatus.setAttribute("id","parainventorystatus"+(parseInt($('#simcount').val())+1));
        var lblinventorystatus = "<label for=\"inventorystatus"+(parseInt($('#simcount').val())+1)+"\">Inventory Status:</label>";
        var selinventorystatus = "<select name=\"inventorystatus"+ (parseInt($('#simcount').val())+1) + "\" id=\"inventorystatus"+(parseInt($('#simcount').val())+1) +"\" ><option value=\"In-stock\">In-stock</option><option value=\"Deployed\">Deployed</option></select>";
        $('#tab2').append( parainventorystatus);
        $('#parainventorystatus'+(parseInt($('#simcount').val())+1)).append(lblinventorystatus,selinventorystatus);

        var parastoragelocation = document.createElement("P");
        parastoragelocation.setAttribute("id","parastoragelocation"+(parseInt($('#simcount').val())+1));
        var lblstoragelocation = "<label for=\"storagelocation"+(parseInt($('#simcount').val())+1)+"\">Storage Location:</label>";
        var txtstoragelocation = "<input type=\"text\" name=\"storagelocation"+ (parseInt($('#simcount').val())+1) + "\" id=\"storagelocation"+(parseInt($('#simcount').val())+1) +"\" value=\"\" />";
        $('#tab2').append(parastoragelocation);
        $('#parastoragelocation'+(parseInt($('#simcount').val())+1)).append(lblstoragelocation,txtstoragelocation);

        var paraimei = document.createElement("P");
        paraimei.setAttribute("id","paraimei"+(parseInt($('#simcount').val())+1));
        var lblimei = "<label for=\"imei"+(parseInt($('#simcount').val())+1)+"\">IMEI No.:</label>";
        var txtimei = "<input type=\"text\" name=\"imei"+ (parseInt($('#simcount').val())+1) + "\" id=\"imei"+(parseInt($('#simcount').val())+1) +"\" value=\"\" />";
        $('#tab2').append(paraimei);
        $('#paraimei'+(parseInt($('#simcount').val())+1)).append(lblimei,txtimei);

        var paraproductmodel = document.createElement("P");
        paraproductmodel.setAttribute("id","paraproductmodel"+(parseInt($('#simcount').val())+1));
        var prodmodel = "<label for=\"productmodel" + (parseInt($('#simcount').val())+1) + "\">Product Model:</label>";
        var selectprodmodel = "<select name=\"productmodel"+ (parseInt($('#simcount').val())+1) + "\" id=\"productmodel"+(parseInt($('#simcount').val())+1)+ "\"><option value=\"Blank\"><--Select--></option>";  
        var selectoption="</select><hr></hr>";
        $('#tab2').append(paraproductmodel);
        $('#paraproductmodel'+(parseInt($('#simcount').val())+1)).append(prodmodel,selectprodmodel,selectoption);

        $.ajax({
            url: 'getallproductmodel.php',
            type: "POST",
            success: function(data) {
               
                   $("#productmodel"+(parseInt($('#simcount').val())+1)).append(data);
                   $('#simcount').val(parseInt($('#simcount').val())+1);
            }

        });

        $('#tab2').append($('#btnaddsim'));
    }
    function removesims(){
         if (confirm('Are you sure you want to remove SIM?')) {
            if(parseInt($('#simcount').val()) < 2){
                alert("At least one SIM must be set up.");
            }
            else{ 
                $('#parasimnumber'+parseInt($('#simcount').val())).remove();
                $('#paratelnumber'+parseInt($('#simcount').val())).remove();
                $('#parabeforedate'+parseInt($('#simcount').val())).remove();
                $('#paraactivationstatus'+parseInt($('#simcount').val())).remove();
                $('#paraactivationdate'+parseInt($('#simcount').val())).remove();
                $('#parainventorystatus'+parseInt($('#simcount').val())).remove();
                $('#parastoragelocation'+parseInt($('#simcount').val())).remove();
                $('#paraimei'+parseInt($('#simcount').val())).remove();
                $('#paraproductmodel'+parseInt($('#simcount').val())).remove();
                $('#simcount').val(parseInt($('#simcount').val())-1);
                $('#tab2').append($('#btnaddproduct'));
            }

         } 
         else {
             // Do nothing!
         }
    }
    function funcfileuploadtype(){
        $('#fileuploadtype').val($('#uploadtype').val());
        
       
    }
    function funcexceltype(){
        $('#fileexceltype').val($('#exceltype').val());
    }
</script>

</head>
<body>
    <div class="headercolor"></div> 
    <div class="container">
        <div class="mp-pusher" id="mp-pusher">         
                <nav id="mp-menu" class="mp-menu">
                    <div class="mp-level">
                        <h2 class="icon icon-world">SIM Card Management</h2>
                         <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="addsim.php" style="background-color:aqua;">Add SIM</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="editsim.php">Edit SIM</a>
                            </li>
                        </ul>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="actideactisim.php">Activation & Deactivation</a>
                              
                            </li>
                        </ul>
                        
                         <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="menu.php">Exit</a>
                               
                            </li>
                        </ul>
                    </div>
                </nav>
            <div class="scroller"><!-- this is for emulating position fixed of the nav -->
                    <div class="scroller-inner" id="pagecontent">  
                        
                            <div class="block block-80 clearfix">
                                <p><a href="#" id="trigger" class="menu-trigger" style="display:none;">Menu</a></p>
                                 <p style="float:right;">
                                               
                                                <input type="button" value="Exit" onclick="location.href='menu.php';"></input>
                                             </p>
                                
                                <div class="tabs">
                                    <ul class="tab-links">
                                        <li class="active"><a href="#tab1">Provider</a></li>
                                        <li><a href="#tab2">SIM Card</a></li>
                                        <li><a href="#tab3">Import SIM</a></li> 
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab1" class="tab active">
                                            <p>
                                                 <label for="simtype">SIM Type:</label>
                                                  <select name="simtype" id="simtype" onchange="getsimgroup();" >
                                                   <option value="Blank"><--Select--></option>
                                                  <?php 
                                                  $sql= $conn->prepare('SELECT simid,simtype FROM simcardmaster');
                                                  $sql->execute();
                                                  $sql->bind_result($simid,$simtype);
                                                  while($sql->fetch()){
                                                  ?>
                                                       <option value="<?php echo $simid ?>"><?php echo $simtype ?></option>  
                                                  <?php
                                                  }
                                                  ?>
                                              </select> 
                                            </p>


                                            <p> 
                                                <label for="simprovider">Provider:</label>
                                                <input type="text" name="simprovider" id="simprovider" value="" class="noedit" readonly="readonly"/>                                               
                                            </p>
                                            <p> 
                                                <label for="simrate">Rate:</label>
                                                <input type="text" name="simrate" id="simrate" value="" class="noedit" readonly="readonly" />
                                            </p>
                                            <p> 
                                                <label for="simplan">Rate Plan:</label>
                                                <input type="text" name="simplan" id="simplan" value="" class="noedit" readonly="readonly"/>
                                            </p>
                                            <p>  
                                                <label for="simcurrency">Currency:</label>
                                                <input type="text" name="simcurrency" id="simcurrency" value="" class="noedit" readonly="readonly" />
                                            </p>
                                            <p> 
                                                <label for="simbilling">Min Billing Months:</label>
                                                <input type="text" name="simbilling" id="simbilling" value="" class="noedit" readonly="readonly"/>
                                            </p>
                                             <p> 
                                                <label for="simsize">SIM Size:</label>
                                                <input type="text" name="simsize" id="simsize" value="" class="noedit" readonly="readonly"/>
                                            </p>
                                            <p> 
                                                <label for="simonline">On-Line Management:</label>
                                                <input type="text" name="simonline" id="simonline" value="" class="noedit" readonly="readonly"/>
                                            </p>
                                            <p> 
                                                <label for="simnoteplan">Notes:</label>
                                                <textarea name="simnoteplan" id="simnoteplan" rows="4" class="noedit" readonly="readonly"></textarea>
                                            </p>
                                        </div>
                                        <div id="tab2" class="tab">
                                            <p id="parasimnumber1"> 
                                                <label for="simnumber1">Sim No.:</label>
                                                <input type="text" name="simnumber1" id="simnumber1" value=""/>
                                            </p>
                                            <p id="paratelnumber1"> 
                                                <label for="telnumber1">MSISDN (Tel No.):</label>
                                                <input type="text" name="telnumber1" id="telnumber1" value=""/>
                                            </p>
                                            <p id="parabeforedate1"> 
                                                <label for="beforedate1">Activation date before:</label>
                                                <input type="date" name="beforedate1" id="beforedate1" value="" />
                                            </p>
                                            <p id="paraactivationstatus1"> 
                                                <label for="activationstatus1">Activation Status: </label>                                         
                                                    <select name="activationstatus1" id="activationstatus1">
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                        <option value="Suspended">Suspended</option>
                                                        <option value="Terminated">Terminated</option>
                                                    </select>
                                            </p>
                                            <p id="paraactivationdate1"> 
                                                <label for="activationdate1">Activation Date:</label>
                                                <input type="text" name="activationdate1" id="activationdate1" value=""/>
                                            </p>
                                            <p id="parainventorystatus1"> 
                                                <label for="inventorystatus1">Inventory Status:</label>                                       
                                                    <select name="inventorystatus1" id="inventorystatus1">
                                                        <option value="In-stock">In-stock</option>
                                                        <option value="Deployed">Deployed</option>
                                                    </select>    
                                            </p>
                                            <p id="parastoragelocation1"> 
                                                <label for="storagelocation1">Storage Location:</label>                                       
                                                <input type="text" name="storagelocation1" id="storagelocation1" value=""/>     
                                            </p>
                                            <p id="paraimei1"> 
                                                <label for="imei1">IMEI No.:</label>                                       
                                                <input type="text" name="imei1" id="imei1" value=""/>   
                                            </p>
                                            <p id="paraproductmodel1"> 
                                                <label for="productmodel1">Product Model:</label>                                       
                                                 <select name="productmodel1" id="productmodel1">
                                                           <option value="Blank"><--Select--></option>
                                                          <?php 
                                                          $sql16= $conn->prepare('SELECT productmodelid,productmodelname FROM productmodelmaster WHERE productmodelname != "Null"');
                                                          $sql16->execute();
                                                          $sql16->bind_result($productmodelid,$productmodelname);
                                                          
                                                          while($sql16->fetch()){
                                                          ?>
                                                               <option value="<?php echo $productmodelid ?>"><?php echo $productmodelname ?></option>  
                                                          <?php
                                                          }
                                                          ?>
                                                </select>    
                                            </p>
                                            <hr></hr>
                                            <p id="btnaddsim">
                                                <input type="button" value="Add SIM" onclick="addsims();"></input>
                                                <input type="button" value="Remove SIM" onclick="removesims();"></input>
                                                <input type="button" value="Reset" onclick="resetsim();"></input>
                                                 <input type="button" value="Submit" onclick="addsim();"></input> 
                                                <label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label>
                                            </p>
                                            
                                        </div>
                                        <div id="tab3" class="tab">
                                            <label id="statuslabel1" style='color:lightgreen;font-weight: bold;'></label>
                                            <input type="hidden" name="fname" id="fname" val=""/>
                                            <p>
                                               <label for="uploadtype">Upload Type: </label> 
                                                <select id="uploadtype" name="uploadtype" onchange="funcfileuploadtype();">
                                                    <option value="SIM">SIM only</option>
                                                    <option value="IMEI">SIM & IMEI</option>
                                                </select>
                                            </p>
                                             <p> 
                                                 <label for="exceltype">Excel Type:</label>
                                                    <select name="exceltype" id="exceltype" onchange="funcexceltype();">
                                                        <option value="xls">.xls</option>
                                                        <option value="xlsx">.xlsx</option>
                                                      </select>
                                            </p>
                                            <p>
                                               
                                                <form action="upload.php" method="POST" enctype="multipart/form-data">
                                                    Select file to upload:
                                                    <input type="file" name="fileToUpload" id="fileToUpload"/>
                                                     
                                                    <input type="hidden" name="fileuploadtype" id="fileuploadtype" value="SIM"></input>
                                                    <input type="hidden" name="fileexceltype" id="fileexceltype" value="xls"></input>
                                                    <input type="submit" value="Upload" name="submit"/>
                                                </form>
                                            </p>
                                            <p id="readexcel">
                                                <label id="simheader"></label>
                                            </p>
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
                                    //  new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
           mainMenu = new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {type : 'overlap'});
           mainMenu._openMenu();
    </script>
    <input type="hidden" id="simcount" name="simcount" value="1"></input>
    
</body>
</html>
