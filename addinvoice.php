<!--
This module is used for adding invoices. There are 3 types of invoices which are product, sim and service, sim and service renew
-->
<?php include "dbConfig.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Add Invoice - SIM CARD Management System</title>
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
<link rel="stylesheet" href="css/tabbed.css" media="all"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<link rel="stylesheet" href="/resources/demos/style.css"/>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
//displays tab and tab content
   jQuery('.tabs .tab-links a').on('click', function(e)  {
       var currentAttrValue = jQuery(this).attr('href');

       // Show/Hide Tabs
       jQuery('.tabs ' + currentAttrValue).show().siblings().hide();

       // Change/remove current tab to active
       jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

       e.preventDefault();
   });
//initializes date picker on date fields  
    $(function() {
        $("#searchrenewaldatefrom").datepicker();
    });
    
     $(function() {
        $("#searchrenewaldateto").datepicker();
    });
    
    $(function() {
        $("#searchendingdatefrom").datepicker();
    });
   
    $(function() {
        $("#searchendingdateto").datepicker();
    });
 //check if user is authorized to use module
   $.ajax({
         url: "checkfuncauth.php",
         type: "POST",
         data: {
             
             activity:'invoicefull'
         },
         success: 
            function(result){
               
                 if(result==='1'){
                    $('#btnSubmit').show();
                 }
                 else
                 {      
                   $('#btnSubmit').hide();
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
//sets service plan based on product model
function getserviceplan(productid){
    var myid = productid.id;
    myid=myid.replace("prodModel","");


    if($('#invType').val()==='Service Renew')
    {

        $.ajax({
            url: 'getproductmodel.php',
            type: 'POST',
            data: {
                productmodel:$('#prodModel1').val()
            },
            success: function(data) {
                //retrieve product model details
                $("#tab3").empty();
                $("#tab3").append(data);
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

                            $('#qtysim1').prop('disabled',true);
                            $('#qty1').prop('disabled',true);
                            $('#billcycle1').prop('disabled',true);
                            $('#cntractStart1').prop('disabled',true);
                            $('#cntractRenew1').prop('disabled',true);
                            $('#cntractEnd1').prop('disabled',true);
                            $('#notes1').prop('disabled',true);
                            //sets service plan and service plan details
                             $.ajax({
                                    //url: 'getserviceplan.php?productmodel=' + $('#selectedpmodelnum').val(),
                                    //url:'getserviceplan.php?productmodel=' + arrResult[0].productmodel,
                                     url:'getserviceplan.php',
                                    success: function(data) {

                                      $("#serviceplan1").empty();
                                      //$("#serviceplan"+(i+1)).append("<option value=\"Blank\"><--Select--></option>");
                                        $("#serviceplan1").append(data);
                                      //  $('#serviceplannew').empty();
                                      //  $('#serviceplannew').append(data);
                                        $("#serviceplan1").val(arrResult[0].serviceplan);
                                        $("#serviceplan1").prop('disabled',true);
                                        $(function() {
                                            $("#serviceplanrenewdate").datepicker();
                                        });
                                         $(function() {
                                            $("#serviceplanenddate").datepicker();
                                        });
                                    }
                                });
                        }

                    }
                });
            }
        });


    }
    else{
        $.ajax({
            //url: 'getserviceplan.php?productmodel=' + $('#prodModel'+myid).val(),
            url: 'getserviceplan.php',
            success: function(data) {
              $("#serviceplan"+myid).empty();
              $("#serviceplan"+myid).append("<option value=\"Blank\"><--Select--></option>")
                $("#serviceplan"+myid).append(data);
            }
        });
    }


}

//submits the invoice
function addproduct(btnValue){
    if ($('#salesChannel').val()==="Blank"){
         alert("Kindly select sales channel.");
    }
    else if ($('#invNum').val()===""){
        alert("Kindly enter invoice number.");
    }
    else if (isNaN($('#invNum').val())){
        alert("Invoice number should be a number.");
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
        if(btnValue.value==='Submit'){

            var prodcount= parseInt($('#productcount').val());
            var i=0;
            var bTest=0;
            var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ; //date format to check for date fields.
            var invoicestatus;
            invoicestatus= 'Waiting for Renew';
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
                     /* not required for now.
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
                     }*/
                    else if($('#cntractStart'+(i+1)).val()!=="")
                    {
                        if(!(date_regex.test($('#cntractStart'+(i+1)).val()))){
                         alert("Contract start date format should be mm/dd/yyyy on product model"+(i+1)+".");
                         bTest=1;
                         break;
                        }
                    }
                    else if($('#cntractRenew'+(i+1)).val()!=="")
                    {
                        if(!(date_regex.test($('#cntractRenew'+(i+1)).val()))){
                         alert("Contract renew date format should be mm/dd/yyyy on product model"+(i+1)+".");
                         bTest=1;
                         break;
                        }
                    }
                    else if($('#cntractEnd'+(i+1)).val()!=="")
                    {
                        if(!(date_regex.test($('#cntractEnd'+(i+1)).val()))){
                         alert("Contract end date format should be mm/dd/yyyy on product model"+(i+1)+".");
                         bTest=1;
                         break;
                        }
                    }

                    i++;
                }
                invoicestatus='Waiting for SIM';
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
                 invoicestatus='Waiting for SIM';
            }
            else if($('#invType').val()==="Service Renew"){
                if ($('#prodModel'+(i+1)).val()==="Blank"){
                    alert("Kindly select product model"+(i+1)+".");
                    bTest=1; 
                }
                else if($('#itemcounter').val()<2){
                    alert('Kindly add SIM to renew. Select SIM from the Products tab.');
                    bTest=1;
                }
                
                
                
                invoicestatus='Waiting for Service Renew';
            }
            if(bTest){

            }
            else{
                /*if($('#invType').val()==="Service Renew"){
                    var d=0;
                    var itemtorenewcount=$('#itemcounter').val()-1;
                    var arrproductmodelmaster=[];
                    while(d<itemtorenewcount){
                        
                        arrproductmodelmaster[d]=$('#selectedprodmodelnumber'+(d+1)).val();//reference product model id form product model master
                        
                        d++;
                    }
                    $.ajax({
                        url: "checkserviceplan.php",
                        type: "POST",
                        data: {
                            serviceplan:$('#serviceplannew option:selected').text(),
                            productmodel:arrproductmodelmaster
                        },
                        success: 
                            function(result){
                               if(result==='success'){
                                   runmodule();
                               } 
                               else{
                                   alert(result);
                               }
                            }

                    });
                }
                else{
                    runmodule();
                }
                function runmodule(){*/
  
                    $.ajax({
                        url: "addinvrecord.php",
                        type: "POST",
                        data: {

                            invNum:$('#invNum').val(),
                            frstInv:$('#searchcust').val(),
                            salesChannel:$('#salesChannel').val(),
                            customerPO:$('#customerPO').val(),
                            status: invoicestatus,
                            invType:$('#invType').val()

                        },
                        success: 
                            function(result){
                               
                                if(result === "success"){
                                    if($('#invType').val()==="Service Renew"){
                                        var arrproductmodel=[];
                                        var arrSIM=[];
                                        var arrIMEI=[];
                                        var arrproductmodelmaster=[];
                                        var d=0;
                                        var itemtorenewcount=$('#itemcounter').val()-1;
                                        while(d<itemtorenewcount){
                                           
                                            arrIMEI[d]=$('#tablerowimei'+(d+1)).text();
                                            arrSIM[d]=$('#tablerowsimnumber'+(d+1)).text();
                                            arrproductmodel[d]=$('#productmodelnumber'+(d+1)).val();//actual product model id
                                            arrproductmodelmaster[d]=$('#selectedprodmodelnumber'+(d+1)).val();//reference product model id form product model master
                                            d++;
                                        }
                                        d=0;
                                            $.ajax({
                                               url: "addprodrecord.php",
                                               type: "POST",
                                               data: {
                                                   invNum:$('#invNum').val(),
                                                   prodModel:arrproductmodel,
                                                   billcycle:$('#billcycle'+(d+1)).val(),
                                                   cntractStart:$('#cntractStart'+(d+1)).val(),
                                                   notes:$('#notes'+(d+1)).val(),
                                                   invType:$('#invType').val(),
                                                   simnumber:arrSIM,
                                                   productmodel:arrproductmodelmaster,
                                                   newbillcycle:$('#serviceplanbilling').val(),
                                                   newserviceplan:$('#serviceplannew').val(),
                                                   newrenewaldate:$('#serviceplanrenewdate').val(),
                                                   newenddate:$('#serviceplanenddate').val(),
                                                   imei:arrIMEI
                                               },
                                               success: 
                                                   function(result){
                                                
                                                      if(result === "success"){
                                                          $('#statuslabel').show();
                                                           $('#statuslabel').text("Product added to Invoice");
                                                           $('#statuslabel').fadeOut(8000);
                                                       }
                                                       else if(result.indexOf("failed")>-1){
                                                           $('#statuslabel').show();
                                                           $('#statuslabel').text("Error adding product.");
                                                           $('#statuslabel').fadeOut(8000);
                                                       }
                                                       else
                                                       {
                                                           $('#statuslabel').show();
                                                           $('#statuslabel').text("Service Renewal created.");
                                                            $('#statuslabel').fadeOut(8000);

                                                           
                                                       }

                                                   }
                                              });



                                    }
                                    else{
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
                                                       invType:$('#invType').val(),
                                                       simnumber:$('#lblsimnumber').text(),
                                                       productmodel:$('#selectedpmodelnum').val(),
                                                       newbillcycle:$('#serviceplanbilling').val(),
                                                       newserviceplan:$('#serviceplannew').val(),
                                                       newrenewaldate:$('#serviceplanrenewdate').val(),
                                                       newenddate:$('#serviceplanenddate').val(),
                                                       imei:$('#lblimei').text()
                                                   },
                                                   success: 
                                                       function(result){

                                                          if(result === "success"){
                                                              $('#statuslabel').show();
                                                               $('#statuslabel').text("Product added to Invoice");
                                                               $('#statuslabel').fadeOut(4000);
                                                               x++;
                                                               addproductmodels();

                                                           }
                                                           else if(result === "successsuccesssuccess"){
                                                               $('#statuslabel').show();
                                                               $('#statuslabel').text("Service Renewal created.");
                                                                $('#statuslabel').fadeOut(8000);
                                                           }
                                                           else
                                                           {

                                                               $('#statuslabel').show();
                                                               $('#statuslabel').text("Error adding product.");
                                                               $('#statuslabel').fadeOut(4000);
                                                           }

                                                       }
                                                  });
                                           }
                                        }
                                    }
                                }
                                else if(result==='exists')
                                {
                                    $('#statuslabel').show();
                                    $('#statuslabel').text("Invoice already exists.");
                                    $('#statuslabel').fadeOut(4000);
                                }
                                else
                                {
                                    $('#statuslabel').show();
                                    $('#statuslabel').text("Error creating invoice.");
                                    $('#statuslabel').fadeOut(4000);
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
//add product model in product model tab
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
//remove products in the product model tab.
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
//add product model elements
function addproductmodel(){
     var para = document.createElement("P");
     para.setAttribute("id","para"+(parseInt($('#productcount').val())+1));
     var prodmodel = "<label for=\"prodModel" + (parseInt($('#productcount').val())+1) + "\">Product Model:</label>";
     var selectprodmodel = "<select name=\"prodModel"+ (parseInt($('#productcount').val())+1) + "\" id=\"prodModel"+(parseInt($('#productcount').val())+1)+ "\" onchange=\"getserviceplan(this);\"><option value=\"Blank\"><--Select--></option>";  
     var selectoption="</select>";
     $('#tab2').append(para);
     $('#para'+(parseInt($('#productcount').val())+1)).append(prodmodel,selectprodmodel,selectoption);

     var paraQty = document.createElement("P");
     paraQty.setAttribute("id","paraQty"+(parseInt($('#productcount').val())+1));
     var lblQty = "<label for=\"qty"+(parseInt($('#productcount').val())+1)+"\">Quantity:</label>";
     var txtQty = "<input type=\"text\" name=\"qty"+ (parseInt($('#productcount').val())+1) + "\" id=\"qty"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
     $('#tab2').append(paraQty);
     $('#paraQty'+(parseInt($('#productcount').val())+1)).append(lblQty,txtQty);

     var paraQtyOfSim = document.createElement("P");
     paraQtyOfSim.setAttribute("id","paraQtyOfSim"+(parseInt($('#productcount').val())+1));
     var lblQtyOfSim = "<label for=\"qtysim"+(parseInt($('#productcount').val())+1)+"\">Quantity of SIM:</label>";
     var txtQtyOfSim = "<input type=\"text\" name=\"qtysim"+ (parseInt($('#productcount').val())+1) + "\" id=\"qtysim"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
     $('#tab2').append(paraQtyOfSim);
     $('#paraQtyOfSim'+(parseInt($('#productcount').val())+1)).append(lblQtyOfSim,txtQtyOfSim);

     var paraPlan = document.createElement("P");
     paraPlan.setAttribute("id","paraPlan"+(parseInt($('#productcount').val())+1));
     var lblPlan = "<label for=\"serviceplan"+(parseInt($('#productcount').val())+1)+"\">Service Plan:</label>";
     var txtPlan = "<select name=\"serviceplan"+ (parseInt($('#productcount').val())+1) + "\" id=\"serviceplan"+(parseInt($('#productcount').val())+1) +"\" ><option value=\"Blank\"><--Select--></option></select>";
     $('#tab2').append(paraPlan);
     $('#paraPlan'+(parseInt($('#productcount').val())+1)).append(lblPlan,txtPlan);

     var parabillcycle = document.createElement("P");
     parabillcycle.setAttribute("id","parabillcycle"+(parseInt($('#productcount').val())+1));
     var lblbillcycle = "<label for=\"billcycle"+(parseInt($('#productcount').val())+1)+"\">Laipac Billing Cycle:</label>";
     var txtbillcycle = "<input type=\"text\" name=\"billcycle"+ (parseInt($('#productcount').val())+1) + "\" id=\"billcycle"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
     $('#tab2').append(parabillcycle);
     $('#parabillcycle'+(parseInt($('#productcount').val())+1)).append(lblbillcycle,txtbillcycle);


     var paracntractStart = document.createElement("P");
     paracntractStart.setAttribute("id","paracntractStart"+(parseInt($('#productcount').val())+1));
     var lblcntractstart = "<label for=\"cntractStart"+(parseInt($('#productcount').val())+1)+"\">Initial Contract Start Date:</label>";
     var txtcntractstart = "<input type=\"text\" name=\"cntractStart"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractStart"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
     $('#tab2').append(paracntractStart);
     $('#paracntractStart'+(parseInt($('#productcount').val())+1)).append(lblcntractstart,txtcntractstart);
     $(function() {
         $("#cntractStart"+(parseInt($('#productcount').val())+1)).datepicker();
     });


     var paracntractRenew = document.createElement("P");
     paracntractRenew.setAttribute("id","paracntractRenew"+(parseInt($('#productcount').val())+1));
     var lblcntractrenew = "<label for=\"cntractRenew"+(parseInt($('#productcount').val())+1)+"\">Contract Renewal Date:</label>";
     var txtcntractrenew = "<input type=\"text\" name=\"cntractRenew"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractRenew"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
     $('#tab2').append(paracntractRenew);
     $('#paracntractRenew'+(parseInt($('#productcount').val())+1)).append(lblcntractrenew,txtcntractrenew);
     $(function() {
         $("#cntractRenew"+(parseInt($('#productcount').val())+1)).datepicker();
     });


     var paracntractEnd = document.createElement("P");
     paracntractEnd.setAttribute("id","paracntractEnd"+(parseInt($('#productcount').val())+1));
     var lblcntractend = "<label for=\"cntractEnd"+(parseInt($('#productcount').val())+1)+"\">Contract Ending Date:</label>";
     var txtcntractend = "<input type=\"text\" name=\"cntractEnd"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractEnd"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
     $('#tab2').append(paracntractEnd);
     $('#paracntractEnd'+(parseInt($('#productcount').val())+1)).append(lblcntractend,txtcntractend);
     $(function() {
         $("#cntractEnd"+(parseInt($('#productcount').val())+1)).datepicker();
     });
     var paranotes = document.createElement("P");
     paranotes.setAttribute("id","paranotes"+(parseInt($('#productcount').val())+1));
     var lblnotes = "<label for=\"notes"+(parseInt($('#productcount').val())+1)+"\">Notes:</label>";
     var txtnotes = "<textarea name=\"notes"+ (parseInt($('#productcount').val())+1) + "\" id=\"notes"+(parseInt($('#productcount').val())+1) +"\" rows=\"5\" /></textarea><hr></hr>";
     $('#tab2').append(paranotes);
     $('#paranotes'+(parseInt($('#productcount').val())+1)).append(lblnotes,txtnotes);

     $.ajax({
         url: 'getallproducts.php',
         type: 'POST',
         data: {
             invType:$('#invType').val(),
             customer:$('#searchcust').val()
         },
         success: function(data) {

              $("#prodModel"+(parseInt($('#productcount').val())+1)).empty();
             $("#prodModel"+(parseInt($('#productcount').val())+1)).append(data);
                $('#productcount').val(parseInt($('#productcount').val())+1);
         }

     });

     $('#tab2').append($('#btnaddproduct'));
}
//add product model special case for invoice type service renew.
function addproductmodelrenew(){
    var para = document.createElement("P");
    para.setAttribute("id","para"+(parseInt($('#productcount').val())+1));
    var prodmodel = "<label for=\"prodModel" + (parseInt($('#productcount').val())+1) + "\">Product Model:</label>";
    var selectprodmodel = "<select name=\"prodModel"+ (parseInt($('#productcount').val())+1) + "\" id=\"prodModel"+(parseInt($('#productcount').val())+1)+ "\" onchange=\"getserviceplan(this);\"><option value=\"Blank\"><--Select--></option>";  
    var selectoption="</select>";
    $('#tab2').append(para);
    $('#para'+(parseInt($('#productcount').val())+1)).append(prodmodel,selectprodmodel,selectoption);

    var paraQty = document.createElement("P");
    paraQty.setAttribute("id","paraQty"+(parseInt($('#productcount').val())+1));
    var lblQty = "<label for=\"qty"+(parseInt($('#productcount').val())+1)+"\">Quantity:</label>";
    var txtQty = "<input type=\"text\" name=\"qty"+ (parseInt($('#productcount').val())+1) + "\" id=\"qty"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
    $('#tab2').append(paraQty);
    $('#paraQty'+(parseInt($('#productcount').val())+1)).append(lblQty,txtQty);

    var paraQtyOfSim = document.createElement("P");
    paraQtyOfSim.setAttribute("id","paraQtyOfSim"+(parseInt($('#productcount').val())+1));
    var lblQtyOfSim = "<label for=\"qtysim"+(parseInt($('#productcount').val())+1)+"\">Quantity of SIM:</label>";
    var txtQtyOfSim = "<input type=\"text\" name=\"qtysim"+ (parseInt($('#productcount').val())+1) + "\" id=\"qtysim"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
    $('#tab2').append(paraQtyOfSim);
    $('#paraQtyOfSim'+(parseInt($('#productcount').val())+1)).append(lblQtyOfSim,txtQtyOfSim);

    var paraPlan = document.createElement("P");
    paraPlan.setAttribute("id","paraPlan"+(parseInt($('#productcount').val())+1));
    var lblPlan = "<label for=\"serviceplan"+(parseInt($('#productcount').val())+1)+"\">Service Plan:</label>";
    var txtPlan = "<select name=\"serviceplan"+ (parseInt($('#productcount').val())+1) + "\" id=\"serviceplan"+(parseInt($('#productcount').val())+1) +"\" ><option value=\"Blank\"><--Select--></option></select>";
    $('#tab2').append(paraPlan);
    $('#paraPlan'+(parseInt($('#productcount').val())+1)).append(lblPlan,txtPlan);

    var parabillcycle = document.createElement("P");
    parabillcycle.setAttribute("id","parabillcycle"+(parseInt($('#productcount').val())+1));
    var lblbillcycle = "<label for=\"billcycle"+(parseInt($('#productcount').val())+1)+"\">Laipac Billing Cycle:</label>";
    var txtbillcycle = "<input type=\"text\" name=\"billcycle"+ (parseInt($('#productcount').val())+1) + "\" id=\"billcycle"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
    $('#tab2').append(parabillcycle);
    $('#parabillcycle'+(parseInt($('#productcount').val())+1)).append(lblbillcycle,txtbillcycle);


    var paracntractStart = document.createElement("P");
    paracntractStart.setAttribute("id","paracntractStart"+(parseInt($('#productcount').val())+1));
    var lblcntractstart = "<label for=\"cntractStart"+(parseInt($('#productcount').val())+1)+"\">Initial Contract Start Date:</label>";
    var txtcntractstart = "<input type=\"text\" name=\"cntractStart"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractStart"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
    $('#tab2').append(paracntractStart);
    $('#paracntractStart'+(parseInt($('#productcount').val())+1)).append(lblcntractstart,txtcntractstart);
    $(function() {
        $("#cntractStart"+(parseInt($('#productcount').val())+1)).datepicker();
    });


    var paracntractRenew = document.createElement("P");
    paracntractRenew.setAttribute("id","paracntractRenew"+(parseInt($('#productcount').val())+1));
    var lblcntractrenew = "<label for=\"cntractRenew"+(parseInt($('#productcount').val())+1)+"\">Contract Renewal Date:</label>";
    var txtcntractrenew = "<input type=\"text\" name=\"cntractRenew"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractRenew"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
    $('#tab2').append(paracntractRenew);
    $('#paracntractRenew'+(parseInt($('#productcount').val())+1)).append(lblcntractrenew,txtcntractrenew);
    $(function() {
        $("#cntractRenew"+(parseInt($('#productcount').val())+1)).datepicker();
    });


    var paracntractEnd = document.createElement("P");
    paracntractEnd.setAttribute("id","paracntractEnd"+(parseInt($('#productcount').val())+1));
    var lblcntractend = "<label for=\"cntractEnd"+(parseInt($('#productcount').val())+1)+"\">Contract Ending Date:</label>";
    var txtcntractend = "<input type=\"text\" name=\"cntractEnd"+ (parseInt($('#productcount').val())+1) + "\" id=\"cntractEnd"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
    $('#tab2').append(paracntractEnd);
    $('#paracntractEnd'+(parseInt($('#productcount').val())+1)).append(lblcntractend,txtcntractend);
    $(function() {
        $("#cntractEnd"+(parseInt($('#productcount').val())+1)).datepicker();
    });
    var paranotes = document.createElement("P");
    paranotes.setAttribute("id","paranotes"+(parseInt($('#productcount').val())+1));
    var lblnotes = "<label for=\"notes"+(parseInt($('#productcount').val())+1)+"\">Notes:</label>";
    var txtnotes = "<textarea name=\"notes"+ (parseInt($('#productcount').val())+1) + "\" id=\"notes"+(parseInt($('#productcount').val())+1) +"\" rows=\"5\" /></textarea><hr></hr>";
    $('#tab2').append(paranotes);
    $('#paranotes'+(parseInt($('#productcount').val())+1)).append(lblnotes,txtnotes);

    $.ajax({
        url: 'getallproductsrenew.php',
        type: 'POST',
        data: {
            invType:"Service Assigned",
            customer:$('#searchcust').val()
        },
        success: function(data) {
          
             $("#prodModel"+(parseInt($('#productcount').val())+1)).empty();
            $("#prodModel"+(parseInt($('#productcount').val())+1)).append(data);
               $('#productcount').val(parseInt($('#productcount').val())+1);
                $.ajax({
                    url: 'setsearchprodrenew.php',
                    type: 'POST',
                    data: {
                        invType:"Service Assigned",
                        customer:$('#searchcust').val()
                    },
                    success: function(data) {

                        $('#searchproductmodel').empty();
                        $('#searchproductmodel').append(data);
                                /*
                         $.ajax({
                            url: 'setsearchsplanrenew.php',
                            type: 'POST',
                            data: {
                                invType:"Service Assigned",
                                customer:$('#searchcust').val()
                            },
                            success: function(data) {
                               
                                $('#searchserviceplan').empty();
                                $('#searchserviceplan').append(data);



                            }

                        });*/

                    }

                });
            
        }

    });
    $('#btnaddproduct').empty();
}
// add product model elements for invoice type sim
function addsim(){

         var para = document.createElement("P");
         para.setAttribute("id","para"+(parseInt($('#productcount').val())+1));
         var prodmodel = "<label for=\"prodModel" + (parseInt($('#productcount').val())+1) + "\">Product Model:</label>";
         var selectprodmodel = "<select name=\"prodModel"+ (parseInt($('#productcount').val())+1) + "\" id=\"prodModel"+(parseInt($('#productcount').val())+1)+ "\" onchange=\"getserviceplan(this);\"><option value=\"Blank\"><--SELECT--></option>";  
         var selectoption="</select>";
         $('#tab2').append(para);
         $('#para'+(parseInt($('#productcount').val())+1)).append(prodmodel,selectprodmodel,selectoption);

         var paraQtyOfSim = document.createElement("P");
         paraQtyOfSim.setAttribute("id","paraQtyOfSim"+(parseInt($('#productcount').val())+1));
         var lblQtyOfSim = "<label for=\"qtysim"+(parseInt($('#productcount').val())+1)+"\">Quantity of SIM:</label>";
         var txtQtyOfSim = "<input type=\"text\" name=\"qtysim"+ (parseInt($('#productcount').val())+1) + "\" id=\"qtysim"+(parseInt($('#productcount').val())+1) +"\" value=\"\" />";
         $('#tab2').append(paraQtyOfSim);
         $('#paraQtyOfSim'+(parseInt($('#productcount').val())+1)).append(lblQtyOfSim,txtQtyOfSim);

         var paraPlan = document.createElement("P");
         paraPlan.setAttribute("id","paraPlan"+(parseInt($('#productcount').val())+1));
         var lblPlan = "<label for=\"serviceplan"+(parseInt($('#productcount').val())+1)+"\">Service Plan:</label>";
         var txtPlan = "<select name=\"serviceplan"+ (parseInt($('#productcount').val())+1) + "\" id=\"serviceplan"+(parseInt($('#productcount').val())+1) +"\" ><option value=\"Blank\"><--Select--></option></select>";
         $('#tab2').append(paraPlan);
         $('#paraPlan'+(parseInt($('#productcount').val())+1)).append(lblPlan,txtPlan);

         var paranotes = document.createElement("P");
         paranotes.setAttribute("id","paranotes"+(parseInt($('#productcount').val())+1));
         var lblnotes = "<label for=\"notes"+(parseInt($('#productcount').val())+1)+"\">Notes:</label>";
         var txtnotes = "<textarea name=\"notes"+ (parseInt($('#productcount').val())+1) + "\" id=\"notes"+(parseInt($('#productcount').val())+1) +"\" rows=\"5\" /></textarea><hr></hr>";
         $('#tab2').append(paranotes);
         $('#paranotes'+(parseInt($('#productcount').val())+1)).append(lblnotes,txtnotes);

          $.ajax({
             url: 'getallproducts.php',
             type: 'POST',
             data: {
                 invType:$('#invType').val(),
                 customer:$('#searchcust').val()
             },
             success: function(data) {
                 $("#prodModel"+(parseInt($('#productcount').val())+1)).empty();
                 $("#prodModel"+(parseInt($('#productcount').val())+1)).append(data);
                 $('#productcount').val(parseInt($('#productcount').val())+1);

             }

         });

         $('#tab2').append($('#btnaddproduct'));
}
           function setproductdetails(invoicetype){
              if(parseInt($('#productcount').val()) > 1){
                  var i = parseInt($('#productcount').val());
                  if(invoicetype.value==="SIM"){
                      
                      while(i>0){
                        $('#paranotes'+i).remove();
                     
                        $('#paracntractEnd'+i).remove();
                        $('#paracntractRenew'+i).remove();
                        $('#paracntractStart'+i).remove();
                        $('#parabillcycle'+i).remove();
                        $('#paraPlan'+i).remove();
                        $('#paraQtyOfSim'+i).remove();
                        $('#paraQty'+i).remove();
                        $('#para'+i).remove();
                          i--;
                      }
                      $('#productcount').val("0");
                      $('hr').remove();
                       $('#listproducts').hide();
                       $('#btnaddproduct').show();
                       addsim();
                       $('#paraproductmodelrenew').hide();
                       $('#para1').show();
                        $('#searchcriteria').hide();
                        $('#productstoadd').hide();
                       
                  }
                  else if(invoicetype.value === "Product, SIM and Service"){
                      while(i>0){
                        $('#paranotes'+i).remove();
                        $('#paracntractEnd'+i).remove();
                        $('#paracntractRenew'+i).remove();
                        $('#paracntractStart'+i).remove();
                        $('#parabillcycle'+i).remove();
                        $('#paraPlan'+i).remove();
                        $('#paraQtyOfSim'+i).remove();
                        $('#paraQty'+i).remove();
                        $('#para'+i).remove();
                        i--;
                      }
                      $('#productcount').val("0");
                      $('hr').remove();
                      $('#listproducts').hide();
                      addproductmodel();
                      $('#btnaddproduct').show();
                       $('#paraproductmodelrenew').hide();
                       $('#para1').show();
                        $('#searchcriteria').hide();
                         $('#productstoadd').hide();
                  }
                  else if(invoicetype.value === "Service Renew"){
                        while(i>0){
                        $('#paranotes'+i).remove();
                        $('#paracntractEnd'+i).remove();
                        $('#paracntractRenew'+i).remove();
                        $('#paracntractStart'+i).remove();
                        $('#parabillcycle'+i).remove();
                        $('#paraPlan'+i).remove();
                        $('#paraQtyOfSim'+i).remove();
                        $('#paraQty'+i).remove();
                        $('#para'+i).remove();
                        i--;
                      }
                      $('#productcount').val("0");
                      $('hr').remove();
                      $('#listproducts').show();
                       addproductmodelrenew();
                      $('#btnaddproduct').show();
                      $('#paraproductmodelrenew').hide();
                       $('#para1').show();
                       $('#searchcriteria').show();
                        $('#productstoadd').show();
                  }
              }
              else{
                  if(invoicetype.value==="SIM"){
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
                    $('#searchcriteria').hide();
                    $('#productstoadd').hide();
                  }
                  else if(invoicetype.value === "Product, SIM and Service"){
                      
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
                    $('#searchcriteria').hide();
                    $('#productstoadd').hide();
                  }
                  else if(invoicetype.value === "Service Renew"){
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
                     addproductmodelrenew();
                       $('#btnaddproduct').show();
                       $('#paraproductmodelrenew').hide();
                       $('#para1').show();
                        $('#searchcriteria').show();
                        $('#productstoadd').show();
                  }
                  else{
                      alert("Select an invoice type.");
                  } 
              }
           }
        function setrenewal(productmodelid){
            $('#tablesims').hide();
           // alert($('#tablecellsimnumber'+productmodelid).text());
           // alert($('#selectedpmodelnum').val());
            
            $('#lblproductmodel').text("Product Model:"+$('#selectedpmodelname').val());
            $('#lblsimnumber').text("SIM number:"+$('#tablecellsimnumber'+productmodelid).text());
            $('#lblimei').text("IMEI:"+$('#tablecellimei'+productmodelid).text());
           $('#pararenewalbuttons').show();
            $('#pararenewserviceplan').show();
            $('#pararenewserviceplanbilling').show();
            $('#pararenewserviceplanrenewdate').show();
            $('#pararenewserviceplanenddate').show();
            $('#parastatuses').show();
        }
function setdates(){
    var i;
    i=0;
//    alert($('#totaldevices').val());
var totalsim = $('#totaldevices').val();
    while(i<totalsim){
        if($('#productmodelname'+(i+1)).prop('checked')){
            $('#tablesimsrenew').append('<div class="tablerow" id=productmodelrow'+(parseInt($('#itemcounter').val()))+'>'+$('#tableproductrow'+(i+1)).html()+'</div>');

            $('#tableproductrow'+(i+1)).remove();
            $('#tablecellimei'+(i+1)).prop('id','tablerowimei'+(parseInt($('#itemcounter').val())));
            $('#tablecellsimnumber'+(i+1)).prop('id','tablerowsimnumber'+(parseInt($('#itemcounter').val())));
            $('#tablerowproductmodel'+(i+1)).empty();
            $('#tablerowproductmodel'+(i+1)).append('<p>'+$('#selectedpmodelname'+(i+1)).val()+'</p>');
            $('#tablerowproductmodel'+(i+1)).prop('id','tablerowprodmodel'+(parseInt($('#itemcounter').val())));
            $('#selectedpmodelname'+(i+1)).prop('id','selectedproductmodelname'+(parseInt($('#itemcounter').val())));
            $('#selectedpmodelnum'+(i+1)).prop('id','selectedprodmodelnumber'+(parseInt($('#itemcounter').val())));
            $('#productmodelrow'+(parseInt($('#itemcounter').val()))).append('<input type="hidden" id="productmodelnumber'+(parseInt($('#itemcounter').val()))+'" value="'+$('#prodModel1').val()+'"></input>');
            $('#productmodelrow'+(parseInt($('#itemcounter').val()))).prepend('<div id="tabletoadd'+ (parseInt($('#itemcounter').val())) +'" class="tablecellsim"><p><input type="checkbox" id="productmodelcheckbox' + (parseInt($('#itemcounter').val())) + '" value="' + (parseInt($('#itemcounter').val())) + '"> </input></p></div>');

            $('#itemcounter').val(parseInt($('#itemcounter').val())+1);

            $('#totaldevices').val(parseInt($('#totaldevices').val())-1);

        }
        i++;
    }
    var new_number = 1;
    $("div[id^='tableproductrow']").each(function() {

        this.id="tableproductrow"+new_number;
         new_number++;
    });
    new_number = 1;
    $("input[id^='selectedpmodelnum']").each(function() {
        this.id="selectedpmodelnum"+new_number;
         new_number++;
    });

    new_number = 1;
    $("input[id^='selectedpmodelname']").each(function() {
        this.id="selectedpmodelname"+new_number;
         new_number++;
    });
    new_number = 1;
    $("div[id^='tablerowproductmodel']").each(function() {
        this.id="tablerowproductmodel"+new_number;
         new_number++;
    });
    new_number = 1;
    $("input[id^='productmodelname']").each(function() {
        this.id="productmodelname"+new_number;
         new_number++;
    });

    new_number = 1;
    $("div[id^='tablecellimei']").each(function() {
        this.id="tablecellimei"+new_number;
         new_number++;
    });
    new_number = 1;
    $("div[id^='tablecellsimnumber']").each(function() {
        this.id="tablecellsimnumber"+new_number;
         new_number++;
    });
}
function removedates(){
   var i,totalsim;
   i=1;
   totalsim = $('#itemcounter').val();
   while(i< totalsim){
       if($('#productmodelcheckbox'+i).prop('checked')){

           if($('#productmodelnumber'+i).val()===$('#prodModel1').val()){

               $('#totaldevices').val(parseInt($('#totaldevices').val())+1);
               $('#tablesims').append('<div class="tablerow" id=tableproductrow'+(parseInt($('#totaldevices').val()))+'>'+$('#productmodelrow'+(i)).html()+'</div>');
               //$('#tableproductrow'+(parseInt($('#totaldevices').val()))).append('<input type="hidden" id="selectedpmodelname'+(parseInt($('#totaldevices').val()))+'" value="'+$('#selectedproductmodelname'+i).val() +'"></input>');
               $('#selectedproductmodelname'+(i)).prop('id','selectedpmodelname'+(parseInt($('#totaldevices').val())));
               $('#selectedprodmodelnumber'+(i)).prop('id','selectedpmodelnum'+(parseInt($('#totaldevices').val())));
               $('#tablerowprodmodel'+i).remove();
             //  $('#productmodelcheckbox'+i).prop('id','productmodelname'+(parseInt($('#totaldevices').val())));
               $('#tabletoadd'+i).empty();
               $('#tabletoadd'+i).prop('id','tablerowproductmodel'+(parseInt($('#totaldevices').val())));
               $('#tablerowproductmodel'+(parseInt($('#totaldevices').val()))).append('<p><input type="checkbox" id="productmodelname' + (parseInt($('#totaldevices').val())) + '" value="' + (parseInt($('#totaldevices').val())) + '"> </input></p>');


               $('#productmodelname'+i).val(parseInt($('#totaldevices').val()));
               $('#tablerowimei'+i).prop('id','tablecellimei'+(parseInt($('#totaldevices').val())));
               $('#tablerowsimnumber'+i).prop('id','tablecellsimnumber'+(parseInt($('#totaldevices').val())));
               $('#productmodelnumber'+i).remove();
           }
           $('#productmodelrow'+i).remove();
           $('#itemcounter').val(parseInt($('#itemcounter').val())-1);
       }
        i++;
   }
   var new_number = 1;
    $("div[id^='productmodelrow']").each(function() {
        this.id="productmodelrow"+new_number;
         new_number++;
    });
    new_number = 1;
    $("div[id^='tabletoadd']").each(function() {
        this.id="tabletoadd"+new_number;
         new_number++;
    });
    new_number = 1;
    $("input[id^='selectedprodmodelnumber']").each(function() {
        this.id="selectedprodmodelnumber"+new_number;
         new_number++;
    });
    new_number = 1;
    $("input[id^='selectedproductmodelname']").each(function() {
        this.id="selectedproductmodelname"+new_number;
         new_number++;
    });
    new_number = 1;
    $("input[id^='productmodelcheckbox']").each(function() {
        this.id="productmodelcheckbox"+new_number;
         new_number++;
    });
    new_number = 1;
    $("div[id^='tablerowprodmodel']").each(function() {
        this.id="tablerowprodmodel"+new_number;
         new_number++;
    });
    new_number = 1;
    $("div[id^='tablerowimei']").each(function() {
        this.id="tablerowimei"+new_number;
         new_number++;
    });
    new_number = 1;
    $("div[id^='tablerowsimnumber']").each(function() {
        this.id="tablerowsimnumber"+new_number;
         new_number++;
    });
    new_number = 1;
    $("input[id^='productmodelnumber']").each(function() {
        this.id="productmodelnumber"+new_number;
         new_number++;
    });

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
                              $('#statuslabelrenew').show();
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
function resetcustomer(){
    $('#invType').val("Blank");
    $('#salesChannel').val("Blank");
    $('#invNum').val("");
    $('#customerPO').val("");
}
function searchrenewproductmodels(){
   if($('#searchcust').val()==='Blank'){
       alert("Kindly select a customer");
   }
   else if ($('#salesChannel').val()==="Blank"){
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
    else{
         $.ajax({
            url: 'searchproductmodelsrenew.php',
            type: 'POST',
            data: {
                frstInv:$('#searchcust').val(),
                serviceplan:$('#searchserviceplan').val(),
                productmodel:$('#searchproductmodel').val(),
                billingcycle:$('#searchbillingcycle').val(),
                cntractRenewFrom:$('#searchrenewaldatefrom').val(),
                cntractRenewTo:$('#searchrenewaldateto').val(),
                cntractEndingFrom:$('#searchendingdatefrom').val(),
                cntractEndingTo:$('#searchendingdateto').val()
                
            },
            success: function(data) {
                if(data==="none"){
                    $('#searchstatuslabel').show();
                    $('#searchstatuslabel').text("No product models found.");
                    $('#searchstatuslabel').fadeOut(6000);
                }
                else if(data==="failed"){
                    $('#searchstatuslabel').show();
                    $('#searchstatuslabel').text("Error running query.");
                    $('#searchstatuslabel').fadeOut(6000);
                }
                else{
                    $('#prodModel1').empty();
                    $('#prodModel1').append(data);
                      $('#searchstatuslabel').show();
                    $('#searchstatuslabel').text("Product models in the product model tab.");
                    $('#searchstatuslabel').fadeOut(6000);
               
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
                        <h2 class="icon icon-world">Invoice Management</h2>
                        <ul>
                            <li class="icon icon-arrow-left"  style="background-color:aqua;">
                                <a class="icon icon-display" href="addinvoice.php">Add</a>
                              
                            </li>
                        </ul>
                        <ul>
                            <li class="icon icon-arrow-left">
                                <a class="icon icon-display" href="editinvoice.php">Edit</a>
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
                                                <input type="button" value="Submit" id="btnSubmit" onclick="addproduct(this);"></input>
                                               
                                                <input type="button" value="Exit" onclick="location.href='menu.php';"></input>
                                             </p>
                                        
                                        <div class="tabs">
                                             <p><label id="statuslabel" style='color:lightgreen;font-weight: bold;'></label></p>
                                            <ul class="tab-links">
                                                <li class="active"><a href="#tab1">Invoice</a></li>
                                                <li id="searchcriteria" style="display:none;"><a href="#tab4">Search</a></li>
                                                <li><a href="#tab2">Product Model</a></li>
                                                <li id="listproducts" style="display:none;"><a href="#tab3">Products</a></li>
                                                 <li id="productstoadd" style="display:none;"><a href="#tab5">For Renewal</a></li>
                                            </ul>
                                           
                                            <div class="tab-content">
                                                <div id="tab1" class="tab active">

                                                    <p> 
                                                        <label for="searchcust">Customer:
                                                        </label>
                                                        
                                                        <select name="searchcust" id="searchcust" onchange="resetcustomer();">
                                                           <option value="Blank"><--Select--></option>
                                                          <?php 
                                                          $sql= $conn->prepare('SELECT cmpnyName,frstinv FROM customers');
                                                          $sql->execute();
                                                          $sql->bind_result($companyname,$customernumber);
                                                          while($sql->fetch()){
                                                          ?>
                                                               <option value="<?php echo $customernumber ?>"><?php echo $companyname ?></option>  
                                                          <?php
                                                          }
                                                          ?>
                                                        </select>  
                                                    </p>
                                                     <p> <label for="invType">Invoice Type:</label>
                                                         <select name="invType" id="invType" onchange="setproductdetails(this);">
                                                             <option value="Blank"><--Select--></option>
                                                             <option value="Product, SIM and Service">Product, SIM and Service</option>
                                                             <option value="SIM">SIM</option>
                                                             <option value="Service Renew">Service Renew</option>
                                                         </select>   
                                                    </p>
                                                    <p> <label for="salesChannel">Sales Channel: </label>
                                                      <select name="salesChannel" id="salesChannel" >
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
                                                    <p> <label for="invNum">Invoice#: </label>
                                                        <input type="text" name="invNum" id="invNum" value=""/>
                                                    </p>

                                                    <p> <label for="customerPO">Customer's PO#: </label>
                                                        <input type="text" name="customerPO" id="customerPO" value=""/>
                                                    </p>
                                                   
                                                    <p> <label for="status">Status:</label>
                                                            <input type="text" name="status" id="status" value="New" readonly class="noedit"/>
                                                    </p>
                                                      
                                                    
                                                    
                                                </div>
                                                <div id="tab4" class="tab">
                                                     <p> <label for="searchproductmodel">Product Model:  </label>
                                                        <select name="searchproductmodel" id="searchproductmodel">
                                                           <option value="Blank"><--Select--></option>
                                                          
                                                        </select>   
                                                    </p>
                                                    <p> <label for="searchserviceplan">Service Plan:  </label>
                                                        <select name="searchserviceplan" id="searchserviceplan">
                                                           <option value="Blank"><--Select--></option>
                                                        </select>   
                                                    </p>
                                                    <p> <label for="searchbillingcycle">Billing Cycle:  </label>
                                                        <input type="text" id="searchbillingcycle" value=""></input>
                                                           
                                                    </p>
                                                    <p>
                                                        <label>Contract Renewal Date</label>
                                                    </p>
                                                    <div style="width: 45%; float:left;">
                                                        <p> <label for="searchrenewaldatefrom">From:  </label>
                                                            <input type="text" id="searchrenewaldatefrom" value=""></input>
                                                              
                                                        </p>
                                                    </div>
                                                    <div style="width: 45%; float:left;">
                                                        <p> <label for="searchrenewaldateto">To:  </label>
                                                            <input type="text" id="searchrenewaldateto" value=""></input>
                                                              
                                                        </p>
                                                    </div>
                                                    <p>
                                                        <label>Contract Ending Date</label>
                                                    </p>
                                                    <div style="width: 45%; float:left;">
                                                        <p> <label for="searchendingdatefrom">From:  </label>
                                                            <input type="text" id="searchendingdatefrom" value=""></input>
                                                              
                                                        </p>
                                                    </div>
                                                    <div style="width: 45%; float:left;">
                                                        <p> <label for="searchendingdateto">To:  </label>
                                                            <input type="text" id="searchendingdateto" value=""></input>
                                                              
                                                        </p>
                                                    </div>
                                                    <p style="color:red;">
                                                        <label id="searchstatuslabel"></label>
                                                    </p>
                                                    <input type="button" value="Search" onclick="searchrenewproductmodels();"></input>
                                                </div>
                                                <div id="tab2" class="tab">                                                   
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
                                                    <p id="paraQty1">  <label for="qty1">Quantity:</label>  <input type="text" name="qty1" id="qty1" value="" /></p>
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
                                                    <p id="btnaddproduct">
                                                        <input type="button" value="Add Product" onclick="addproducts();"></input>
                                                        <input type="button" value="Remove" onclick="removeproducts();"></input>
                                                    </p>
                                                </div>
                                                <div id="tab3" class="tab">
                                                    
                                                </div>
                                                <div id="tab5" class="tab">
                                                    <div id="tablesimsrenew" class="tablelayout">
                                                        <div class="tableheading">
                                                            <div class="tablecellsim"><p>Select</p></div>
                                                            <div class="tablecellsim"><p>Product Model</p></div>
                                                            <div class="tablecellsim"><p>Locator ID</p></div>
                                                            <div class="tablecellsim"><p>IMEI</p></div>
                                                            <div class="tablecellsim"><p>SIM Number</p></div>
                                                            <div class="tablecellsim"><p>Activation Status</p></div>
                                                            <div class="tablecellsim"><p>Provider</p></div>
                                                            <div class="tablecellsim"><p>Service Plan</p></div>
                                                            <div class="tablecellsim"><p>Billing Cycle</p></div>
                                                            <div class="tablecellsim"><p>Renewal Date</p></div>
                                                            <div class="tablecellsim"><p>End Date</p></div>
                                                            <div class="tablecellsim"><p>Locator Name</p></div>
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                    <p>
                                                        <input type="button" value="Remove" onclick="removedates()"></input>
                                                    </p>
                                                     <p id="pararenewserviceplan" >
                                                        <label for="serviceplannew">Service Plan:</label>
                                                        <select name="serviceplannew" id="serviceplannew">
                                                            <option value="Blank"><--Select--></option>
                                                            <?php 
                                                            $sql61= $conn->prepare('SELECT planid,plantype FROM serviceplan');
                                                            $sql61->execute();
                                                            $sql61->bind_result($channelid,$channelname);
                                                            while($sql61->fetch()){
                                                            ?>
                                                                 <option value="<?php echo $channelid ?>"><?php echo $channelname ?></option>  
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        </p>
                                                        <p id="pararenewserviceplanbilling" >
                                                        <label for="serviceplanbilling">Billing Cycle:</label>
                                                        <input type="text" id="serviceplanbilling" value="" />
                                                        </p>
                                                        <p id="pararenewserviceplanrenewdate" >
                                                        <label for="serviceplanrenewdate">Renewal Date:</label>
                                                        <input type="text" id="serviceplanrenewdate" value="" />
                                                        </p>
                                                        <p id="pararenewserviceplanenddate" >
                                                        <label for="serviceplanenddate">Ending Date:</label>
                                                        <input type="text" id="serviceplanenddate" value="" />
                                                        </p>
                                                </div>
                                            </div>
                                        </div>                                                                     
                                </div>
                        
                </div><!-- /scroller-inner -->
            </div><!-- /scroller -->
        </div>
        <input type="hidden" id="itemcounter" value="1" />
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
