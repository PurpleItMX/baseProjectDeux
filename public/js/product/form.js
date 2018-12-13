var id_product_category_inactive;
var id_product_type_inactive;
$(document).ready(function(){	

	$("#saveFormProduct").click(function(){
		$("#saveProduct").validate();
		if($("#saveProduct").valid()){
			$("#saveProduct").submit();
		}
	});

	$("#newProduct").click(function(){
		$("#id_product").val("");
		if(id_product_category_inactive)
			$("#id_product_category option[value="+id_product_category_inactive+"]").remove();
		if(id_product_type_inactive)
			$("#id_product_type option[value="+id_product_type_inactive+"]").remove();
		$("#id_product").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_product_category").val("");
    	$("#id_product_type").val("");
    	$("#umd").val("");
		$("#price_sale").val("");
		$("#margen_category").val("");
		$("#margen_actually").val("");
		$("#cost_sale").val("");
		$("#expenditure_operative").val("");
		$("#utility").val("");
		$("#iva").val("");
		$("#import_iva").val("");
		$("#price_sale_iva").val("");
		$("#description").val("");
    	$("#myModalProduct").modal();
	});

	$(".search-product").click(function(){
		$("#id_product").val("");
		if(id_product_category_inactive)
			$("#id_product_category option[value="+id_product_category_inactive+"]").remove();
		if(id_product_type_inactive)
			$("#id_product_type option[value="+id_product_type_inactive+"]").remove();
		
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_product_category").val("");
    	$("#id_product_type").val("");
    	$("#umd").val("");
		$("#price_sale").val("");
		$("#margen_category").val("");
		$("#margen_actually").val("");
		$("#cost_sale").val("");
		$("#expenditure_operative").val("");
		$("#utility").val("");
		$("#iva").val("");
		$("#import_iva").val("");
		$("#price_sale_iva").val("");
		$("#description").val("");
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/product/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_product").val(data.id_product);
  			$("#clave").val(data.clave);
  			$("#clave").attr('data-id' , data.id_product_type);
  			$("#umd").val(data.udm);
  			$("#price_sale").val(data.price_sale);
  			$("#margen_category").val(data.margen_category);
  			$("#margen_actually").val(data.margen_actually);
  			$("#cost_sale").val(data.cost_sale);
  			$("#expenditure_operative").val(data.expenditure_operative);
  			$("#utility").val(data.utility);
  			$("#iva").val(data.iva);
  			$("#import_iva").val(data.import_iva);
  			$("#price_sale_iva").val(data.price_sale_iva);  			
  			$("#description").val(data.description);
  			$("#id_product_category").val(data.id_product_category);
  			if($('#id_product_category').find(":selected").text() == ''){
  				id_product_category_inactive = data.id_product_category;
  				searchValueInactiveCategory(data.id_product_category, "id_product_category");
  			}
  			$("#id_product_type").val(data.id_product_type);
  			if($('#id_product_type').find(":selected").text() == ''){
  				id_product_type_inactive = data.id_product_type;
  				searchValueInactiveType(data.id_product_category, "id_product_type");
  			}
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalProduct").modal();
	});

	$("#id_product_category").change(function(){
		var id = $(this).val();
		productType(id,false);
	});
});

function productType(id, draw){
	$("#id_product_type").empty();
	$("#id_product_type").append(new Option("Seleccione", ""));
	if(id != ""){
		$.ajax({
				url: baseUrl+'/product-type/category/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
		.fail(function() {
			var message = "Ocurrio un error al realizar la consulta" ;
    		messages('error', message);
			}).always(function(data) {
				$.each(data, function(id,obj){
					$("#id_product_type").append(new Option(obj.clave, obj.id_product_type));
				});
				if(draw)
				$("#id_product_type option[value="+id+"]").attr('selected', 'selected');
			});
	}
}

function searchValueInactiveType(id, input){
	$.ajax({
			url: baseUrl+'/product-type/'+id,
	})
	/*.done(function() {console.log( "second success" );})*/
	.fail(function() {
		var message = "Ocurrio un error al realizar la consulta" ;
    		messages('error', message);
	}).always(function(data) {
		$("#"+input).append(new Option(data.clave, data.id_product_type));
		$("#id_product_type option[value="+id+"]").attr('selected', 'selected');
	});
}

function searchValueInactiveCategory(id, input){
	$.ajax({
			url: baseUrl+'/product-category/'+id,
	})
	/*.done(function() {console.log( "second success" );})*/
	.fail(function() {
		var message = "Ocurrio un error al realizar la consulta" ;
    		messages('error', message);
	}).always(function(data) {
		$("#"+input).append(new Option(data.clave, data.id_product_category));
		$("#id_product_category option[value="+id+"]").attr('selected', 'selected');
	});
}