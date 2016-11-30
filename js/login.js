var rootURL = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/login";

function formToJSON() {
	return JSON.stringify({
		"user": $('#user').val(),
		"password": $('#password').val()
		});
}

function login() {
	console.log(formToJSON());
	$.ajax({
		type: 'POST',
		contentType: 'application/json',
		url: rootURL,
		dataType: "json",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
			alert('Vino creado exitosamente');
			$('#btnBorrar').show();
			$('#Idvino').val(data.id);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error en la funcion agregaVino: ' + textStatus);
		}
	});
}
