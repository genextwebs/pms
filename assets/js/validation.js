$(function(){
	$("form[name='leads']").validate({
		rules:{
			company_name : "required",
			client_name : "required",
			client_email : "required",
			mobile :
					{	
						required:true,
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