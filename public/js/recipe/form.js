var table;
var countRowsSupplyId = 0;
var countRowsSupplies =  0;
var supplies = [];
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

	$("#saveFormRecipe").click(function(){		
		$("#saveRecipe").validate({ignore:false});
		if($("#saveRecipe").valid()){
			if(countRowsSupplies > 0){
				$("#supplies").val(JSON.stringify(supplies));
				$("#saveRecipe").submit();
			}else{
				messages('error','es requerido al menos un insumo o subreceta');
			}
		}
	});

	$("#newRecipe").click(function(){
		supplies = [];
		table
    	.clear()
    	.draw(true);
		$("#id_recipe").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#umd").val("");
		$("#description").val("");
		$("#cost_sale").val("");
		$("#expenditure_operative").val("");
		$("#margen_actually").val("");
		$("#margen_category").val("");
		$("#price_sale").val("");
		$("#utility").val("");
		$("#iva").val("");
		$("#import_iva").val("");
		$("#price_sale_iva").val("");
		$("#quantity_sale").val("");
		$("#production_cost").val("");
		$("#quantity_sell").val("");
		$("#cost_projection").val("");
		$("#estatus").prop('checked',false);
    	$("#myModalRecipe").modal();
	});

	$(".search-recipe").click(function(){
		table
    	.clear()
    	.draw(true);
		supplies = [];
		//countRowsSupplyId = 0;
		//countRowsSupplies =  0;
		$("#id_recipe").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#umd").val("");
		$("#description").val("");
		$("#cost_sale").val("");
		$("#expenditure_operative").val("");
		$("#margen_actually").val("");
		$("#margen_category").val("");
		$("#price_sale").val("");
		$("#utility").val("");
		$("#iva").val("");
		$("#import_iva").val("");
		$("#price_sale_iva").val("");
		$("#quantity_sale").val("");
		$("#production_cost").val("");
		$("#quantity_sell").val("");
		$("#cost_projection").val("");
		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/recipe/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function(error) {
    		var message = "Ocurrio un error al realizar la consulta" ;
    		messages('error', message);
  		}).always(function(data) {
  			$("#id_supply").val(data.recipe.id_supply);
			$("#clave").val(data.recipe.clave);
			$("#clave").attr('data-id' , data.recipe.id_supply);
			$("#umd").val(data.recipe.udm);
			$("#description").val(data.recipe.description);
			$("#cost_sale").val(data.recipe.cost_sale);
			$("#expenditure_operative").val(data.recipe.expenditure_operative);
			$("#margen_actually").val(data.recipe.margen_actually);
			$("#margen_category").val(data.recipe.margen_category);
			$("#price_sale").val(data.recipe.price_sale);
			$("#utility").val(data.recipe.utility);
			$("#iva").val(data.recipe.iva);
			$("#import_iva").val(data.recipe.import_iva);
			$("#price_sale_iva").val(data.recipe.price_sale_iva);
			$("#quantity_sale").val(data.recipe.quantity_sale);
			$("#production_cost").val(data.recipe.production_cost);
			$("#quantity_sell").val(data.recipe.quantity_sell);
			$("#cost_projection").val(data.recipe.cost_projection);
  			if(data.recipe.estatus == 1)
    			$("#estatus").prop('checked',true);

  			$.each(data.recipeSupply, function(i, element){
  				updateTableWarehouseUpdate(element);
  			});
  		});
		$("#myModalRecipe").modal();
	});

	$("#addButtonSupply").click(function(){
		$("#myModalSupply").modal();		
	});

	$("#saveFormSupply").click(function(){
		if($("#claveSupply").val() != ""){
			 var data = {
	            "column": $("#claveSupply").attr('name'),
	            "val": $("#claveSupply").val(),
	            "_token":$('input[name="_token"]').val(),
	            };
			$.ajax({
				type: "POST",
	            data: data,
	  			url: baseUrl+'/recipe/supply',
			})
			/*.done(function() {console.log( "second success" );})*/
	    	.fail(function(error) {
	    		var message = "Ocurrio un error al realizar la consulta" ;
	    		messages('error', message);
	  		}).always(function(data) {
	  			if(data.length == 0){
	  				messages('warning','no se encontro insumo con la clave escrita');
	  			}else{
	  				updateTableWarehouse(data);
	  				$("#myModalSupply").modal('hide');
	  				messages('ok','se añdio insumo a la tabla');		
	  			}
	  		});
  		}else{
  			messages('error','el campo no puede estar vacio');
  		}

	});
});

function updateTableWarehouse(data){
	var label1 = '<div>'+data.clave+'</div>';
	var label2 = '<div>'+data.description+'</div>';
	var label3 = '<div>'+data.udm+'</div>';
	var input4 = "<input data-id='"+countRowsSupplyId+"' value='' class='form-control cost required number'/>";
	var input5 = "<input data-id='"+countRowsSupplyId+"' value='' class='form-control gr_recipe required number'/>";
	var input6 = "<input data-id='"+countRowsSupplyId+"' value='' class='form-control performance required number'/>";
	var input7 = "<input data-id='"+countRowsSupplyId+"' value='' class='form-control gr_neto required number'/>";
	var input8 = "<input data-id='"+countRowsSupplyId+"' value='' class='form-control cost_supply required number'/>";
	var input9 = "<input data-id='"+countRowsSupplyId+"' value='' class='form-control quantity_occupy required number'/>";
	var input10 = "<input data-id='"+countRowsSupplyId+"' value='' class='form-control cost_total required number'/>";
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
    				'unity' : data.udm, 
    				'cost' : '', 
    				'gr_recipe' : '',
    				'performance' : '', 
    				'gr_neto' : '', 
    				'cost_supply' : '', 
    				'quantity_occupy' : '', 
    				'cost_total': ''});
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

    $(".cost_total").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].cost_total = $(this).val();
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
	var input10 = "<input data-id='"+countRowsSupplyId+"' value='"+data.cost_total+"' class='form-control production_required required number'/>";
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
    				'cost_total':  data.cost_total});
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

    $(".cost_total").change(function(){
    	if($(this).val() != "") 
    	supplies[$(this).attr('data-id')].cost_total = $(this).val();
    });
}


function deleteWarehouse(element){
	 table
    .row($(element).parents('tr'))
    .remove()
    .draw(true);
    delete supplies[$(element).attr('data-id')];
    countRowsSupplies--;
}