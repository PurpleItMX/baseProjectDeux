var table;
var countRowsSupplyId = 0;
var countRowsSupplies =  0;
var supplies = [];
var idSupply;
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

	$("#clave").change(function(){
		$("#umd").val("");
		$("#description").val("");
        $("#performance").addClass("hide");
        $("#unit_cost_text").text("");
        $("#recipe_cost_text").text("");
        $("#previous_production_week_text").text("");
        $("#quantity_produce_text").text("");
		if(($("#clave").hasClass('error') == false)){
			var clave = $(this).val();
			$.ajax({
	  			url: baseUrl+'/subrecipe/findClave/'+clave,
			})
			/*.done(function() {console.log( "second success" );})*/
	    	.fail(function(error) {
	    		var message = "Ocurrio un error al realizar la consulta" ;
	    		messages('error', message);
	  		}).always(function(data) {
	  			idSupply = data.id_supply
				$("#umd").val(data.udm);
				$("#description").val(data.description);
				$("#unit_cost").val("0.00");
				$("#unit_cost_text").text("$0.00");
				$("#performance").val("0.00");
				$("#performance").removeClass("hide");
				$("#recipe_cost").val("0.00");
				$("#recipe_cost_text").text("$0.00");
				$("#previous_production_week").val("0.00");
				$("#previous_production_week_text").text("$0.00");
				$("#quantity_produce").val("0.00");
				$("#quantity_produce_text").text("$0.00");
	  		});
		}
	});

	$("#saveFormSubrecipe").click(function(){		
		$("#saveSubrecipe").validate({ignore:false});
		if($("#saveSubrecipe").valid()){
			if(countRowsSupplies > 0){
				$("#supplies").val(JSON.stringify(supplies));
				$("#saveSubrecipe").submit();
			}else{
				messages('error','es requerido al menos un insumo o subreceta');
			}
		}
	});

	$("#performance").change(function(){
		var cost_unity = parseFloat($("#recipe_cost").val()) / parseFloat($("#performance").val());
		$("#unit_cost").val(parseFloat(cost_unity).toFixed(2));
		$("#unit_cost_text").text(parseFloat(cost_unity).toFixed(2));
	});

	$("#recipe_cost").change(function(){
		var cost_unity = parseFloat($("#recipe_cost").val()) / parseFloat($("#performance").val());
		$("#unit_cost").val(parseFloat(cost_unity).toFixed(2));
		$("#unit_cost_text").text(parseFloat(cost_unity).toFixed(2));
	});

	$("#newSubrecipe").click(function(){
		supplies = [];
		table
    	.clear()
    	.draw(true);
		$("#id_subrecipe").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#umd").val("");
		$("#description").val("");
		$("#unit_cost").val("");
		$("#performance").val("");
		$("#recipe_cost").val("");
		$("#previous_production_week").val("");
		$("#quantity_produce").val("");
		$("#estatus").prop('checked',false);
    	$("#myModalSubrecipe").modal();
	});

	$(".search-subrecipe").click(function(){
		supplies = [];
		table
    	.clear()
    	.draw(true);
		$("#id_subrecipe").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#umd").val("");
		$("#description").val("");
		$("#unit_cost").val("0.00");
		$("#unit_cost_text").text("$0.00");
		$("#performance").val("0.00");
		$("#performance_text").text("$0.00");
		$("#recipe_cost").val("0.00");
		$("#recipe_cost_text").text("$0.00");
		$("#previous_production_week").val("0.00");
		$("#previous_production_week_text").text("$0.00");
		$("#quantity_produce").val("0.00");
		$("#quantity_produce_text").text("$0.00");
		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/subrecipe/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function(error) {
    		var message = "Ocurrio un error al realizar la consulta" ;
    		messages('error', message);
  		}).always(function(data) {
  			$("#id_subrecipe").val(data.subrecipe.id_subrecipe);
			$("#clave").val(data.subrecipe.clave);
			$("#clave").attr('data-id' , data.subrecipe.id_supply);
			$("#umd").val(data.subrecipe.udm);
			$("#description").val(data.subrecipe.description);
			$("#unit_cost").val(data.subrecipe.uni_cost);
			$("#performance").val(data.subrecipe.performance);
			$("#recipe_cost").val(data.subrecipe.recipe_cost);
			$("#previous_production_week").val(data.subrecipe.previous_production_week);
			$("#quantity_produce").val(data.subrecipe.quantity_produce);
  			if(data.subrecipe.estatus == 1)
    			$("#estatus").prop('checked',true);

  			$.each(data.subrecipeSupply, function(i, element){
  				updateTableWarehouseUpdate(element);
  			});
  		});
		$("#myModalSubrecipe").modal();
	});

	$("#addButtonSupply").click(function(){
		$("#myModalSupply").modal();		
	});

	$("#saveFormSupply").click(function(){
		$("#saveFormSupply").prop('disabled', true);
		if($("#claveSupply").val() != ""){
			 var data = {
			 	"id_supply": idSupply,
	            "column": $("#claveSupply").attr('name'),
	            "val": $("#claveSupply").val(),
	            "_token":$('input[name="_token"]').val(),
	            };
			$.ajax({
				type: "POST",
	            data: data,
	  			url: baseUrl+'/subrecipe/supply',
			})
			/*.done(function() {console.log( "second success" );})*/
	    	.fail(function(error) {
	    		var message = "Ocurrio un error al realizar la consulta" ;
	    		messages('error', message);
	    		$("#saveFormSupply").prop('disabled', false);
	  		}).always(function(data) {
	  			if(data.length == 0){
	  				messages('warning','no se encontro insumo con la clave escrita');
	  				$("#saveFormSupply").prop('disabled', false);
	  			}else{
	  				updateTableWarehouse(data);
	  				$("#myModalSupply").modal('hide');
	  				messages('ok','se añadio insumo a la tabla');		
	  				$("#saveFormSupply").prop('disabled', false);
	  			}
	  		});
  		}else{
  			messages('error','el campo no puede estar vacio');
  			$("#saveFormSupply").prop('disabled', false);
  		}

	});
});

function updateTableWarehouse(data){
	var label1 = '<div>'+data.clave+'</div>';
	var label2 = '<div>'+data.description+'</div>';
	var label3 = '<div>'+data.udm+'</div>';
	var label4 = "<div data-id='"+countRowsSupplyId+"' value='' class='cost'>$"+data.last_cost+"</div>";
	var input5 = "<input data-id='"+countRowsSupplyId+"' value='' class='form-control gr_recipe required number'/>";
	var input6 = "<input data-id='"+countRowsSupplyId+"' value='100' class='form-control performance required number'/>";
	var label7 = "<div id='grNeto'"+countRowsSupplyId+" data-id='"+countRowsSupplyId+"' value='' class='gr_neto'>0.000</div>";
	var label8 = "<div id='costSupply'"+countRowsSupplyId+" data-id='"+countRowsSupplyId+"' value='100' class='cost_supply'>$0.00</div>";
	var input9 = "<input data-id='"+countRowsSupplyId+"' value='0.000' class='form-control quantity_occupy required number'/>";
	var input10 = "<input data-id='"+countRowsSupplyId+"' value='0.000' class='form-control production_required required number'/>";
	var buttons ="<button id='buttonWarehouseDelete"+countRowsSupplyId+"' data-id='"+countRowsSupplyId+"' class='btn btn-danger bt-sm deleteWarehouse' onclick='deleteWarehouse(buttonWarehouseDelete"+countRowsSupplyId+")'><i class='fa fa-trash-o'></i></button>";
	var myData = [ label1, label2, label3, label4, input5, input6, label7, label8, input9, input10, buttons];
	table
    .row.add(myData)
    .draw();
    supplies.push({
    				'id_supply': data.id_supply,
    				'clave':data.clave, 
    				'description': data.description, 
    				'unity' : data.udm, 
    				'cost' : data.last_cost, 
    				'gr_recipe' : '0.000',
    				'performance' : '100', 
    				'gr_neto' : '0.000', 
    				'cost_supply' : '0.00', 
    				'quantity_occupy' : '0.000', 
    				'production_required': '0.000'});
    countRowsSupplyId++;
    countRowsSupplies++;

    $(".gr_recipe").change(function(){
    	if($(this).val() != "") {
    		var id = $(this).attr('data-id');

    		var cost = parseFloat(supplies[$(this).attr('data-id')].cost);
    		var performance = parseFloat(supplies[$(this).attr('data-id')].performance);
    		supplies[$(this).attr('data-id')].gr_recipe = parseFloat($(this).val());
    		supplies[$(this).attr('data-id')].gr_neto = parseFloat($(this).val());
    		supplies[$(this).attr('data-id')].cost_supply = cost * parseFloat($(this).val());
    		$("#grNeto"+id).text(parseInt($(this).val()));
    		var costSupply = parseFloat(cost) * parseFloat($(this).val());
    		$("#costSupply"+id).text(parseFloat(costSupply).toFixed(2));
    		updateTableWarehouseDraw();
    		updateCostRecipe();
    	}
    });

    $(".performance").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].performance = $(this).val();
    });

    $(".quantity_occupy").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].quantity_occupy = $(this).val();
    });

    $(".production_required").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].production_required = $(this).val();
    });
}

function updateTableWarehouseDraw(){
	table
	.clear();
	$.each(supplies, function(index, data){
		var label1 = '<div>'+data.clave+'</div>';
		var label2 = '<div>'+data.description+'</div>';
		var label3 = '<div>'+data.unity+'</div>';
		var label4 = "<div data-id='"+index+"' value='' class='cost'>$"+data.cost+"</div>";
		var input5 = "<input data-id='"+index+"' value='"+data.gr_recipe+"' class='form-control gr_recipe required number'/>";
		var input6 = "<input data-id='"+index+"' value='"+data.performance+"' class='form-control performance required number'/>";
		var label7 = "<div id='grNeto'"+index+" data-id='"+index+"' value='' class='gr_neto'>"+data.gr_neto+"</div>";
		var label8 = "<div id='costSupply'"+index+" data-id='"+index+"' value='100' class='cost_supply'>$"+data.cost_supply+"</div>";
		var input9 = "<input data-id='"+index+"' value='"+data.quantity_occupy+"' class='form-control quantity_occupy required number'/>";
		var input10 = "<input data-id='"+index+"' value='"+data.production_required+"' class='form-control production_required required number'/>";
		var buttons ="<button id='buttonWarehouseDelete"+index+"' data-id='"+index+"' class='btn btn-danger bt-sm deleteWarehouse' onclick='deleteWarehouse(buttonWarehouseDelete"+index+")'><i class='fa fa-trash-o'></i></button>";
		var myData = [ label1, label2, label3, label4, input5, input6, label7, label8, input9, input10, buttons];
		table
	    .row.add(myData);
	});
	table.draw();

	$(".gr_recipe").change(function(){
    	if($(this).val() != "") {
    		var id = $(this).attr('data-id');
    		var cost = parseFloat(supplies[$(this).attr('data-id')].cost).toFixed(2);
    		var performance = parseFloat(supplies[$(this).attr('data-id')].performance).toFixed(2);
    		supplies[$(this).attr('data-id')].gr_recipe = parseFloat($(this).val()).toFixed(2);
    		supplies[$(this).attr('data-id')].gr_neto = parseFloat($(this).val()).toFixed(2);
    		supplies[$(this).attr('data-id')].cost_supply = cost * parseFloat($(this).val()).toFixed(2);
    		$("#grNeto"+id).text(parseInt($(this).val().toFixed2));
    		$("#costSupply"+id).text(cost * parseFloat($(this).val()).toFixed(2));
    		updateTableWarehouseDraw();
    		updateCostRecipe();
    	}
    });

    $(".performance").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].performance = $(this).val();
    });

    $(".quantity_occupy").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].quantity_occupy = $(this).val();
    });

    $(".production_required").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].production_required = $(this).val();
    });
	
}

function updateTableWarehouseUpdate(data){
	var label1 = '<div>'+data.clave+'</div>';
	var label2 = '<div>'+data.description+'</div>';
	var label3 = '<div>'+data.unity+'</div>';
	var input4 = "<input data-id='"+countRowsSupplyId+"' value='"+data.cost+"' class='form-control cost required number'/>";
	var input5 = "<input data-id='"+countRowsSupplyId+"' value='"+data.gr_recipe+"' class='form-control gr_recipe required number'/>";
	var input6 = "<input data-id='"+countRowsSupplyId+"' value='"+data.performance+"' class='form-control performance required number'/>";
	var input7 = "<input data-id='"+countRowsSupplyId+"' value='"+data.gr_neto+"' class='form-control gr_neto required number'/>";
	var input8 = "<input data-id='"+countRowsSupplyId+"' value='"+data.cost_supply+"' class='form-control cost_supply required number'/>";
	var input9 = "<input data-id='"+countRowsSupplyId+"' value='"+data.quantity_occupy+"' class='form-control quantity_occupy required number'/>";
	var input10 = "<input data-id='"+countRowsSupplyId+"' value='"+data.production_required+"' class='form-control production_required required number'/>";
	//var buttons = "<button data-id='' class='btn btn-sucess bt-sm save'><i class='fa fa-floppy-o'></i></button>";
		//buttons +="<button data-id='' class='btn btn-default bt-sm update'><i class='fa fa-pencil'></i></button>";
	var buttons ="<button id='buttonWarehouseDelete"+countRowsSupplyId+"' data-id='"+countRowsSupplyId+"' class='btn btn-danger bt-sm deleteWarehouse' onclick='deleteWarehouse(buttonWarehouseDelete"+countRowsSupplyId+")'><i class='fa fa-trash-o'></i></button>";
	var myData = [ label1, label2, label3, input4, input5, input6, input7, input8, input9, input10, buttons];
	table
    .row.add(myData)
    .draw();
    supplies.push({
    				'id_supply': data.id_supply,
    				'clave':data.clave, 
    				'description': data.description, 
    				'unity' : data.unity, 
    				'cost' :  data.cost, 
    				'gr_recipe' :  data.gr_recipe,
    				'performance' :  data.performance, 
    				'gr_neto' :  data.gr_neto, 
    				'cost_supply' :  data.cost_supply, 
    				'quantity_occupy' :  data.quantity_occupy, 
    				'production_required':  data.production_required});
    countRowsSupplyId++;
    countRowsSupplies++;

    $(".cost").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].cost = $(this).val();
    });

    $(".gr_recipe").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].gr_recipe = $(this).val();
    });

    $(".performance").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].performance = $(this).val();
    });

    $(".gr_neto").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].gr_neto = $(this).val();
    });

    $(".cost_supply").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].cost_supply = $(this).val();
    });

    $(".quantity_occupy").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].quantity_occupy = $(this).val();
    });

    $(".production_required").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].production_required = $(this).val();
    });
}

function updateCostRecipe(){
	var total = parseFloat(0);
	$.each(supplies, function(index, data){
		total = total + parseFloat(data.cost_supply);
	});

	$("#recipe_cost").val(parseFloat(total).toFixed(2));
	$("#recipe_cost_text").text("$"+parseFloat(total).toFixed(2));
}

function deleteWarehouse(element){
	 table
    .row($(element).parents('tr'))
    .remove()
    .draw(true);
    delete supplies[$(element).attr('data-id')];
    countRowsSupplies--;
}