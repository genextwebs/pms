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

	else if(controllerName == 'products' && (functionName == 'index' || functionName == '')){
		var oTable = jQuery('#products').DataTable({
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
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"products/product_list",
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
	                    var oTable = $('#products').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Products</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Products</small>)';
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

	else if(controllerName == 'employee' && (functionName == 'index' || functionName == '')){
		var oTable = jQuery('#employee').DataTable({
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
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]}, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ "desc", "asc" ] }, 
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [ ] }, 
                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"employee/employee_list",
	        "sServerMethod": "POST",
	        "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
        	"oLanguage": { "sProcessing": "<i class='fa fa-spinner fa-spin fa-3x fa-fw green bigger-400'></i>", "sEmptyTable": '<center><br/>No Leads found<br/><br/></center>', "sZeroRecords": "<center><br/>No Leads found<br/><br/></center>", "sInfo": "_START_ to _END_ of _TOTAL_ leads", "sInfoFiltered": "", "oPaginate": {"sPrevious": "<i class='fa fa-angle-double-left'></i>", "sNext": "<i class='fa fa-angle-double-right'></i>"}},
        	"fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
        		var selected = [];
					$("#skill :selected").map(function(i, el) {
						selected[$(this).val()] = $(this).text();
					}).get();
					//console.log(selected);
					aoData.push( { "name": "status", "value": $('#status').val() } );

					aoData.push( { "name": "employeename", "value": $('#employeename').val() } );
					
					aoData.push( { "name": "skill", "value": $('#skill').val() } );
					aoData.push( { "name": "designation", "value": $('#designation').val() } );
					aoData.push( { "name": "department", "value": $('#department').val() } );
        		oSettings.jqXHR = $.ajax( {
	                "dataType": 'json',
	                "type": "POST",
	                "url": sSource,
	                "data": aoData,
	                "timeout": 60000, //1000 - 1 sec - wait one minute before erroring out = 30000
	                "success": function(json) {
	                    var oTable = $('#employee').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Employees</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Employees</small>)';
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

	else if(controllerName == 'project' && functionName == 'task'){
		var oTable = jQuery('#tasks-table').DataTable({
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
                      { "sWidth": "250px", sClass: "text-center", "asSorting": [  ]},  
                     ],
	        "bServerSide": true,
	        "fixedHeader": true,
	        "sAjaxSource": base_url+"project/task_list",
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
	                    var oTable = $('#tasks-table').dataTable();
	                    var oLanguage = oTable.fnSettings().oLanguage;

	                    if((json.estimateCount == true) && (json.iTotalDisplayRecords == json.limitCountQuery)){
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of more than _TOTAL_ (<small>' + json.iTotalRecordsFormatted + ' Tasks</small>)';
	                    }
	                    else{
	                        oLanguage.sInfo = '<b>_START_ to _END_</b> of <b>_TOTAL_</b> (<small>' + json.iTotalRecordsFormatted + ' Tasks</small>)';
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
$('#btnapply').click(function(){ 
			//button filter event click
	var oTable = $('#employee').DataTable();
	oTable.draw();
});

$(document).ready(function(){
  $("#toggle-filter").click(function(){
    $("#filterdiv").toggle();
  });
});

$(function(){
	$("#creatclient").validate({
		rules:{
			company_name : "required",
			name : "required",
			website:{
				required:true,
				url:true,
			},
			mobile:
					{	
						required:true,
						digits: true,
						minlength:10,
						maxlength:10
					},
			email:
			{
				required:true,
				email: true
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

$(function(){

		$('#product').validate({
		rules:{
				name : "required",
				price : "required",
				description : "required"					
		},			
		submitHandler: function(form) {
		form.submit();}
	});
});

$(function(){

		$("form[name='tax']").validate({	
		rules:{
				tax_name : "required",
				rate : "required",
		},			
		submitHandler: function(form) {
		form.submit();}
	});
});

$(function(){

		$('#createemployee').validate({
		rules:{
				employee_name : "required",
				employee_email :{
							
							required:true,
							email: true
						},
				password : "required",
				mobile:
					{	
						required:true,
						digits: true,
						minlength:10,
						maxlength:10
					},
				designation : "required",
				department : "required",
		},	
		messages:
				{
					mobile : "Enter 10 digit",
					
				},	
		submitHandler: function(form) {
		form.submit();}
	});
});

$(function(){

		$("form[name='task_category']").validate({
		rules:{
				title_task : "required",
				startdate : "required" ,
				due_date : "required" ,
				assignemp : "required"
		},	
		messages:{
				assignemp : "Choose an assignee",
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
	                $("#leads").DataTable().ajax.reload();
	            },
	            error: function (xhr, ajaxOptions, thrownError) {
	                swal("Error deleting!", "Please try again", "error");
	            }
	        });
	    }
    });
}

// for add tax in product
$("#save-product").click(function(event) {
			event.preventDefault();
			var taxname = $("input[name='tax_name']").val();
       		var rate = $("input[name='rate']").val();
       		var dataString = 'taxname='+ taxname + '&rate='+ rate;
        $.ajax({
           url: base_url+"products/inserttax",
           type: 'POST',
           dataType: 'json',
           data: dataString,
           error: function() {
              alert('Something is wrong');
           },
           success: function(data) {
           	console.log(data);
     			/*$.each(data.taxdata, function(key, value) {
                           $('select[name="tax"]').append('<option value="'+ value.id +'">'+ value.rate +'</option>');
                       })*/
                $('select[name="tax"]').html('');       
                $('select[name="tax"]').append(data.taxdata);
               $("tbody").append("<tr><td>"+data.count+"</td><td>"+taxname+"</td><td>"+rate+"</td></tr>");
               $('#project-tax').modal('toggle');
                $('#tax')[0].reset();
           }
        });
});

function deleteproducts(id){
	var url = base_url+"products/deleteproducts";
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
           data: {id:id},
          dataType: "html",
		  
           success: function (data) {
               swal("Done!", "It was succesfully deleted!", "success");
			   $('#products').DataTable().ajax.reload();
           },
           error: function (xhr, ajaxOptions, thrownError) {
               swal("Error deleting!", "Please try again", "error");
           }
       });
   }
   });
}

// display skills in employee
$(function() {
		$('#skills').tagsInput({width:'auto'});
    });

// display designation in employee
$("#save-designation").click(function(event) {
			event.preventDefault();
			var name = $("input[name='designation_name']").val();
       		var dataString = 'name='+ name;
        $.ajax({
           url: base_url+"employee/insert_designation",
           type: 'POST',
           dataType: 'json',
           data: dataString,
           error: function() {
              alert('Something is wrong');
           },
           success: function(data) {
           	//console.log(data);
     			/*$.each(data.taxdata, function(key, value) {
                           $('select[name="tax"]').append('<option value="'+ value.id +'">'+ value.rate +'</option>');
                       })*/
                $('select[name="designation"]').html('');
                $('select[name="designation"]').append(data.taxdata);
              // $("tbody").append("<tr><td>"+data.count+"</td><td>"+taxname+"</td><td>"+rate+"</td></tr>");
               $('#data-designation').modal('toggle');
                $('#modeldesignation')[0].reset();
           }
        });
});

// display department in employee
$("#save-department").click(function(event) {
			event.preventDefault();
			var name = $("input[name='department_name']").val();
       		var dataString = 'name='+ name;
        $.ajax({
           url: base_url+"employee/insert_department",
           type: 'POST',
           dataType: 'json',
           data: dataString,
           error: function() {
              alert('Something is wrong');
           },
           success: function(data) {
           	//console.log(data);
     			/*$.each(data.taxdata, function(key, value) {
                           $('select[name="tax"]').append('<option value="'+ value.id +'">'+ value.rate +'</option>');
                       })*/
                $('select[name="department"]').html('');
                $('select[name="department"]').append(data.taxdata);
              // $("tbody").append("<tr><td>"+data.count+"</td><td>"+taxname+"</td><td>"+rate+"</td></tr>");
               $('#data-department').modal('toggle');
                $('#modaldepartment')[0].reset();
           }
        });
});

// image upload and preview
/*$(document).ready(function(){
 
        $('#createemployee').change(function(e){
			
            e.preventDefault(); 
                 $.ajax({
                     url:base_url+"employee/do_upload",
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
						var myArray = JSON.parse(data);
						if(myArray.error!='')
						  {
							 alert(myArray.error);
							$('#errordiv').css('display', 'block');
							$('#errordiv').append(myArray.error);  
						  }
						  else
						  {
						  	$('#imgdiv').css('display', 'block');
							$('#imgdiv').append('<img src="'+base_url + 'uploads/'+myArray.image +'" width="100px" height="100px"><a onClick="removeimage();" href="">Remove</a>');
							$('#imagename').val(myArray.image);
						  }	
					}
                 });
            });
    });
    function removeimage()
	{
	$('#imgdiv').html('');
	}*/


//for search deopdown
$(document).ready(function(){
	$("#designation").select2();
   });

$(document).ready(function(){
	$("#department").select2();
   });

function deleteemployee(id){
	
	var url = base_url+"employee/deleteemployee";
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
           data: {id:id},
          dataType: "html",
		  
           success: function (data) {
               swal("Done!", "It was succesfully deleted!", "success");
			   $('#employee').DataTable().ajax.reload();
           },
           error: function (xhr, ajaxOptions, thrownError) {
               swal("Error deleting!", "Please try again", "error");
           }
       });
   }
   });
}

$(document).ready( function() {
        $('.submit-alerts').delay(1000).fadeOut();
      });

// for repeat holiday item
$('#repeate-data').click(function(){
	
	var counter=$('#counter').val();
	counter++;
	$('#counter').val(eval(counter));
	$('#dynamic').append('<div id="row'+counter+'"><div class="row"><div class="col-md-4"><div class="form-group"><input type="text" name="holiday_name[]" id="start_date'+counter+'"  placeholder="Date" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><input type="text" name="occasion[]" id="occasion1"  placeholder="Occasion" class="form-control"><div class="col-md-1 text-right visible-md visible-lg"><button type="button" name="remove" id="'+counter+'" class="btn remove-item btn-circle btn-danger remove"><i class="fa fa-remove"></i></button></div></div></div></div>');
	$("#start_date"+counter).datepicker({  format: 'dd-mm-yyyy'});
 });                                       
 
 $(document).on('click','.remove',function(){
	var btn_id=$(this).attr("id");
	$("#row"+btn_id+'').remove();
});  

//add holiday

$("#save-holiday").click(function(event) {
	var holiday_arr = [];
	var ocasion_arr = [];
	var holiday_err = 0;
	var occasion_err = 0;
	$("input[name^='holiday_name']").each(function() {
		var holiday_date = $(this).val();
		if(holiday_date.trim() == ''){
			holiday_err = 1;
		}
    holiday_arr.push($(this).val());
});
	$("input[name^='occasion']").each(function() {
		var occasion = $(this).val();
		if(occasion.trim() == ''){
			 occasion_err = 1;
		}
    ocasion_arr.push($(this).val());
});
	
	if(holiday_err == 1){
		alert('enter holiday');
		return false;
	}
	if(occasion_err == 1){
		alert('enter occasion');
		return false;
	}
	
	event.preventDefault();
        $.ajax({
           url: base_url+"holiday/insert_data",
           type: 'POST',
           data: {'holiday':holiday_arr,'occasion' : ocasion_arr},
           error: function() {
              alert('Something is wrong');
           },
           success: function(data) {
           		if(data == 1){
           			alert('Already assign Occasion');
           		}
           		else{
           		$('#data-holiday').modal('toggle');
                $('#modelholiday')[0].reset();
                displayData();
            	}
           	}
        });
});

//for save save-defaultholiday


$("#save-defaultholiday").click(function(event) {
			event.preventDefault();
			//var saturday = $("input[name='saturday']").val();
			 if ($("input[name='saturday']").prop('checked')== true) { 
			 	saturday = '1';
			 }
			 else{
			 	saturday = '0';
			 }
			 if ($("input[name='sunday']").prop('checked')== true) { 
			 	sunday = '1';
			 }
			 else{
			 	sunday = '0';
			 }
       		//var dataString = 'saturday='+ saturday +'sunday=' + sunday ;
       		//alert(dataString);
        $.ajax({
           url: base_url+"holiday/insert_defaultholiday",
           type: 'POST',
           
           data: {saturday : saturday , sunday : sunday},
           error: function() {
              alert('Something is wrong');
           },
           success: function(data) {
	               $('#data-defaultholiday').modal('toggle');
	               $('#modeldefaultholiday')[0].reset();
           		
               displayData();
           }
        });
});

$(".close").click(function() {
	$('#data-holiday').modal('toggle');
    $('#modelholiday')[0].reset();
    $('#dynamic').html('');
 });   
                                 
$(".closedata").click(function() {                                                  
	$('#data-defaultholiday').modal('toggle');
    $('#modeldefaultholiday')[0].reset();  
});                                               
 

function displayData(){
	$.ajax({
           	url: base_url+"holiday/displayData",
           	type: 'POST',
           	dataType:'JSON',
           	error: function() {
              alert('Something is wrong');
           	},
      	 	success: function(data) {

	           	jQuery('#janTbody').html('');
	       		jQuery('#janTbody').append(data.janStr);
	       		jQuery('#febTbody').html('');
	       		jQuery('#febTbody').append(data.febStr);
	       		jQuery('#marTbody').html('');
	       		jQuery('#marTbody').append(data.marStr);
	       		jQuery('#aprilTbody').html('');
	       		jQuery('#aprilTbody').append(data.aprilStr);
	       		jQuery('#mayTbody').html('');
	       		jQuery('#mayTbody').append(data.mayStr);
	       		jQuery('#juneTbody').html('');
	       		jQuery('#juneTbody').append(data.juneStr);
	       		jQuery('#julyTbody').html('');
	       		jQuery('#julyTbody').append(data.julyStr);
	       		jQuery('#augTbody').html('');
	       		jQuery('#augTbody').append(data.augStr);
	       		jQuery('#sepTbody').html('');
	       		jQuery('#sepTbody').append(data.sepStr);
	       		jQuery('#octTbody').html('');
	       		jQuery('#octTbody').append(data.octStr);
	       		jQuery('#novTbody').html('');
	       		jQuery('#novTbody').append(data.novStr);
	       		jQuery('#decTbody').html('');
	       		jQuery('#decTbody').append(data.decStr);
	       	}
    	});
}                                           
function deleteHoliday(id,type){
		
	var url = base_url+"holiday/deleteholiday";
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
           data: {id:id,type:type},
          dataType: "html",
		  
           success: function (data) {
               swal("Done!", "It was succesfully deleted!", "success");
			   displayData();
           },
           error: function (xhr, ajaxOptions, thrownError) {
               swal("Error deleting!", "Please try again", "error");
           }
       });
   }
   });
}

$('#selectyear').change(function(){
	year = $(this).val();
	$.ajax({
		url : base_url+"holiday/check_year",
        type : 'POST',
        data : {year: year},
        error: function() {
              alert('Something is wrong');
           },
        success: function(){
        	displayData();
        }
	});

});

function deleteTemplateM(id){
	var url = base_url+"project/deletetemplateM";
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
           data: {id:id},
          dataType: "html",
		  
           success: function (data) {
               swal("Done!", "It was succesfully deleted!", "success");
               $('#'+atob(id)+'-tr').hide();
			   
           },
           error: function (xhr, ajaxOptions, thrownError) {
               swal("Error deleting!", "Please try again", "error");
           }
       });
   }
   });
}                                            
 


 function deleteProjectM(pmid){
	var url = base_url+"project/deleteprojectM";
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
           data: {id:pmid},
          dataType: "html",
		  
           success: function (data) {
               swal("Done!", "It was succesfully deleted!", "success");
               $('#'+atob(pmid)+'-tr').hide();
			   
           },
           error: function (xhr, ajaxOptions, thrownError) {
               swal("Error deleting!", "Please try again", "error");
           }
       });
   }
   });
}                          

// add category in task

$('#save-task-category').click(function(){
	var task_cat_name = $("input[name='category_name']").val();
	if(task_cat_name != ''){
		$.ajax({
			url: base_url+"project/checkTaskCategory",
			type: 'POST',
			dataType: 'html',
			data:{task_cat_name:task_cat_name},
			success: function(data) {
				if(data == 0){
					var dataString = 'task_cat_name='+ task_cat_name;
					$.ajax({
						url: base_url+"project/insert_task_category",
						type: 'POST',
						dataType: 'JSON',
						data: dataString,
						success: function(data){
							$('select[name="task-category"]').html('');
							$('select[name="task-category"]').append(data.task_cat);
							$('#taxCategory').append("<tr id='taskCat_"+data.lastTaskCatinsertid+"'><td>"+data.count+"</td><td>"+task_cat_name+"</td><td><input type='submit' class='btn btn-sm btn-danger btn-rounded delete-category' onclick='deletetaskCat(\""+data.lastTaskCatinsertid+"\");' value='Remove' id='deletetaskCat'></td></tr>");
							$('#add-task-categ').modal('toggle');
							$('#createTaskCategoryForm')[0].reset();
						}
					});		
				}else{
					jQuery('#errormsg').html('');
					jQuery('#errormsg').html('<b>This task category already exists</b>');
				}
			}
		});
	}
		else{
			jQuery('#errormsg').html('');
			jQuery('#errormsg').html('<b>Please enter taxk category name</b>');
		}
});

function deletetaskCat(id){
	$.ajax({
	    type: "POST",
	    url: base_url+"project/deletetaskCat",
	    cache: false,
	    data: "id="+id,
	    success: function(data){
		   	if(data == 1){
		   		jQuery('#taskCat_'+id).remove();
		   	}
		   	else{
		   		$('#succmsg').html('');
				$('#succmsg').html('<b>Something went to wrong</b>');
		   	}
		}
	});
}

//for show add new task
$('#show-new-task-panel').click(function(){
	$('#task_show').show();
});

//for close add task div
$('#hide-new-task-panel').click(function(){
	$('#task_show').hide();
});
                                                                                     
// for show update task view

$('#updateTask').click(function(){
	$('#update_task_show').show();
});                                    
                                    

                                              
	