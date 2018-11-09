$(document).ready(function(){

	$("#saveFormSeason").click(function(){
		$("#saveSeason").validate();
		if($("#saveSeason").valid()){
			$("#saveSeason").submit();
		}
	});

});
