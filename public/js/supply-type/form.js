var id_supply_category_inactive;
$(document).ready(function(){	

	$("#saveFormSupplyType").click(function(){
		$("#saveSupplyType").validate();
		if($("#saveSupplyType").valid()){
			$("#saveSupplyType").submit();
		}
	});

	$("#newSupplytype").click(function(){
		if(id_supply_category_inactive)
			$("#id_supply_category option[value="+id_supply_category_inactive+"]").remove();
		$("#id_supply_type").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_supply_category").val("");
    	$("#myModalSupplyType").modal();
	});

	$(".search-supply-type").click(function(){
		if(id_supply_category_inactive)
			$("#id_supply_category option[value="+id_supply_category_inactive+"]").remove();
		$("#id_supply_type").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#id_supply_category").val("");
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/supply-type/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_supply_type").val(data.id_supply_type);
  			$("#clave").val(data.clave);
  			$("#clave").attr('data-id' , data.id_supply_type);
  			$("#description").val(data.description);
  			$("#id_supply_category").val(data.id_supply_category);
  			if($('#id_supply_category').find(":selected").text() == ''){
  				id_supply_category_inactive = data.id_supply_category;
  				searchValueInactive(data.id_supply_category, "id_supply_category");
  			}
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalSupplyType").modal();
	});
});

function searchValueInactive(id, input){
	$.ajax({
			url: baseUrl+'/supply-category/'+id,
	})
	/*.done(function() {console.log( "second success" );})*/
	.fail(function() {
		var message = "Ocurrio un error al realizar la consulta" ;
    		messages('error', message);
	}).always(function(data) {
		$("#"+input).append(new Option(data.clave, data.id_supply_category));
		$("#id_supply_category option[value="+id+"]").attr('selected', 'selected');
	});
}
