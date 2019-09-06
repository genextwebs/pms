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
		
$(function(){
			$("form[name='division']").validate({
			rules:{
					division_name:"required",
					branch:"required",
					semester:"required",
					Intake:"required",
					status:"required",	
					
				},			
				submitHandler: function(form) {
				form.submit();}
			});
		});

$(function(){
			$("form[name='subject']").validate({
			rules:{
					branch:"required",
					semester:"required",
					faculty:"required",
					'multiple_branch[]':"required",
					subject_name:"required",
					subject_code:"required",
					status:"required",	
					
				},			
				submitHandler: function(form) {
				form.submit();}
			});
		});


