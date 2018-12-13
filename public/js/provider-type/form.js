var id_provider_category_inactive;
$(document).ready(function(){

	$("#saveFormProviderType").click(function(){
		$("#saveProviderType").validate();
		if($("#saveProviderType").valid()){
			$("#saveProviderType").submit();
		}
	});

	$("#newProvidertype").click(function(){
		if(id_provider_category_inactive)
			$("#id_supply_category option[value="+id_provider_category_inactive+"]").remove();
		$("#id_provider_type").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_provider_category").val("");
    	$("#myModalProviderType").modal();
	});

	$(".search-provider-type").click(function(){
		if(id_provider_category_inactive)
			$("#id_supply_category option[value="+id_provider_category_inactive+"]").remove();
		$("#id_provider_type").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_provider_category").val("");
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/provider-type/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_provider_type").val(data.id_provider_type);
  			$("#clave").val(data.clave);
  			$("#clave").attr('data-id' , data.id_provider_type);
  			$("#description").val(data.description);
  			$("#id_provider_category").val(data.id_provider_category);
  			if($('#id_provider_category').find(":selected").text() == ''){
  				searchValueInactive(data.id_provider_category, "id_provider_category");
  				id_provider_category_inactive = data.id_provider_category;
  			}
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalProviderType").modal();
	});

});

function searchValueInactive(id, input){	
	$.ajax({
			url: baseUrl+'/provider-category/'+id,
	})
	/*.done(function() {console.log( "second success" );})*/
	.fail(function() {
		console.log( "error" );
	}).always(function(data) {
		$("#"+input).append(new Option(data.clave, data.id_provider_category));
		$("#id_provider_category option[value="+id+"]").attr('selected', 'selected');
	});
}
