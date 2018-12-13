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
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#variant").val("");
    	$("#myModalSupplyCategory").modal();
	});

	$(".search-supply-category").click(function(){
		$("#id_supply_category").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
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
  			$("#clave").attr('data-id' , data.id_supply_category);
  			$("#description").val(data.description);
  			$("#variant").val(data.variant);
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalSupplyCategory").modal();
	});

});
