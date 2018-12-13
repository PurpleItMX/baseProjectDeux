var id_service_category_inactive;
$(document).ready(function(){

	$("#saveFormServiceType").click(function(){
		$("#saveServiceType").validate();
		if($("#saveServiceType").valid()){
			$("#saveServiceType").submit();
		}
	});

	$("#newServiceType").click(function(){
		if(id_service_category_inactive)
		$("#id_service_category option[value="+id_service_category_inactive+"]").remove();
		$("#id_service_type").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_service_category").val("");
    	$("#myModalServiceType").modal();
	});

	$(".search-service-type").click(function(){
		if(id_service_category_inactive)
		$("#id_service_category option[value="+id_service_category_inactive+"]").remove();
		$("#id_service_type").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_service_category").val("");
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/service-type/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_service_type").val(data.id_service_type);
  			$("#clave").val(data.clave);
  			$("#clave").attr('data-id' , data.id_service_type);
  			$("#description").val(data.description);
  			$("#id_service_category").val(data.id_service_category);
  			if($('#id_service_category').find(":selected").text() == ''){
  				searchValueInactive(data.id_service_category, "id_service_category");
  				id_service_category_inactive = data.id_service_category;
  			}
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalServiceType").modal();
	});

});

function searchValueInactive(id, input){	
	$.ajax({
			url: baseUrl+'/service-category/'+id,
	})
	/*.done(function() {console.log( "second success" );})*/
	.fail(function() {
		console.log( "error" );
	}).always(function(data) {
		$("#"+input).append(new Option(data.clave, data.id_service_category));
		$("#id_service_category option[value="+id+"]").attr('selected', 'selected');
	});
}
