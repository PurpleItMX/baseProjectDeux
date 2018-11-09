$(document).ready(function(){

	$("#saveFormWarehouse").click(function(){
		$("#saveWarehouse").validate();
		if($("#saveWarehouse").valid()){
			$("#saveWarehouse").submit();
		}
	});

});
