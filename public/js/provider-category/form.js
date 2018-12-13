$(document).ready(function(){

	$("#saveFormProviderCategory").click(function(){
		$("#saveProviderCategory").validate();
		if($("#saveProviderCategory").valid()){
			$("#saveProviderCategory").submit();
		}
	});

	$("#newProviderCategory").click(function(){
		$("#id_provider_category").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#myModalProviderCategory").modal();
	});

	$(".search-provider-category").click(function(){
		$("#id_provider_category").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/provider-category/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_provider_category").val(data.id_provider_category);
  			$("#clave").val(data.clave);
  			$("#clave").attr('data-id' , data.id_provider_category);
  			$("#description").val(data.description);
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalProviderCategory").modal();
	});

});
