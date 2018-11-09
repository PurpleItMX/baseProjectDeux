$(document).ready(function(){

	$("#saveFormSupplyType").click(function(){
		$("#saveSupplyType").validate();
		if($("#saveSupplyType").valid()){
			$("#saveSupplyType").submit();
		}
	});

});
