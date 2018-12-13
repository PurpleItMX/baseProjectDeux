$(document).ready(function(){

	$("#saveFormSeason").click(function(){
		$("#saveFormSeason").prop('disabled', true);
		$("#saveSeason").validate({
			rules: {
        		time_end: { greaterThan: "#time_initial_season_modal" }
    		}
		});
		if($("#saveSeason").valid()){
			save("saveSeason","#id_season",false,"myModalSeason", "season");
		}
		$("#saveFormSeason").prop('disabled', false);
	});

	$("#saveFormWarehouse").click(function(){
		$("#saveFormWarehouse").prop('disabled', true);
		$("#saveWarehouse").validate();
		if($("#saveWarehouse").valid()){
			save("saveWarehouse",".warehouseSelect",true,"myModalWarehouse", "warehouse");
		}
		$("#saveFormWarehouse").prop('disabled', false);
	});

	$("#saveFormSupplyType").click(function(){
		$("#saveSupplyType").prop('disabled', true);
		$("#saveSupplyType").validate();
		if($("#saveSupplyType").valid()){
			save("saveSupplyType","#id_supply_type",false,"myModalSupplyType", "supply-type");
		}
		$("#saveSupplyType").prop('disabled', false);
	});

	$("#saveFormSupplyCategory").click(function(){
		$("#saveFormSupplyCategory").prop('disabled', true);
		$("#saveSupplyCategory").validate();
		if($("#saveSupplyCategory").valid()){
			save("saveSupplyCategory","#id_supply_category",false,"myModalSupplyCategory", "supply-category");
		}
		$("#saveFormSupplyCategory").prop('disabled', false);
	});

	$("#newSeason").click(function(){
		$("#id_season_modal").val("");
		$("#clave_season_modal").val("");
		$("#clave_season_modal").attr('data-id' , '');
		$("#time_initial_season_modal").val("");
		$("#time_end_season_modal").val("");
		$("#estatus_season_modal").prop('checked',false);
		$("#description_season_modal").val("");
    	$("#myModalSeason").modal();
	});	

	$("#newWarehouse").click(function(){
		$("#id_warehouse_modal").val("");
		$("#clave_warehouse_modal").val("");
		$("#clave_warehouse_modal").attr('data-id' , '');
		$("#description_warehouse_modal").val("");
		$("#estatus_warehouse_modal").prop('checked',false);
    	$("#prorate_warehouse_modal").prop('checked',false);
    	$("#myModalWarehouse").modal();
	});

	$("#newSupplytype").click(function(){
		$("#id_supply_type_modal").val("");
		$("#clave_supply_type_modal").val("");
		$("#clave_supply_type_modal").attr('data-id' , '');
		$("#description_supply_type_modal").val("");
		$("#estatus_supply_type_modal").prop('checked',false);
    	$("#id_supply_category_supply_type_modal").val("");
    	$("#myModalSupplyType").modal();
	});	

	$("#newSupplyCategory").click(function(){
		$("#id_supply_category_modal").val("");
		$("#clave_supply_category_modal").val("");
		$("#clave_supply_category_modal").attr('data-id' , '');
		$("#description_supply_category_modal").val("");
		$("#estatus_supply_category_modal").prop('checked',false);
    	$("#variant_supply_category_modal").val("");
    	$("#myModalSupplyCategory").modal();
	});

});

function save(form, id, is_class, modal, type){

	var action = $("#"+form).attr('action');
	$.ajax({
		type: "POST",
        data: $("#"+form).serialize(),
  		url: action,
	})
		/*.done(function() {console.log( "second success" );})*/
    .fail(function(error) {
    	console.log( error );
    	messages("error",error.message);
  	}).always(function(data) {
  		drawCombo(is_class, id, data,modal, type);
  	});
}

function drawCombo(is_class, id, data,modal, type){
	if(is_class){		
		$.each($(id),function(id, input){
			$(input).empty();
			var idInput = $(input).attr('id');
			$.each(data,function(i, obj){
					$("#"+idInput).append(new Option(obj.clave, obj.id_warehouse));
			});
		});
		$("#warehousesInput").val(JSON.stringify(data));
	}else{
		$(id).empty();
		$(id).append(new Option("Seleccione", ''));
		$.each(data,function(i, obj){
			switch(type){
				case "season":
					$(id).append(new Option(obj.clave, obj.id_season));		
				break;
				case "supply-type":
					$(id).append(new Option(obj.clave, obj.id_supply_type));
				break;
				case "supply-category":
					$(id).append(new Option(obj.clave, obj.id_supply_category));
				break;
			}
		});
	}	
	$("#"+modal).modal('hide');
}