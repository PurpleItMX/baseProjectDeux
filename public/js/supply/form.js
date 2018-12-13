var countRowWarehousesId = 0;
var countRowWarehouses = 0;
var table;
var id_supply_category_inactive;
var id_supply_type_inactive;
var id_season_inactive;
var warehouses = [];
$(document).ready(function(){	 
	 
	 table = $("#listTableIn").DataTable({
        		"lengthMenu": [[5, 10], [5, 10]],
        		"fixedColumns": true,
        		"autoWidth": true,
        		"responsive": true,
        		"language": {
            		"url": baseUrl+"/js/Spanish.json"
        		},
    		});

	$("body").on("keydown",$("listTableIn"),function(e){
		if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
	});

	$("#saveFormSupply").click(function(){
		$("#saveSupply").validate({ignore:false});
		if($("#saveSupply").valid()){
			if(countRowWarehouses > 0){
				$("#warehouses").val(JSON.stringify(warehouses));
				$("#saveSupply").submit();
			}else{
				messages('error','es requerido al menos un almacén');
			}
		}
	});

	$("#newSupply").click(function(){
		warehouses = [];
		if(id_supply_category_inactive)
			$("#id_supply_category option[value="+id_supply_category_inactive+"]").remove();
		if(id_supply_type_inactive)
			$("#id_supply_type option[value="+id_supply_type_inactive+"]").remove();
		if(id_season_inactive)
			$("#id_season option[value="+id_season_inactive+"]").remove();
		$("#id_supply").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#umd").val("");
		$("#description").val("");
		$("#id_supply_category").val("");
    	$("#id_supply_type").val("");
    	$("#id_season").val("");
    	$("#performance").val("");
    	$("#is_inventorial").prop('checked',false);
    	$("#is_product").prop('checked',false);
    	$("#is_auditable").prop('checked',false);
    	$("#is_direct_purchase").prop('checked',false);
		$("#radioSupply0").prop("checked",true);
		$("#radioSupply1").prop("checked",false);
		$("#radioSupply2").prop("checked",false);
		$("#stock_fixed").val("");
		$("#stock_variable").val("");
		$("#minimal_presentation").val("");
		$("#tolerance").val("");

		$("#estatus").prop('checked',false);
		$("#id_supply_category").val("");
		$("#id_supply_type").val("");
    	$("#myModalSupply").modal();
	});

	$(".search-supply").click(function(){
		if(id_supply_category_inactive)
			$("#id_supply_category option[value="+id_supply_category_inactive+"]").remove();
		if(id_supply_type_inactive)
			$("#id_supply_type option[value="+id_supply_type_inactive+"]").remove();
		if(id_season_inactive)
			$("#id_season option[value="+id_season_inactive+"]").remove();
		$("#id_supply").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#umd").val("");
		$("#description").val("");
		$("#id_supply_category").val("");
    	$("#id_supply_type").val("");
    	$("#id_season").val("");
    	$("#performance").val("");
    	$("#is_inventorial").prop('checked',false);
    	$("#is_product").prop('checked',false);
    	$("#is_auditable").prop('checked',false);
    	$("#is_direct_purchase").prop('checked',false);
		$("#radioSupply0").prop("checked",true);
		$("#radioSupply1").prop("checked",false);
		$("#radioSupply2").prop("checked",false);
		$("#stock_fixed").val("");
		$("#stock_variable").val("");
		$("#minimal_presentation").val("");
		$("#tolerance").val("");


		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/supplier/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function(error) {
    		var message = "Ocurrio un error al realizar la consulta" ;
    		/*console.log(error.responseJSON.line);
    		console.log(error.responseJSON.exception);
    		console.log(error);*/
    		messages('error', message);
  		}).always(function(data) {
  			//console.log(data.supply.id_supply);
  			$("#id_supply").val(data.supply.id_supply);
			$("#clave").val(data.supply.clave);
			$("#clave").attr('data-id' , data.supply.id_supply);
			$("#umd").val(data.supply.udm);
			$("#description").val(data.supply.description);
			$("#id_supply_category").val(data.supply.id_supply_category);
  			supplyType(data.supply.id_supply_type, true);
	    	$("#id_season").val(data.supply.id_season);
	    	$("#performance").val(data.supply.performance);
			if(data.supply.is_inventorial == 1)
	    	$("#is_inventorial").prop('checked',true);
	    	if(data.supply.is_product == 1)
	    	$("#is_product").prop('checked',true);
	    	if(data.supply.is_auditable == 1)
	    	$("#is_auditable").prop('checked',true);
	    	if(data.supply.is_direct_purchase == 1)
	    	$("#is_direct_purchase").prop('checked',true);

	    	if(data.type == 0){
				$("#radioSupply0").prop("checked",true);
				$("#radioSupply1").prop("checked",false);
				$("#radioSupply2").prop("checked",false);
			}else if(data.type == 1){
				$("#radioSupply0").prop("checked",false);
				$("#radioSupply1").prop("checked",true);
				$("#radioSupply2").prop("checked",false);
			}else if(data.type == 2){
				$("#radioSupply0").prop("checked",false);
				$("#radioSupply1").prop("checked",false);
				$("#radioSupply2").prop("checked",true);
			}
			
			$("#stock_fixed").val(data.supply.stock_fixed);
			$("#stock_variable").val(data.supply.stock_variable);
			$("#minimal_presentation").val(data.supply.minimal_presentation);
			$("#tolerance").val(data.supply.tolerance);

  			if(data.supply.estatus == 1)
    			$("#estatus").prop('checked',true);

    		if($('#id_supply_category').find(":selected").text() == ''){
  				id_supply_category_inactive = data.supply.id_supply_category;
  				searchValueInactive(data.supply.id_supply_category, "id_supply_category" ,"supply-category");
  			}

  			if($('#id_supply_type').find(":selected").text() == '' || $('#id_supply_type').find(":selected").text() == 'Seleccione'){
  				id_supply_type_inactive = data.supply.id_supply_type;
  				searchValueInactive(data.supply.id_supply_type, "id_supply_type", "supply-type");
  			}
  			if($('#id_season').find(":selected").text() == ''){
  				id_season_inactive = data.supply.id_season;
  				searchValueInactive(data.supply.id_season, "id_season","season");
  			}
  			$.each(data.supplyWarehouse, function(i, element){
  				updateTableWarehouseUpdate(element.id_warehouse, element.percent);
  			});
  		});
		$("#myModalSupply").modal();
	});

	$("#id_supply_category").change(function(){
		var id = $(this).val();
		supplyType(id,false);
	});

	$("#addButtonWarehouse").click(function(){
		if(countRowWarehouses <= 4 ){
			updateTableWarehouse();
		}else{
			messages('error', 'Solo se permite hasta 5 almacenes');
		}
	});


});

function updateTableWarehouse(html){
	var select = "<select id='selectWarehouse"+countRowWarehousesId+"' data-id='"+countRowWarehousesId+"' class='form-control warehouseSelect required' ><option value=''>Seleccione</option>";
	$.each(JSON.parse($("#warehousesInput").val()),function(id,warehouse){
		select += "<option value='"+warehouse.id_warehouse+"'>"+warehouse.clave+"</option>";
	});
	select += "</select>";
	var input = "<input data-id='"+countRowWarehousesId+"' value='' class='form-control warehouseInput required'/>";
	//var buttons = "<button data-id='' class='btn btn-sucess bt-sm save'><i class='fa fa-floppy-o'></i></button>";
		//buttons +="<button data-id='' class='btn btn-default bt-sm update'><i class='fa fa-pencil'></i></button>";
	var buttons ="<button id='buttonWarehouseDelete"+countRowWarehousesId+"' data-id='"+countRowWarehousesId+"' class='btn btn-danger bt-sm deleteWarehouse' onclick='deleteWarehouse(buttonWarehouseDelete"+countRowWarehousesId+")'><i class='fa fa-trash-o'></i></button>";
	var myData = [ select, input, buttons];
	table
    .row.add(myData)
    .draw();
    warehouses.push({'id_warehouse':'', 'porcent': ''});
    countRowWarehouses++;
    countRowWarehousesId++;

    $(".warehouseSelect").change(function(){
    	if( $(this).val() != 'Seleccione' || $(this).val() != "") 
    		warehouses[$(this).attr('data-id')].id_warehouse = $(this).val();
    });

    $(".warehouseInput").change(function(){
    	if($(this).val() != "") 
    	warehouses[$(this).attr('data-id')].porcent = $(this).val();
    });
}

function updateTableWarehouseUpdate(id_warehouse, percent){
	var select = "<select id='selectWarehouse"+countRowWarehousesId+"' data-id='"+countRowWarehousesId+"' class='form-control warehouseSelect required' ><option value=''>Seleccione</option>";
	$.each(JSON.parse($("#warehousesInput").val()),function(id,warehouse){
		if(id_warehouse == warehouse.id_warehouse){
			select += "<option value='"+warehouse.id_warehouse+"' selected>"+warehouse.clave+"</option>";
		}else{
			select += "<option value='"+warehouse.id_warehouse+"'>"+warehouse.clave+"</option>";
		}
	});
	select += "</select>";
	var input = "<input data-id='"+countRowWarehousesId+"' value='"+percent+"' class='form-control warehouseInput required'/>";
	//var buttons = "<button data-id='' class='btn btn-sucess bt-sm save'><i class='fa fa-floppy-o'></i></button>";
		//buttons +="<button data-id='' class='btn btn-default bt-sm update'><i class='fa fa-pencil'></i></button>";
	var buttons ="<button id='buttonWarehouseDelete"+countRowWarehousesId+"' data-id='"+countRowWarehousesId+"' class='btn btn-danger bt-sm deleteWarehouse' onclick='deleteWarehouse(buttonWarehouseDelete"+countRowWarehousesId+")'><i class='fa fa-trash-o'></i></button>";
	var myData = [ select, input, buttons];
	table
    .row.add(myData)
    .draw();
    warehouses.push({'id_warehouse':id_warehouse, 'porcent': percent});
    countRowWarehouses++;
    countRowWarehousesId++;

    $(".warehouseSelect").change(function(){
    	if( $(this).val() != 'Seleccione' || $(this).val() != "") 
    		warehouses[$(this).attr('data-id')].id_warehouse = $(this).val();
    });

    $(".warehouseInput").change(function(){
    	if($(this).val() != "") 
    	warehouses[$(this).attr('data-id')].porcent = $(this).val();
    });
}

function deleteWarehouse(element){
	 table
    .row($(element).parents('tr'))
    .remove()
    .draw(true);
    countRowWarehouses--;

    delete warehouses[$(element).attr('data-id')];
}

function supplyType(id, draw){
	$("#id_supply_type").empty();
	$("#id_supply_type").append(new Option("Seleccione", ""));
	if(id != ""){
		$.ajax({
				url: baseUrl+'/supply-type/category/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
		.fail(function() {
			var message = "Ocurrio un error al realizar la consulta" ;
    		messages('error', message);
			}).always(function(data) {
				$.each(data, function(id,obj){
					$("#id_supply_type").append(new Option(obj.clave, obj.id_supply_type));
				});
				if(draw)
				$("#id_supply_type option[value="+id+"]").attr('selected', 'selected');
			});
	}
}

function searchValueInactive(id, input, controller){
	$.ajax({
			url: baseUrl+'/'+controller+'/'+id,
	})
	/*.done(function() {console.log( "second success" );})*/
	.fail(function() {
		var message = "Ocurrio un error al realizar la consulta" ;
    		messages('error', message);
	}).always(function(data) {
		switch(controller){
			case "season":
				$("#"+input).append(new Option(data.clave, data.id_season));		
			break;
			case "supply-type":
				$("#"+input).append(new Option(data.clave, data.id_supply_type));
			break;
			case "supply-category":
				$("#"+input).append(new Option(data.clave, data.id_supply_category));
			break;
		}
		$("#"+input+" option[value="+id+"]").attr('selected', 'selected');
	});
}