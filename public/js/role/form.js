$(document).ready(function(){

	$("#saveFormRole").click(function(){
		$("#saveRole").validate();
		if($("#saveRole").valid()){
			$("#saveRole").submit();
		}
	});

	$("#newRole").click(function(){
		$("#id_role").val("");
		$("#name").val("");
		$("#name").attr('data-id' , '');
		$("#estatus").prop('checked',false);
    	$("#myModalRole").modal();
	});

	$(".search-role").click(function(){
		$("#id_role").val("");
		$("#name").val("");
		$("#name").attr('data-id' , '');
		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/role/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function(error) {
    		messages("error","Ocurrio un error al realizar la consulta");
  		}).always(function(data) {
  			$("#id_role").val(data.id_role);
  			$("#name").val(data.name);
  			$("#name").attr('data-id' , data.id_role);
  			if(data.status == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalRole").modal();
	});

});
