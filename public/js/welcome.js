$(document).ready(function(){

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
       	console.log('Esto es un dispositivo móvil');
    	window.location.replace("denied");
    }else{
        console.log('Computadora');

    }
     $("#myModalLogin").modal();
});