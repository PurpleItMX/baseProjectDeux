$(document).ready(function(){

	$("#saveFormSupplyCategory").click(function(){
		$("#saveSupplyCategory").validate();
		if($("#saveSupplyCategory").valid()){
			$("#saveSupplyCategory").submit();
		}
	});

});
