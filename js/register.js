var rootURL = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/login";

function obtenerDatosCliente() {
	return JSON.stringify({
            "nombre": $('#nombreCliente').val(),
            "apPaterno": $('#apPaternoCliente').val(),
            "apMaterno": $('#apMaternoCliente').val(),
            "foto": $('#fotoCliente').val(),
            "telefono": $('#telefonoCliente').val(),
            "membresia": $('#membresiaCliente').val(),
            "user": $('#userCliente').val(),
            "password": $('#passwordCliente').val(),
		});
}

function insertCliente() {

	$.ajax({
		type: 'POST',
		contentType: 'application/json',
		url: rootURL,
		dataType: "json",
		data: obtenerDatosCliente(),
		success: function(data, textStatus, jqXHR){

            window.location = "index.html";

		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error al agregar cliente: ' + textStatus);
		}
	});
}
