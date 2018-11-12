$(document).ready(function(){

	$("#saveFormSupplyType").click(function(){
		$("#saveSupplyType").validate();
		if($("#saveSupplyType").valid()){
			$("#saveSupplyType").submit();
		}
	});

	$("#newSupplytype").click(function(){
		$("#id_supply_type").val("");
		$("#clave").val("");
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_supply_category").val("");
    	$("#myModalSupplyType").modal();
	});

	$(".search-supply-type").click(function(){
		$("#id_supply_type").val("");
		$("#clave").val("");
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_supply_category").val("");
		var id = $(this).attr('data-id');
		$.ajax({
  			url: 'http://localhost/baseProjectDeux/public/supply-type/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_supply_type").val(data.id_supply_type);
  			$("#clave").val(data.clave);
  			$("#description").val(data.description);
  			$("#id_supply_category").val(data.id_supply_category);
  			if(data.estatus)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalSupplyType").modal();
	});

});
