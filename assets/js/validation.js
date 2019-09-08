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
	
});


function checkuncheck()
{
	var checkbox = document.getElementById('randompassword');
	var password = document.getElementById('password');
	//var jobValue = document.getElementById('txtname').value;
	if(checkbox.checked==true{
		var myval = "@123";
		password.value=document.getElementById('name').value+myval;
	}
}

