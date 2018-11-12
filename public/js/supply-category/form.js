$(document).ready(function(){

	$("#saveFormSupplyCategory").click(function(){
		$("#saveSupplyCategory").validate();
		if($("#saveSupplyCategory").valid()){
			$("#saveSupplyCategory").submit();
		}
	});

	$("#newSupplyCategory").click(function(){
		$("#id_supply_category").val("");
		$("#clave").val("");
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#variant").val("");
    	$("#myModalSupplyCategory").modal();
	});

	$(".search-supply-category").click(function(){
		$("#id_supply_category").val("");
		$("#clave").val("");
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#variant").val("");
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/supply-category/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_supply_category").val(data.id_supply_category);
  			$("#clave").val(data.clave);
  			$("#description").val(data.description);
  			$("#variant").val(data.variant);
  			if(data.estatus)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalSupplyCategory").modal();
	});

});
