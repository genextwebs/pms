function checkuncheck()
{
	
	var checkbox = document.getElementById('randompassword');
	var password = document.getElementById('password');
	var jobValue = document.getElementById('txtname');
	if(checkbox.checked==true){
		var myval = "@123";
		password.value=document.getElementById('name').value+myval;
	}
	else
	{
		            	password.value="";

	}
}

	//clientvalidation
	
$(function() {
	$("form[name='client']").validate({
		rules: {
			website :{	required: true,
      					url: true
						},
			name: "required",
			 client_email:
						{
							required:true,
							email: true
						},
			password:
			  {
				required: true,
				minlength: 6
			  
			  }
			 	},
				submitHandler: function(form) {
				form.submit();}
	});
});


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

	
	