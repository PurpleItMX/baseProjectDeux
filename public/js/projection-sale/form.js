var productTable = [];
var table;
$(document).ready(function(){
	$("#saveFormProjectionSale").click(function(){
		$("#saveProjectionSale").validate({ignore: ""});

		if($("#saveProjectionSale").valid()){
			$("#saveProjectionSale").submit();
		}
	});

	 table = $("#listTableIn").DataTable({
        		"lengthMenu": [[5, 10], [5, 10]],
        		"fixedColumns": true,
        		"autoWidth": true,
        		"responsive": true,
        		"language": {
            		"url": baseUrl+"/js/Spanish.json"
        		},
    });

	$("#search-detail-sales").click(function(){
		if($("#date_end").val() && $("#date_initial").val()){
		   var company ="Churrasco"; //cambiar por el combo;
		   var token = $('input[name="_token"]').val();
		   var date_initial = $("#date_initial").val();
		   var date_end = $("#date_end").val();
		   var date_initial_format = date_initial.substring(8,10)+"/"+date_initial.substring(5,7)+"/"+date_initial.substring(0,4)+" 00:00:00";
		   var date_end_format = date_end.substring(8,10)+"/"+date_end.substring(5,7)+"/"+date_end.substring(0,4)+" 23:59:59";
		   var data = {
	                "company": company,
	                "date_initial": date_initial_format,
	                "date_end": date_end_format,
	                "_token":token,
	                };
			$.ajax({
				type: "POST",
	  			url: baseUrl+'/projection-sale/detail-sales',
	  			data: data,
			})
			.fail(function(error) {
	    		var message = "Ocurrio un error al realizar la consulta" ;
	    		messages('error', message);
	    	}).always(function(data) {
	    		updateTable(data);
	    		messages('ok','Tabla Actualizada');
	    	});
	    }else{
			messages('error','Una de las fechas esta vacia');
	    }
	});
});


function updateTable(data){
	table
    .clear();
    productTable = [];

	$.each(data,function(index, object){
		var row = [
		object.clave_product, 
		object.description, 
		object.quantity, 
		object.quantity_proj, 
		object.price_sale_iva, 
		object.price_proj, 
		object.price_sale, 
		object.total, 
		object.income_proj, 
		object.cost, 
		object.cost_percent, 
		object.cost_total, 
		object.expenditure, 
		object.utility, 
		object.total_utility];
		productTable.push(object);
		table
	    .row.add(row)
	    .draw();
	});
}