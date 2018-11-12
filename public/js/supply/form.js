$(document).ready(function(){

	//guarda nuevos almacenes
	$("#saveFormWarehouse").click(function(){
		$("#saveWarehouse").validate();
		if($("#saveWarehouse").valid()){
			$("#saveWarehouse").submit();
		}
	});

	//guarda nuevas categoria de insumo
	$("#saveFormSupplyCategory").click(function(){
		$("#saveSupplyCategory").validate();
		if($("#saveSupplyCategory").valid()){
			$("#saveSupplyCategory").submit();
		}
	});

	//guarda nuevo tipo de insumo
	$("#saveFormSupplyType").click(function(){
		$("#saveSupplyType").validate();
		if($("#saveSupplyType").valid()){
			$("#saveSupplyType").submit();
		}
	});

	//guarda nuevas temporadas
	$("#saveFormSeason").click(function(){
		$("#saveSeason").validate();
		if($("#saveSeason").valid()){
			$("#saveSeason").submit();
		}
	});

	$("#saveFormSupply").click(function(){
		$("#saveSupply").validate();
		if($("#saveSupply").valid()){
			$("#saveSupply").submit();
		}
	});

	

});
