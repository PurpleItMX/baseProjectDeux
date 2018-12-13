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
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#prorate").prop('checked',false);
    	$("#myModalWarehouse").modal();
	});

	$(".searchWarehouse").click(function(){
		$("#id_warehouse").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#prorate").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/warehouse/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function(error) {
    		console.log( error );
    		messages("error",error.message);
  		}).always(function(data) {
  			$("#id_warehouse").val(data.id_warehouse);
  			$("#clave").val(data.clave);
  			$("#clave").attr('data-id' , data.id_warehouse);
  			$("#description").val(data.description);
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
    		if(data.prorate == 1)
    			$("#prorate").prop('checked',true);
  		});
		$("#myModalWarehouse").modal();
	});

});
