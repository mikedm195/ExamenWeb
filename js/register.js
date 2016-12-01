var rootURL = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/login";

function obtenerDatosCliente() {
	return {
            "nombre": $('#nombreCliente').val(),
            "apPaterno": $('#apPaternoCliente').val(),
            "apMaterno": $('#apMaternoCliente').val(),
            "foto": $('#fotoCliente').val(),
            "telefono": $('#telefonoCliente').val(),
            "membresia": $('#membresiaCliente').val(),
            "user": $('#userCliente').val(),
            "password": $('#passwordCliente').val(),
		};
}

function insertCliente() {
    var datos = obtenerDatosCliente();
    console.log(datos);
    if(datos.nombre && datos.apPaterno && datos.apMaterno && datos.user && datos.password){
        var d = JSON.stringify(datos);
    	$.ajax({
    		type: 'POST',
    		contentType: 'application/json',
    		url: "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/cliente",
    		dataType: "json",
    		data: d,
    		success: function(data, textStatus, jqXHR){

                window.location = "index.html";

    		},
    		error: function(jqXHR, textStatus, errorThrown){
    			alert('Error al agregar cliente: ' + textStatus);
    		}
    	});
    }else{
        alert("Llene los campos obligatorios");
    }
}
