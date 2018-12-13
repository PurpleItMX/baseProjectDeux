$(document).ready(function(){
	$('#rfc').mask('ZZZZ000000AAA',{translation:  {'Z': {pattern: /[a-zA-Z]/, recursive: true}}});
	$("#saveFormProvider").click(function(){
		$("#saveProvider").validate({ignore: ""});

		if($("#saveProvider").valid()){
			$("#saveProvider").submit();
		}
	});

	$("#id_provider_category").change(function(){
		var id = $(this).val();
		providerType(id,false);
	});

	$(".radio-type").click(function(){
		switch($(this).val()){
    	case "0":
    		$('#rfc').mask('ZZZZ000000AAA',{translation:  {'Z': {pattern: /[a-zA-Z]/, recursive: true}}});
    		$("#rfc").val("");
        break;
    	case "1":
    		$('#rfc').mask('ZZZ000000AAA',{translation:  {'Z': {pattern: /[a-zA-Z]/, recursive: true}}});
        	$("#rfc").val("");
        break;
        case "2":
        	$('#rfc').mask('ZZZZ000000AAA',{translation:  {'Z': {pattern: /[a-zA-Z]/, recursive: true}}});
        	$("#rfc").val("XEXX010101000");
        break;
        case "3":
        	$('#rfc').mask('ZZZZ000000AAA',{translation:  {'Z': {pattern: /[a-zA-Z]/, recursive: true}}});
        	$("#rfc").val("XAXX010101000");
        	
        break;
		}
	});

	$("#newProvider").click(function(){
		$("#id_provider").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#rfc").val("");
		$("#name").val("");
		$("#name_commercial").val("");
		//aqui va lo de tipo
		$("#radio1").prop("checked",true);
		$("#radio2").prop("checked",false);
		$("#radio3").prop("checked",false);
		$("#radio4").prop("checked",false);
		$("#id_provider_category").val("");
		$("#id_provider_type").val("");
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
		$("#clave").attr('data-id' , '');
		$("#rfc").val("");
		$("#name").val("");
		$("#name_commercial").val("");
		$("#radio1").prop("checked",true);
		$("#radio2").prop("checked",false);
		$("#radio3").prop("checked",false);
		$("#radio4").prop("checked",false);
		$("#id_provider_category").val("");
		$("#id_provider_type").val("");
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
  			url: baseUrl+'/provider/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_provider").val(data.id_provider);
			$("#clave").val(data.clave);
			$("#clave").attr('data-id' , data.id_provider);
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
			$("#id_provider_category option[value="+data.id_provider_category+"]").attr('selected', 'selected');
			providerType(data.id_provider_type, true);
			$("#number_ext").val(data.number_ext);
			$("#number_int").val(data.number_int);
			$("#colony").val(data.colony);
			$("#city").val(data.city);
			$("#state").val(data.state);
			$("#country").val(data.country);
			$("#zip_code").val(data.zip_code);
			$("#phone").val(data.phone);
			$("#email").val(data.email);
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
    		
  		});
		$("#myModalProvider").modal();
	});

	function providerType(id, draw){
		$("#id_provider_type").empty();
		$("#id_provider_type").append(new Option("Seleccione", ""));
		if(id != ""){
			$.ajax({
  				url: baseUrl+'/provider-type/category/'+id,
			})
			/*.done(function() {console.log( "second success" );})*/
			.fail(function() {
    		console.log( "error" + data);
  			}).always(function(data) {
  				$.each(data, function(id,obj){
  					$("#id_provider_type").append(new Option(obj.clave, obj.id_provider_type));
  				});
  				if(draw)
  				$("#id_provider_type option[value="+id+"]").attr('selected', 'selected');
  			});
		}
	}
});
