function checkuncheck()
{
	
	var checkbox = document.getElementById('randompassword');
	var password = document.getElementById('password');
	var jobValue = document.getElementById('txtname');
	if(checkbox.checked==true){
		var myval = "@123";
		password.value=document.getElementById('name').value+myval;
	}
	else{
		            	password.value="";

	}
}

//clientvalidation
	
$(function() {
	$("form[name='client']").validate({
		rules: {
			company_name:'required',
			website :{	
				required: true,
				url: true
			},
			name: "required",
			mobile:
					{	
						required:true,
						digits: true,
						minlength:10,
						maxlength:10
					},
			email:{	
				required:true,
				email: true
			},
			password:{	required: true,
						minlength: 6
					}
	 	},
	 	messages:
		{
			mobile : "Enter 10 digit Number",
			
		},		
		submitHandler: function(form) {
		form.submit();}
	});
});

//client list
jQuery(document).ready(function() {
	if(controllerName == 'clients' && (functionName == 'index' || functionName == '')){
		var oTable = jQuery('#clients').DataTable({
			'bRetrieve': true,
	        "bPaginate": true,
	        "bLengthChange": true,
	        "iDisplayLength": 10,
	        "bFilter": true,
	        "bSort": true,
	        "aaSorting": [],
	        "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000, 5000], [10, 25, 50, 100, 200, 500, 1000, 5000]],
	        "bInfo": true,
	        "bAutoWidth": false,
	        "bProcessing": true,
	        "aoColumns": [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"Clients/client_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Leads found<br/><br/></center>', "sZeroRecords": "<center><br/>No Leads found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
					aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
					aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
					aoData.push( { "name": "status", "value": $('#status').val() } );
					aoData.push( { "name": "clientname", "value": $('#clientname').val() } );
					
			
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#clients').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Clients</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Clients</small>)';
	                    }
	                    
	                    fnCallback(json);
	                }
	            });
        	},
        	"fnRowCallback": function( nRow, aData, iDisplayIndex ){
                return nRow;
	        },
	        "fnDrawCallback": function(oSettings, json) {

	        },
		});

		$('#btnApplyClients').click(function(){ //button filter event click
	
			var oTable = $('#clients').DataTable();
			oTable.draw();
		});
	}
});



$('#reset-filters').click(function(){ 
	jQuery('#startdate').val('');
	jQuery('#enddate').val('');
	jQuery('#status').val('all');
	jQuery('#clientname').val('');
	jQuery('#ticket-filters').after('<p style="color:#00B200"><b>Succesfully Reset Filters</b></p>');
	var oTable = $('#clients').DataTable();
	oTable.draw();
});
				
//delete clients
function deleteclients(clientid){
		var url = base_url+"Clients/deleteclient";
		swal({
		 title: "Are you sure?",
		 text: "You will not be able to recover this imaginary file!",
		 type: "warning",
		 showCancelButton: true,
		 confirmButtonColor: "#DD6B55",
		 confirmButtonText: "Yes, delete it!",
		 closeOnConfirm: false
		},
	function(isConfirm){
	if (isConfirm) {
		   $.ajax({
			   url: url,
			   type: "POST",
			   dataType: "JSON",
			   data: {clientid:clientid},
			  dataType: "html",
			  
			   success: function (data) {
				   swal("Done!", "It was succesfully deleted!", "success");
				   $('#clients').DataTable().ajax.reload();

				   //$("#leads").fnReloadAjax();
					//$('#leads').DataTable.ajax.reload(null,false);
					//window.location.reload();
			   },
			   error: function (xhr, ajaxOptions, thrownError) {
				   swal("Error deleting!", "Please try again", "error");
			   }
		   });
	   }
	   });
}
//datepicker	
$(document).ready(function(){
  	$("#startdate").datepicker({
			 dateFormat: 'Y-m-d'
	   });
		
		$("#enddate").datepicker({
	  		 dateFormat: 'Y-m-d'
	 	});
		
});

//count amount

function countamount(counter){
    var f1 = $('#quantity'+counter).val();
	var f2 = $('#cost_per_item'+counter).val();
	var mul = eval(f1)*eval(f2);
	$('#amount'+counter).val(mul);
	totalamount();
}		

function counttax(counter){
	var f3 = $('#taxes'+counter).val();
	
	if(f3 != ''){
		var f = $('#amount'+counter).val();
		var amount=eval(f);
		var fa=(eval(amount)*eval(f3))/100;
		var finalamount =eval(amount)+eval(fa);
		$('#amount'+counter).val(eval(finalamount));
	}
	totalamount();
}

function totalamount(){
	var counter=$('#counter').val();
	var totalAmount=0;
	for(var i=1;i<=counter;i++){
		var finalamount=$('#amount'+i).val();
		totalAmount=eval(totalAmount) + eval(finalamount);
	}
	document.getElementById("total").innerHTML = totalAmount;
	$('#finaltotal').val(eval(totalAmount));
}
	
//repeat Item
$('#item-repeat').click(function(){

	var counter=$('#counter').val();

	counter++;
	$('#counter').val(eval(counter));
	//alert($("#taxes'+counter+'").html());
	$('#dynamic').append('<div id="row'+counter+'"><div class="row"><div class="form-group"><label class="control-label hidden-md hidden-lg">Item</label><div class="input-group"><div class="input-group-addon"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></div><input type="text" class="form-control item_name" name="item_name[]">  </div></div><div class="col-md-1"><div class="form-group"><label class="control-label hidden-md hidden-lg">Qty/Hrs</label><input type="number" min="1" class="form-control quantity" name="quantity[]" id="quantity'+counter+'"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label hidden-md hidden-lg">Unit Price</label><input type="text" class="form-control cost_per_item" name="cost_per_item[]" id="cost_per_item'+counter+'" onblur="countamount('+counter+');"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label hidden-md hidden-lg">TaX<a href="javascript:;" id="tax-settings" data-toggle="modal" data-target="#project-tax">	<i class="ti-settings text-info"></i></a>	</label><select name="tax[]" class="form-control"  id="taxes'+counter+'" onchange="counttax('+counter+');">'+$("#taxes1").html()+'</select></div></div><div class="col-md-2 border-dark  text-center"><label class="control-label hidden-md hidden-lg">Amount</label><input type="text" name="amount[]" id="amount'+counter+'"></div><div class="col-md-1 text-right visible-md visible-lg"><button type="button" name="remove" id="'+counter+'" class="btn remove-item btn-circle btn-danger remove"><i class="fa fa-remove"></i></button></div></div><div class="row"><div class="form-group"><textarea name="item_Description[]" class="form-control" placeholder="Description" rows="2"></textarea></div></div></div>');
	$("#taxes"+counter).val('');
});

$(document).on('click','.remove',function(){
	var btn_id=$(this).attr("id");
	var amount1=$('#amount'+btn_id).val();

	$("#row"+btn_id+'').remove();
		
	
	 var ftotal1=$('#finaltotal').val();

	var  finaltotal1=(eval(ftotal1))-(eval(amount1));
		document.getElementById("total").innerHTML = finaltotal1;
	$('#finaltotal').val(eval(finaltotal1));
	
});

//estimate table
jQuery(document).ready(function() {
	if(controllerName == 'finance' && (functionName == 'index' || functionName == '')){
		//alert(functionName);
		var oTable = jQuery('#estimate').DataTable({
			'bRetrieve': true,
	        "bPaginate": true,
	        "bLengthChange": true,
	        "iDisplayLength": 10,
	        "bFilter": true,
	        "bSort": true,
	        "aaSorting": [],
	        "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000, 5000], [10, 25, 50, 100, 200, 500, 1000, 5000]],
	        "bInfo": true,
	        "bAutoWidth": false,
	        "bProcessing": true,
	        "aoColumns": [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"Finance/estimate_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Leads found<br/><br/></center>', "sZeroRecords": "<center><br/>No Leads found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
					aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
					aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
					aoData.push( { "name": "status", "value": $('#status').val() } );
					
			
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#estimate').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Estimates</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Estimates</small>)';
	                    }
	                    
	                    fnCallback(json);
	                }
	            });
        	},
        	"fnRowCallback": function( nRow, aData, iDisplayIndex ){
                return nRow;
	        },
	        "fnDrawCallback": function(oSettings, json) {

	        },
		});
		$('#btnApplyEstimates').click(function(){ //button filter event click
			var oTable = $('#estimate').DataTable();
			oTable.draw();
});
	
	}
});

			
//delete estimate
function deleteestimates(estimateid){

		var url = base_url+"Finance/deleteestimate";
		swal({
		 title: "Are you sure?",
		 text: "You will not be able to recover this imaginary file!",
		 type: "warning",
		 showCancelButton: true,
		 confirmButtonColor: "#DD6B55",
		 confirmButtonText: "Yes, delete it!",
		 closeOnConfirm: false
		},
	function(isConfirm){
	if (isConfirm) {
		   $.ajax({
			   url: url,
			   type: "POST",
			   dataType: "JSON",
			   data: {estimateid:estimateid},
			  dataType: "html",
			  
			   success: function (data) {
				   swal("Done!", "It was succesfully deleted!", "success");
				   $('#estimate').DataTable().ajax.reload();

				   //$("#leads").fnReloadAjax();
					//$('#leads').DataTable.ajax.reload(null,false);
					//window.location.reload();
			   },
			   error: function (xhr, ajaxOptions, thrownError) {
				   swal("Error deleting!", "Please try again", "error");
			   }
		   });
	   }
	   });
}

//show &hide
 $("#recurring_payment").change(function(){
  if ( this.value == '1')
  {
	$(".showdiv").show();
  }
  else
  {
    $(".showdiv").hide();
  }
});

//invoicelist

jQuery(document).ready(function() {
	if(controllerName == 'finance' && (functionName == 'invoice')){
		var oTable = jQuery('#invoices').DataTable({
			'bRetrieve': true,
	        "bPaginate": true,
	        "bLengthChange": true,
	        "iDisplayLength": 10,
	        "bFilter": true,
	        "bSort": true,
	        "aaSorting": [],
	        "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000, 5000], [10, 25, 50, 100, 200, 500, 1000, 5000]],
	        "bInfo": true,
	        "bAutoWidth": false,
	        "bProcessing": true,
	        "aoColumns": [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
					  { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 

                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"Finance/invoice_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Leads found<br/><br/></center>', "sZeroRecords": "<center><br/>No Leads found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
					aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
					aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
					aoData.push( { "name": "projectname", "value": $('#projectname').val() } );
					aoData.push( { "name": "clientname", "value": $('#clientname').val() } );
					aoData.push( { "name": "status", "value": $('#status').val() } );
					
			
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#invoices').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Invoices</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Invoices</small>)';
	                    }
	                    
	                    fnCallback(json);
	                }
	            });
        	},
        	"fnRowCallback": function( nRow, aData, iDisplayIndex ){
                return nRow;
	        },
	        "fnDrawCallback": function(oSettings, json) {

	        },
		});

		$('#btnApplyInvoices').click(function(){ //button filter event click
	var oTable = $('#invoices').DataTable();
	oTable.draw();
	});
	}
});



//delete invoice


function deleteinvoices(invoiceid){
		var url = base_url+"Finance/deleteinvoice";
		swal({
		 title: "Are you sure?",
		 text: "You will not be able to recover this imaginary file!",
		 type: "warning",
		 showCancelButton: true,
		 confirmButtonColor: "#DD6B55",
		 confirmButtonText: "Yes, delete it!",
		 closeOnConfirm: false
		},
	function(isConfirm){
	if (isConfirm) {
		   $.ajax({
			   url: url,
			   type: "POST",
			   dataType: "JSON",
			   data: {id:invoiceid},
			  dataType: "html",
			  
			   success: function (data) {
				   swal("Done!", "It was succesfully deleted!", "success");
				   $('#invoices').DataTable().ajax.reload();

				   //$("#leads").fnReloadAjax();
					//$('#leads').DataTable.ajax.reload(null,false);
					//window.location.reload();
			   },
			   error: function (xhr, ajaxOptions, thrownError) {
				   swal("Error deleting!", "Please try again", "error");
			   }
		   });
	   }
	   });
}

//expense list
jQuery(document).ready(function() {
	if(controllerName == 'finance' && (functionName == 'expense')){
		var oTable = jQuery('#expenses').DataTable({
			'bRetrieve': true,
	        "bPaginate": true,
	        "bLengthChange": true,
	        "iDisplayLength": 10,
	        "bFilter": true,
	        "bSort": true,
	        "aaSorting": [],
	        "aLengthMenu": [[10, 25, 50, 100, 200, 500, 1000, 5000], [10, 25, 50, 100, 200, 500, 1000, 5000]],
	        "bInfo": true,
	        "bAutoWidth": false,
	        "bProcessing": true,
	        "aoColumns": [{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
					  { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 

                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"Finance/expense_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Leads found<br/><br/></center>', "sZeroRecords": "<center><br/>No Leads found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
					aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
					aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
					aoData.push( { "name": "employee", "value": $('#employee').val() } );
					aoData.push( { "name": "status", "value": $('#status').val() } );
					
			
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#expenses').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Expenses</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Expenses</small>)';
	                    }
	                    
	                    fnCallback(json);
	                }
	            });
        	},
        	"fnRowCallback": function( nRow, aData, iDisplayIndex ){
                return nRow;
	        },
	        "fnDrawCallback": function(oSettings, json) {

	        },
		});

		$('#btnApplyExpanse').click(function(){ //button filter event click
			var oTable = $('#expenses').DataTable();
			oTable.draw();
		});
	}
});






//delete expenses
function deleteexpenses(expenseid){
		var url = base_url+"Finance/deleteexpense";
		swal({
		 title: "Are you sure?",
		 text: "You will not be able to recover this imaginary file!",
		 type: "warning",
		 showCancelButton: true,
		 confirmButtonColor: "#DD6B55",
		 confirmButtonText: "Yes, delete it!",
		 closeOnConfirm: false
		},
	function(isConfirm){
	if (isConfirm) {
		   $.ajax({
			   url: url,
			   type: "POST",
			   dataType: "JSON",
			   data: {id:expenseid},
			  dataType: "html",
			  
			   success: function (data) {
				   swal("Done!", "It was succesfully deleted!", "success");
				   $('#expenses').DataTable().ajax.reload();

				   //$("#leads").fnReloadAjax();
					//$('#leads').DataTable.ajax.reload(null,false);
					//window.location.reload();
			   },
			   error: function (xhr, ajaxOptions, thrownError) {
				   swal("Error deleting!", "Please try again", "error");
			   }
		   });
	   }
	   });
}





//expense validation

$(function() {
  $("form[name='expense']").validate({
      rules: {
      employee: "required",
      project: "required",
	  currency:"required",
	  itemname:"required",
		price:"required",
		purchasedfrom:"required",
		purchasedate:"required"
	  
      },
    submitHandler: function(form) {
      form.submit();
    }
  });
});


//client wise project

function getprojectbyclient(projectid){
 	var url = base_url+"Finance/getproject";
        //var projectid = $this.val();
        if(projectid){
            $.ajax({
                type:'POST',
                url:url,
                dataType:'json',
                data:'id='+projectid,
                success:function(html){
                		//console.log(html);
                		//alert("ht");
                	$('select[name="project"]').html(" ");
					 $('select[name="project"]').append(html.projectdata);                }
            }); 
        }
}

//estimate-invoice validation

$("#estimate-invoice").click(function(event) {
	
	var client_name_err  = 0;
	var currency_name_err  = 0;
	var validtill_err  = 0;

	var project_name_err  = 0;
	var invoice_err  = 0;
	var invoicedate_err  = 0;
	var duedate_err  = 0;
	var status_err  = 0;

	var item_name_err  = 0;
	var quantity_err  = 0;
	var cost_per_item_err  = 0;
	var tax_err  = 0;
	var amount_err  = 0;
	

	$("select[name^='client']").each(function() {
		var client = $(this).val();
		if(client == ''){
			client_name_err = 1;
		}
 
  
});


	
	$("select[name^='currency']").each(function() {
		var currency = $(this).val();
		if(currency.trim() == ''){
			currency_name_err = 1;
		}
   
  
});
	$("input[name^='valid_till']").each(function() {
		var valid_till = $(this).val();
		if(valid_till.trim() == ''){
			validtill_err = 1;
		}
   
  
});
	$("select[name^='project']").each(function() {
		var project = $(this).val();
		if(project == ''){
			project_name_err = 1;
		}
 
});

	$("input[name^='invoice_number']").each(function() {
		var invoice_number = $(this).val();
		if(invoice_number == ''){
			invoice_err = 1;
		}
 
});

$("input[name^='invoice_date']").each(function() {
		var invoice_date = $(this).val();
		if(invoice_date == ''){
			invoicedate_err = 1;
		}
 
});

$("input[name^='due_date']").each(function() {
		var due_date = $(this).val();
		if(due_date == ''){
			duedate_err = 1;
		}
 
});

$("select[name^='status']").each(function() {
		var status = $(this).val();
		if(status == ''){
			status_err = 1;
		}
 
});

	

	$("input[name^='item_name']").each(function() {
		var item_name = $(this).val();
		if(item_name.trim() == ''){
			item_name_err = 1;
		}
   
  
});
	$("input[name^='quantity']").each(function() {
		var quantity = $(this).val();
		if(quantity.trim() == ''){
			quantity_err = 1;
		}
   
   
});
	$("input[name^='cost_per_item']").each(function() {
		var cost_per_item = $(this).val();
		if(cost_per_item.trim() == ''){
			cost_per_item_err = 1;
		}
  
    

});
	
	$("input[name^='amount']").each(function() {
	var amount = $(this).val();
	if(amount.trim() == ''){
		amount_err = 1;
	}
   
   
});

	  if(client_name_err == 1){
		alert('enter Client name');
		return false;
	}

	

	  if(currency_name_err == 1){
		alert('enter Currency');
		return false;
	}

	  if(validtill_err == 1){
		alert('enter ValidTill Date');
		return false;
	}

	if(project_name_err == 1){
		alert('enter project name');
		return false;
	}

	if(invoice_err == 1){
		alert('enter Invoice Number');
		return false;
	}

	if(invoicedate_err == 1){
		alert('enter invoice date');
		return false;
	}

	if(duedate_err == 1){
		alert('enter Due Date');
		return false;
	}

	if(status_err == 1){
		alert('enter Status');
		return false;
	}

	  if(item_name_err == 1){
		alert('enter item name');
		return false;
	}
	
	 if(quantity_err == 1){
		alert('enter quantity');
		return false;
	}

	if(cost_per_item_err == 1){
		alert('enter cost per item');
		return false;
	}

	

	 if(amount_err == 1){
		alert('enter amount');
		return false;
	}
});	

	


//insert attendance

function insertAttendance(employeeid,counter){
	//alert('fghh');
 	var url = base_url+"Attendance/insertattendance";
 	var attendancedate = $('#atsdate').val();
	var attendance = $('input:radio[name=attendance'+counter+']:checked').val();
	
       	 if(employeeid){
			$.ajax({
				url: url,
				type: "POST",
				data: {
					attendancedate: attendancedate,		
					employee: employeeid,
					attendance: attendance
							
				},
				cache: false,
				success: function(dataResult){
					//alert("fg");
					//$('#suceessmsg').html('');
					$('#suceessmsg'+counter).append('<b>Attendance Saved Successfully</b>');
					$('#suceessmsg'+counter).fadeOut(6000);  
			}

		
	});
}
}



//attendance filter   apply-filter

$("#apply-filter").click(function() {
	var month = $('#month').val();
	var year = $('#year').val();
	var department = $('#dept').val();
	var employee = $('#employee').val();
	//alert(employee);
	$.ajax({
		url : base_url+"Attendance/getfilterdata",
        type : 'POST',
        data : {month: month,year:year,department:department,employee:employee},
        error: function() {
              alert('Something is wrong');
           },
        success: function(data){
			window.location.reload();
        }
	});

	});

//datepicker validation 

$(document).ready(function(){
  	$("#atsdate").datepicker({
			 dateFormat: 'Y-m-d',
			  autoclose: true,
        	orientation: "top",
        	endDate: "today"
	   });
});

//reset filter attendance

$('#reset-filtersAttendance').click(function(){ 
	 

	$.ajax({
		url : base_url+"Attendance/destroydata",
        type : 'POST',
        error: function() {
              alert('Something is wrong');
           },
        success: function(){
			window.location.reload();
        }
	});
});

//for search option in select  

$(document).ready(function(){
	$("#timezone").select2();
   });

$(document).ready(function(){
	$("#date_format").select2();
   });

$(document).ready(function(){
	$("#time_format").select2();
   });

$(document).ready(function(){
	$("#locale").select2();
   });

//
 $(document).ready(function() {
          $('#recaptcha').click(function () { 
           var selected = $(this).val(); alert(selected);  
              if(selected == 'on') {
               $('.key').show();
               $('.secret').show();
            } else {
               $('.key').hide();
               $('.secret').hide();
             }
     });       
});


var h=0;
var m=0;
var s=0;
function to_start(){

switch(document.getElementById('btn').value)
{
case  'Stop':
window.clearInterval(tm); // stop the timer 
document.getElementById('btn').value='Start';
break;
case  'Start':
tm=window.setInterval('disp()',1000);
document.getElementById('btn').value='Stop';
break;
}
}


function disp(){
// Format the output by adding 0 if it is single digit //
if(s<10){var s1='0' + s;}
else{var s1=s;}
if(m<10){var m1='0' + m;}
else{var m1=m;}
if(h<10){var h1='0' + h;}
else{var h1=h;}
// Display the output //
str= h1 + ':' + m1 +':' + s1 ;
document.getElementById('n1').innerHTML=str;
// Calculate the stop watch // 
if(s<59){ 
s=s+1;
}else{
s=0;
m=m+1;
if(m==60){
m=0;
h=h+1;
} // end if  m ==60
}// end if else s < 59
// end of calculation for next display

}