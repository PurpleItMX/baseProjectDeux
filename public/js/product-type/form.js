var id_product_category_inactive;
$(document).ready(function(){	

	$("#saveFormProductType").click(function(){
		$("#saveProductType").validate();
		if($("#saveProductType").valid()){
			$("#saveProductType").submit();
		}
	});

	$("#newProductType").click(function(){
		if(id_product_category_inactive)
			$("#id_product_category option[value="+id_product_category_inactive+"]").remove();
		$("#id_product_type").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_product_category").val("");
    	$("#myModalProductType").modal();
	});

	$(".search-product-type").click(function(){
		if(id_product_category_inactive)
			$("#id_product_category option[value="+id_product_category_inactive+"]").remove();
		$("#id_product_type").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_product_category").val("");
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/product-type/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_product_type").val(data.id_product_type);
  			$("#clave").val(data.clave);
  			$("#clave").attr('data-id' , data.id_product_type);
  			$("#description").val(data.description);
  			$("#id_product_category").val(data.id_product_category);
  			if($('#id_product_category').find(":selected").text() == ''){
  				id_product_category_inactive = data.id_product_category;
  				searchValueInactive(data.id_product_category, "id_product_category");
  			}
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalProductType").modal();
	});
});

function searchValueInactive(id, input){
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
