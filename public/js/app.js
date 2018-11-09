$(document).ready(function(){
	$("#listTable").DataTable({
		"responsive": true,
		"language": {
            "url": "js/Spanish.json"
        },
	});
});

function goBack() {
    window.history.back();
}