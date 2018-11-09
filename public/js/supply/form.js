$(document).ready(function(){

	$("#saveFormSupply").click(function(){
		$("#saveSupply").validate();
		if($("#saveSupply").valid()){
			$("#saveSupply").submit();
		}
	});

});
