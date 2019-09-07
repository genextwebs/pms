$(function(){
	$("form[name='leads']").validate({
		rules:{
			company_name : "required",
			client_name : "required",
			client_email : "required",
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