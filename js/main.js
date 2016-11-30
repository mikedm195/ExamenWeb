
if(localStorage.getItem("session") != ''){
    $('#loginBtn').hide();
    $('#logoutBtn').show();
}else{
    $('#loginBtn').show();
    $('#logoutBtn').hide();
}

buscaCliente();
function logout(){
    localStorage.setItem("session", '');
}


function buscaCliente(){
    var url = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/cliente/" + localStorage.getItem("session");
    console.log(url);
    $.ajax({
		type: 'GET',
		url: url,
		dataType: "json",
		success: function(data, textStatus, jqXHR){
            var cliente = data;
            console.log(cliente);
            console.log(data);
            if(cliente){
                $('#nombreCliente').val(cliente.nombre);
            	$('#apPaternoCliente').val(cliente.apPaterno);
            	$('#apMaternoCliente').val(cliente.apMaterno);
            	$('#telefonoCliente').val(cliente.telefono);
            	$('#membresiaCliente').val(cliente.membresia);
                $('#userCliente').val(cliente.user);
            	$('#passwordCliente').val(cliente.password);
            }else{
                alert("Usuario y/o contraseña incorrectos");
            }
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error en la funcion getCliente: ' + textStatus);
		}
	});
}

function obtenerDatosCliente() {
	return JSON.stringify({
            "nombre": $('#nombreCliente').val(),
            "apPaterno": $('#apPaternoCliente').val(),
            "apMaterno": $('#apMaternoCliente').val(),
            "foto": $('#fotoCliente').val(),
            "telefono": $('#telefonoCliente').val(),
            "membresia": $('#membresiaCliente').val()
		});
}

function  actualizarCliente(){
    var url = "http://ubiquitous.csf.itesm.mx/~daw-1015019/content/ExamenWeb/api/index.php/cliente/" + localStorage.getItem("session");
    console.log('updateCliente');
	$.ajax({
		type: 'PUT',
		contentType: 'application/json',
		url: url,
		dataType: "json",
		data: obtenerDatosCliente(),
		success: function(data, textStatus, jqXHR){
			console.log('Cliente actualizado exitosamente');
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('Error en la funcion actualizaVino: ' + textStatus);
		}
	});
}
