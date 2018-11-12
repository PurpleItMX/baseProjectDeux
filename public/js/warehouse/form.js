$(document).ready(function(){

	$("#saveFormWarehouse").click(function(){
		$("#saveWarehouse").validate();
		if($("#saveWarehouse").valid()){
			$("#saveWarehouse").submit();
		}
	});

	$("#newWarehouse").click(function(){
		$("#id_warehouse").val("");
		$("#clave").val("");
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#prorate").prop('checked',false);
    	$("#myModalWarehouse").modal();
	});

	$(".searchWarehouse").click(function(){
		$("#id_warehouse").val("");
		$("#clave").val("");
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#prorate").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/warehouse/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_warehouse").val(data.id_warehouse);
  			$("#clave").val(data.clave);
  			$("#description").val(data.description);
  			if(data.estatus)
    			$("#estatus").prop('checked',true);
    		if(data.prorate)
    			$("#prorate").prop('checked',true);
  		});
		$("#myModalWarehouse").modal();
	});

});
