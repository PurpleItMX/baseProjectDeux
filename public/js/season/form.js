$(document).ready(function(){

	$("#saveFormSeason").click(function(){
		$("#saveSeason").validate();
		if($("#saveSeason").valid()){
			$("#saveSeason").submit();
		}
	});

	$("#newSeason").click(function(){
		$("#id_season").val("");
		$("#clave").val("");
		$("#time_initial").val("");
		$("#time_end").val("");
		$("#estatus").prop('checked',false);
    	$("#myModalSeason").modal();
	});

	$(".search-season").click(function(){
		$("#id_supply_category").val("");
		$("#clave").val("");
		$("#time_initial").val("");
		$("#time_end").val("");
		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/season/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			$("#id_season").val(data.id_season);
  			$("#clave").val(data.clave);
  			$("#time_initial").val(data.time_initial);
			$("#time_end").val(data.time_end);
  			if(data.estatus)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalSeason").modal();
	});

});
