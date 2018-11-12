$(document).ready(function(){

	$("#saveFormProvider").click(function(){
		$("#saveProvider").validate();
		if($("#saveProvider").valid()){
			$("#saveProvider").submit();
		}
	});

	$("#id_supply_category").change(function(){
		$("#id_supply_type").empty();
		$("#id_supply_type").append(new Option("Seleccione", ""));
		var id = $(this).val();
		if(id != ""){
			$.ajax({
  				url: 'http://localhost/baseProjectDeux/public/supply-type/category/'+id,
			})
			/*.done(function() {console.log( "second success" );})*/
			.fail(function() {
    		console.log( "error" + data);
  			}).always(function(data) {
  				$.each(data, function(id,obj){
  					$("#id_supply_type").append(new Option(obj.clave, obj.id_supply_type));
  				});
  			});
		}
		
	});

	$("#newProvider").click(function(){
		$("#id_provider").val("");
		$("#clave").val("");
		$("#rfc").val("");
		$("#name").val("");
		$("#name_commercial").val("");
		//aqui va lo de tipo
		$("#radio1").prop("checked",true);
		$("#radio2").prop("checked",false);
		$("#radio3").prop("checked",false);
		$("#radio4").prop("checked",false);
		$("#id_supply_category").val("");
		$("#id_supply_type").val("");
		$("#street").val("");
		$("#number_ext").val("");
		$("#number_int").val("");
		$("#colony").val("");
		$("#city").val("");
		$("#state").val("");
		$("#country").val("");
		$("#zip_code").val("");
		$("#phone").val("");
		$("#email").val("");
		$("#estatus").prop('checked',false);
    	$("#myModalProvider").modal();
	});

	$(".search-Provider").click(function(){
		$("#id_provider").val("");
		$("#clave").val("");
		$("#rfc").val("");
		$("#name").val("");
		$("#name_commercial").val("");
		//aqui va lo de tipo
		$("#radio1").prop("checked",true);
		$("#radio2").prop("checked",false);
		$("#radio3").prop("checked",false);
		$("#radio4").prop("checked",false);
		$("#id_supply_category").val("");
		$("#id_supply_type").val("");
		$("#street").val("");
		$("#number_ext").val("");
		$("#number_int").val("");
		$("#colony").val("");
		$("#city").val("");
		$("#state").val("");
		$("#country").val("");
		$("#zip_code").val("");
		$("#phone").val("");
		$("#email").val("");
		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: 'http://localhost/baseProjectDeux/public/provider/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_provider").val(data.id_provider);
			$("#clave").val(data.clave);
			$("#rfc").val(data.rfc);
			$("#name").val(data.name);
			$("#name_commercial").val(data.name_commercial);
			if(data.type == 0){
				$("#radio1").prop("checked",true);
				$("#radio2").prop("checked",false);
				$("#radio3").prop("checked",false);
				$("#radio4").prop("checked",false);
			}else if(data.type == 1){
				$("#radio1").prop("checked",false);
				$("#radio2").prop("checked",true);
				$("#radio3").prop("checked",false);
				$("#radio4").prop("checked",false);

			}else if(data.type == 2){
				$("#radio1").prop("checked",false);
				$("#radio2").prop("checked",false);
				$("#radio3").prop("checked",true);
				$("#radio4").prop("checked",false);
			}else if(data.type == 3){
				$("#radio1").prop("checked",false);
				$("#radio2").prop("checked",false);
				$("#radio3").prop("checked",false);
				$("#radio4").prop("checked",true);
			}
			$("#street").val(data.street);
			$("#id_supply_category option[value="+data.id_supply_category+"]").attr('selected', 'selected');
			$("#number_ext").val(data.number_ext);
			$("#number_int").val(data.number_int);
			$("#colony").val(data.colony);
			$("#city").val(data.city);
			$("#state").val(data.state);
			$("#country").val(data.country);
			$("#zip_code").val(data.zip_code);
			$("#phone").val(data.phone);
			$("#email").val(data.email);
  			if(data.estatus)
    			$("#estatus").prop('checked',true);
    		
  		});
		$("#myModalProvider").modal();
	});

});
