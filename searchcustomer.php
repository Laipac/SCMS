<!--
This module is for searching customer and display details.
-->

<?php include "dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Account Management - SIM CARD Management System</title>
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
<link rel="stylesheet" href="css/tabbed.css" media="all"/>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

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
             
             activity:'accountsearch'
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
</script>
<script type="text/javascript">//<![CDATA[
function setreadonlyinvoice(){
 
   $('#invType').prop('disabled',true);
   $('#salesChannel').prop('disabled',true);
   $('#customerPO').prop('disabled',true);
   $('#status').prop('disabled',true);
    
}
function setreadonlycustomer(){
    $('#frstInv').prop('disabled',true);
    $('#cmpnyName').prop('disabled',true);;
    $('#divName').prop('disabled',true);
    $('#indivName').prop('disabled',true);
    $('#country').prop('disabled',true);
    $('#city').prop('disabled',true);
    $('#address').prop('disabled',true);
    $('#platform').prop('disabled',true);
    $('#cntactName').prop('disabled',true);
    $('#cntactPhone').prop('disabled',true);
    $('#cntactEmail').prop('disabled',true);
    $('#serviceBillTo').prop('disabled',true);
}
function getcustomerdetails(){
    if($('#customer').val()==="" && $('#platformadmin').val()==="" && $('#platformuser').val()==="" && $('#locatorid').val()==="" && $('#invoicenumber').val()==="" && $('#simnumber').val()==="" && $('#imeinumber').val()===""){
        alert('At least one search criteria must be filled.');
    }
    
    else{
        var bFlag=0;
        if($('#platformadmin').val()!==""){
            if($('#platformuser').val()===""){
                alert('Platform admin and platform user must be filled.');
                bFlag=1;
            }
        }
        else if($('#platformuser').val()!==""){
            if($('#platformadmin').val()===""){
                alert('Platform admin and platform user must be filled.');
                bFlag=1;
            }
        }
        if(bFlag===1){
            
        }
        else{
            
            $('#invType').val("");
            $('#salesChannel').val("");
            $('#customerPO').val("");
            $('#status').val("");
            $('#invNum').empty();
            
            
          $.ajax({
              url: "searchcustcrit.php",
              type: "POST",
              data: {
                  customer:$('#customer').val(),
                  platformadmin:$('#platformadmin').val(),
                  platformuser:$('#platformuser').val(),
                  locatorid: $('#locatorid').val(),
                  invoicenumber:$('#invoicenumber').val(),
                  simnumber:$('#simnumber').val(),
                  imeinumber:$('#imeinumber').val()
              },
              success: 
                  function(result){
                    //  alert(result);
                      if(result === "failed"){
                          $('#statuslabel').show();
                          $('#statuslabel').text("Customer not found.");
                          $('#statuslabel').fadeOut(4000);
                      }
                      else
                      {
                        $('#statuslabel').show();
                        $('#statuslabel').text("See customer details in the customer tab.");
                        $('#statuslabel').fadeOut(4000);
                        var arrResult = JSON.parse(result);
                        $('#frstInv').val(arrResult[0].frstInv);
                        $('#cmpnyName').val(arrResult[0].cmpnyName);
                        $('#divName').val(arrResult[0].divName);
                        $('#indivName').val(arrResult[0].indivName);
                        $('#country').val(arrResult[0].country);
                        $('#city').val(arrResult[0].city);
                        $('#address').val(arrResult[0].address);
                        $('#platform').val(arrResult[0].platform);
                        $('#cntactName').val(arrResult[0].cntactName);
                        $('#cntactPhone').val(arrResult[0].cntactPhone);
                        $('#cntactEmail').val(arrResult[0].cntactEmail);
                        $('#serviceBillTo').val(arrResult[0].serviceBillTo);
                        setreadonlycustomer();
                         
                        if(arrResult.length > 0){
                            var i = 0;
                            var unique = new Array();
                            while(i < arrResult.length){
                                unique[i]=arrResult[i].invoices;
                                i++;
                            }
                            i=0;
                            unique1 = unique.filter(function(item, y, ar){ return ar.indexOf(item) === y; });
                           
                            if(unique1.length>1){
                                $('#invNum').append('<option value="Blank"><--Select--></option>');
                                while(i < unique1.length){
                                $('#invNum').append('<option value=\"'+ unique1[i] +'\">'+ unique1[i] +'</option>');
                                i++;
                                }
                                setreadonlyinvoice();
                            }
                            else{
                                if(arrResult[0].productmodel===null){
                                    setreadonlyinvoice();
                                }
                                else{
                                    $('#invNum').empty();
                                    $('#invNum').append('<option value=\"'+ arrResult[0].invoices +'\">'+ arrResult[0].invoices +'</option>');
                             
                                    setproductdetails(arrResult[0].productmodel);
                                    setreadonlyinvoice();
                                }
                               
                            }
                        }
                        else{
                         
                        }
                      }
                      
                  }
             });
        }
    }
}
function clearsearchdetails(){
    $('#customer').val("");
    $('#platformadmin').val("");
     $('#platformuser').val("");
     $('#locatorid').val("");
     $('#invoicenumber').val("");
     $('#simnumber').val("");
     $('#imeinumber').val("");
}
function addproductmodel(productmodel){
               
    var para = document.createElement("P");
    para.setAttribute("id","para"+(parseInt($('#productcount').val())+1));
    var prodmodel = "<label for=\"prodModel" + (parseInt($('#productcount').val())+1) + "\">Product Model:</label>";
    var selectprodmodel = "<select name=\"prodModel"+ (parseInt($('#productcount').val())+1) + "\" id=\"prodModel"+(parseInt($('#productcount').val())+1)+ "\" onchange=\"getserviceplan(this);\"><option value=\"Blank\"><--SELECT--></option>";  
    var selectoption="</select>";
    $('#tab4').append(para);
    $('#para'+(parseInt($('#productcount').val())+1)).append(prodmodel,selectprodmodel,selectoption);

    var paraQty = document.createElement("P");
    paraQty.setAttribute("id","paraQty"+(parseInt($('#productcount').val())+1));
    var lblQty = "<label for=\"qty"+(parseInt($('#productcount').val())+1)+"\">Quantity:</label>";
    var txtQty = "<input type=\"text\" name=\"qty"+ (parseInt($('#productcount').val())+1) + "\" id=\"qty"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\"/>";
    $('#tab4').append(paraQty);
    $('#paraQty'+(parseInt($('#productcount').val())+1)).append(lblQty,txtQty);

    var paraQtyOfSim = document.createElement("P");
    paraQtyOfSim.setAttribute("id","paraQtyOfSim"+(parseInt($('#productcount').val())+1));
    var lblQtyOfSim = "<label for=\"qtysim"+(parseInt($('#productcount').val())+1)+"\">Quantity of SIM:</label>";
    var txtQtyOfSim = "<input type=\"text\" name=\"qtysim"+ (parseInt($('#productcount').val())+1) + "\" id=\"qtysim"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\" />";
    $('#tab4').append(paraQtyOfSim);
    $('#paraQtyOfSim'+(parseInt($('#productcount').val())+1)).append(lblQtyOfSim,txtQtyOfSim);

    var paraPlan = document.createElement("P");
    paraPlan.setAttribute("id","paraPlan"+(parseInt($('#productcount').val())+1));
    var lblPlan = "<label for=\"serviceplan"+(parseInt($('#productcount').val())+1)+"\">Service Plan:</label>";
    var txtPlan = "<select name=\"serviceplan"+ (parseInt($('#productcount').val())+1) + "\" id=\"serviceplan"+(parseInt($('#productcount').val())+1) +"\" disabled=\"true\"><option value=\"Blank\"><--Select--></option></select>";
   // var txtPlan = "<input type=\"text\" name=\"serviceplan"+ (parseInt($('#productcount').val())+1) + "\" id=\"serviceplan"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\" />";
        
    $('#tab4').append(paraPlan);
    $('#paraPlan'+(parseInt($('#productcount').val())+1)).append(lblPlan,txtPlan);

    var parabillcycle = document.createElement("P");
    parabillcycle.setAttribute("id","parabillcycle"+(parseInt($('#productcount').val())+1));
    var lblbillcycle = "<label for=\"billcycle"+(parseInt($('#productcount').val())+1)+"\">Laipac Billing Cycle:</label>";
    var txtbillcycle = "<input type=\"text\" name=\"billcycle"+ (parseInt($('#productcount').val())+1) + "\" id=\"billcycle"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\"/>";
    $('#tab4').append(parabillcycle);
    $('#parabillcycle'+(parseInt($('#productcount').val())+1)).append(lblbillcycle,txtbillcycle);


    var paracntractStart = document.createElement("P");
    paracntractStart.setAttribute("id","paracntractStart"+(parseInt($('#productcount').val())+1));
    var lblcntractstart = "<label for=\"cntractStart"+(parseInt($('#productcount').val())+1)+"\">Initial Contract Start Date:</label>";
    var txtcntractstart = "<input type=\"text\" name=\"cntractStart"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractStart"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\" />";
    $('#tab4').append(paracntractStart);
    $('#paracntractStart'+(parseInt($('#productcount').val())+1)).append(lblcntractstart,txtcntractstart);

    var paracntractRenew = document.createElement("P");
    paracntractRenew.setAttribute("id","paracntractRenew"+(parseInt($('#productcount').val())+1));
    var lblcntractrenew = "<label for=\"cntractRenew"+(parseInt($('#productcount').val())+1)+"\">Contract Renewal Date:</label>";
    var txtcntractrenew = "<input type=\"text\" name=\"cntractRenew"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractRenew"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\"/>";
    $('#tab4').append(paracntractRenew);
    $('#paracntractRenew'+(parseInt($('#productcount').val())+1)).append(lblcntractrenew,txtcntractrenew);

    var paracntractEnd = document.createElement("P");
    paracntractEnd.setAttribute("id","paracntractEnd"+(parseInt($('#productcount').val())+1));
    var lblcntractend = "<label for=\"cntractEnd"+(parseInt($('#productcount').val())+1)+"\">Contract Ending Date:</label>";
    var txtcntractend = "<input type=\"text\" name=\"cntractEnd"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractEnd"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\" />";
    $('#tab4').append(paracntractEnd);
    $('#paracntractEnd'+(parseInt($('#productcount').val())+1)).append(lblcntractend,txtcntractend);

    var paranotes = document.createElement("P");
    paranotes.setAttribute("id","paranotes"+(parseInt($('#productcount').val())+1));
    var lblnotes = "<label for=\"notes"+(parseInt($('#productcount').val())+1)+"\">Notes:</label>";
    var txtnotes = "<textarea name=\"notes"+ (parseInt($('#productcount').val())+1) + "\" id=\"notes"+(parseInt($('#productcount').val())+1) +"\" rows=\"5\" readonly class=\"noedit\"/></textarea><hr></hr>";
    $('#tab4').append(paranotes);
    $('#paranotes'+(parseInt($('#productcount').val())+1)).append(lblnotes,txtnotes);

    $.ajax({
        url: 'getproductsbyinv.php',
        type: 'POST',
        data: {
            invNum:$('#invNum').val()
        },
        success: function(data) {
            $("#prodModel1").empty();
            $("#prodModel1").append(data);
           
            if(typeof productmodel==='undefined' || productmodel===null){
                 $("#prodModel1").prop('disabled',false);
            }
            else{
               
                
                $("#prodModel1").val(productmodel);
                $("#prodModel1").prop('disabled',true);
                getserviceplan();
            }
        }

    });
}
function addsim(productmodel){

        var para = document.createElement("P");
        para.setAttribute("id","para"+(parseInt($('#productcount').val())+1));
        var prodmodel = "<label for=\"prodModel" + (parseInt($('#productcount').val())+1) + "\">Product Model:</label>";
        var selectprodmodel = "<select name=\"prodModel"+ (parseInt($('#productcount').val())+1) + "\" id=\"prodModel"+(parseInt($('#productcount').val())+1)+ "\" onchange=\"getserviceplan(this);\"><option value=\"Blank\"><--SELECT--></option>";  
        var selectoption="</select>";
        $('#tab4').append(para);
        $('#para'+(parseInt($('#productcount').val())+1)).append(prodmodel,selectprodmodel,selectoption);

        var paraQtyOfSim = document.createElement("P");
        paraQtyOfSim.setAttribute("id","paraQtyOfSim"+(parseInt($('#productcount').val())+1));
        var lblQtyOfSim = "<label for=\"qtysim"+(parseInt($('#productcount').val())+1)+"\">Quantity of SIM:</label>";
        var txtQtyOfSim = "<input type=\"text\" name=\"qtysim"+ (parseInt($('#productcount').val())+1) + "\" id=\"qtysim"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\" />";
        $('#tab4').append(paraQtyOfSim);
        $('#paraQtyOfSim'+(parseInt($('#productcount').val())+1)).append(lblQtyOfSim,txtQtyOfSim);

        var paraPlan = document.createElement("P");
        paraPlan.setAttribute("id","paraPlan"+(parseInt($('#productcount').val())+1));
        var lblPlan = "<label for=\"serviceplan"+(parseInt($('#productcount').val())+1)+"\">Service Plan:</label>";
        var txtPlan = "<select name=\"serviceplan"+ (parseInt($('#productcount').val())+1) + "\" id=\"serviceplan"+(parseInt($('#productcount').val())+1) +"\" disabled=\"true\"><option value=\"Blank\"><--Select--></option></select>";
       // var txtPlan = "<input type=\"text\" name=\"serviceplan"+ (parseInt($('#productcount').val())+1) + "\" id=\"serviceplan"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\" />";
        
        $('#tab4').append(paraPlan);
        $('#paraPlan'+(parseInt($('#productcount').val())+1)).append(lblPlan,txtPlan);

        var paranotes = document.createElement("P");
        paranotes.setAttribute("id","paranotes"+(parseInt($('#productcount').val())+1));
        var lblnotes = "<label for=\"notes"+(parseInt($('#productcount').val())+1)+"\">Notes:</label>";
        var txtnotes = "<textarea name=\"notes"+ (parseInt($('#productcount').val())+1) + "\" id=\"notes"+(parseInt($('#productcount').val())+1) +"\" rows=\"5\" readonly class=\"noedit\"/></textarea><hr></hr>";
        $('#tab4').append(paranotes);
        $('#paranotes'+(parseInt($('#productcount').val())+1)).append(lblnotes,txtnotes);

         $.ajax({
            url: 'getproductsbyinv.php',
            type: 'POST',
            data: {
                invNum:$('#invNum').val()

            },
            success: function(data) {
                $("#prodModel1").empty();
                $("#prodModel1").append(data);
                 if(typeof productmodel==='undefined' || productmodel===null){
                      $("#prodModel1").prop('disabled',false);
                 }
                else{
                    $("#prodModel1").val(productmodel);
                     $("#prodModel1").prop('disabled',true);
                    
                    getserviceplan();
                }
            }

        });
}
function setproductdetails(productmodel){
    if($('#invNum').val()==="Blank"){
        $('#customerPO').val("");
        $('#status').val("");
        $('#submitDate').val("");
        $('#salesChannel').val("");
        $('#invType').val("");
    }
    else{
        $.ajax({
              url: "getinvoicedetails.php",
              type: "POST",
              data: {
                  invNum:$('#invNum option:selected').val()
              },
              success: 
                  function(result){
                       
                      if(result === "failed"){
                         alert('failed');
                      }
                      else
                      { 
                        var arrResult = JSON.parse(result);
                        $('#invType').val(arrResult['invType']);
                        $('#salesChannel').val(arrResult['salesChannel']);
                        $('#customerPO').val(arrResult['customerPO']);
                        $('#status').val(arrResult['status']);
                        if($('#invType').val()==="SIM"){
                            $('#productcount').val("1");
                            $('#paranotes'+parseInt($('#productcount').val())).remove();

                            $('#paracntractEnd'+parseInt($('#productcount').val())).remove();
                            $('#paracntractRenew'+parseInt($('#productcount').val())).remove();
                            $('#paracntractStart'+parseInt($('#productcount').val())).remove();
                            $('#parabillcycle'+parseInt($('#productcount').val())).remove();
                            $('#paraPlan'+parseInt($('#productcount').val())).remove();
                            $('#paraQtyOfSim'+parseInt($('#productcount').val())).remove();
                            $('#paraQty'+parseInt($('#productcount').val())).remove();
                            $('#para'+parseInt($('#productcount').val())).remove();
                            $('#productcount').val("0");
                            $('hr').remove();
                            $('#listproducts').show();
                           
                            addsim(productmodel);
                            
                            $('#para1').show();
                          }
                          else if($('#invType').val() === "Product, SIM and Service"){

                            $('#productcount').val("1");
                            $('#paranotes'+parseInt($('#productcount').val())).remove();
                            $('#paracntractEnd'+parseInt($('#productcount').val())).remove();
                            $('#paracntractRenew'+parseInt($('#productcount').val())).remove();
                            $('#paracntractStart'+parseInt($('#productcount').val())).remove();
                            $('#parabillcycle'+parseInt($('#productcount').val())).remove();
                            $('#paraPlan'+parseInt($('#productcount').val())).remove();
                            $('#paraQtyOfSim'+parseInt($('#productcount').val())).remove();
                            $('#paraQty'+parseInt($('#productcount').val())).remove();
                            $('#para'+parseInt($('#productcount').val())).remove();
                            $('#productcount').val("0");
                            $('hr').remove();
                            $('#listproducts').show();
                            addproductmodel(productmodel);
                           
                               $('#para1').show();
                          }
                          else if($('#invType').val()=== "Service Renew"){
                            $('#productcount').val("1");
                            $('#paranotes'+parseInt($('#productcount').val())).remove();
                            $('#paracntractEnd'+parseInt($('#productcount').val())).remove();
                            $('#paracntractRenew'+parseInt($('#productcount').val())).remove();
                            $('#paracntractStart'+parseInt($('#productcount').val())).remove();
                            $('#parabillcycle'+parseInt($('#productcount').val())).remove();
                            $('#paraPlan'+parseInt($('#productcount').val())).remove();
                            $('#paraQtyOfSim'+parseInt($('#productcount').val())).remove();
                            $('#paraQty'+parseInt($('#productcount').val())).remove();
                            $('#para'+parseInt($('#productcount').val())).remove();
                            $('#productcount').val("0");
                            $('hr').remove();
                            $('#listproducts').show();
                            addproductmodel(productmodel);

                            $('#para1').show();
                          }
                      }  
                  }
             });
           
    }
}
function getserviceplan(){
  
    $.ajax({
        url: 'getproductrenew.php',
        type: 'POST',
        data: {
            invNum:$('#prodModel1').val(),
            invType:$('#invType').val()
        },
        success: function(result) {

            if(result==="failed"){
                $('#statuslabel').text("Error retrieving product details.");                                  
            }
            else{
                var arrResult = JSON.parse(result); 
               
                 $('#qtysim1').val(arrResult[0].quantityofsim);

                $('#qty1').val(arrResult[0].quantity);
                $('#billcycle1').val(arrResult[0].billingcycle);
                $('#cntractStart1').val(arrResult[0].startDate);
                $('#cntractRenew1').val(arrResult[0].renewalDate); 
                $('#cntractEnd1').val(arrResult[0].endingDate);
                $('#notes1').val(arrResult[0].notes);
                $('#productid1').val(arrResult[0].prodid);
             //   $("#serviceplan1").val(arrResult[0].serviceplan); 
                $('#listproducts').show();
                
                $.ajax({
                        url: 'getsimimeiloc.php',
                        type: 'POST',
                        data: {
                            productmodel:$('#prodModel1').val()
                            
                        },
                    success: function(result) {
                        
                        
                        $('#productsims').empty();
                        $('#productsims').append(result);
                         $.ajax({
                                url: 'getallserviceplan.php',
                                success: function(data) {
                                  $("#serviceplan1").empty();

                                    $("#serviceplan1").append(data);

                                    $("#serviceplan1").val(arrResult[0].serviceplan);
                                   
                                }
                         });
                        
                    }
                    
                });
                
            }

        }
    });  
}
function getsimdetails(){
     $.ajax({
            url: "getsimdetails.php",
            type: "POST",
            data: {
                simnumber:$('#txtsimnumber').val(),
               simgroup:''
            },
            success: 
                function(result){

                    if(result==="failed"){
                        $('#simstatuslabel').text("SIM does not exist.");                                  
                    }
                    else{
                       var arrResult = JSON.parse(result);                               
                        $('#telnumber').val(arrResult['telnumber']);
                        $('#beforedate').val(arrResult['beforedate']);
                        $('#activationstatus').val(arrResult['activationstatus']);
                        $('#activationdate').val(arrResult['activationdate']);
                        $('#inventorystatus').val(arrResult['inventorystatus']);
                        $('#storagelocation').val(arrResult['storagelocation']);
                        $('#imei').val(arrResult['imei']);
                        $('#locatorid').val(arrResult['locatorid']);
                        $('#locatorname').val(arrResult['locatorname']);
                        $('#simproductmodel').val(arrResult['productmodel']);
                        $('#simimei').val(arrResult['imei']);
                         $('#simtype').val(arrResult['simtype']);
                         $('#simstatuslabel').text(""); 
                    }
                }
        });
}



//]]></script>
           
<style type="text/css">
    input[type=button].btnsearch{
        
        color:white;
        font-family: futura;
        border-radius: 25px;
        -webkit-border-radius: 25px;
        -moz-border-radius:25px;
        border:none;
         cursor:pointer;
         background: url('../images/search32.png') 5px no-repeat ;
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
                        <h2 class="icon icon-world">Account Management</h2>
                       
                           
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-phone" href="searchcustomer.php"  style="background-color:aqua;">Search</a>
                            </li>
                             <li class="icon icon-arrow-left">
                                <a class="icon icon-phone" href="acctmgmt.php">Add</a>
                            </li>
                             <li class="icon icon-arrow-left">
                                <a class="icon icon-phone" href="editcustomer.php">Edit</a>
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
                                                <li class="active"><a href="#tab1">Search</a></li>
                                                <li><a href="#tab2">Details</a></li>
                                                 <li><a href="#tab3">Invoice</a></li>
                                                <li><a href="#tab4">Product Model</a></li>
                                                <li id="listproducts" style="display:none;"><a href="#tab5">SIM</a></li> 
                                            </ul>
                                            <div class="tab-content">
                                                <div id="tab1" class="tab active">
                                                    <p> 
                                                        <label for="customer">Customer:</label>
                                                        <input type="text" name="customer" id="customer" value="" />
                                                    </p>
                                                    <p> <label for="platformadmin">Platform Admin:</label>
                                                         <input type="text" name="platformadmin" id="platformadmin" value="" />
                                                    </p>
                                                    <p> <label for="platformuser">Platform User:</label>
                                                         <input type="text" name="platformuser" id="platformuser" value="" />
                                                    </p>
                                                    <p>
                                                        <label for="locatorid">Locator Id:</label>
                                                       <input type="text" name="locatorid" id="locatorid" value="" /> 
                                                    </p>
                                                    <p>
                                                        <label for="invoicenumber">Invoice #:</label>
                                                       <input type="text" name="invoicenumber" id="invoicenumber" value="" /> 
                                                    </p>
                                                    <p>
                                                        <label for="simnumber">SIM #:</label>
                                                       <input type="text" name="simnumber" id="simnumber" value="" /> 
                                                    </p>
                                                    <p>
                                                        <label for="imeinumber">IMEI #:</label>
                                                       <input type="text" name="imeinumber" id="imeinumber" value="" /> 
                                                    </p>
                                                     <p><input type="button" value="Search" onclick="getcustomerdetails();" class="btnsearch"></input>
                                                     <label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label>
                                                     <input type="button" value="Clear" onclick="clearsearchdetails();" class="btnsearch"></input>
                                                     </p>
                                                    <p></p>
                                                   
                                                </div>
                                                <div id="tab2" class="tab">                                                   
                                                    <p>  
                                                        <label for="frstInv">First Laipac Invoice#:</label>
                                                        <input type="text" name="frstInv" id="frstInv" value="" />
                                                    </p>
                                                    <p> <label for="cmpnyName">Company's Name:</label>  <input type="text" name="cmpnyName" id="cmpnyName" value=""/></p>
                                                    <p> <label for="divName">Division's Name:</label>  <input type="text" name="divName" id="divName" value=""/></p>
                                                    <p> <label for="indivName">Individual's Name:</label><input type="text" name="indivName" id="indivName" value=""/></p>
                                                    <p> <label for="country">Country:</label><input type="text" name="country" id="country" value=""/></p>
                                                    <p> <label for="city">City:</label><input type="text" name="city" id="city" value=""/></p>
                                                     <p> <label for="address">Address:</label><input type="text" name="address" id="address" value=""/></p>
                                                    <p> <label for="platform">Platform:</label><select name="platform" id="platform" ><option value="Blank"><--Select--></option>
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
                                                     <p> <label for="cntactName">Contact Name:</label><input type="text" name="cntactName" id="cntactName" value=""/></p>
                                                     <p> <label for="cntactPhone">Contact Tel. No.:</label><input type="text" name="cntactPhone" id="cntactPhone" value=""/></p>
                                                     <p> <label for="cntactEmail">Contact Email:</label><input type="text" name="cntactEmail" id="cntactEmail" value=""/></p>
                                                      <p><label for="serviceBillTo">Service Bill to:</label><input type="text" name="serviceBillTo" id="serviceBillTo" value=""/></p>
                                                </div>
                                                <div id="tab3" class="tab">
                                                    <p>
                                                        <label for="invNum">Invoice:</label>
                                                         <select name="invNum" id="invNum" onchange="setproductdetails();">
                                                             <option value="Blank"><--Select--></option>
                                                         </select>
                                                    </p>
                                                    <p> <label for="invType">Invoice Type:</label>  <input type="text" name="invType" id="invType" value=""/></p>
                                                    <p> <label for="salesChannel">Sales Channel:</label>  <input type="text" name="salesChannel" id="salesChannel" value=""/></p>
                                                    <p> <label for="customerPO">Customer PO:</label>  <input type="text" name="customerPO" id="customerPO" value=""/></p>
                                                    <p> <label for="status">Status:</label> <input type="text" name="status" id="status" value=""/></p>
                                                </div>
                                                <div id="tab4" class="tab">
                                                    <p id="para1"> <label for="prodModel1">Product Model:  </label>
                                                        <select name="prodModel1" id="prodModel1" onchange="getserviceplan(this);">
                                                            <option value="Blank"><--Select--></option>
                                                        </select>   
                                                    </p>
                                                   
                                                </div>
                                                <div id="tab5" class="tab">
                                                    <div style="width: 55%; float:left">
                                                        <p style="font-size:20px">
                                                            <label for="txtsimnumber">SIM Number:</label>
                                                            <input type="text" id="txtsimnumber" value=""></input>
                                                            <input type="button" value=""  onclick="getsimdetails()" title="Check" style="width:40px;height:40px;background: url('search.png');background-position:center;background-repeat: no-repeat;"></input>
                                                        </p>
                                                        <p>
                                                             <label id="simstatuslabel" style="font-weight:bold;color:red;"></label>
                                                           
                                                           
                                                        </p>
                                                        <p id="simstatusmessage" style="display:none;">
                                                           
                                                            <textarea id="simtoaddstatus" rows="15" cols="25" readonly="readonly" ></textarea>
                                                            
                                                        </p>
                                                        <p id="productsims" style="font-size:25px;">
                                                           
                                                           
                                                        </p>
                                                     </div>
                                                    
                                                     <div id="simdetails" style="width: 45%; float:left">
                                                         <p style="font-size:20px;">
                                                             <label for="simtype">SIM Type:</label>
                                                             <input type="text" id="simtype" value="" class="noedit"></input>
                                                         </p>
                                                         <p style="font-size:20px;">
                                                             <label for="simimei">IMEI:</label>
                                                             <input type="text" id="simimei" value="" class="noedit"></input>
                                                         </p>
                                                         <p style="font-size:20px;">
                                                             <label for="telnumber">MSISDN:</label>
                                                             <input type="text" id="telnumber" value="" class="noedit"></input>
                                                         </p>
                                                         <p style="font-size:20px;">
                                                             <label for="beforedate">Activation Date Before:</label>
                                                             <input type="text" id="beforedate" value="" class="noedit"></input>
                                                         </p>
                                                          <p style="font-size:20px;">
                                                             <label for="activationstatus">Activation Status:</label>
                                                             <input type="text" id="activationstatus" value="" class="noedit"></input>
                                                         </p>
                                                         <p style="font-size:20px;">
                                                             <label for="activationdate">Activation Date:</label>
                                                             <input type="text" id="activationdate" value="" class="noedit"></input>
                                                         </p>
                                                         <p style="font-size:20px;">
                                                             <label for="inventorystatus">Inventory Status:</label>
                                                             <input type="text" id="inventorystatus" value="" class="noedit"></input>
                                                         </p>
                                                         <p style="font-size:20px;">
                                                             <label for="storagelocation">Storage Location:</label>
                                                             <input type="text" id="storagelocation" value="" class="noedit"></input>
                                                         </p>
                                                         <p style="font-size:20px;">
                                                             <label for="simproductmodel">Product Model:</label>
                                                             <input type="text" id="simproductmodel" value="" class="noedit"></input>
                                                         </p>
                                                         <p style="font-size:20px;">
                                                             <label for="locatorid">Locator ID:</label>
                                                             <input type="text" id="locatorid" value="" class="noedit"></input>
                                                         </p>
                                                         <p style="font-size:20px;">
                                                             <label for="locatorname">Locator Name:</label>
                                                             <input type="text" id="locatorname" value="" class="noedit"></input>
                                                         </p>
                                                     </div>
                                                    <div style="clear:both;"></div>
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
   <input type="hidden" id="productcount" name="productcount" value="1"></input>
</body>
</html>
