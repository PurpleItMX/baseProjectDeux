$(document).ready(function(){

	$("#saveFormServiceCategory").click(function(){
		$("#saveServiceCategory").validate();
		if($("#saveServiceCategory").valid()){
			$("#saveServiceCategory").submit();
		}
	});

	$("#newServiceCategory").click(function(){
		$("#id_service_category").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#myModalServiceCategory").modal();
	});

	$(".search-service-category").click(function(){
		$("#id_service_category").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/service-category/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_service_category").val(data.id_service_category);
  			$("#clave").val(data.clave);
  			$("#clave").attr('data-id' , data.id_service_category);
  			$("#description").val(data.description);
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalServiceCategory").modal();
	});

});
