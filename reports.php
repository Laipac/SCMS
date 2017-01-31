<!--
This module is for reports individual
-->

<?php include "dbConfig.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Reports - SIM CARD Management System</title>
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
             
             activity:'repindividual'
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
                var contractstart;
                if(!(arrResult[0].startDate===null)){
                    contractstart = (arrResult[0].startDate).split("-");

                     contractstart = contractstart[1]+'/'+contractstart[2]+'/'+contractstart[0];
                 }
                 else{
                     contractstart =null;
                 }

                 $('#cntractStart1').val(contractstart);
                 if(!(arrResult[0].renewalDate===null)){
                    contractstart = (arrResult[0].renewalDate).split("-");

                     contractstart = contractstart[1]+'/'+contractstart[2]+'/'+contractstart[0];
                 }
                 else{
                     contractstart =null;
                 }

                 $('#cntractRenew1').val(contractstart); 
                  if(!(arrResult[0].endingDate===null)){
                    contractstart = (arrResult[0].endingDate).split("-");

                     contractstart = contractstart[1]+'/'+contractstart[2]+'/'+contractstart[0];
                 }
                 else{
                     contractstart =null;
                 }
                 $('#cntractEnd1').val(contractstart);
                $('#notes1').val(arrResult[0].notes);
                $('#productid1').val(arrResult[0].prodid);
               
                $('#listproducts').show();
                
                $.ajax({
                         url: 'setserviceplans.php',
                         type: 'POST',
                       /*  data: {
                             productmodel:$('#prodModel1').val()

                         },*/
                     success: function(result) {
                         $("#serviceplan1").empty();
                         $("#serviceplan1").append(result);
                         $("#serviceplan1").val(arrResult[0].serviceplan);
                        $.ajax({
                                url: 'getproductreadonly.php',
                                type: 'POST',
                                data: {
                                    productmodel:$('#prodModel1').val()

                                },
                            success: function(result) {
                                $('#productsims').empty();
                                $('#productsims').append(result);
                            }

                        });
                     }
                 });  
            }

        }
    });  
}
            function addproduct(btnValue){
                if ($('#salesChannel').val()==="Blank"){
                     alert("Kindly select sales channel.");
                }
                else if ($('#invNum').val()===""){
                    alert("Kindly enter invoice number.");
                }
                else if ($('#customerPO').val()===""){
                    alert("Kindly enter customer PO.");
                }
                else if ($('#indivName').val()===""){
                    alert("Kindly enter individual name.");
                }
                else if ($('#invType').val()==="Blank"){
                    alert("Kindly select invoice type.");
                }
                else{
                    if(btnValue.value==='Save'){
                        
                        var prodcount= parseInt($('#productcount').val());
                        var i=0;
                        var bTest=0;
                        
                        if($('#invType').val()==="Product, SIM and Service"){
                            while(i < prodcount){
                            
                                if ($('#prodModel'+(i+1)).val()==="Blank"){
                                      alert("Kindly select product model"+(i+1)+".");
                                      bTest=1;
                                      break;
                                 }
                                 else if ($('#qty'+(i+1)).val()===""){
                                     alert("Kindly enter quantity on product model"+(i+1)+".");
                                     bTest=1;
                                     break;

                                 }
                                 else if ($('#qtysim'+(i+1)).val()===""){
                                     alert("Kindly enter quantity of SIM on product model"+(i+1)+".");
                                     bTest=1;
                                     break;
                                 }
                                  else if ($('#serviceplan'+(i+1)).val()==="Blank"){
                                     alert("Kindly select service plan on product model"+(i+1)+".");
                                     bTest=1;
                                     break;
                                 }
                                 else if ($('#billcycle'+(i+1)).val()===""){
                                     alert("Kindly enter billing cycle on product model."+(i+1)+".");
                                     bTest=1;
                                     break;
                                 }
                                  else if ($('#cntractStart'+(i+1)).val()===""){
                                     alert("Kindly enter contract start date on product model"+(i+1)+".");
                                     bTest=1;
                                     break;
                                 }
                                   else if ($('#cntractRenew'+(i+1)).val()===""){
                                     alert("Kindly enter contract renewal date on product model"+(i+1)+".");
                                     bTest=1;
                                     break;
                                 }
                                 else if ($('#cntractEnd'+(i+1)).val()===""){
                                     alert("Kindly enter contract end date on product model"+(i+1)+".");
                                     bTest=1;
                                     break;
                                 }

                                i++;
                            }
                        }
                        else if($('#invType').val()==="SIM"){
                           
                             while(i < prodcount){
                                if ($('#prodModel'+(i+1)).val()==="Blank"){
                                      alert("Kindly select product model"+(i+1)+".");
                                      bTest=1;
                                      break;
                                 }
                                
                                 else if ($('#qtysim'+(i+1)).val()===""){
                                     alert("Kindly enter quantity of SIM on product model"+(i+1)+".");
                                     bTest=1;
                                     break;
                                 }
                                  else if ($('#serviceplan'+(i+1)).val()==="Blank"){
                                     alert("Kindly select service plan on product model"+(i+1)+".");
                                     bTest=1;
                                     break;
                                 }
                                

                                i++;
                            }
                        }
                
                        if(bTest){
                           
                        }
                        else{
                            $.ajax({
                            url: "addinvrecord.php",
                            type: "POST",
                            data: {

                                invNum:$('#invNum').val(),
                                frstInv:$('#searchcust').val(),
                                salesChannel:$('#salesChannel').val(),
                                customerPO:$('#customerPO').val(),
                                status:$('#status').val(),
                                invType:$('#invType').val()

                            },
                            success: 
                                function(result){

                                    if(result === "success"){
                                        var x=0;
                                        addproductmodels();
                                        function addproductmodels(){
                                            if(x < $('#productcount').val()){
                                                $.ajax({
                                                   url: "addprodrecord.php",
                                                   type: "POST",
                                                   data: {
                                                       invNum:$('#invNum').val(),
                                                       prodModel:$('#prodModel'+(x+1)).val(),
                                                       qty:$('#qty'+(x+1)).val(),
                                                       qtysim:$('#qtysim'+(x+1)).val(),
                                                       serviceplan:$('#serviceplan'+(x+1)).val(),
                                                       billcycle:$('#billcycle'+(x+1)).val(),
                                                       cntractStart:$('#cntractStart'+(x+1)).val(),
                                                       cntractRenew:$('#cntractRenew'+(x+1)).val(),
                                                       cntractEnd:$('#cntractEnd'+(x+1)).val(),
                                                       notes:$('#notes'+(x+1)).val(),
                                                       invType:$('#invType').val()
                                                   },
                                                   success: 
                                                       function(result){
                                                          if(result === "success"){   
                                                               $('#statuslabel').text("Product added to Invoice");
                                                               x++;
                                                               addproductmodels();
                                                           }
                                                           else
                                                           {
                                                               $('#statuslabel').text("Error adding product.");
                                                           }

                                                       }
                                                  });
                                           }
                                        }       
                                        $('#statuslabel').text("Invoice created");
                                    }
                                    else
                                    {
                                        $('#statuslabel').text("Error creating invoice.");
                                    }
                                }
                           }); 
                        } 
                    }
                    else if(btnValue.value==='Add Product Model'){
                      $.ajax({
                         url: "searchinvoice.php",
                         type: "POST",
                         data: {invNum:$('#invNum').val()                        
                         },
                         success: 
                             function(result){
                                 if(result==="success"){
                                     $('#statuslabel').text("");
                                     location.href='addprodmodel.php?invNum='+$('#invNum').val();
                                 }
                                 else
                                 {
                                     $('#statuslabel').text("Save invoice first.");
                                 }
                             
                            }
                        });
                    }                    
                }
                if (btnValue.value === "Save and Continue"){
                   $('#frstInv').val("");
                   $('#cmpnyName').val("");
                   $('#divName').val("");
                   $('#indivName').val("");
                   $('#country').val("");
                   $('#city').val("");
                   $('#address').val("");
                   $('#platform').val("");
                   $('#cntactName').val("");
                   $('#cntactPhone').val("");
                   $('#cntactEmail').val("");
                   $('#serviceBillTo').val("");
                   $('#invType').val("Blank");
                   
               }
            }
            function addproducts(){
                
                if($('#invType').val()==="Product, SIM and Service"){
                    addproductmodel();
                }
                else if($('#invType').val()==="SIM"){
                    addsim();
                }
                else{
                    alert("Select an invoice type.");
                }
                
            
           }
           function removeproducts(){
               if (confirm('Are you sure you want to remove product?')) {
                   if(parseInt($('#productcount').val()) < 2){
                       alert("At least one product model must be set up.");
                   }
                   else{
                       if($('#invType').val()==="Product, SIM and Service"){
                            $('#paranotes'+parseInt($('#productcount').val())).remove();
                            $('#paracntractEnd'+parseInt($('#productcount').val())).remove();
                            $('#paracntractRenew'+parseInt($('#productcount').val())).remove();
                            $('#paracntractStart'+parseInt($('#productcount').val())).remove();
                            $('#parabillcycle'+parseInt($('#productcount').val())).remove();
                            $('#paraPlan'+parseInt($('#productcount').val())).remove();
                            $('#paraQtyOfSim'+parseInt($('#productcount').val())).remove();
                            $('#paraQty'+parseInt($('#productcount').val())).remove();
                            $('#para'+parseInt($('#productcount').val())).remove();
                            $('#productcount').val(parseInt($('#productcount').val())-1);
                            $('#tab2').append($('#btnaddproduct'));
                       }
                       else if($('#invType').val()==="SIM"){
                           $('#paranotes'+parseInt($('#productcount').val())).remove();
                           $('#paraPlan'+parseInt($('#productcount').val())).remove();
                           $('#paraQtyOfSim'+parseInt($('#productcount').val())).remove();
                           $('#para'+parseInt($('#productcount').val())).remove();
                           $('#productcount').val(parseInt($('#productcount').val())-1);
                           $('#tab2').append($('#btnaddproduct'));
                       }
                       else{
                           alert("Select an invoice type.");
                       }
                    
                   }
                    
                } 
                else {
                    // Do nothing!
                }
           }
           function addproductmodel(){
               
                var para = document.createElement("P");
                para.setAttribute("id","para"+(parseInt($('#productcount').val())+1));
                var prodmodel = "<label for=\"prodModel" + (parseInt($('#productcount').val())+1) + "\">Product Model:</label>";
                var selectprodmodel = "<select name=\"prodModel"+ (parseInt($('#productcount').val())+1) + "\" id=\"prodModel"+(parseInt($('#productcount').val())+1)+ "\" onchange=\"getserviceplan(this);\" ><option value=\"Blank\"><--SELECT--></option>";  
                var selectoption="</select>";
                $('#tab5').append(para);
                $('#para'+(parseInt($('#productcount').val())+1)).append(prodmodel,selectprodmodel,selectoption);
                
                var paraQty = document.createElement("P");
                paraQty.setAttribute("id","paraQty"+(parseInt($('#productcount').val())+1));
                var lblQty = "<label for=\"qty"+(parseInt($('#productcount').val())+1)+"\">Quantity:</label>";
                var txtQty = "<input type=\"text\" name=\"qty"+ (parseInt($('#productcount').val())+1) + "\" id=\"qty"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\"/>";
                $('#tab5').append(paraQty);
                $('#paraQty'+(parseInt($('#productcount').val())+1)).append(lblQty,txtQty);
                
                var paraQtyOfSim = document.createElement("P");
                paraQtyOfSim.setAttribute("id","paraQtyOfSim"+(parseInt($('#productcount').val())+1));
                var lblQtyOfSim = "<label for=\"qtysim"+(parseInt($('#productcount').val())+1)+"\">Quantity of SIM:</label>";
                var txtQtyOfSim = "<input type=\"text\" name=\"qtysim"+ (parseInt($('#productcount').val())+1) + "\" id=\"qtysim"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\" />";
                $('#tab5').append(paraQtyOfSim);
                $('#paraQtyOfSim'+(parseInt($('#productcount').val())+1)).append(lblQtyOfSim,txtQtyOfSim);
                
                var paraPlan = document.createElement("P");
                paraPlan.setAttribute("id","paraPlan"+(parseInt($('#productcount').val())+1));
                var lblPlan = "<label for=\"serviceplan"+(parseInt($('#productcount').val())+1)+"\">Service Plan:</label>";
                var txtPlan = "<select name=\"serviceplan"+ (parseInt($('#productcount').val())+1) + "\" id=\"serviceplan"+(parseInt($('#productcount').val())+1) +"\" disabled=true><option value=\"Blank\"><--Select--></option></select>";
                $('#tab5').append(paraPlan);
                $('#paraPlan'+(parseInt($('#productcount').val())+1)).append(lblPlan,txtPlan);
                
                var parabillcycle = document.createElement("P");
                parabillcycle.setAttribute("id","parabillcycle"+(parseInt($('#productcount').val())+1));
                var lblbillcycle = "<label for=\"billcycle"+(parseInt($('#productcount').val())+1)+"\">Laipac Billing Cycle:</label>";
                var txtbillcycle = "<input type=\"text\" name=\"billcycle"+ (parseInt($('#productcount').val())+1) + "\" id=\"billcycle"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\"/>";
                $('#tab5').append(parabillcycle);
                $('#parabillcycle'+(parseInt($('#productcount').val())+1)).append(lblbillcycle,txtbillcycle);
                
                
                var paracntractStart = document.createElement("P");
                paracntractStart.setAttribute("id","paracntractStart"+(parseInt($('#productcount').val())+1));
                var lblcntractstart = "<label for=\"cntractStart"+(parseInt($('#productcount').val())+1)+"\">Initial Contract Start Date:</label>";
                var txtcntractstart = "<input type=\"text\" name=\"cntractStart"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractStart"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\" />";
                $('#tab5').append(paracntractStart);
                $('#paracntractStart'+(parseInt($('#productcount').val())+1)).append(lblcntractstart,txtcntractstart);
                
                var paracntractRenew = document.createElement("P");
                paracntractRenew.setAttribute("id","paracntractRenew"+(parseInt($('#productcount').val())+1));
                var lblcntractrenew = "<label for=\"cntractRenew"+(parseInt($('#productcount').val())+1)+"\">Contract Renewal Date:</label>";
                var txtcntractrenew = "<input type=\"text\" name=\"cntractRenew"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractRenew"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\"/>";
                $('#tab5').append(paracntractRenew);
                $('#paracntractRenew'+(parseInt($('#productcount').val())+1)).append(lblcntractrenew,txtcntractrenew);
               
                var paracntractEnd = document.createElement("P");
                paracntractEnd.setAttribute("id","paracntractEnd"+(parseInt($('#productcount').val())+1));
                var lblcntractend = "<label for=\"cntractEnd"+(parseInt($('#productcount').val())+1)+"\">Contract Ending Date:</label>";
                var txtcntractend = "<input type=\"text\" name=\"cntractEnd"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractEnd"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\"/>";
                $('#tab5').append(paracntractEnd);
                $('#paracntractEnd'+(parseInt($('#productcount').val())+1)).append(lblcntractend,txtcntractend);
               
                var paranotes = document.createElement("P");
                paranotes.setAttribute("id","paranotes"+(parseInt($('#productcount').val())+1));
                var lblnotes = "<label for=\"notes"+(parseInt($('#productcount').val())+1)+"\">Notes:</label>";
                var txtnotes = "<textarea name=\"notes"+ (parseInt($('#productcount').val())+1) + "\" id=\"notes"+(parseInt($('#productcount').val())+1) +"\" rows=\"5\" readonly class=\"noedit\"/></textarea><hr></hr>";
                $('#tab5').append(paranotes);
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
                        
                    }
                });
           }
           function addsim(){
              
                    var para = document.createElement("P");
                    para.setAttribute("id","para"+(parseInt($('#productcount').val())+1));
                    var prodmodel = "<label for=\"prodModel" + (parseInt($('#productcount').val())+1) + "\">Product Model:</label>";
                    var selectprodmodel = "<select name=\"prodModel"+ (parseInt($('#productcount').val())+1) + "\" id=\"prodModel"+(parseInt($('#productcount').val())+1)+ "\" onchange=\"getserviceplan(this);\" ><option value=\"Blank\"><--SELECT--></option>";  
                    var selectoption="</select>";
                    $('#tab5').append(para);
                    $('#para'+(parseInt($('#productcount').val())+1)).append(prodmodel,selectprodmodel,selectoption);

                    var paraQtyOfSim = document.createElement("P");
                    paraQtyOfSim.setAttribute("id","paraQtyOfSim"+(parseInt($('#productcount').val())+1));
                    var lblQtyOfSim = "<label for=\"qtysim"+(parseInt($('#productcount').val())+1)+"\">Quantity of SIM:</label>";
                    var txtQtyOfSim = "<input type=\"text\" name=\"qtysim"+ (parseInt($('#productcount').val())+1) + "\" id=\"qtysim"+(parseInt($('#productcount').val())+1) +"\" value=\"\" readonly class=\"noedit\" />";
                    $('#tab5').append(paraQtyOfSim);
                    $('#paraQtyOfSim'+(parseInt($('#productcount').val())+1)).append(lblQtyOfSim,txtQtyOfSim);

                    var paraPlan = document.createElement("P");
                    paraPlan.setAttribute("id","paraPlan"+(parseInt($('#productcount').val())+1));
                    var lblPlan = "<label for=\"serviceplan"+(parseInt($('#productcount').val())+1)+"\">Service Plan:</label>";
                    var txtPlan = "<select name=\"serviceplan"+ (parseInt($('#productcount').val())+1) + "\" id=\"serviceplan"+(parseInt($('#productcount').val())+1) +"\" disabled=true><option value=\"Blank\"><--Select--></option></select>";
                    $('#tab5').append(paraPlan);
                    $('#paraPlan'+(parseInt($('#productcount').val())+1)).append(lblPlan,txtPlan);
                    
                    var paranotes = document.createElement("P");
                    paranotes.setAttribute("id","paranotes"+(parseInt($('#productcount').val())+1));
                    var lblnotes = "<label for=\"notes"+(parseInt($('#productcount').val())+1)+"\">Notes:</label>";
                    var txtnotes = "<textarea name=\"notes"+ (parseInt($('#productcount').val())+1) + "\" id=\"notes"+(parseInt($('#productcount').val())+1) +"\" rows=\"5\" readonly class=\"noedit\"/></textarea><hr></hr>";
                    $('#tab5').append(paranotes);
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
                            
                        }
                  
                    });
                    
                 //   $('#tab2').append($('#btnaddproduct'));
           }
function setproductdetails(){
      $.ajax({
            url: "retrieveInv.php",
            type: "POST",
            data: {invNum:$('#invNum').val(),
               invType:$('#invType').val()
            },
            success: 
                function(result){

                    if(result==="failed"){
                        $('#statuslabel').text("Error retrieving invoice details.");                                  
                    }
                    else{
                       var arrResult = JSON.parse(result); 
                      
                        $('#salesChannel').val(arrResult['salesChannel']);
                        $('#customerPO').val(arrResult['customerPO']);
                        $('#status').val(arrResult['status']);
                        $('#submitDate').val(arrResult['submitDate']);
                         $.ajax({
                                url: 'getallserviceplan.php',
                                
                                success: function(data) {
                                    $("#serviceplan1").empty();
                                    $("#serviceplan1").append('<option value="Blank"><--Select--></option');
                                    $("#serviceplan1").append(data);
                                    $('#statuslabel').text("");
                                }
                            });       
                    }
                }
        });
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
      $('#listproducts').hide();
      $('#btnaddproduct').show();
      addsim();
      $('#paraproductmodelrenew').hide();
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
      $('#listproducts').hide();
      addproductmodel();
       $('#btnaddproduct').show();
      $('#paraproductmodelrenew').hide();
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
        addproductmodel();
         $('#btnaddproduct').hide();
         $('#paraproductmodelrenew').hide();
         $('#para1').show();
    }
    else{
        alert("Select an invoice type.");
    } 
              
}
        function setrenewal(productmodelid){
            $('#tablesims').hide();
           // alert($('#tablecellsimnumber'+productmodelid).text());
           // alert($('#selectedpmodelnum').val());
            
            $('#lblproductmodel').text("Product Model:"+$('#selectedpmodelname').val());
            $('#lblsimnumber').text("SIM number:"+$('#tablecellsimnumber'+productmodelid).text());
           $('#pararenewalbuttons').show();
            $('#pararenewserviceplan').show();
            $('#pararenewserviceplanbilling').show();
            $('#pararenewserviceplanrenewdate').show();
            $('#pararenewserviceplanenddate').show();
            $('#parastatuses').show();
        }
        function addinvoicerenewal(){
           
            if ($('#salesChannel').val()==="Blank"){
                 alert("Kindly select sales channel.");
            }
            else if ($('#invNum').val()===""){
                alert("Kindly enter invoice number.");
            }
            else if ($('#customerPO').val()===""){
                alert("Kindly enter customer PO.");
            }
            else if ($('#invType').val()==="Blank"){
                alert("Kindly select invoice type.");
            }
            else if($('#serviceplanbilling').val()===""){
                alert("Kindly enter billing.");
            }
            else if($('#serviceplanrenewdate').val()===""){
                alert("Kindly enter contract renewal date.");
            }
            else if($('#serviceplanenddate').val()===""){
                alert("Kindly enter contract end date.");
            }
            else{
                    $.ajax({
                        url: 'addinvrecord.php',
                        type: 'POST',
                        data: {
                            frstInv:$('#searchcust').val(),
                            invNum:$('#invNum').val(),
                            customerPO:$('#customerPO').val(),
                            salesChannel:$('#salesChannel').val(),
                            invType:$('#invType').val(),
                            status:$('#status').val(),
                            billingmonths:$('#serviceplanbilling').val(),
                            renewaldate:$('#serviceplanrenewdate').val(),
                            enddate:$('#serviceplanenddate').val(),
                            productmodel:$('#selectedpmodelnum').val(),
                            serviceplan:$('#serviceplannew').val(),
                            simnumber:$('#lblsimnumber').text()
                        },
                        success: function(data) {
                       
                          if(data==="successsuccesssuccess"){
                              $('#statuslabelrenew').text("Service renewal added.");
                               $('#statuslabelrenew').fadeOut(4000);
                          }
                        }
                    });
            }
            
        }
        function backinvoicerenewal(){
            $('#tablesims').show();
            $('#pararenewalbuttons').hide();
             $('#parastatuses').hide();
            $('#pararenewserviceplan').hide();
            $('#pararenewserviceplanbilling').hide();
            $('#pararenewserviceplanrenewdate').hide();
            $('#pararenewserviceplanenddate').hide();
           $('#lblproductmodel').text("");
            $('#lblsimnumber').text("");
           
        }
function setinvoices(){
             $.ajax({
                    url: 'getinvoices.php',
                    type: 'POST',
                    data: {
                        frstInv:$('#searchcust').val(),                   
                        invType:$('#invType').val()
                       
                    },
                    success: function(data) {
                         $('#invNum').empty();
                        $('#invNum').append(data);
                        $('#salesChannel').val("Blank");
                        $('#customerPO').val("");
                        $('#prodModel1').val("");
                        $('#listproducts').hide();
                        $('#status').val("");
                       
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
function addtotextarea(){
    if($('#simtoadd').val()===""){
        
         if( $('#txtsimnumber').val().length < 19){
             alert("SIM numbers must be 19 digits.");
         }
          else if( $('#txtsimnumber').val().length >19){
            alert("SIM numbers must be 19 digits.");
        }
         else{
              $('#simtoadd').val($('#txtsimnumber').val());
         }    
    }
    else{
        
        var allsim = $('#simtoadd').val();
        var newsim = $('#txtsimnumber').val();
        
        if(newsim.length < 19)
        {
           alert("SIM numbers must be 19 digits.");
           
        }
        else if(newsim.length>19){
            alert("SIM numbers must be 19 digits.");
        }
        else if(allsim.indexOf(newsim)>=0)
        {
            alert("SIM number already exists.");
        }
        else{
             $('#simtoadd').val($('#simtoadd').val()+'\n'+$('#txtsimnumber').val());
             
           
        }
        
    }
   
}
function resettextarea(){
   
    var x=0;
    while(x< $('#simcount').val()){
        $('#locatorid'+(x+1)).val("");
         $('#locatorname'+(x+1)).val("");
        x++;
    }
    
}
function addtoinvoice(){
    var x=0;
    var arrLOCID=[];
    var arrLOCNAME=[];
    var locatoridblank=0;
    var locatornameblank=0;
    var arrIMEI=[];
    var arrIDIMEI=[];
    var arrIDSIM=[];
    var arrSIM=[];
    var imeiblank=0;
    var simblank=0;
    
    while(x<$('#simcount').val()){
        
        if($('#locatorid'+(x+1)).val()===""){
           
           alert('Locator ID '+(x+1)+ ' is blank.');
           locatoridblank=1;
            break;
        }
        else if($('#locatorname'+(x+1)).val()===""){
            alert('Locator User Name '+(x+1)+ ' is blank.');
           locatornameblank=1;
            break;
        }
        else if($('#sim'+(x+1)).val()===""){
            alert('SIM'+(x+1)+' is blank.');
            simblank=1;
            break
        }
        else{
            
            arrSIM[x]=$('#sim'+(x+1)).val();
            arrIDSIM[x]=$('#idsim'+(x+1)).val();
            arrLOCID[x]=$('#locatorid'+(x+1)).val();
            arrLOCNAME[x]=$('#locatorname'+(x+1)).val();
            x++;
            
        }
    }
    x=0;
    while(x<$('#imeicount').val()){
        
        if($('#imei'+(x+1)).val()===""){
           
           alert('IMEI '+(x+1)+ ' is blank.');
           imeiblank=1;
            break;
        }
        else{
         
            arrIMEI[x]=$('#imei'+(x+1)).val();
            arrIDIMEI[x]=$('#idimei'+(x+1)).val();
            x++;
        }
    }
    
    
    if(locatoridblank || locatornameblank || imeiblank || simblank){
        
    }
    else if($('#billcycle1').val()===""){
        alert("Enter billing cycle.");
    }
    else if($('#cntractRenew1').val()===""){
        alert("Enter contract renewal date.");
    }
    else if($('#cntractEnd1').val()===""){
        alert("Enter contract end date.");
    }
    else if($('#serviceplan1').val()==="Blank"){
        alert("Select service plan.");
    }
    else{
        var counts = [];
        var duplicate=0;
        for(var i = 0; i <= arrLOCID.length; i++) {
            if(counts[arrLOCID[i]] === undefined) {
                counts[arrLOCID[i]] = 1;
            } else {
               duplicate=1;
                break;
            }
        }
        var counts1 = [];
        var duplicate1=0;
        for(var i = 0; i <= arrLOCNAME.length; i++) {
            if(counts1[arrLOCNAME[i]] === undefined) {
                counts1[arrLOCNAME[i]] = 1;
            } else {
               duplicate1=1;
                break;
            }
        }
        var counts2=[];
        var duplicate2=0;
        for(var i = 0; i <= arrIMEI.length; i++) {
            if(counts2[arrIMEI[i]] === undefined) {
                counts2[arrIMEI[i]] = 1;
            } else {
               duplicate2=1;
                break;
            }
        }
        var counts3=[];
        var duplicate3=0;
        for(var i = 0; i <= arrSIM.length; i++) {
            if(counts3[arrSIM[i]] === undefined) {
                counts3[arrSIM[i]] = 1;
            } else {
               duplicate3=1;
                break;
            }
        }
        
    
    
        if(duplicate){
            alert("Error. Duplicate Locator ID exists.");
        }
        else if(duplicate1){
            alert("Error. Duplicate Locator User Name exists.");
        }
        else if(duplicate2){
            alert("Error. Duplicate IMEI exists.");
        }
        else if(duplicate3){
            alert("Error. Duplicate SIM exists.");
        }
        else{
            $.ajax({
                url: "checkimeisim.php",
                type: "POST",
                data: {
                    simnumber:arrSIM,
                    imei:arrIMEI,
                    productmodel:$('#prodModel1').val()
                   
                },
                success: 
                    function(result){
                        
                        if(result==="success"){
                             $.ajax({
                                url: "updproductitems.php",
                                type: "POST",
                                data: {
                                    simnumber:arrSIM,
                                    idsim:arrIDSIM,
                                    imei:arrIMEI,
                                    idimei:arrIDIMEI,
                                    productmodel:$('#prodModel1').val(),
                                    locatorid:arrLOCID,
                                    locatorname:arrLOCNAME,
                                    serviceplan:$('#serviceplan1').val(),
                                    billcycle:$('#billcycle1').val(),
                                    cntractRenew:$('#cntractRenew1').val(),
                                    cntractEnd:$('#cntractEnd1').val()
                                },
                                success: 
                                    function(result){

                                        if(result==="failed"){
                                            $('#simstatuslabel').text("Error modifying locator ID and user name to SIM & IMEI.");
                                             $('#simstatuslabel').fadeOut(3000);
                                        }
                                        else{
                                           $('#simstatuslabel').text("Locator ID and User Name modified.");
                                           $('#simstatuslabel').fadeOut(3000);
                                        }
                                    }
                            });
                        }
                        else{
                           $('#simstatuslabel').text("SIM, IMEI, locator id and locator name modified.");
                           $('#simstatuslabel').fadeOut(3000);
                           
                           $('#simstatuslabel').text("Error modifying SIM & IMEI.");
                             $('#simstatuslabel').fadeOut(3000);
                        }
                    }
            });
        }
    }
    
}
function searchval(){
    if($('#searchval').val()===""){
        alert('Search value is blank.');
    }
   
    else{
            $.ajax({
                url: "searchcust.php",
                type: "POST",
                data: {
                  searchval:$('#searchval').val()
                },
                success: 
                    function(result){
                       
                        if(result==="failed"){
                             $('#searchstatuslabel').show();
                              $('#searchstatuslabel').text("");
                            $('#searchstatuslabel').text("Customer does not exist.");
                             $('#searchstatuslabel').fadeOut(3000);
                        }
                        else{
                            $('#searchstatuslabel').text("");
                            $('#searchstatuslabel').show();
                            $('#searchstatuslabel').text("View details on the respective tabs.");
                            $('#searchstatuslabel').fadeOut(3000);
                            
                            var arrCompany = JSON.parse(result);
                            $('#cmpnyName').val(arrCompany.cmpnyName);
                            $('#divName').val(arrCompany.divName);
                            $('#indivName').val(arrCompany.indivName);
                            $('#country').val(arrCompany.country); 
                            $('#city').val(arrCompany.city);
                            $('#address').val(arrCompany.address);
                            $('#platform').val(arrCompany.platform);
                            $('#cntactName').val(arrCompany.cntactName);
                            $('#cntactPhone').val(arrCompany.cntactPhone);
                            $('#cntactEmail').val(arrCompany.cntactEmail);
                            $('#serviceBillTo').val(arrCompany.serviceBillTo);
                            $('#frstInv').val(arrCompany.frstInv);
                            $('#searchcust').val(arrCompany.frstInv);
                         
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
                        <h2 class="icon icon-world">Reports</h2>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="reports.php" style="background-color:aqua;">Individual</a>
                              
                            </li>
                        </ul>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="repcustadmin.php">Admin</a>
                              
                            </li>
                        </ul>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="repcustplatform.php">Platform</a>
                              
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
                                                <input type="button" value="Search" onclick="addtoinvoice(this);"></input>
                                                
                                                <input type="button" value="Exit" onclick="location.href='menu.php';"></input>
                                             </p>
                                        
                                        <div class="tabs">
                                            <ul class="tab-links">
                                                <li class="active"><a href="#tab1">Search</a></li>
                                                <li><a href="#tab2">Customer</a></li>
                                                <li><a href="#tab4">Invoice</a></li>
                                                <li><a href="#tab5">Product Model</a></li>
                                                <li id="listproducts" style="display:none;"><a href="#tab3">SIM</a></li>     
                                            </ul>
                                            <div class="tab-content">
                                                <div id="tab1" class="tab active">
                                                    
                                                    <p>
                                                         <label for="searchval">Search:</label>
                                                         <input type="text" name="searchval" id="searchval" value=""/>
                                                    </p>
                                                    <p>
                                                         <input type="button" value="Search" onclick="searchval();"></input>
                                                    </p>
                                                    <p>
                                                        <label id="searchstatuslabel" style="font-weight:bold;color:red;"></label>
                                                    </p>
                                                </div>
                                                <div id="tab2" class="tab">
                                                     <p> 
                                                        <label for="frstInv">Customer ID: </label>
                                                          <input type="text" name="frstInv" id="frstInv" value="" readonly class="noedit"/>
                                                    </p>
                                                    <p> 
                                                        <label for="cmpnyName">Company: </label>
                                                          <input type="text" name="cmpnyName" id="cmpnyName" value="" readonly class="noedit"/>
                                                    </p>
                                                    <p> 
                                                        <label for="divName">Division: </label>
                                                          <input type="text" name="divName" id="divName" value="" readonly class="noedit"/>
                                                    </p>
                                                     <p> 
                                                        <label for="indivName">Individual: </label>
                                                          <input type="text" name="indivName" id="indivName" value="" readonly class="noedit"/>
                                                    </p>
                                                     <p> 
                                                        <label for="country">Country: </label>
                                                          <input type="text" name="country" id="country" value="" readonly class="noedit"/>
                                                    </p>
                                                    <p> 
                                                        <label for="city">City: </label>
                                                          <input type="text" name="city" id="city" value="" readonly class="noedit"/>
                                                    </p>
                                                    <p> 
                                                        <label for="address">Address: </label>
                                                          <input type="text" name="address" id="address" value="" readonly class="noedit"/>
                                                    </p>
                                                    <p> 
                                                        <label for="platform">Platform: </label>
                                                          <input type="text" name="platform" id="platform" value="" readonly class="noedit"/>
                                                    </p>
                                                    <p> 
                                                        <label for="cntactName">Contact Name: </label>
                                                          <input type="text" name="cntactName" id="cntactName" value="" readonly class="noedit"/>
                                                    </p>
                                                    <p> 
                                                        <label for="cntactPhone">Contact Phone: </label>
                                                          <input type="text" name="cntactPhone" id="cntactPhone" value="" readonly class="noedit"/>
                                                    </p>
                                                    <p> 
                                                        <label for="cntactEmail">Contact Email: </label>
                                                          <input type="text" name="cntactEmail" id="cntactEmail" value="" readonly class="noedit"/>
                                                    </p>
                                                    <p> 
                                                        <label for="serviceBillTo">Service Bill To: </label>
                                                          <input type="text" name="serviceBillTo" id="serviceBillTo" value="" readonly class="noedit"/>
                                                    </p>
                                                </div>
                                                <div id="tab4" class="tab">
                                                    <p> 
                                                    <label for="searchcust">Customer:
                                                    </label>
                                                        <input type="text" name="searchcust" id="searchcust" value="" readonly class="noedit"/>
                                                        </p>
                                                     <p> <label for="invType">Invoice Type:</label>
                                                         <select name="invType" id="invType" onclick="setinvoices();">
                                                             <option value="Blank"><--Select--></option>
                                                             <option value="Product, SIM and Service">Product, SIM and Service</option>
                                                             <option value="SIM">SIM</option>
                                                             <option value="Service Renew">Service Renew</option>
                                                         </select>   
                                                    </p>
                                                    <p> 
                                                        <label for="invNum">Invoice#: </label>
                                                          <select name="invNum" id="invNum" onchange="setproductdetails();">
                                                             <option value="Blank"><--Select--></option>
                                                          </select>
                                                    </p>
                                                   
                                                    <p> <label for="salesChannel">Sales Channel: </label>
                                                      <select name="salesChannel" id="salesChannel" disabled="true" >
                                                           <option value="Blank"><--Select--></option>
                                                          <?php 
                                                          $sql= $conn->prepare('SELECT channelid,channelname FROM saleschannel');
                                                          $sql->execute();
                                                          $sql->bind_result($channelid,$channelname);
                                                          while($sql->fetch()){
                                                          ?>
                                                               <option value="<?php echo $channelid ?>"><?php echo $channelname ?></option>  
                                                          <?php
                                                          }
                                                          ?>
                                                      </select>   
                                                    </p>
                                                    

                                                    <p> <label for="customerPO">Customer's PO#: </label>
                                                        <input type="text" name="customerPO" id="customerPO" value="" readonly class="noedit" />
                                                    </p>
                                                   
                                                    <p> <label for="status">Status:</label>
                                                            <input type="text" name="status" id="status" value="" readonly class="noedit"/>
                                                    </p>
                                                      
                                                    
                                                    <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                                </div>
                                                <div id="tab5" class="tab">                                                   
                                                    <p id="para1"> <label for="prodModel1">Product Model:  </label>
                                                         <select name="prodModel1" id="prodModel1" onchange="getserviceplan(this);">
                                                           <option value="Blank"><--Select--></option>
                                                          <?php 
                                                          $sql= $conn->prepare('SELECT productmodelid,productmodelname FROM productmodelmaster');
                                                          $sql->execute();
                                                          $sql->bind_result($productmodelid,$productmodelname);
                                                          
                                                          while($sql->fetch()){
                                                          ?>
                                                               <option value="<?php echo $productmodelid ?>"><?php echo $productmodelname ?></option>  
                                                          <?php
                                                          }
                                                          
                                                          ?>
                                                      </select>   
                                                    </p>
                                                    <p id="paraproductmodelrenew" style='display:none;'> <label for="pmodel1">Product Model:  </label>
                                                         <select name="pmodel1" id="pmodel1" onchange="getserviceplan(this);">
                                                           <option value="Blank"><--Select--></option>
                                                          <?php 
                                                          //$var = $_GET["invoice"];
                                                          $var="LP123123";
                                                          $sql1 = $conn->prepare('SELECT DISTINCT productmodel.prodmodelid,productmodelmaster.productmodelname,productmodel.invNum FROM productmodel INNER JOIN invoices ON productmodel.invNum=invoices.invNum INNER JOIN customers ON customers.frstInv=invoices.frstInv INNER JOIN productmodelmaster ON productmodelmaster.productmodelid=productmodel.productmodel WHERE customers.frstInv=?');
                                                          $sql1->bind_param('s',$var);
                                                          $sql1->execute();
                                                          $sql1->bind_result($productmodelnumbers,$productmodelnames,$invoicenumber);
                                                          
                                                          while($sql1->fetch()){
                                                          ?>
                                                               <option value="<?php echo $productmodelnumbers ?>"><?php echo $invoicenumber." - ".$productmodelnames ?></option>
                                                              
                                                          <?php
                                                          }
                                                          ?>
                                                      </select>   
                                                    </p>
                                                    <p id="paraQty1">  <label for="qty1">Quantity:</label>  <input type="text" name="qty1" id="qty1" value=""  /></p>
                                                    <p id="paraQtyOfSim1"> <label for="qtysim1">Quantity of SIM:</label> <input type="text" name="qtysim1" id="qtysim1" value=""/></p>
                                                    <p id="paraPlan1"> <label for="serviceplan1">Service Plan:</label>
                                                        <select name="serviceplan1" id="serviceplan1">
                                                             <option value="Blank"><--Select--></option>
                                                        </select>
                                                    </p>
                                                    <p id="parabillcycle1"> <label for="billcycle1">Laipac Billing Cycle:</label><input type="text" name="billcycle1" id="billcycle1" value=""/></p>
                                                    <p id="paracntractStart1"> <label for="cntractStart1">Initial Contract Start Date:</label><input type="text" name="cntractStart1" id="cntractStart1" value="" /></p>
                                                    <p id="paracntractRenew1"> <label for="cntractRenew1">Contract Renewal Date:</label><input type="text" name="cntractRenew1" id="cntractRenew1" value="" /></p>
                                                    <p id="paracntractEnd1"> <label for="cntractEnd1">Contract Ending Date:</label><input type="text" name="cntractEnd1" id="cntractEnd1" value="" /></p>
                                                    <p id="paranotes1">
                                                       
                                                        <label for="notes1">Notes:</label>
                                                        <textarea name="notes1" id="notes1" rows="5"></textarea>
                                                        
                                                    </p>
                                                    <hr></hr>
                                                    <!--
                                                    <p id="btnaddproduct">
                                                        <input type="button" value="Add Product" onclick="addproducts();"></input>
                                                        <input type="button" value="Remove" onclick="removeproducts();"></input>
                                                    </p>-->
                                                </div>
                                                <div id="tab3" class="tab">
                                                    
                                                    <div style="width: 55%; float:left">
                                                        <p style="font-size:20px">
                                                            <label for="txtsimnumber">SIM Number:</label>
                                                            <input type="text" id="txtsimnumber" value=""></input>
                                                            <input type="button" value=""  onclick="getsimdetails()" title="Check" style="width:40px;height:40px;background: url('search.png');background-position:center;background-repeat: no-repeat;"></input>
                                                        </p>
                                                        <p>
                                                             <label id="simstatuslabel" style="font-weight:bold;color:red;"></label>
                                                           
                                                             <input type="button" value="Reset" onclick="resettextarea();"></input>
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
