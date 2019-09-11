$(function(){
	$("form[name='leads']").validate({
		rules:{
			company_name : "required",
			client_name : "required",
			client_email:
						{
							required:true,
							email: true
						},
			mobile :
					{	
						required:true,
						digits: true,
						minlength:10,
						maxlength:10
					},
		},	
		messages:
				{
					mobile : "Enter 10 digit Number",
					
				},		
		submitHandler: function(form) {
		form.submit();}
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

	$("form[name='leadtoclient']").validate({
		rules:{
				password : "required",
				website :{
							required: true,
      						url: true
						},
		},			
		submitHandler: function(form) {
		form.submit();}
	});
	
});


function checkuncheck()
{
	
	var checkbox = document.getElementById('randompassword');
	var password = document.getElementById('password');
	//var jobValue = document.getElementById('txtname').value;
	if(checkbox.checked==true){
		var myval = "@123";
		password.value=document.getElementById('name').value+myval;
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
                //$("#leads").fnReloadAjax();
                 //$('#leads').DataTable.ajax.reload(null,false); 
                 window.location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error deleting!", "Please try again", "error");
            }
        });
    }
    });
}

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
           data: {clientid:clienti},
          dataType: "html",
           success: function (data) {
               swal("Done!", "It was succesfully deleted!", "success");
               //$("#leads").fnReloadAjax();
                //$('#leads').DataTable.ajax.reload(null,false);
                window.location.reload();
           },
           error: function (xhr, ajaxOptions, thrownError) {
               swal("Error deleting!", "Please try again", "error");
           }
       });
   }
   });
}

	
