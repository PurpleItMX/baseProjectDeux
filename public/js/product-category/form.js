$(document).ready(function(){

	$("#saveFormProductCategory").click(function(){
		$("#saveProductCategory").validate();
		if($("#saveProductCategory").valid()){
			$("#saveProductCategory").submit();
		}
	});

	$("#newProductCategory").click(function(){
		$("#id_product_category").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#variant").val("");
    	$("#myModalProductCategory").modal();
	});

	$(".search-product-category").click(function(){
		$("#id_product_category").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#variant").val("");
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/product-category/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_product_category").val(data.id_product_category);
  			$("#clave").val(data.clave);
  			$("#clave").attr('data-id' , data.id_product_category);
  			$("#description").val(data.description);
  			$("#variant").val(data.variant);
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalProductCategory").modal();
	});

});
