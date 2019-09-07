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
	
});