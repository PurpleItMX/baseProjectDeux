//var hideMenu = false;
$(document).ready(function(){

	baseUrl = $("#baseUrl").val();

    /*if(hideMenu == true){
        $('body').removeClass('sidebar-open');
        $('body').addClass('sidebar-collapse');
    }

    $("#buttonMenu").click(function(){
        hideMenu = true;
    })*/

    $("#ChangePassword").click(function(){
        $("#new-password").val("");
        $("#ChangePasswordModal").modal();
    });

    $("#saveChangePassword").click(function(){
        $("#saveChangePasswordForm").validate();
        if($("#saveChangePasswordForm").valid()){
            var id = $("#idUser").val();
            var password = $("#new-password").val();
            var token = $('input[name="_token"]').val();
            var controller = "user/reset-password";
            var data = {
                    "password": password,
                    "id": id,
                    "_token":token,
                    };
            $.ajax({
                type: "POST",
                data: data,
                url: baseUrl+'/'+controller,
            })
            /*.done(function() {console.log( "second success" );})*/
            .fail(function(error) {
                console.log( error );
                messages("error",error.message);
            }).always(function(data) {
                if(data == 1){
                    $("#ChangePasswordModal").modal('hide');
                    $("#new-password").val("");
                    messages("ok","Contraseña cambiada");
                }
            });
        }
    });
	
    $("#listTable").DataTable({    
        "lengthMenu": [[10], [10]],    
		"fixedColumns": true,
        "autoWidth": true,
        "responsive": true,
		"language": {
            "url": baseUrl+"/js/Spanish.json"
        },
	});

    //mask aqui se agregar para tener ordenado
    $('.zip_code').mask('00000');
    $('.number').mask('00000');
    $('.phone').mask('(000)-0000000');
    $('.cellphone').mask('000-0000000');

    //jquery validator
	jQuery.extend(jQuery.validator.messages, {
    	required: "Campo Requerido.",
    	//remote: "Please fix this field.",
    	email: "Formato de correo invalido.",
    	//url: "Please enter a valid URL.",
    	date: "Formato de fecha invalido.",
    	//dateISO: "Please enter a valid date (ISO).",
    	number: "Solo se permiten numeros.",
    	//digits: "Please enter only digits.",
    	//creditcard: "Please enter a valid credit card number.",
    	equalTo: "Las contraseñas deben ser iguales",
    	//accept: "Please enter a value with a valid extension.",
    	//maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    	minlength: jQuery.validator.format("La contraseña debe contener al menos {0} caracteres."),
    	//rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    	//range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    	//max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    	//min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
	});

    //valida que la fecha inicial se ha menor que la fecha final
    jQuery.validator.addMethod("greaterThan", 
        function(value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params).val());
        }
        return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val())); 
    },'La fecha final no puede ser menor o igual a la fecha inicial.');

    jQuery.validator.addMethod("repit", function(){
        return false;
    },"Valor previamente registrado"); 

    
	if($("#message").val() != ""){
        closeAlert();
		//messages($("#message").attr('data-type'), $("#message").val());
        //messages('info', "mensaheegehge");
	}

    //habilita el tootlip
	$('[data-toggle="tooltip"]').tooltip();

    $(".search").change(function(){
        if($(this).val() != ""){
            $(this).removeClass('repit');
            var id = $(this).attr('data-id');
            var that = $(this).attr('id');
            var val = $(this).val();
            var token = $('input[name="_token"]').val();
            var column = $(this).attr('name');
            var controller = $(this).attr('data-controller')+"/search";
            var data = {
                        "id": id,
                        "column": column,
                        "val": val,
                        "_token":token,
                    };
            $.ajax({
                type: "POST",
                data: data,
                url: baseUrl+'/'+controller,
            })
            /*.done(function() {console.log( "second success" );})*/
            .fail(function(error) {
                console.log( error );
                messages("error",error.message);
            }).always(function(data) {
                if(data.length !== 0){
                    $("#"+that).addClass('repit');
                }
            });
        }
    });
});

function messages(type, message){

    $("#message").append('<div id="messageAlert"><p></p></div>');
	switch(type) {
    	case 'ok':
    		$("#messageAlert").addClass('alert alert-success');
        break;
    	case 'error':
        	$("#messageAlert").addClass(' alert alert-danger');
        break;
        case 'warning':
        	$("#messageAlert").addClass('alert alert-warning');
        break;
        case 'info':
        	$("#messageAlert").addClass('alert alert-info');
        break;
    	default:
    	$("#messageAlert").addClass('alert alert-primary');
	}
    $("#messageAlert").find('p').text(message)
    $("#messageAlert").alert();

    closeAlert();
}

function closeAlert(){
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 6000);
}

function goBack() {
    window.history.back();
}
