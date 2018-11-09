$(document).ready(function(){
	$("#saveFormUser").click(function(){
		$("#saveUser").validate();
		if($("#saveUser").valid()){
			$("#saveUser").submit();
		}
	});

	$("#password").change(function(){
		if($("#password-confirm").value() == $("#password").value()){
			$("#password-confirm").addClass('error');
		}else{
			$("#password-confirm").removeClass('error');
		}

	});

	$("#password-confirm").change(function(){
		if($("#password-confirm").value() == $("#password").value()){
			$("#password-confirm").addClass('error');
		}else{
			$("#password-confirm").removeClass('error');
		}
	});

});
