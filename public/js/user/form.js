$(document).ready(function(){
	$("#saveFormUser").click(function(){
		$("#saveUser").validate({
			 rules : {
                password : {
                    minlength : 8
                },
                password_confirmation : {
                    minlength : 8,
                    equalTo : "#password"
                }
            }
		});
		if($("#saveUser").valid()){
			$("#saveUser").submit();
		}
	});

});
