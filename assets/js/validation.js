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
	
});