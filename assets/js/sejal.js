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
		//	{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
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
		//	{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
			],
			"bServerSide": true,
			"fixedHeader": true,
			"sAjaxSource": base_url+"Leaves/leavelist",
			"sServerMethod": "POST",
			"sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
			"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Projects found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
			"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
				aoData.push( { "name": "sdate", "value": $('#startdate').val() } );
				echo(sdate);die;
				aoData.push( { "name": "edate", "value": $('#enddate').val() } );
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
	jQuery('#startdate').val('');
	jQuery('#enddate').val('');
	jQuery('#empname').val('all');
	// jQuery('#clientname').val('');
	// jQuery('#ticket-filters').after('<p style="color:#00B200"><b>Succesfully Reset Filters</b></p>');
	var oTable = $('#leaves').DataTable();
	oTable.draw();
});

//addproject=> datepicker
$(document).ready(function(){
	//for start date
	$("#start_date").datepicker({
        format: 'dd-mm-yyyy',
        todayHighlight: true,
        autoclose: true,
    }).on('changeDate', function (selected) {
        $('#deadline').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });
        var minDate = new Date(selected.date.valueOf());
        $('#deadline').datepicker("update", minDate);
        $('#deadline').datepicker('setStartDate', minDate);
    });
	//for end date
	$("#deadline").datepicker({
        format: 'dd-mm-yyyy',
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
	

//addtemplate validation
$("form[name='creatclient']").validate({
	rules:{
			project_name : "required",
	},			
	submitHandler: function(form) {
	form.submit();}
});

	
//addcategory using jquery 
/*$("#category").submit(function(event) {
			event.preventDefault();
			var name = $("input[name='category_name']").val();
			var dataString = 'name='+ name;
			$.ajax({
			   url: base_url+"project/insertcategory",
			   type: 'POST',
			   data: dataString,
			   error: function() {
				  alert('Something is wrong');
			   },
			   success: function(data) {
				window.location.reload();
			  }
			});
});*/

// for add category in addproject
$("#save-category").click(function(event) {
	//event.preventDefault();
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
							console.log(data.catdata);
							$('select[name="project-category"]').html('');       
							$('select[name="project-category"]').append(data.catdata);
							 //  $("tbody").append("<tr><td>"+data.count+"</td><td>"+catname+"</td> <td><a href='javascript:;' class='btn btn-sm btn-danger btn-rounded delete-category' id='deletecat'>Remove</a></td></tr>");
							$("tbody").append("<tr id='cate_"+data.lastinsertid+"'><td>"+data.count+"</td><td>"+catname+"</td> <td><input type='submit' class='btn btn-sm btn-danger btn-rounded delete-category' onclick='deletecat(\'"+data.lastinsertid+"\');' id='deletecat' value='Remove'></tr>");
							$('#project-category1').removeClass('show');
							$('.modal-backdrop').removeClass('show');
							$('.modal-backdrop').find('div').remove();
							$('body').removeAttr("style");
							$('body').removeClass("modal-open");
							$('#category')[0].reset();
							$('#succmsg').html('');
							$('#succmsg').html('<b>Successfully category added</b>');
							//window.location.reload();
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


// addproject=> delete category 
	function deletecat(id)
	{
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
		//alert(id);
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
	
	//delete template
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
						   $('#template').DataTable().ajax.reload();
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
			   		$('#leave-edit').html('');
				  	$('#leave-edit').append(data);
			   },
			   error: function (xhr, ajaxOptions, thrownError) {
				   
			   }
		   });
		 }
			
    //edidt btn clicking
    function editdata(id){
		var mem = $('#choose_mem').val();
		var ltype = $('#leave_type').val();
		var date = $('#date').val();
		var abs = $('#absence').val();
		var sta = $('#status').val();
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

						   //$("#leads").fnReloadAjax();
							//$('#leads').DataTable.ajax.reload(null,false);
							//window.location.reload();
					   },
					   error: function (xhr, ajaxOptions, thrownError) {
						   swal("Error !", "Please try again", "error");
					   }
				   });
			   }
			   });
		}
		
		function archivedata(id) {
		//alert(id);
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

	//+addleaves 
/*
	$("#save_leave").click(function(event) {
		//event.preventDefault();
		var leave_name = $("input[name='leavename']").val();
		if(catname!=""){
			$.ajax({
				url: base_url+"Leaves/checkleave",
				type: 'POST',
				dataType: 'html',
				data:{passleave:leave_name},
				success: function(data) {
					
					if(data==0){
						var dataString = 'name='+ leave_name;
						jQuery('#errormsg').html('');
						$.ajax({
						    url: base_url+"Leaves/insertleavestype",
						    type: 'POST',
						    dataType: 'json',
						    data: dataString,
							success: function(data) {
								console.log(data.catdata);
								$('select[name="leave_type"]').html('');       
								$('select[name="leave_type"]').append(data.catdata);
								 //  $("tbody").append("<tr><td>"+data.count+"</td><td>"+catname+"</td> <td><a href='javascript:;' class='btn btn-sm btn-danger btn-rounded delete-category' id='deletecat'>Remove</a></td></tr>");
								$("tbody").append("<tr id='cate_"+data.lastinsertid+"'><td>"+data.count+"</td><td>"+leave_name+"</td> <td><input type='submit' class='btn btn-sm btn-danger btn-rounded delete-category' onclick='deleteleave(\'"+data.lastinsertid+"\');' id='deleteleave' value='Remove'></tr>");
								$('#leave_type1').removeClass('show');
								$('.modal-backdrop').removeClass('show');
								$('.modal-backdrop').find('div').remove();
								$('body').removeAttr("style");
								$('body').removeClass("modal-open");
								$('#category')[0].reset();
								$('#succmsg').html('');
								$('#succmsg').html('<b>Successfully category added</b>');
								//window.location.reload();
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
	});*/