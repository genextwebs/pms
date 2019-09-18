jQuery(document).ready(function() {
	if(controllerName == 'leads' && (functionName == 'index' || functionName == '')){
		var oTable = jQuery('#leads').DataTable({
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
	        "sAjaxSource": base_url+"leads/lead_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Leads found<br/><br/></center>', "sZeroRecords": "<center><br/>No Leads found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#leads').dataTable();
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
});

$(function(){
	$("#creatclient").validate({
		rules:{
			company_name : "required",
			client_name : "required",
			client_email:
						{
							required:true,
							email: true
						},
			mobile:
					{	
						required:true,
						digits: true,
						minlength:10,
						maxlength:10
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

	$(function(){

		$("form[name='leadtoclient']").validate({
		rules:{
				password : "required",
				website :{
							required: true,
      						url: true
						}
		},			
		submitHandler: function(form) {
		form.submit();}
	});
	
});


function checkuncheck()
{
	
	var checkbox = document.getElementById('randompassword');
	var password = document.getElementById('password');
	if(checkbox.checked == true){
		var myval = "@123";
		password.value = document.getElementById('name').value+myval;
	}
	else{
		password.value = "";
	}
}

function deleteLeadClient(leadId, clientId, type){
	var url = base_url+"leads/deleteleads";
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
            data: {leadId:leadId, clientId:clientId, type:type},
           	dataType: "html",
            success: function (data) {
                swal("Done!", "It was succesfully deleted!", "success");
                //var objJson = JSON.parse(data);

                //location.reload(true);
                $("#leads").DataTable().ajax.reload();
 				// $("#leads").load(window.location + " #leads");
            /*var table = $("#leads").dataTable();
 
            oSettings = table.fnSettings();
 
            table.fnClearTable(this);
 
            for (var i=0; i < objJson.detail.length; i++)
            {
                table.oApi._fnAddData(oSettings, objJson.detail[i]);
                //this part always send error DataTables warning: table id=tbDataTable - Requested unknown parameter '0' for row 0.
            }
 
            oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
            table.fnDraw();
                //$("#leads").fnReloadAjax();
                 //$('#leads').DataTable.ajax.reload(null,false); 
                // window.location.reload();*/
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
            }
        });
    }
    });
}