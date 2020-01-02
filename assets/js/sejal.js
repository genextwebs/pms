jQuery(document).ready(function() {
	if(controllerName == 'project' && (functionName == 'index' || functionName == '')){
		var oTable = jQuery('#project').DataTable({
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
			],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"Project/projectlist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Projects found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
				aoData.push( { "name": "status1", "value": $('#project_status').val() } );
				aoData.push( { "name": "clientname1", "value": $('#clientname').val() } );
				aoData.push( { "name": "categoryname1", "value": $('#categoryname').val() } );

				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var oTable = $('#project').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Projects</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Projects</small>)';
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

	else if(controllerName == 'project' && functionName == 'projecttemplate'){
		var oTable = jQuery('#template').DataTable({    
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
						{ "sWidth": "250px", sClass: "text-center", "asSorting": [ ] },
					  ],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"Project/templatelist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Templates found<br/><br/></center>', "sZeroRecords": "<center><br/>No Templates found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ Templates", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
				oSettings.jqXHR = $.ajax( {
              		"dataType": 'json',
              		"type": "POST",
              		"url": sSource,
              		"data": aoData,
            		"timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
            		"success": function(json) {
	                	var oTable = $('#template').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Templates</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Templates</small>)';
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

	else if(controllerName == 'project' && functionName == 'viewarchiev'){
		var oTable = jQuery('#archievdata').DataTable({    
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
			"aoColumns": [
							{ "sWidth": "40px", sClass: "text-left", "asSorting": [  ] }, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
							{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
						],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"Project/archivelist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Templates found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
				aoData.push( { "name": "status2", "value": $('#project_status').val() } );
				aoData.push( { "name": "clientname2", "value": $('#clientname').val() } );
				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var oTable = $('#archievdata').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Archive</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Archive</small>)';
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

	else if(controllerName == 'leaves' && (functionName == 'index' || functionName == '')){
		
		var oTable = jQuery('#leaves').DataTable({
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
			],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"Leaves/leavelist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Projects found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
				aoData.push( { "name": "startdate", "value": $('#startdate').val() } );
				aoData.push( { "name": "enddate", "value": $('#enddate').val() } );
				aoData.push( { "name": "ename", "value": $('#empname').val() } );

				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var oTable = $('#leaves').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Leaves</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Leaves </small>)';
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

	else if(controllerName == 'ticket' && (functionName == 'index' || functionName == '')){
		var oTable = jQuery('#tickets').DataTable({
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
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 

		     ],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"Ticket/ticketlist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Projects found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
		    	//aoData.push( { "name": "agent", "value": $('#agent').val() } );
		    	aoData.push({"name": "s_date", "value":$('#start_date').val()});
		    	aoData.push({"name" :"e_date" ,"value":$('#deadline').val()});
				aoData.push( { "name": "status1", "value": $('#status').val() } );
				aoData.push( { "name": "priority", "value": $('#priority').val() } );
				aoData.push( { "name": "channelname", "value": $('#channelname').val() } );
				aoData.push( { "name": "tickettype", "value": $('#tickettype').val() } );
				
				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var oTable = $('#tickets').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Leaves</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Leaves </small>)';
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

	else if(controllerName == 'timelog' && (functionName == 'index' || functionName == '')){
		var oTable = jQuery('#timelog').DataTable({
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
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
			{ "sWidth": "250px", sClass: "text-center", "asSorting": [ ] }, 


		     ],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"Timelog/timeloglist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Projects found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
			
		    	//aoData.push( { "name": "agent", "value": $('#agent').val() } );
		    	/*aoData.push({"name": "s_date", "value":$('#start_date').val()});
		    	aoData.push({"name" :"e_date" ,"value":$('#deadline').val()});
				aoData.push( { "name": "status1", "value": $('#status').val() } );
				aoData.push( { "name": "priority", "value": $('#priority').val() } );
				aoData.push( { "name": "channelname", "value": $('#channelname').val() } );
				aoData.push( { "name": "tickettype", "value": $('#tickettype').val() } );*/
				
				oSettings.jqXHR = $.ajax( {
					"dataType": 'json',
					"type": "POST",
					"url": sSource,
					"data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                	var oTable = $('#timelog').dataTable();
	                	var oLanguage = oTable.fnSettings().oLanguage;

	                	if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Leaves</small>)';
	                	}
	                	else{
	                		oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Leaves </small>)';
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

//PROJECT FILTER
$('#clientname').change(function(){ //button filter event click
	var oTable = $('#project').DataTable();
		oTable.draw();
});

$('#categoryname').change(function(){ //button filter event click
	var oTable = $('#project').DataTable();
		oTable.draw();
});

$('#project_status').change(function(){
	//button filter event click
	var oTable = $('#project').DataTable();
		oTable.draw();
});		
		
//ARCHIEVE FILTER
$('#clientname').change(function(){ 
	var oTable = $('#archievdata').DataTable();
		oTable.draw();
});

$('#project_status').change(function(){ 
	var oTable = $('#archievdata').DataTable();
		oTable.draw();
});

$('#btnApplyLeaves').click(function(){ 
	var oTable = $('#leaves').DataTable();
	oTable.draw();
});


$('#btnApplyTicket').click(function(){
	var oTable = $('#tickets').DataTable();
	oTable.draw();
});

$('#btnApply').click(function(){
	var oTable = $('#tickets').DataTable();
	oTable.draw();
});

/*$(function(){
	$('#starttime').datetimepicker({
		format:'LT'
	});

});*/



//addproject=> datepicker
$(document).ready(function(){
	//for start date
	$("#start_date").datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
    }).on('changeDate', function (selected) {
        $('#deadline').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });
        var minDate = new Date(selected.date.valueOf());
        $('#deadline').datepicker("update", minDate);
        $('#deadline').datepicker('setStartDate', minDate);
    });
	//for end date
	$("#deadline").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    }).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('#start_date').datepicker('setEndDate', maxDate);
    });
});

//addproject validation for all input
$("form[name='creatclient']").validate({
	rules:{
		project_name : "required",
		select_client : "required",
		start_date : "required",
		deadline : "required",
		project_budget:{
						digits: true,
		},
		hours_allocated:{
						digits:true,
		},
	},		
	messages:
		{
			project_budget : "Enter valid input",
			hours_allocated : "Enter Valid input",
		},
	submitHandler: function(form) {
	form.submit();}
});

//edit(insert)ticket
$("form[name='editticket']").validate({
	rules:{
		editor:"required",
		requestername:"required",
		status:"required",
	},
	messages:{
		editor: "The subject field is required.",
		requestername:"The description field is required.",
		status:"The status field is requird",

	},
	submitHandler: function(form) {
	form.submit();}
});
	
//Leaves Validation
$("form[name='creatleave']").validate({
	rules:{
		date: "required",
		absence : "required",
	},	
	messages:{
		date    : "Enter valid date",
		absence : "Enter Reason",
	},
	submitHandler:function(form){
	form.submit();
	}
});

//addtemplate validation
$("form[name='creatclient']").validate({
	rules:{
			project_name : "required",
	},			
	submitHandler: function(form) {
	form.submit();}
});


//for addticket vlaidation

$("form[id='addticket']").validate({
	rules:{
		ticket_subject: "required",
		editor2: "required",
		requestername: "required",
		status :"required",

	},
	messages:{
		ticket_subject: "The subject field is required",
		editor2: "The description field is required",
		requestername: "Requester Name Required",
		status: "Status is Required",

	},
	submitHandler:function(form){
	form.submit();
	}


});
// for add category in addproject
$("#save-category").click(function(event) {
	var catname = $("input[name='category_name']").val();
	if(catname!=""){
		$.ajax({
			url: base_url+"project/checkcategory",
			type: 'POST',
			dataType: 'html',
			data:{category:catname},
			success: function(data) {
				
				if(data==0){
					var dataString = 'name='+ catname;
					jQuery('#errormsg').html('');
					$.ajax({
					    url: base_url+"project/insertcat",
					    type: 'POST',
					    dataType: 'json',
					    data: dataString,
						success: function(data) {
							console.log(data.ticketdata);
							/*$('select[name="project-category"]').html('');       
							$('select[name="project-category"]').append(data.catdata);
							$("tbody").append("<tr id='cate_"+data.lastinsertid+"'><td>"+data.count+"</td><td>"+catname+"</td> <td><input type='submit' class='btn btn-sm btn-danger btn-rounded delete-category' onclick='deletecat(\'"+data.lastinsertid+"\');' id='deletecat' value='Remove'></tr>");
						    $('#project-category1').removeClass('show');
							$('.modal-backdrop').removeClass('show');
							$('.modal-backdrop').find('div').remove();
							$('body').removeAttr("style");
							$('body').removeClass("modal-open");
							$('#category')[0].reset();*/
							$('#succmsg').html('');
							$('#succmsg').html('<b>Successfully category added</b>');
					   }
					});
				}else{
					jQuery('#errormsg').html('')
					jQuery('#errormsg').html('<b>This category already exists</b>');
				}
			}
		});
	}else{
		jQuery('#errormsg').html('')
		jQuery('#errormsg').html('<b>Please enter category name</b>');
	}
});


// for add leaves 
$("#save_leave").click(function() {
	var leavename = $("input[name='leavename']").val();
	if(leavename != ''){

		$.ajax({
				url: base_url+"leaves/checkleaves",
			    type: 'POST',
			    dataType: 'Json',
			    data: {leave:leavename},
				success: function(data){
					if(data == 0){
						var dataString = 'name='+ leavename;
							$.ajax({
						   		url: base_url+"leaves/insertleavestype",
						  		type: 'POST',
						    	dataType: 'json',
						  		data: dataString,
								success: function(data){
										$('select[name="leave_type"]').html('');       
										$('select[name="leave_type"]').append(data.deleteleavetype);
										$("tbody").append("<tr id='leave"+data.leaveData+"'><td>"+data.count+"</td><td>"+leavename+"</td> <td><input type='submit' class='btn btn-sm btn-danger btn-rounded delete-category' onclick='deleteleavetype(\""+data.leaveData+"\");' id='deletesearchLeave' value='Remove'></td></tr>");
										$('#leave_type1').modal('toggle');
										$('#leave')[0].reset();
		    			
								 }
							});
					}else{
						jQuery('#errormsg').html('')
						jQuery('#errormsg').html('<b>This Leaves already exists</b>');
					}	
				}
		});
	}else{
			jQuery('#errormsg').html('')
			jQuery('#errormsg').html('<b>Please enter Leaves name</b>');
	}
});

// add ticket type
$("#save_ticket").click(function(event) {
	var t_name = $("input[name='ticket_type']").val();
//	alert(tname);
	if(t_name!=""){
		//alert(t_name);
		$.ajax({
			url: base_url+"ticket/check_t_type",
			type: 'POST',
			dataType: 'html',
			data:{ticket:t_name},
			success: function(data) {
				//alert(t_name);
				if(data==0){
					var dataString = 'name='+ t_name;
					jQuery('#errormsg').html('');
					$.ajax({
					    url: base_url+"ticket/insert_t_type",
					    type: 'POST',
					    dataType: 'json',
					    data: dataString,
						success: function(data) {
							console.log(data.ticketdata);
						    $('#question').html('');       
							$('#question').append(data.ticketdata);
							
							$('#ticket')[0].reset();
							$('#type1').modal('toggle');
							$('#succmsg').html('');
							$('#succmsg').html('<b>Successfully ticket added</b>');
							$('#succmsg').fadeOut(3000);
					   }
					});
				}else{
					jQuery('#errormsg').html('')
					jQuery('#errormsg').html('<b>This ticket already exists</b>');
				}
			}
		});
	}else{
		jQuery('#errormsg').html('')
		jQuery('#errormsg').html('<b>Please enter ticket name</b>');
	}
});


//add channel 
$("#save_tchannel").click(function(event) {
	var c_name = $("input[name='channel_name']").val();
	if(c_name!=""){
		$.ajax({
			url: base_url+"ticket/check_t_channel",
			type: 'POST',
			dataType: 'html',
			data:{channel:c_name},
			success: function(data) {
				if(data==0){
					var dataString = 'name='+ c_name;
					jQuery('#errormsg').html('');
					$.ajax({
					    url: base_url+"ticket/insert_t_channel",
					    type: 'POST',
					    dataType: 'json',
					    data: dataString,
						success: function(data) {
							console.log(data.ticketcdata);
						    $('#channel').html('');       
							$('#channel').append(data.ticketcdata);
						
							$('#ticketchannel')[0].reset();
								$('#channel1').modal('toggle');
							$('#succmsg').html('');
							$('#succmsg').html('<b>Successfully Channel added</b>');
							$('#succmsg').fadeOut(3000);

					   }
					});
				}else{
					jQuery('#errormsgc').html('')
					jQuery('#errormsgc').html('<b>This Channel already exists</b>');
				}
			}
		});
	}else{
		jQuery('#errormsgc').html('')
		jQuery('#errormsgc').html('<b>Please enter Channel Name</b>');
	}
});


// addproject=> delete category 
	function deleteleavetype(id)
	{
		
		$.ajax({
		    type: "POST",
		    url: base_url+"leaves/deleteleavetype",
		    cache: false,
		    data: "id="+id,

		    success: function(data){
			   	if(data == 1){
			   		//alert(id);
					jQuery('#leave'+id).remove();
					$('#leave_type1').removeClass('show');
					$('.modal-backdrop').removeClass('show');
					$('.modal-backdrop').find('div').remove();
					$('body').removeAttr("style");
					$('body').removeClass("modal-open");
					$('#leave')[0].reset();
					$('#succmsg').html('');
					$('#succmsg').html('<b>Successfully category removed</b>');
				}else{
					$('#succmsg').html('');
					$('#succmsg').html('<b>Something went to wrong</b>');
				}
			}
		});
	}



	// addleaves=> addleavestype => deleteleaves 
	function deletecat(id){
		$.ajax({
		    type: "POST",
		    url: base_url+"project/deletecat",
		    cache: false,
		    data: "id="+id,
		    success: function(data){
			   	if(data == 1){
					jQuery('#cate_'+id).remove();
					$('#project-category1').removeClass('show');
					$('.modal-backdrop').removeClass('show');
					$('.modal-backdrop').find('div').remove();
					$('body').removeAttr("style");
					$('body').removeClass("modal-open");
					$('#leavecategory')[0].reset();
					$('#succmsg').html('');
					$('#succmsg').html('<b>Successfully category removed</b>');
				}else{
					$('#succmsg').html('');
					$('#succmsg').html('<b>Something went to wrong</b>');
				}
			}
		});
	}

   
	function searchleaves(id)
	{
		$.ajax({
		    type: "POST",
		    url: base_url+"leaves/searchleaves",
		    cache: false,
		    dataType: 'json',
		    data: "id="+id,
		   success: function(data){
		   	$('#leave-preview').html('');
		   	$('#leave-preview').append(data);

			}
		});

	}

	function edittimelog(id){
		//alert('heloo mmm');
		$.ajax({
			type: "POST",
		    url: base_url+"timelog/edittimelog",
		    cache: false,
		    dataType: 'json',
		    data: "id="+id,
		   success: function(data){
		   	$('#timelogpreview').html('');
		   	$('#timelogpreview').append(data);

			}


		});
	}

	
	

	function checkUncheck(){ 
		var checkBox = document.getElementById("without_deadline");
        if (checkBox.checked) {
            $('#deadlineBox').hide().checked;
        }
		else{
			 $('#deadlineBox').show();
		}	
	}

	function viewtask(){ 
		var checkBox = document.getElementById("client-view-tasks");
        if (checkBox.checked) {
            $('#viewnotification').show().checked;
        }
		else{
			 $('#viewnotification').hide();
		}	
	}

	//delete projects
	function deleteproject(id){
		var url = base_url+"project/deleteproject";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this project?",
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
					    data: {id:id},
					    dataType: "html",
					  
				   success: function (data) {
					   swal("Done!", "It was succesfully deleted!", "success");
					   $('#project').DataTable().ajax.reload();
					   $('#archievdata').DataTable().ajax.reload();
				   },
				   error: function (xhr, ajaxOptions, thrownError) {
					   swal("Error deleting!", "Please try again", "error");
				   }
				});
			}
		});
	}
	
	//delete timelog
	function deletetimelog(id){
		var url = base_url+"timelog/deletetimelog";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this timelog?",
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
					    data: {id:id},
					    dataType: "html",
					  
				   success: function (data) {
					   swal("Done!", "It was succesfully deleted!", "success");
					   $('#timelog').DataTable().ajax.reload();
					 
				   },
				   error: function (xhr, ajaxOptions, thrownError) {
					   swal("Error deleting!", "Please try again", "error");
				   }
				});
			}
		});
	}

	// deleteticket
   function deleteticket(id){
		var url = base_url+"ticket/deleteticket";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this Ticket?",
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
					   data: {id:id},
					   dataType: "html",
					  
					   success: function (data) {
						   swal("Done!", "It was succesfully deleted!", "success");
						   $('#tickets').DataTable().ajax.reload();
					   },
					   error: function (xhr, ajaxOptions, thrownError) {
						   swal("Error deleting!", "Please try again", "error");
					   }
				   });
			   }
			});
		}

	//deletetemplate
	function deletetemplate(id){
		var url = base_url+"project/deletetemplate";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this project?",
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
					   data: {id:id},
					  dataType: "html",
					  
					   success: function (data) {
						   swal("Done!", "It was succesfully deleted!", "success");
					   },
					   error: function (xhr, ajaxOptions, thrownError) {
						   swal("Error deleting!", "Please try again", "error");
					   }
				   });
			   }
			   });
		}

	//delete leaves
	function deleteleaves(id){
		var url = base_url+"Leaves/deleteleaves";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this leaves?",
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
					   data: {id:id},
					  dataType: "html",
					  
					   success: function (data) {
						   swal("Done!", "It was succesfully deleted!", "success");
						   $('#leaves').DataTable().ajax.reload();
					   },
					   error: function (xhr, ajaxOptions, thrownError) {
						   swal("Error deleting!", "Please try again", "error");
					   }
				   });
			   }
			   });
	}



	//edit leaves
	function editleaves(id){
		$('#leaves-popup').modal('toggle');
		$('#editleaves').modal('show');
		var url = base_url+"Leaves/editleavesbtn";
		  	$.ajax({

	   			type: 'POST',
		   		url: url,
		        cache: false,
			    dataType: 'json',
			    data: "id="+id,
			    success: function (data) {
			   		$('#leave_edit').html('');
				  	$('#leave_edit').append(data);
			    },
			   error: function (xhr, ajaxOptions, thrownError) {
			    }
	        });
	}
	

	function deleteSearchLeaves(id){
		var url = base_url+"Leaves/deleteSearchLeaves";
		swal({
			 title: "Are you sure?",
			 text: "Do you want to delete this leaves?",
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
					data: {id:id},
					dataType: "html",
				    success: function (data) {
						   swal("Done!", "It was succesfully deleted!", "success");
						   $('#edileaves').modal('toggle');
						   window.location.reload();
					},
					error: function (xhr, ajaxOptions, thrownError) {
						swal("Error deleting!", "Please try again", "error");
					}
				});
			}
		});
    }

    //closeleaves
    function closeleaves(){
    	$.ajax({
    	    success: function (data) {
			    $('#edileaves').modal('toggle');
			    window.location.reload();
			},
			error: function (xhr, ajaxOptions, thrownError) {
			}
		});
    }
	 
    //edit btn clicking 
    function editdata(id){
    	var mem = $('#choose_mem').val();
		var ltype = $('#leave_type').val();
		var date = $('#date').val();
        var abs = $('#absence').val();
		var sta = $('#status').val();
		

    	if(abs.trim() == ''){
		alert('Enter Reason for absence');
		return false;
		}
		else{

		$.ajax({
      			url: base_url+"Leaves/updateleaves",
				type: "POST",
				dataType: "JSON",
				data: {id : id  , mem : mem ,ltype : ltype , date : date , abs : abs, sta : sta},
				dataType: "html",
			    success: function (data) {
					$('#editleaves').modal('toggle');
						window.location.reload();
				},
		    });
		}
	}
	

	function archivetoproject(id){
		var url = base_url+"project/archivetoproject";
		swal({
				 title: "Are you sure?",
				 text: "Do you want to restore this project?",
				 type: "warning",
				 showCancelButton: true,
				 confirmButtonColor: "#DD6B55",
				 confirmButtonText: "Yes, restore it!",
				 closeOnConfirm: false
		},
	    function(isConfirm){
			if (isConfirm) {
				   $.ajax({
						   url: url,
						   type: "POST",
						   dataType: "JSON",
						   data: {id:id},
						   dataType: "html",
					  
					success: function (data) {
								swal("Done!", "Project restored successfully..!", "success");
								$('#project').DataTable().ajax.reload();
							},

					   error: function (xhr, ajaxOptions, thrownError) {
						   swal("Error !", "Please try again", "error");
					   }
				   });
			   }
	    });
	}
		
	function archivedata(id) {
		var url = base_url+"project/archivedata";
			swal({
			 		title: "Are you sure?",
					text: "Do you want to archive this project?",
					type: "warning",
				    showCancelButton: true,
				    confirmButtonColor: "#DD6B55",
				    confirmButtonText: "Yes, archive it!",
				    closeOnConfirm: false
		    },
			function(isConfirm){
				if (isConfirm) {
				   	$.ajax({
				   			url: url,
					  		type: "POST",
					        dataType: "JSON",
					        data: {id:id},
					        dataType: "html",
					        success: function (data) {
						   		swal("Done!", "Project archived successfully..!", "success");
						        $('#project').DataTable().ajax.reload();
					        },
					        error: function (xhr, ajaxOptions, thrownError) {
						   		swal("Error !", "Please try again", "error");
					   		}
				   });
			    }
		   });
	}




$("#submitticket").click(function(event) {
	var editorname = $("#editor").val();
	var t_status = $("#status").val();
	var empid= $("#requestername").val();
	imgurl = base_url+"uploads/";
	alert(editorname);
		$.ajax({
			
		    type: "POST",
		    url: base_url+"ticket/insert_comment",

		    dataType: 'json',
		    data:{name:editorname,status:t_status,t_empid:empid},
		   
		   success: function(data){
		  	alert(data.profileimg);
			$('tbody').append("<tr><td>"+data.count+"</td><td><img height='50px' width='50px' src="+imgurl+data.profileimg+"></td><td>"+data.replay+"</td><td>"+data.create+"</td><td><input type='button' class='btn btn-sm btn-danger btn-rounded delete-category' onclick ='delete_t_comment(\""+data.insCommentData+"\");' id='deletereply' value='Remove'></td></tr>");
			$('textarea').val('');
			//$('replaytable').append();
			}
		});

});

	//delete tickets testttt
	function delete_t_comment(id){
		var url = base_url+"ticket/deletecomment";
		swal({
		 title: "Are you sure?",
		 text: "Do you want to delete this Ticket Replay?",
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
					   data: {id:id},
					  dataType: "html",
					  
					   success: function (data) {
						   swal("Done!", "It was succesfully deleted!", "success");
						   window.location.reload();
					   },
					   error: function (xhr, ajaxOptions, thrownError) {
						   swal("Error deleting!", "Please try again", "error");
					   }
				   });
			   }
			   });
	}


$("#save_tchannel").click(function(event) {
	var c_name = $("input[name='channel_name']").val();
	if(c_name!=""){
		$.ajax({
			url: base_url+"ticket/check_t_channel",
			type: 'POST',
			dataType: 'html',
			data:{channel:c_name},
			success: function(data) {
				if(data==0){
					var dataString = 'name='+ c_name;
					jQuery('#errormsg').html('');
					$.ajax({
					    url: base_url+"ticket/insert_t_channel",
					    type: 'POST',
					    dataType: 'json',
					    data: dataString,
						success: function(data) {
							console.log(data.ticketcdata);
						    $('#channel').html('');       
							$('#channel').append(data.ticketcdata);
						
							$('#ticketchannel')[0].reset();
								$('#channel1').modal('toggle');
							$('#succmsg').html('');
							$('#succmsg').html('<b>Successfully Channel added</b>');
							$('#succmsg').fadeOut(3000);

					   }
					});
				}else{
					jQuery('#errormsgc').html('')
					jQuery('#errormsgc').html('<b>This Channel already exists</b>');
				}
			}
		});
	}else{
		jQuery('#errormsgc').html('')
		jQuery('#errormsgc').html('<b>Please enter Channel Name</b>');
	}
});

//for timelog --> project dropdown=>employee disply accordingly
$("#projectname").change(function(event) {
	  	pname = $('#projectname').val();
	  	alert(pname);
	$('#empdiv').show();
	if(pname !=''){
		$.ajax({
			 url: base_url+"timelog/getEmployee",
			type:'post',
			 dataType:'json',
			 data:{projectname:pname},
			 success:function(data){
               	$('#empname').append(data.empname);
            }

		});
	}
});

 


  $('#starttime').timepicker();
  $('#endtime').timepicker();
  
function append(dl, dtTxt, ddTxt) {
  var dt = document.createElement("dt");
  var dd = document.createElement("dd");
  dd.setAttribute=("name","hours");
  dt.name="id";
  dt.textContent = dtTxt;
  dd.textContent = ddTxt;
  dl.appendChild(dt);
  dl.appendChild(dd);
}

$(document).ready(function() {

  var today = new Date();
  $('#d1').val(today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + (today.getDate() + 1)).slice(-2));
  $('#d2').val($('#d1').val());
  $('#t1').val('00:00');
  $('#t2').val('00:00');
  //
  //$('#d1 #d2 #t1 #t2').
  $('#d1, #d2, #t1, #t2').on('change', function(ev) {
    var dl = document.getElementById("diff");
    while (dl.hasChildNodes()) {
      dl.removeChild(dl.lastChild);
    }

    var date1 = new Date($('#d1').val() + " " + $('#t1').val()).getTime();
    var date2 = new Date($('#d2').val() + " " + $('#t2').val()).getTime();
   // append(dl, "Interval ", " from: " + $('#d1').val() + " " + $('#t1').val() + " to: " + $('#d2').val() + " " + $('#t2').val());
    var msec = date2 - date1;
    var mins = Math.floor(msec / 60000);
    var hrs = Math.floor(mins / 60);
    var days = Math.floor(hrs / 24);
    var yrs = Math.floor(days / 365);
    //append(dl, "Minutes: ", mins + " minutes");
    mins = mins % 60;
    append(dl, "", hrs +" Hrs " + mins + " Mins");
  });
  $('#d1').change();

});
