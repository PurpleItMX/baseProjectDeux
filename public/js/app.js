$(document).ready(function(){

	baseUrl = $("#baseUrl").val();
	$("#listTable").DataTable({
		"responsive": true,
		"language": {
            "url": "js/Spanish.json"
        },
	});

	$('.alert').alert();

	$('[data-toggle="tooltip"]').tooltip();
});

function goBack() {
    window.history.back();
}
