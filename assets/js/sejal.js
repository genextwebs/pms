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
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
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
	else if(controllerName == 'project' && functionName == 'projecttemplate')
	{
			
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
                     // { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                      //{ "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      //{ "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"Project/templatelist",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Projects found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
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
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Leads</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Leads</small>)';
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
	else if(controllerName == 'project' && functionName == 'viewarchiev')
		{
			
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
	        "sAjaxSource": base_url+"Project/archivelist",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Projects found<br/><br/></center>', "sZeroRecords": "<center><br/>No Projects found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
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
			$('#project_status').change(function(){ //button filter event click
				var oTable = $('#project').DataTable();
					oTable.draw();
			});
        
		
	//ARCHIEVE FILTER
	$('#clientname').change(function(){ //button filter event click
				var oTable = $('#archievdata').DataTable();
					oTable.draw();
			});

			$('#project_status').change(function(){ //button filter event click
				var oTable = $('#archievdata').DataTable();
					oTable.draw();
			});
        
		
	//add project
	$("form[name='creatclient']").validate({
		rules:{
				project_name : "required",
				start_date : "required",
				deadline : "required",		
		},			
		submitHandler: function(form) {
		form.submit();}
	});
	
	//add template
	$("form[name='creatclient']").validate({
		rules:{
				project_name : "required",
		},			
		submitHandler: function(form) {
		form.submit();}
	});
	

