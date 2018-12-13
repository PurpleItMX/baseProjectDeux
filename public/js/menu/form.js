$(document).ready(function(){

	$("#saveFormMenu").click(function(){
		$("#saveMenu").validate();
		if($("#saveMenu").valid()){
			$("#saveMenu").submit();
		}
	});

	$("#newMenu").click(function(){
		$("#id_menu").val("");
		$("#name").val("");
		$("#name").attr('data-id',"");
		$("#url").val("");
		$("#icono").val("");
		$("#id_parent").val("");
		$("#estatus").prop('checked',false);
    	$("#myModalMenu").modal();
	});

	$(".search-menu").click(function(){
		$("#id_menu").val("");
		$("#name").val("");
		$("#name").attr('data-id', "");
		$("#url").val("");
		$("#icono").val("");
		$("#id_parent").val("");
		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/menu/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function(error) {
    		messages("error","Ocurrio un error al realizar la cosnulta");
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_menu").val(data.id_menu);
  			$("#name").val(data.name);
  			$("#name").attr('data-id' , data.id_menu);
  			$("#url").val(data.url);
  			$("#icono").val(data.icono);
  			$("#id_parent").val(data.id_parent);
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalMenu").modal();
	});

});
