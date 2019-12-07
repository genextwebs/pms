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
					aoData.push( { "name": "clientname", "value": $('#clientname').val() } );
					aoData.push( { "name": "status", "value": $('#status').val() } );
					
			
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
	}
});

$('#btnapply').click(function(){ //button filter event click
	var oTable = $('#clients').DataTable();
	oTable.draw();
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
	   todayBtn:  1,
		autoclose: true,
	   }).on('changeDate', function (selected) {
		/*var minDate = new Date(selected.date.valueOf());
		$('#enddate').datetimepicker('setStartDate', minDate);*/
	});
		
	$("#enddate").datepicker();
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
	
	$('#dynamic').append('<div id="row'+counter+'"><div class="row"><div class="form-group"><label class="control-label hidden-md hidden-lg">Item</label><div class="input-group"><div class="input-group-addon"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></div><input type="text" class="form-control item_name" name="item_name[]">  </div></div><div class="col-md-1"><div class="form-group"><label class="control-label hidden-md hidden-lg">Qty/Hrs</label><input type="number" min="1" class="form-control quantity" name="quantity[]" id="quantity'+counter+'"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label hidden-md hidden-lg">Unit Price</label><input type="text" class="form-control cost_per_item" name="cost_per_item[]" id="cost_per_item'+counter+'" onblur="countamount('+counter+');"></div></div><div class="col-md-2"><div class="form-group"><label class="control-label hidden-md hidden-lg">TaX<a href="javascript:;" id="tax-settings" data-toggle="modal" data-target="#project-tax">	<i class="ti-settings text-info"></i></a>	</label><select name="tax[]" class="form-control"  id="taxes'+counter+'" onchange="counttax('+counter+');">'+$("#taxes1").html()+'</select></div></div><div class="col-md-2 border-dark  text-center"><label class="control-label hidden-md hidden-lg">Amount</label><input type="text" name="amount[]" id="amount'+counter+'"></div><div class="col-md-1 text-right visible-md visible-lg"><button type="button" name="remove" id="'+counter+'" class="btn remove-item btn-circle btn-danger remove"><i class="fa fa-remove"></i></button></div></div><div class="row"><div class="form-group"><textarea name="item_Description[]" class="form-control" placeholder="Description" rows="2"></textarea></div></div>');
});

$(document).on('click','.remove',function(){
	var btn_id=$(this).attr("id");
	$("#row"+btn_id+'').remove();
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
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' entries</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' entries</small>)';
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
	}
});

$('#btnapply').click(function(){ //button filter event click
	var oTable = $('#estimate').DataTable();
	oTable.draw();
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
	}
});

$('#btnapply').click(function(){ //button filter event click
	var oTable = $('#invoices').DataTable();
	oTable.draw();
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
					aoData.push( { "name": "projectname", "value": $('#employee').val() } );
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
	}
});

$('#btnapply').click(function(){ //button filter event click
	var oTable = $('#expenses').DataTable();
	oTable.draw();
});

//expense delete

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

//estimate validation

$(function() {
  $("form[name='estimate']").validate({
      rules: {
      client: "required",
      currency: "required",
	  valid_till:"required"
	  
      },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

//invoice validation

$(function() {
  $("form[name='createinvoice11']").validate({
      rules: {
      invoice_number: "required",
	  currency:"required",
	  invoice_date:"required",
		due_date:"required",
		status:"required"
	  
      },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

//invoice validation

$(function() {
  $("form[name='createinvoice11']").validate({
      rules: {
      invoice_number: "required",
      project: "required",
	  currency:"required",
	  invoice_date:"required",
		due_date:"required",
		status:"required"
	  
      },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

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
	//alert("fghg");
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