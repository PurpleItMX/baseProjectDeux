$(document).ready(function(){

	$("#saveFormSeason").click(function(){
		$("#saveSeason").validate({
			rules: {
        		time_end: { greaterThan: "#time_initial" }
    		}
		});
		if($("#saveSeason").valid()){
			$("#saveSeason").submit();
		}
	});

	$("#newSeason").click(function(){
		$("#id_season").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#time_initial").val("");
		$("#time_end").val("");
		$("#estatus").prop('checked',false);
		$("#description").val("");
    	$("#myModalSeason").modal();
	});

	$(".search-season").click(function(){
		$("#id_supply_category").val("");
		$("#clave").val("");
		$("#clave").attr('data-id' , '');
		$("#time_initial").val("");
		$("#time_end").val("");
		$("#description").val("");
		$("#estatus").prop('checked',false);
		var id = $(this).attr('data-id');
		$.ajax({
  			url: baseUrl+'/season/'+id,
		})
		/*.done(function() {console.log( "second success" );})*/
    	.fail(function() {
    		console.log( "error" );
  		}).always(function(data) {
  			var dateInitial = new Date(data.time_initial);
  			var dateFinal = new Date(data.time_end);
  			$("#id_season").val(data.id_season);
  			$("#clave").val(data.clave);
  			$("#clave").attr('data-id' , data.id_season);
  			var monthInitial = dateInitial.getMonth() +1 ;
  			$("#time_initial").val(dateInitial.getFullYear()+"-"+monthInitial+"-"+dateInitial.getDate());
  			var monthEnd = dateInitial.getMonth() +1 ;
			$("#time_end").val(dateFinal.getFullYear()+"-"+monthInitial+"-"+dateFinal.getDate());
			$("#description").val(data.description);
  			if(data.estatus == 1)
    			$("#estatus").prop('checked',true);
  		});
		$("#myModalSeason").modal();
	});

});
