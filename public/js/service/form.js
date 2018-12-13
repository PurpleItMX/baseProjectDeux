var id_service_category_inactive;
var id_service_type_inactive;
$(document).ready(function(){
	$("#saveFormService").click(function(){
		$("#saveService").validate({ignore: ""});

		if($("#saveService").valid()){
			$("#saveService").submit();
		}
	});

	$("#id_service_category").change(function(){
		var id = $(this).val();
		serviceType(id,false);
	});


	$("#newService").click(function(){
		if(id_service_category_inactive)
			$("#id_service_category option[value="+id_service_category_inactive+"]").remove();
		if(id_service_type_inactive)
			$("#id_service_type option[value="+id_service_type_inactive+"]").remove();
		$("#id_service").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#udm").val("");
		$("#apportionment").val("");
		$("#percentage_apportionment").val("");
		$("#id_service_category").val("");
		$("#id_service_type").val("");
		$("#description").val("");
		$("#estatus").prop('checked',false);
    	$("#myModalService").modal();
	});

	$(".search-Service").click(function(){
		if(id_service_category_inactive)
			$("#id_service_category option[value="+id_service_category_inactive+"]").remove();
		if(id_service_type_inactive)
			$("#id_service_type option[value="+id_service_type_inactive+"]").remove();
		$("#id_service").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#udm").val("");
		$("#apportionment").val("");
		$("#percentage_apportionment").val("");
		$("#id_service_category").val("");
		$("#id_service_type").val("");
		$("#description").val("");
		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/service/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_service").val(data.id_service);
			$("#clave").val(data.clave);
			$("#clave").attr('data-id' , data.id_service);
			$("#udm").val(data.udm);
			$("#apportionment").val(data.apportionment);
			$("#percentage_apportionment").val(data.percentage_apportionment);
			$("#id_service_category option[value="+data.id_service_category+"]").attr('selected', 'selected');
			serviceType(data.id_service_type, true);
			$("#description").val(data.description);

			if($('#id_service_category').find(":selected").text() == ''){
  				id_service_category_inactive = data.id_supply_category;
  				searchValueInactive(data.id_service_category, "id_service_category" ,"service-category");
  			}

  			if($('#id_service_type').find(":selected").text() == '' || $('#id_service_type').find(":selected").text() == 'Seleccione'){
  				id_service_type_inactive = data.id_service_type;
  				searchValueInactive(data.id_service_type, "id_service_type", "service-type");
  			}
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
    		
  		});
		$("#myModalService").modal();
	});

	function serviceType(id, draw){
		$("#id_service_type").empty();
		$("#id_service_type").append(new Option("Seleccione", ""));
		if(id != ""){
			$.ajax({
  				url: baseUrl+'/service-type/category/'+id,
			})
			/*.done(function() {console.log( "second success" );})*/
			.fail(function() {
    		console.log( "error" + data);
  			}).always(function(data) {
  				$.each(data, function(id,obj){
  					$("#id_service_type").append(new Option(obj.clave, obj.id_service_type));
  				});
  				if(draw)
  				$("#id_service_type option[value="+id+"]").attr('selected', 'selected');
  			});
		}
	}
});

function searchValueInactive(id, input, controller){
	$.ajax({
			url: baseUrl+'/'+controller+'/'+id,
	})
	.fail(function() {
		var message = "Ocurrio un error al realizar la consulta" ;
    		messages('error', message);
	}).always(function(data) {
		switch(controller){
			case "service-type":
				$("#"+input).append(new Option(data.clave, data.id_service_type));
			break;
			case "service-category":
				$("#"+input).append(new Option(data.clave, data.id_service_category));
			break;
		}
		$("#"+input+" option[value="+id+"]").attr('selected', 'selected');
	});
}